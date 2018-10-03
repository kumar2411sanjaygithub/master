<?php

namespace App\Common;

use App\AccountStatement;

use App\Basicinformation;

use App\User;

class FinancialFunctions
{
  public static function getoutstandingbalace($client_id){
      $outstandings=AccountStatement::where('client_id',$client_id)->orderBy("date",'ASC')->get();
      $opening_amount=0; $debit=0;  $credit=0;
      foreach($outstandings as $outstanding){
        if($outstanding['trans_type']=='OPEN-BAL'){
            $opening_amount=$outstanding['amount'];
        }
        else if($outstanding['trans_mode']=='DEBIT'){
            $debit+=$outstanding['amount'];
        }
        else if($outstanding['trans_mode']=='CREDIT'){
            $credit+=$outstanding['amount'];
        }
      }
      $total=($opening_amount+$debit)-$credit;
      return $total;
  }

  public static function validatebidtime($user_id){
    $user_id = User::where(["id"=>1])->first();
    switch(true){
      case ($user_id->member_type=="ADMIN"):
      case ($user_id->member_type=="TRADER"):
        return  $bidallowedperiod="12:00";
        break;
      case ($user_id->member_type=="CLIENT"):
        $timeperiod = Basicinformation::where('client_id',$user_id->client_id)->select('submission_time')->first();
        return $bidallowedperiod = ($timeperiod->count()>0)?$timeperiod->submission_time:'12:00';
        break;
      default:
        Auth::logout();
        return redirect('/login');
    }
  }


  public static function getIntFinancialYear($date)
  {
      $date = str_replace("/","-",$date);
      $date = str_replace(".","-",$date);
      $date = strtotime($date);
      $year = date('Y',$date);
      return (date('m',$date) > 3) ? $year.($year +1) : ($year -1).$year;
  }


  /**** Converitng  amount to words for bill *****/
  public static function getIndianCurrency($amount){

      $decimal = round($amount - ($no = floor($amount)), 2) * 100;
      $hundred = null;
      $digits_length = strlen($no);
      $i = 0;
      $str = array();
      $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
      $digits = array('', 'hundred','thousand','lakh', 'crore');
      while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $amount = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($amount) {
          $plural = (($counter = count($str)) && $amount > 9) ? 's' : null;
          $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
          $str [] = ($amount < 21) ? $words[$amount].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($amount / 10) * 10].' '.$words[$amount % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
      }
      $Rupees = implode('', array_reverse($str));
      $paise = ($decimal) ?  ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
      return ($Rupees ? $Rupees . 'Rupees ' : '') ."". " ".$paise." "."Only";

  }
  public function db_format($date){
     return date('Y-m-d', strtotime(str_replace('/','-',$date)));
  }
  public function view_format($date){
     return date('d-m-Y', strtotime(str_replace('/','-',$date)));
  }
}
