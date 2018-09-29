<?php

namespace App\Http\Controllers;
// use Illuminate\Routing\UrlGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Client;
use App\Placebid;
use PHPExcel;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use PHPExcel_Chart_DataSeriesValues;
use PHPExcel_Chart_DataSeries;
use PHPExcel_Chart_PlotArea;
use PHPExcel_Chart_Legend;
use PHPExcel_Chart_Title;
use PHPExcel_Chart;
use PHPExcel_IOFactory;
use Excel;
use App\Exchange;
use Validator;
use App\IexObligationImported;
use App\Bill;
use App\AccountStatement;
use App\PsmApproval;
use  App\Common\Bid;
use App\Basicinformation;
use App\Validationsetting;


class DownloadbidController extends Controller
{
    //  protected $url;

    // public function __construct(UrlGenerator $url)
    // {
    //     $this->url = $url;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadbid()
    {
      $date = date("Y-m-d",strtotime("+1 day", strtotime(date("Y-m-d"))));
        $bidData = DB::table('place_bid')
            ->selectRaw('place_bid.bid_date,place_bid.order_no,client.cin as cin_no,place_bid.client_id,client.company_name,client.iex_portfolio,sum(bid_price) as sum')
            ->rightjoin('clients as client', 'place_bid.client_id', '=', 'client.id')
            ->groupBy('client_id')
            ->where('place_bid.status', '1')
            ->where('place_bid.bid_date', $date)
            ->WhereNull('deleted_at')
            ->get();


        return view('dam.iex.downloadbid.downloadbid',compact('bidData','date'));
    }



    public function downloadbidexcel($type, $bid_type, $order_no,$date,$client_id)
    {

        // echo DB::enableQueryLog();

          /**
            * Block Bid Excel Download
            */

            // $date = date("Y-m-d",strtotime("+1 day", strtotime(date("Y-m-d"))));
            if($bid_type == 'block'){

                      // DB::enableQueryLog();
                      $bidData = DB::table('place_bid')
                          ->join('clients', 'place_bid.client_id', '=', 'clients.id')
                          ->select('place_bid.*')
                          ->where('place_bid.status', '1')
                          ->where('place_bid.bid_type', $bid_type)
                          ->where('place_bid.bid_date','=', $date)
                          ->where('place_bid.client_id','=',$client_id)
                          ->where('place_bid.psm_status','1')
                          ->whereNull('deleted_at')
                          ->orderBy('time_slot_from','DESC')
                          ->get();
                          $bidPrice = DB::table('place_bid')
                              ->join('clients', 'place_bid.client_id', '=', 'clients.id')
                              ->select('place_bid.*')
                              ->where('place_bid.status', '1')
                              ->where('place_bid.bid_type', $bid_type)
                              ->where('place_bid.bid_date','=', $date)
                              ->where('place_bid.client_id','=',$client_id)
                              ->where('place_bid.psm_status','1')
                              ->whereNull('deleted_at')
                              ->get();

                return Excel::create($order_no, function($excel) use ($bidData) {
                    $excel->sheet('sheet', function($sheet) use ($bidData)
                    {

                         $sheet->setCellValue('A1', 'W2MH0TPT0000');
                         $sheet->setCellValue('B1', 'TPT01');
                         $sheet->setCellValue('C1', 'S1TG0TPT0170');
                         $sheet->setCellValue('D1', 'INDIA');
                         $i=2;
                         foreach ($bidData as $key => $value) {
                             $sheet->setCellValue('A'.$i, trim($value->time_slot_from));
                             $sheet->setCellValue('B'.$i, trim($value->time_slot_to));
                             $sheet->setCellValue('C'.$i, trim($value->bid_price));
                             $sheet->setCellValue('D'.$i, trim($value->bid_action=='sell' ? '-'.$value->bid_mw : $value->bid_mw));
                             $i++;
                         }
                        // $sheet->fromArray($data);
                    });
                })->store('csv', storage_path('excel/exports/blockbids/'))->download('csv');
            }

            if($bid_type == 'single'){

              // DB::enableQueryLog();
              $bidData = DB::table('place_bid')
                  ->join('clients', 'place_bid.client_id', '=', 'clients.id')
                  ->selectRaw('place_bid.*')
                  ->where('place_bid.status', '1')
                  ->where('place_bid.bid_date','=', $date)
                  ->where('place_bid.client_id','=',$client_id)
                  ->orderBy('bid_price','DESC')
                  ->whereNull('deleted_at')
                  ->get()->toArray();


              // return Excel::create($order_no, function($excel) use ($bidData) {

                $bidformatted_array=array();


                   $n=0;
                  foreach($bidData as  $biddingarray){
                    $startTime = new \DateTime($biddingarray->time_slot_from);
                    $endTime = new \DateTime($biddingarray->time_slot_to);
                    $duration = $startTime->diff($endTime); //$duration is a DateInterval object
                    $time = explode(':',$duration->format("%H:%I:%S"));
                    $timeslot =(($time[0]*60) + ($time[1]) + ($time[2]/60))/15;
                    $timefromslot = $biddingarray->time_slot_from;
                    $timetoslot = date('H:i:s',strtotime('+15 minutes',strtotime($timefromslot)));
                    $bidData[$n]->timecount=$timeslot;
                    $n++;

                    for($c=1;$c<=$timeslot;$c++){
                      if(strtotime($timetoslot)<=strtotime($biddingarray->time_slot_to)){
                      $bdata = array();
                      $bdata['id'] = $c;
                      $bdata['bid_date'] = $biddingarray->bid_date;
                      $bdata['bid_id'] = $biddingarray->id;
                      $bdata['time_slot_from'] = $timefromslot;
                      $bdata['time_slot_to'] = $timetoslot;
                      $bdata['bid_mw']= ($biddingarray->bid_action=='buy')?$biddingarray->bid_mw:(-$biddingarray->bid_mw);
                      $bdata['bid_price'] = $biddingarray->bid_price;
                      $bdata['bid_action'] = $biddingarray->bid_action;
                      $timetoslot = date('H:i:s',strtotime('+30 minutes',strtotime($timefromslot)));
                      $timefromslot = date('H:i:s',strtotime('+15 minutes',strtotime($timefromslot)));
                      $bidformatted_array=array_merge($bidformatted_array,array($bdata));
                    }
                    }
                  }



                  // $excel->sheet('sheet', function($sheet) use ($bidData,$bidformatted_array)
                  // {

                       // $sheet->setCellValue('A1', 'W2MH0TPT0000');
                       // $sheet->setCellValue('B1', 'TPT01');
                       // $sheet->setCellValue('C1', 'S1TG0TPT0170');
                       // $sheet->setCellValue('D1', 'INDIA');
                       $i=2;

                       $timeslice=$this->gettimeslice1();

                       $j=0; $array_time=array(); $price_column='C';
                       // $sheet->setCellValue($price_column.'2',0);
                       for($i=0;$i<(count($timeslice))-1;$i++){
                         $cell=$i+3;
                         // $sheet->setCellValue('A'.$cell,$timeslice[$j]);
                         $from = date('H:i:s',strtotime($timeslice[$j]));
                         $j=$j+1;
                         // $sheet->setCellValue('B'.$cell,$timeslice[$j]);
                         $to = date('H:i:s',strtotime($timeslice[$j]));
                       foreach ($bidformatted_array as $key => $value) {

                         if($value['time_slot_from']==$from){
                           if(!in_array($value['bid_price'],$array_time)){
                              if($value['bid_price']){
                                $array_time[]=$value['bid_price'];

                              }

                           }
                           if($value['bid_action']=='buy'){
                           if(!in_array($value['bid_price']+1,$array_time)){
                              if($value['bid_price']){
                                  $array_time[]=$value['bid_price']+1;

                              }
                           }
                         }else{
                           if(!in_array($value['bid_price']-1,$array_time)){
                              if($value['bid_price']){
                                  $array_time[]=$value['bid_price']-1;

                              }
                           }
                         }


                         }


                           // $sheet->setCellValue('A'.$i, trim($value->time_slot_from));
                           // $sheet->setCellValue('B'.$i, trim($value->time_slot_to));
                           // $sheet->setCellValue('C'.$i, trim($value->bid_price));
                           // $sheet->setCellValue('D'.$i, trim($value->bid_action=='sell' ? '-'.$value->bid_mw : $value->bid_mw));
                           // $i++;

                       }
                       }


                       $price_column_array=array();
                       $price_column_array['C']=0;
                       sort($array_time);
                       foreach($array_time as $time){
                       $price_column++;
                       // $sheet->setCellValue($price_column.'2',$time);
                       $price_column_array[$price_column]=$time;
                       }
                       $price_column++;
                       // $sheet->setCellValue($price_column.'2',20000);
                       $price_column_array[$price_column]=20000;


                        $array_values = array_values($price_column_array);
                        $array_keys = array_keys($price_column_array);
                        $cell=2;



                       // for($i=0;$i<(count($timeslice))-1;$i++){
                       //   $cell++;
                       //   foreach($price_column_array  as $keyname => $keydata ){
                       //        $sheet->setCellValue($keyname.$cell,0);
                       //  }
                       //
                       //  // $sheet_price_array=array();
                       //  // $startkey=3;
                       //  // foreach($price_column_array as $arra){
                       //  //   $sheet_price_array[$startkey] = $arra;
                       //  //   $startkey++;
                       //  // }
                       //
                       //
                       //
                       //      $settedvalue=array();
                       //     foreach ($bidformatted_array as $key => $value) {
                       //
                       //
                       //        $from = date('H:i:s',strtotime($timeslice[$i]));
                       //       if($value['time_slot_from']==$from){
                       //         $array=array();
                       //         $array_fitted = array_search($value['bid_price'],$array_values);
                       //
                       //         if($value['bid_action']=='buy'){
                       //         for($j=$array_fitted;$j>=0;$j--){
                       //           if(@$locked[$array_values[$j]]){  break; }
                       //           // print_r($cell); die();
                       //
                       //           // if($this->canfilldata($value['id'],$bidformatted_array,'buy',$value['time_slot_from'],$value['time_slot_to'],$array_values[$j],$value['bid_id'],$value['bid_price'],$array_keys[$j].$cell)){
                       //           //  $settedvalue[$array_keys[$j].$cell] = (@$settedvalue[$array_keys[$j].$cell])?$settedvalue[$array_keys[$j].$cell]:0;
                       //           //   $sheet->setCellValue($array_keys[$j].$cell,($value['bid_mw']+$settedvalue[$array_keys[$j].$cell]));
                       //           //   $settedvalue[$array_keys[$j].$cell]=$value['bid_mw'];
                       //           // }
                       //
                       //
                       //              }
                       //           }else{
                       //             $m=0;
                       //          for($j=$array_fitted;$j<=count($array_keys)-1;$j++){
                       //
                       //           if($this->canfilldata($value['id'],$bidformatted_array,'sell',$value['time_slot_from'],$value['time_slot_to'],$array_values[$j],$value['bid_id'],$value['bid_price'],$array_keys[$j].$cell)){
                       //               // print_r($cell); die();
                       //               if(@$locked[$array_values[$j]]){  break; }
                       //                 $settedvalue[$array_keys[$j].$cell] = (@$settedvalue[$array_keys[$j].$cell])?(-$settedvalue[$array_keys[$j].$cell]):0;
                       //                 $sheet->setCellValue($array_keys[$j].$cell,(-$value['bid_mw']+$settedvalue[$array_keys[$j].$cell]));
                       //                 $settedvalue[$array_keys[$j].$cell]=$value['bid_mw'];
                       //               }
                       //                  }
                       //
                       //             // $sheet->setCellValue($array_keys[$j].$cell,$bidData[$key]->bid_mw);
                       //           }
                       //           // $locked[$value['bid_price']]=1;
                       //       }
                       //     }
                       //
                       // }

                      // $sheet->fromArray($data);
                      $a = '00:00,00:15,00:30,00:45,01:00,01:15,01:30,01:45,02:00,02:15,02:30,02:45,03:00,03:15,03:30,03:45,04:00,04:15,04:30,04:45,05:00,05:15,05:30,05:45,06:00,06:15,06:30,06:45,07:00,07:15,07:30,07:45,08:00,08:15,08:30,08:45,09:00,09:15,09:30,09:45,10:00,10:15,10:30,10:45,11:00,11:15,11:30,11:45,12:00,12:15,12:30,12:45,13:00,13:15,13:30,13:45,14:00,14:15,14:30,14:45,15:00,15:15,15:30,15:45,16:00,16:15,16:30,16:45,17:00,17:15,17:30,17:45,18:00,18:15,18:30,18:45,19:00,19:15,19:30,19:45,20:00,20:15,20:30,20:45,21:00,21:15,21:30,21:45,22:00,22:15,22:30,22:45,23:00,23:15,23:30,23:45,24:00';

                      $timeslice = explode(",", $a);
                      $new_bid_data=array();
                      foreach($bidData as $bid)
                      {

                          for($i=0;$i<$bid->timecount;$i++)
                          {
                              $new_bid = clone $bid;
                              $m=(int) ((15*$i)%60);
                              $h=(int) ((15*$i)/60);
                              $new_bid->time_slot_from = date('H:i:s',strtotime('+'.$h.' hours +'.$m.' minutes',strtotime($bid->time_slot_from)));
                              $new_bid->time_slot_to = date('H:i:s',strtotime('+15 minute',strtotime($new_bid->time_slot_from)));
                              $new_bid->timecount=1;
                              $new_bid_data[]=$new_bid;
                          }
                      }
                      $timeslot_wise_bid_data=array();
                      for($i=0;$i<96;$i++)
                      {
                          foreach($new_bid_data as $key=>$value)
                          {
                              if($timeslice[$i].":00" == $value->time_slot_from)
                              {
                                  $timeslot_wise_bid_data[$i][] = $value;
                              }
                          }
                      }



                      //To get unique price value

                      //dd($timeslot_wise_bid_data);
                      $j=0;
                      $array_time=array();
                      $price_column='C';
                      $sheet = array();
                      for($i=0;$i<(count($timeslice))-1;$i++){
                          $cell=$i+3;
                          $sheet['A'][$cell] = $timeslice[$j];
                          $from = date('H:i:s',strtotime($timeslice[$j]));
                          $j=$j+1;
                          $sheet['B'][$cell] = $timeslice[$j];
                          $to = date('H:i:s',strtotime($timeslice[$j]));
                          foreach ($bidData as $key => $value) {
                              if($bidData[$key]->time_slot_from==$from){
                                  if(!in_array($bidData[$key]->bid_price,$array_time)){
                                      if($bidData[$key]->bid_price){
                                          $array_time[]=$bidData[$key]->bid_price;

                                      }

                                  }

                                  if($bidData[$key]->bid_action=='buy'){
                                      if(!in_array($bidData[$key]->bid_price+1,$array_time)){
                                          if($bidData[$key]->bid_price){
                                              $array_time[]=$bidData[$key]->bid_price+1;

                                          }
                                      }
                                  }else{
                                      if(!in_array($bidData[$key]->bid_price-1,$array_time)){
                                          if($bidData[$key]->bid_price){
                                              $array_time[]=$bidData[$key]->bid_price-1;

                                          }
                                      }
                                  }
                              }



                              // $sheet->setCellValue('A'.$i, trim($value->time_slot_from));
                              // $sheet->setCellValue('B'.$i, trim($value->time_slot_to));
                              // $sheet->setCellValue('C'.$i, trim($value->bid_price));
                              // $sheet->setCellValue('D'.$i, trim($value->bid_action=='sell' ? '-'.$value->bid_mw : $value->bid_mw));
                              // $i++;

                          }
                      }
                      $price_column_array=array();
                      $price_column_array['C']=0;
                      sort($array_time);
                      foreach($array_time as $time){
                          $price_column++;
                          $sheet[$price_column]['2'] = $time;
                          $price_column_array[$price_column]=$time;
                      }
                      $price_column++;
                      $sheet[$price_column]['2'] = 20000;
                      $price_column_array[$price_column]=20000;

                      $array_values = array_values($price_column_array);
                      $array_keys = array_keys($price_column_array);
                      // print_r($array_values);

                      $pre_sheetdata = array();
                      $data_lock=array();
                      for($i=0;$i<96;$i++)
                      {
                          if(isset($timeslot_wise_bid_data[$i])){
                              foreach($timeslot_wise_bid_data[$i] as $k=>$value)
                              {
                                  foreach($array_keys as $ak=>$av)
                                  {
                                      if(!isset($pre_sheetdata[$i][$av]) || $pre_sheetdata[$i][$av] == 0)
                                      {
                                          if($array_values[$ak] == $value->bid_price)
                                          {
                                              $pre_sheetdata[$i][$av] = ($value->bid_action=='buy')? $value->bid_mw : "-".$value->bid_mw;
                                          }
                                          else{
                                              $pre_sheetdata[$i][$av]=0;
                                          }
                                      }
                                      elseif(($array_values[$ak] == $value->bid_price) && ($pre_sheetdata[$i][$av] <> 0) && ($value->bid_action=='buy') && $this->gmp_sign((int)$pre_sheetdata[$i][$av])==1)
                                      {
                                          $pre_sheetdata[$i][$av]+=$value->bid_mw;
                                      }
                                      elseif(($array_values[$ak] == $value->bid_price) && ($pre_sheetdata[$i][$av] <> 0) && ($value->bid_action=='sell') && $this->gmp_sign((int)$pre_sheetdata[$i][$av])==-1)
                                      {
                                          $pre_sheetdata[$i][$av]-=$value->bid_mw;
                                      }
                                  }
                              }
                          }
                          else
                          {
                              foreach($array_keys as $key)
                              {
                                  $pre_sheetdata[$i][$key]=0;
                              }
                          }
                      }

                      foreach($pre_sheetdata as $key=>$value)
                      {
                          $pre_sheetdata[$key]['A']=$timeslice[$key];
                          $pre_sheetdata[$key]['B']=$timeslice[$key+1];
                          $afv = array_filter(array_values($value));
                          $afk = array_keys($afv);
                          $x=0;
                          if(!empty($afv)){
                            foreach($afv as $k=>$v)
                            {
                                if($this->gmp_sign((int)round($v))==1){
                                    $e = isset($afk[$x-1])?$afk[$x-1]+1:0;
                                    for($ch=$e; $ch<=$afk[$x];$ch++)
                                    {
                                        $new_col = chr(ord('C')+$ch);
                                        $pre_sheetdata[$key][$new_col]=$v;
                                    }
                                }
                                elseif($this->gmp_sign((int)round($v))==-1){
                                    $e = isset($afk[$x+1])?$afk[$x+1]-1:count($value)-1;
                                    for($ch=$afk[$x]; $ch<=$e;$ch++)
                                    {
                                        $new_col = chr(ord('C')+$ch);
                                        $pre_sheetdata[$key][$new_col]=$v;
                                    }
                                }
                                $x++;
                             }
                          }
                          ksort($pre_sheetdata[$key]);
                      }

                      $client_details['A']='W2MH0TPT0000';
                      $client_details['B']='TPT0';
                      $client_details['C']='S1TG0TPT0170';
                      $client_details['D']='INDIA';
                      $price_column_array['A']='';
                      $price_column_array['B']='';
                      ksort($price_column_array);
                      $pre_sheetdata = array_merge([$client_details, $price_column_array], $pre_sheetdata);
                      $this->generateCSV($pre_sheetdata,$client_id);
                  // });
              // })->store('csv', storage_path('excel/exports/singlebids'))->download('csv');


            }
    }



    function cmp($a, $b) {
        if ($a->time_slot_from == $b->time_slot_from) {
            return 0;
        }
        return ($a->time_slot_from < $b->time_slot_from) ? -1 : 1;
    }

      function gmp_sign($n){
        return ($n>0)-($n<0);
      }

    function generateCSV($pre_sheetdata,$client_id){
      Excel::create('singlebids_'.$client_id, function($excel) use ($pre_sheetdata) {
       $excel->sheet('sheet', function($sheet) use ($pre_sheetdata)
       {
         foreach($pre_sheetdata as $row => $sheetrows){
           foreach($sheetrows as $column => $rowcolumndata){
             $sheet->setCellValue($column.($row+1), trim($rowcolumndata));
           }
         }

       });
      })->store('csv', storage_path('excel/exports/singlebids'))->download('csv');
      }

    public function canfilldata($id,$array,$type,$from_array,$to_array,$value,$bid_id,$bid_value,$cell){
   //    foreach($array as $array_data){
   //
   //      if($type=='buy'){
   //      if(($array_data['bid_id']!=$bid_id)&&$array_data['type']='buy'&&($array_data['time_slot_from']==$from_array)&&($array_data['time_slot_to']==$to_array)&&($array_data['bid_price']>$value)){
   //        return 0;
   //      } }else{
   //      if(($array_data['bid_id']!=$bid_id)&&$array_data['type']='sell'&&($array_data['time_slot_from']==$from_array)&&($array_data['bid_price']<$value)){
   //        return 0;
   //      }
   //      }
   // }
   // return 1;
   if($bid_id=='629'){

     foreach($array as $array_data){

     }
     print($bid_value); echo "<br>";
   }
 }

    public function downloadallbidexcelzip($date){

      $bidusers = DB::table('place_bid')
          ->selectRaw('client_id')
          ->join('clients', 'place_bid.client_id', '=', 'clients.id')
          ->groupBy('client_id')
          ->where('place_bid.status', '1')
          ->whereNull('deleted_at')
          // ->where('place_bid.bid_date', $date)
          ->get();


      foreach($bidusers as $user){

      $bidData = DB::table('place_bid')
          ->join('clients', 'place_bid.client_id', '=', 'clients.id')
          ->select('place_bid.*')
          ->where('place_bid.status', '1')
          ->where('place_bid.bid_date','=', $date)
          ->whereNull('deleted_at')
          ->orderBy('time_slot_from','DESC')
          ->get();

          $bidPrice = DB::table('place_bid')
              ->join('clients', 'place_bid.client_id', '=', 'clients.id')
              ->select('place_bid.*')
              ->where('place_bid.status', '1')
              ->where('place_bid.bid_date','=', $date)
              ->whereNull('deleted_at')
              ->get();

   Excel::create('blockbids_'.$user->client_id, function($excel) use ($bidData) {
    $excel->sheet('sheet', function($sheet) use ($bidData)
    {

         $sheet->setCellValue('A1', 'W2MH0TPT0000');
         $sheet->setCellValue('B1', 'TPT01');
         $sheet->setCellValue('C1', 'S1TG0TPT0170');
         $sheet->setCellValue('D1', 'INDIA');
         $i=2;
         foreach ($bidData as $key => $value) {
             $sheet->setCellValue('A'.$i, trim($value->time_slot_from));
             $sheet->setCellValue('B'.$i, trim($value->time_slot_to));
             $sheet->setCellValue('C'.$i, trim($value->bid_price));
             $sheet->setCellValue('D'.$i, trim($value->bid_action=='sell' ? '-'.$value->bid_mw : $value->bid_mw));
             $i++;
         }
        // $sheet->fromArray($data);
    });
})->store('csv', storage_path('excel/exports/allbids/'));





      // Excel::create('singlebids', function($excel) use ($bidData) {
      //     $excel->sheet('sheet', function($sheet) use ($bidData)
      //     {
      //
      //          $sheet->setCellValue('A1', 'W2MH0TPT0000');
      //          $sheet->setCellValue('B1', 'TPT01');
      //          $sheet->setCellValue('C1', 'S1TG0TPT0170');
      //          $sheet->setCellValue('D1', 'INDIA');
      //          $i=2;
      //
      //          $timeslice=$this->gettimeslice1();
      //
      //          $j=0; $array_time=array(); $price_column='C';
      //          $sheet->setCellValue($price_column.'2',0);
      //          for($i=0;$i<(count($timeslice))-1;$i++){
      //            $cell=$i+3;
      //            $sheet->setCellValue('A'.$cell,$timeslice[$j]);
      //            $from = date('H:i:s',strtotime($timeslice[$j]));
      //            $j=$j+1;
      //            $sheet->setCellValue('B'.$cell,$timeslice[$j]);
      //            $to = date('H:i:s',strtotime($timeslice[$j]));
      //          foreach ($bidData as $key => $value) {
      //            if($bidData[$key]->time_slot_from==$from){
      //              if(!in_array($bidData[$key]->bid_price,$array_time)){
      //                 if($bidData[$key]->bid_price){
      //                   $array_time[]=$bidData[$key]->bid_price;
      //                 }
      //              }
      //              if($bidData[$key]->bid_action=='buy'){
      //              if(!in_array($bidData[$key]->bid_price+1,$array_time)){
      //                 if($bidData[$key]->bid_price){
      //                     $array_time[]=$bidData[$key]->bid_price+1;
      //
      //                 }
      //              }
      //            }else{
      //              if(!in_array($bidData[$key]->bid_price-1,$array_time)){
      //                 if($bidData[$key]->bid_price){
      //                     $array_time[]=$bidData[$key]->bid_price-1;
      //
      //                 }
      //              }
      //            }
      //
      //
      //            }
      //
      //
      //              // $sheet->setCellValue('A'.$i, trim($value->time_slot_from));
      //              // $sheet->setCellValue('B'.$i, trim($value->time_slot_to));
      //              // $sheet->setCellValue('C'.$i, trim($value->bid_price));
      //              // $sheet->setCellValue('D'.$i, trim($value->bid_action=='sell' ? '-'.$value->bid_mw : $value->bid_mw));
      //              // $i++;
      //
      //          }
      //          }
      //          $price_column_array=array();
      //          $price_column_array['C']=0;
      //          sort($array_time);
      //          foreach($array_time as $time){
      //          $price_column++;
      //          $sheet->setCellValue($price_column.'2',$time);
      //          $price_column_array[$price_column]=$time;
      //          }
      //          $price_column++;
      //          $sheet->setCellValue($price_column.'2',20000);
      //          $price_column_array[$price_column]=20000;
      //
      //
      //           $array_values = array_values($price_column_array);
      //           $array_keys = array_keys($price_column_array);
      //           $cell=2;
      //          for($i=0;$i<(count($timeslice))-1;$i++){
      //            $cell++;
      //            foreach($price_column_array  as $keyname => $keydata ){
      //                 $sheet->setCellValue($keyname.$cell,0);
      //           }
      //
      //              foreach ($bidData as $key => $value) {
      //
      //                 $from = date('H:i:s',strtotime($timeslice[$i]));
      //                if($bidData[$key]->time_slot_from==$from){
      //                  $array=array();
      //
      //                  $array_fitted = array_search($bidData[$key]->bid_price,$array_values);
      //
      //                  if($bidData[$key]->bid_action=='buy'){
      //                  for($j=$array_fitted;$j>=0;$j--){
      //                    if(@$locked[$array_values[$j]]){  break; }
      //                    // print_r($cell); die();
      //                      $sheet->setCellValue($array_keys[$j].$cell,($bidData[$key]->bid_mw));
      //                       }
      //                    }else{
      //                      $m=0;
      //                      for($j=$array_fitted;$j<=count($array_keys)-1;$j++){
      //                        // print_r($cell); die();
      //                        if(@$locked[$array_values[$j]]){  break; }
      //                          $sheet->setCellValue($array_keys[$j].$cell,-($bidData[$key]->bid_mw));
      //                           }
      //
      //                      // $sheet->setCellValue($array_keys[$j].$cell,$bidData[$key]->bid_mw);
      //                    }
      //                    $locked[$bidData[$key]->bid_price]=1;
      //                }
      //              }
      //
      //          }
      //
      //         // $sheet->fromArray($data);
      //
      //     });
      // })->store('csv', storage_path('excel/exports/allbids'));


      $bidformatted_array=array();


         $n=0;
        foreach($bidData as  $biddingarray){
          $startTime = new \DateTime($biddingarray->time_slot_from);
          $endTime = new \DateTime($biddingarray->time_slot_to);
          $duration = $startTime->diff($endTime); //$duration is a DateInterval object
          $time = explode(':',$duration->format("%H:%I:%S"));
          $timeslot =(($time[0]*60) + ($time[1]) + ($time[2]/60))/15;
          $timefromslot = $biddingarray->time_slot_from;
          $timetoslot = date('H:i:s',strtotime('+15 minutes',strtotime($timefromslot)));
          $bidData[$n]->timecount=$timeslot;
          $n++;

          for($c=1;$c<=$timeslot;$c++){
            if(strtotime($timetoslot)<=strtotime($biddingarray->time_slot_to)){
            $bdata = array();
            $bdata['id'] = $c;
            $bdata['bid_date'] = $biddingarray->bid_date;
            $bdata['bid_id'] = $biddingarray->id;
            $bdata['time_slot_from'] = $timefromslot;
            $bdata['time_slot_to'] = $timetoslot;
            $bdata['bid_mw']= ($biddingarray->bid_action=='buy')?$biddingarray->bid_mw:(-$biddingarray->bid_mw);
            $bdata['bid_price'] = $biddingarray->bid_price;
            $bdata['bid_action'] = $biddingarray->bid_action;
            $timetoslot = date('H:i:s',strtotime('+30 minutes',strtotime($timefromslot)));
            $timefromslot = date('H:i:s',strtotime('+15 minutes',strtotime($timefromslot)));
            $bidformatted_array=array_merge($bidformatted_array,array($bdata));
          }
          }
        }



        // $excel->sheet('sheet', function($sheet) use ($bidData,$bidformatted_array)
        // {

             // $sheet->setCellValue('A1', 'W2MH0TPT0000');
             // $sheet->setCellValue('B1', 'TPT01');
             // $sheet->setCellValue('C1', 'S1TG0TPT0170');
             // $sheet->setCellValue('D1', 'INDIA');
             $i=2;

             $timeslice=$this->gettimeslice1();

             $j=0; $array_time=array(); $price_column='C';
             // $sheet->setCellValue($price_column.'2',0);
             for($i=0;$i<(count($timeslice))-1;$i++){
               $cell=$i+3;
               // $sheet->setCellValue('A'.$cell,$timeslice[$j]);
               $from = date('H:i:s',strtotime($timeslice[$j]));
               $j=$j+1;
               // $sheet->setCellValue('B'.$cell,$timeslice[$j]);
               $to = date('H:i:s',strtotime($timeslice[$j]));
             foreach ($bidformatted_array as $key => $value) {

               if($value['time_slot_from']==$from){
                 if(!in_array($value['bid_price'],$array_time)){
                    if($value['bid_price']){
                      $array_time[]=$value['bid_price'];

                    }

                 }
                 if($value['bid_action']=='buy'){
                 if(!in_array($value['bid_price']+1,$array_time)){
                    if($value['bid_price']){
                        $array_time[]=$value['bid_price']+1;

                    }
                 }
               }else{
                 if(!in_array($value['bid_price']-1,$array_time)){
                    if($value['bid_price']){
                        $array_time[]=$value['bid_price']-1;

                    }
                 }
               }


               }


                 // $sheet->setCellValue('A'.$i, trim($value->time_slot_from));
                 // $sheet->setCellValue('B'.$i, trim($value->time_slot_to));
                 // $sheet->setCellValue('C'.$i, trim($value->bid_price));
                 // $sheet->setCellValue('D'.$i, trim($value->bid_action=='sell' ? '-'.$value->bid_mw : $value->bid_mw));
                 // $i++;

             }
             }


             $price_column_array=array();
             $price_column_array['C']=0;
             sort($array_time);
             foreach($array_time as $time){
             $price_column++;
             // $sheet->setCellValue($price_column.'2',$time);
             $price_column_array[$price_column]=$time;
             }
             $price_column++;
             // $sheet->setCellValue($price_column.'2',20000);
             $price_column_array[$price_column]=20000;


              $array_values = array_values($price_column_array);
              $array_keys = array_keys($price_column_array);
              $cell=2;



             // for($i=0;$i<(count($timeslice))-1;$i++){
             //   $cell++;
             //   foreach($price_column_array  as $keyname => $keydata ){
             //        $sheet->setCellValue($keyname.$cell,0);
             //  }
             //
             //  // $sheet_price_array=array();
             //  // $startkey=3;
             //  // foreach($price_column_array as $arra){
             //  //   $sheet_price_array[$startkey] = $arra;
             //  //   $startkey++;
             //  // }
             //
             //
             //
             //      $settedvalue=array();
             //     foreach ($bidformatted_array as $key => $value) {
             //
             //
             //        $from = date('H:i:s',strtotime($timeslice[$i]));
             //       if($value['time_slot_from']==$from){
             //         $array=array();
             //         $array_fitted = array_search($value['bid_price'],$array_values);
             //
             //         if($value['bid_action']=='buy'){
             //         for($j=$array_fitted;$j>=0;$j--){
             //           if(@$locked[$array_values[$j]]){  break; }
             //           // print_r($cell); die();
             //
             //           // if($this->canfilldata($value['id'],$bidformatted_array,'buy',$value['time_slot_from'],$value['time_slot_to'],$array_values[$j],$value['bid_id'],$value['bid_price'],$array_keys[$j].$cell)){
             //           //  $settedvalue[$array_keys[$j].$cell] = (@$settedvalue[$array_keys[$j].$cell])?$settedvalue[$array_keys[$j].$cell]:0;
             //           //   $sheet->setCellValue($array_keys[$j].$cell,($value['bid_mw']+$settedvalue[$array_keys[$j].$cell]));
             //           //   $settedvalue[$array_keys[$j].$cell]=$value['bid_mw'];
             //           // }
             //
             //
             //              }
             //           }else{
             //             $m=0;
             //          for($j=$array_fitted;$j<=count($array_keys)-1;$j++){
             //
             //           if($this->canfilldata($value['id'],$bidformatted_array,'sell',$value['time_slot_from'],$value['time_slot_to'],$array_values[$j],$value['bid_id'],$value['bid_price'],$array_keys[$j].$cell)){
             //               // print_r($cell); die();
             //               if(@$locked[$array_values[$j]]){  break; }
             //                 $settedvalue[$array_keys[$j].$cell] = (@$settedvalue[$array_keys[$j].$cell])?(-$settedvalue[$array_keys[$j].$cell]):0;
             //                 $sheet->setCellValue($array_keys[$j].$cell,(-$value['bid_mw']+$settedvalue[$array_keys[$j].$cell]));
             //                 $settedvalue[$array_keys[$j].$cell]=$value['bid_mw'];
             //               }
             //                  }
             //
             //             // $sheet->setCellValue($array_keys[$j].$cell,$bidData[$key]->bid_mw);
             //           }
             //           // $locked[$value['bid_price']]=1;
             //       }
             //     }
             //
             // }

            // $sheet->fromArray($data);



            $a = '00:00,00:15,00:30,00:45,01:00,01:15,01:30,01:45,02:00,02:15,02:30,02:45,03:00,03:15,03:30,03:45,04:00,04:15,04:30,04:45,05:00,05:15,05:30,05:45,06:00,06:15,06:30,06:45,07:00,07:15,07:30,07:45,08:00,08:15,08:30,08:45,09:00,09:15,09:30,09:45,10:00,10:15,10:30,10:45,11:00,11:15,11:30,11:45,12:00,12:15,12:30,12:45,13:00,13:15,13:30,13:45,14:00,14:15,14:30,14:45,15:00,15:15,15:30,15:45,16:00,16:15,16:30,16:45,17:00,17:15,17:30,17:45,18:00,18:15,18:30,18:45,19:00,19:15,19:30,19:45,20:00,20:15,20:30,20:45,21:00,21:15,21:30,21:45,22:00,22:15,22:30,22:45,23:00,23:15,23:30,23:45,24:00';

            $timeslice = explode(",", $a);
            $new_bid_data=array();
            foreach($bidData as $bid)
            {

                for($i=0;$i<$bid->timecount;$i++)
                {
                    $new_bid = clone $bid;
                    $m=(int) ((15*$i)%60);
                    $h=(int) ((15*$i)/60);
                    $new_bid->time_slot_from = date('H:i:s',strtotime('+'.$h.' hours +'.$m.' minutes',strtotime($bid->time_slot_from)));
                    $new_bid->time_slot_to = date('H:i:s',strtotime('+15 minute',strtotime($new_bid->time_slot_from)));
                    $new_bid->timecount=1;
                    $new_bid_data[]=$new_bid;
                }
            }
            $timeslot_wise_bid_data=array();
            for($i=0;$i<96;$i++)
            {
                foreach($new_bid_data as $key=>$value)
                {
                    if($timeslice[$i].":00" == $value->time_slot_from)
                    {
                        $timeslot_wise_bid_data[$i][] = $value;
                    }
                }
            }



            //To get unique price value

            //dd($timeslot_wise_bid_data);
            $j=0;
            $array_time=array();
            $price_column='C';
            $sheet = array();
            for($i=0;$i<(count($timeslice))-1;$i++){
                $cell=$i+3;
                $sheet['A'][$cell] = $timeslice[$j];
                $from = date('H:i:s',strtotime($timeslice[$j]));
                $j=$j+1;
                $sheet['B'][$cell] = $timeslice[$j];
                $to = date('H:i:s',strtotime($timeslice[$j]));
                foreach ($bidData as $key => $value) {
                    if($bidData[$key]->time_slot_from==$from){
                        if(!in_array($bidData[$key]->bid_price,$array_time)){
                            if($bidData[$key]->bid_price){
                                $array_time[]=$bidData[$key]->bid_price;

                            }

                        }

                        if($bidData[$key]->bid_action=='buy'){
                            if(!in_array($bidData[$key]->bid_price+1,$array_time)){
                                if($bidData[$key]->bid_price){
                                    $array_time[]=$bidData[$key]->bid_price+1;

                                }
                            }
                        }else{
                            if(!in_array($bidData[$key]->bid_price-1,$array_time)){
                                if($bidData[$key]->bid_price){
                                    $array_time[]=$bidData[$key]->bid_price-1;

                                }
                            }
                        }


                    }



                    // $sheet->setCellValue('A'.$i, trim($value->time_slot_from));
                    // $sheet->setCellValue('B'.$i, trim($value->time_slot_to));
                    // $sheet->setCellValue('C'.$i, trim($value->bid_price));
                    // $sheet->setCellValue('D'.$i, trim($value->bid_action=='sell' ? '-'.$value->bid_mw : $value->bid_mw));
                    // $i++;

                }
            }
            $price_column_array=array();
            $price_column_array['C']=0;
            sort($array_time);
            foreach($array_time as $time){
                $price_column++;
                $sheet[$price_column]['2'] = $time;
                $price_column_array[$price_column]=$time;
            }
            $price_column++;
            $sheet[$price_column]['2'] = 20000;
            $price_column_array[$price_column]=20000;

            $array_values = array_values($price_column_array);
            $array_keys = array_keys($price_column_array);
            // print_r($array_values);

            $pre_sheetdata = array();
            $data_lock=array();
            for($i=0;$i<96;$i++)
            {
                if(isset($timeslot_wise_bid_data[$i])){
                    foreach($timeslot_wise_bid_data[$i] as $k=>$value)
                    {
                        foreach($array_keys as $ak=>$av)
                        {
                            if(!isset($pre_sheetdata[$i][$av]) || $pre_sheetdata[$i][$av] == 0)
                            {
                                if($array_values[$ak] == $value->bid_price)
                                {
                                    $pre_sheetdata[$i][$av] = ($value->bid_action=='buy')? $value->bid_mw : "-".$value->bid_mw;
                                }
                                else{
                                    $pre_sheetdata[$i][$av]=0;
                                }
                            }
                            elseif(($array_values[$ak] == $value->bid_price) && ($pre_sheetdata[$i][$av] <> 0) && ($value->bid_action=='buy') && $this->gmp_sign((int)$pre_sheetdata[$i][$av])==1)
                            {
                                $pre_sheetdata[$i][$av]+=$value->bid_mw;
                            }
                            elseif(($array_values[$ak] == $value->bid_price) && ($pre_sheetdata[$i][$av] <> 0) && ($value->bid_action=='sell') && $this->gmp_sign((int)$pre_sheetdata[$i][$av])==-1)
                            {
                                $pre_sheetdata[$i][$av]-=$value->bid_mw;
                            }
                        }
                    }
                }
                else
                {
                    foreach($array_keys as $key)
                    {
                        $pre_sheetdata[$i][$key]=0;
                    }
                }
            }

            foreach($pre_sheetdata as $key=>$value)
            {
                $pre_sheetdata[$key]['A']=$timeslice[$key];
                $pre_sheetdata[$key]['B']=$timeslice[$key+1];
                $afv = array_filter(array_values($value));
                $afk = array_keys($afv);
                $x=0;
                if(!empty($afv)){
                  foreach($afv as $k=>$v)
                  {
                      if($this->gmp_sign((int)round($v))==1){
                          $e = isset($afk[$x-1])?$afk[$x-1]+1:0;
                          for($ch=$e; $ch<=$afk[$x];$ch++)
                          {
                              $new_col = chr(ord('C')+$ch);
                              $pre_sheetdata[$key][$new_col]=$v;
                          }
                      }
                      elseif($this->gmp_sign((int)round($v))==-1){
                          $e = isset($afk[$x+1])?$afk[$x+1]-1:count($value)-1;
                          for($ch=$afk[$x]; $ch<=$e;$ch++)
                          {
                              $new_col = chr(ord('C')+$ch);
                              $pre_sheetdata[$key][$new_col]=$v;
                          }
                      }
                      $x++;
                   }
                }
                ksort($pre_sheetdata[$key]);
            }

            $client_details['A']='W2MH0TPT0000';
            $client_details['B']='TPT0';
            $client_details['C']='S1TG0TPT0170';
            $client_details['D']='INDIA';
            $price_column_array['A']='';
            $price_column_array['B']='';
            ksort($price_column_array);
            $pre_sheetdata = array_merge([$client_details, $price_column_array], $pre_sheetdata);
            Excel::create('singlebids_'.$user->client_id, function($excel) use ($pre_sheetdata) {
             $excel->sheet('sheet', function($sheet) use ($pre_sheetdata)
             {
               foreach($pre_sheetdata as $row => $sheetrows){
                 foreach($sheetrows as $column => $rowcolumndata){
                   $sheet->setCellValue($column.($row+1), trim($rowcolumndata));
                 }
               }

             });
            })->store('csv', storage_path('excel/exports/allbids'));
            }

            // $this->generateCSV($pre_sheetdata);
        // });
    // })->store('csv', storage_path('excel/exports/singlebids'))->download('csv');

        // Define Dir Folder
        // $public_dir=public_path();
        // Zip File Name
            $zipFileName = 'allbidzipped.zip';
          // Create ZipArchive Obj
          
            $directories = glob(storage_path("/excel/exports/allbids/*.csv"));
            // $directories=str_replace("/","\\",$directories);
            $filetopath=storage_path('/downloads/'.$zipFileName);
            
            try {
                $zip = new \ZipArchive;
                if($zip->open($filetopath,\ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true)
                {
                   throw new \Exception("Unable to create zip file.");
                }
                // Add File in ZipArchive
                foreach($directories as $directory){
                  if ($zip->addFile($directory, basename($directory))) {
                      continue;
                  } else {
                      throw new \Exception("Unable to add ".basename($directory).": ".$zip->getStatusString());
                  }
                }
                if ($zip->close()) {
                    if(file_exists($filetopath)){
                      $headers = array(
                          'Content-Type' => 'application/octet-stream',
                      );
                      return response()->download($filetopath,$zipFileName,$headers);
                    }
                    else{
                       throw new \Exception("Zip File Not Found.");
                    }
                } else {
                    throw new \Exception("Unable to close zip file: " . $zip->getStatusString());
                }
            }
            catch(\Exception $ex) {
                return back()->withErrors(["Opps! Zip creation failed. ".$ex->getMessage()]);
            }
    }




    function getNextBidDate() {
        return date("Y-m-d", strtotime(date("Y-m-d") . ' + 1 days'));
    }

    function gettimeslice1() {
        $a = '00:00,00:15,00:30,00:45,01:00,01:15,01:30,01:45,02:00,02:15,02:30,02:45,03:00,03:15,03:30,03:45,04:00,04:15,04:30,04:45,05:00,05:15,05:30,05:45,06:00,06:15,06:30,06:45,07:00,07:15,07:30,07:45,08:00,08:15,08:30,08:45,09:00,09:15,09:30,09:45,10:00,10:15,10:30,10:45,11:00,11:15,11:30,11:45,12:00,12:15,12:30,12:45,13:00,13:15,13:30,13:45,14:00,14:15,14:30,14:45,15:00,15:15,15:30,15:45,16:00,16:15,16:30,16:45,17:00,17:15,17:30,17:45,18:00,18:15,18:30,18:45,19:00,19:15,19:30,19:45,20:00,20:15,20:30,20:45,21:00,21:15,21:30,21:45,22:00,22:15,22:30,22:45,23:00,23:15,23:30,23:45,24:00';

        return explode(",", $a);
    }


    function getPriceListForExcel($data) {

    }

    public function FunctionName($value='')
    {

        $priceArray = array();
        $priceArrayFinal = array();
        $priceArraySuperFinal = array();


        for ($i = 0; isset($singleBidArray[$i]); $i++) {
            if ($singleBidArray[$i][3] > 0) {
                $priceArray[$i] = $singleBidArray[$i][2];
            } else {
                $priceArray[$i] = $singleBidArray[$i][2] * -1;
            }
        }

        $priceArrayFinal = array_values(array_unique($priceArray));

        sort($priceArrayFinal);

        // Make Main Price Array
        $priceArraySuperFinal[] = 0;
        for ($i = 0; isset($priceArrayFinal[$i]); $i++) {
            if ($priceArrayFinal[$i] < 0) {
                $priceArraySuperFinal[] = (abs($priceArrayFinal[$i]) - 1);
                $priceArraySuperFinal[] = abs($priceArrayFinal[$i]);
            } else {
                $priceArraySuperFinal[] = $priceArrayFinal[$i];
                 if(($priceArrayFinal[$i] + 1)<=20000){
                $priceArraySuperFinal[] = $priceArrayFinal[$i] + 1;
                }
            }
        }
        $priceArraySuperFinal[] = 20000;

        $PriceArrayForFillUp = array();


        $priceArraySuperFinal = array_values(array_unique($priceArraySuperFinal));
        sort($priceArraySuperFinal);
        foreach ($priceArraySuperFinal as $key => $value) {
            $PriceArrayForFillUp[] = abs($value);
        }
        $priceArraySuperFinal = array_values(array_unique($PriceArrayForFillUp));

        $checkArray = array();
        //End of Make Main Price Array
        $list = array(array($machinDetail[0], $machinDetail[1], $clientArray[$m][1], 'INDIA'));
        $list[] = array_merge(array("", ""), $priceArraySuperFinal);
        $csvFileName = $filename . "/" . $clientArray[$m][1] . "_SB.csv";
        $csvTempFileName = $clientArray[$m][1] . "_SB.csv";
        $myNewJson = '{"myJson":[';
        for ($i = 0; $i <= count($timeslice) - 2; $i++) {

            $lastValue = "";
            $lastAshishIndex = 0;
            $myNewJson.='{"FromTime":"' . trim($timeslice[$i]) . '",';
            $myNewJson.='"toTime":"' . trim($timeslice[$i + 1]) . '",';
            $myNewJson.='"values":[';
            for ($j = 0; isset($priceArraySuperFinal[$j]); $j++) {

                $checkArray[] = abs($priceArraySuperFinal[$j]);
                $myValue = get_price_bid_value($singleBidArray, $timeslice[$i], $timeslice[$i + 1], $priceArraySuperFinal[$j]);
                $myNewJson.='{"price":"' . trim($priceArraySuperFinal[$j]) . '",';
                $myNewJson.='"pricevalue":"' . $myValue . '"},';
            }
            $myNewJson = substr($myNewJson, 0, -1) . "]},";
        }
        $myNewJson = substr($myNewJson, 0, -1) . "]}";
        $myJsonDecoded = json_decode($myNewJson);
// echo "<pre>";
//
//                    print_r($myJsonDecoded);
//                    echo "</pre>";
//                    exit();
        for ($i = 0; $i < count($myJsonDecoded->myJson); $i++) {

            $my = array();
            $blankArray = array();
            $my[] = $myJsonDecoded->myJson[$i]->FromTime;
            $my[] = $myJsonDecoded->myJson[$i]->toTime;
            $blankArray[] = $myJsonDecoded->myJson[$i]->FromTime;
            $blankArray[] = $myJsonDecoded->myJson[$i]->toTime;
            $BlankHint = 0;
            for ($j = 0; $j < count($myJsonDecoded->myJson[$i]->values); $j++) {
                $my[] = $myJsonDecoded->myJson[$i]->values[$j]->pricevalue;
                $blankArray[]="";
                if(abs($myJsonDecoded->myJson[$i]->values[$j]->pricevalue)!=0){
                    $BlankHint=1;
                }
            }
            if($BlankHint==1){
                $list[] = $my;
            }else{
                $list[] = $blankArray;
            }

        }
    }

    public function downloadbidtemplateexcel(Request $request){
      // dd($request);

      $clientname = Client::select('*')->where("id",$request['userselected'])->get()->first();

      $data['company_name']=$clientname['company_name'];
      $data['delivery_date']=$request['deliverydate'];
      $data['company_id']=$request['userselected'];
      $path = 'storage/bid/BID_2018_05_23_n1hr0tpt1000.xlsx';
      $data['exchange']=(@$clientname['iex_portfolio'])?$clientname['iex_portfolio']:'';
      // dd($data);
      Excel::load($path, function($file) use($data)
      {
        $date = str_replace('/', '-', $data['delivery_date']);
        $biddate = date('d',  strtotime($date));
        $file->getActiveSheet()->setCellValue('E3', $data['company_name']);
        $file->getActiveSheet()->setCellValue('AB3', date('d',  strtotime($date)));
        $file->getActiveSheet()->setCellValue('AC3', date('F',  strtotime($date)));
        $file->getActiveSheet()->setCellValue('C2', strtoupper($data['exchange']));
      })->download('xlsx');
    }




    public function uploadbidtemplateexcel(Request $request){
     $validator = Validator::make([], []);
      $file = $request->file('uploadedexcel');



    //File Name
    $filename=$file->getClientOriginalName();

    $fileextension=$file->getClientOriginalExtension();


    if($fileextension!='xlsx'&&$fileextension!='xls'){
      $validator->getMessageBag()->add('filetype', 'Invalid File type');
      return redirect()->back()
                      ->withErrors($validator->getMessageBag());
 }
    //Move Uploaded File

    $destinationPath = storage_path('upload');
    $file->move($destinationPath,$file->getClientOriginalName());
    $filepath=$destinationPath.'/'.$file->getClientOriginalName();
//     Excel::load($filepath, function ($reader) {
//
//      $reader->each(function($sheet) {
//          $sheetData = $sheet->toArray(null, true, true, true);
//          print_r($sheetData);
//      });
// });

       $records = \Excel::load($filepath);

       $sheetData = $records->getActiveSheet()->toArray(null, true, true, true);
        $noc=0; $ppa=0; $psm=0; $exchange=0;
       if($sheetData[2]["C"]){
            $exchangeusertemp=DB::table('clients')
                 ->selectRaw('id,bid_cut_off_time as bid_submission_time')
                 ->where('iex_portfolio',trim($sheetData[2]["C"]))
                 ->first();

            // $exchangeusertemp = Exchange::with(['validationsetting'=>function($query){
            //   $query->with(['clients'=>function($query){
            //     $query->selectRaw("id,bid_cut_off_time as bid_submission_time");
            //   }]);
            // }])->where("portfolio_id",trim($sheetData[2]["C"]))->get()->first();


            if($exchangeusertemp){
              // $noc=(@$exchangeusertemp['validationsetting']['noc'])?1:0;
              // $ppa=(@$exchangeusertemp['validationsetting']['ppa'])?1:0;
              // $psm=(@$exchangeusertemp['validationsetting']['psm'])?1:0;
              // $exchange=(@$exchangeusertemp['validationsetting']['exchange'])?1:0;
              $noc=1;
              $ppa=1;
              $psm=1;
              $exchange=1;
            }else{
              $validator->getMessageBag()->add('User_id', 'UserID not found! Check Excel Sheet');
              return redirect()->back()->withErrors($validator->getMessageBag());
            }
       }
       else{
         $validator->getMessageBag()->add('Portfolio_id', 'PortfolioID not found! Check Excel Sheet');
         return redirect()->back()->withErrors($validator->getMessageBag());
       }

       $client_id = $exchangeusertemp->id;

       $blocked = Client::selectRaw("iex_status")->where("id",$client_id)->first();
       if($blocked->blocked){
             $validator->getMessageBag()->add('account', 'Your account is blocked');
             return redirect()->back()->withErrors($validator->getMessageBag());
       }

       $checkType = trim($sheetData[4]["C"]);

       $basicinfo = Client::selectRaw("trader_type as power_trade_type")->where("id",$client_id)->first();

       if((strtoupper($basicinfo->power_trade_type) != strtoupper($checkType))&&(strtoupper($basicinfo->power_trade_type) != 'BOTH')){
           $validator->getMessageBag()->add('Tradetype', 'Your power trade type is set to '.strtolower($basicinfo->power_trade_type));
           return redirect()->back()->withErrors($validator->getMessageBag());
       }

       if($this->validate_user_status($client_id,'iex')){
         $validator->getMessageBag()->add('Tradetype', "Client's Iex status is Blocked");
         return redirect()->back()->withErrors($validator->getMessageBag());
       }

       if ($sheetData[3]["AB"] == "" || $sheetData[3]["AC"] == "") {
         $validator->getMessageBag()->add('Date', 'No Bid-Date found! Check Excel Sheet');
         return redirect()->back()->withErrors($validator->getMessageBag());
       }
       $portfolio_id=$sheetData[2]["C"];
       $BidExcel_date = array($sheetData[3]["AB"], $sheetData[3]["AC"]);
       $year=Date('Y');
       $BidDate = $BidExcel_date[0] . '-' . $BidExcel_date[1] . '-' . $year;
       $formattedBidDate = date('Y-m-d',strtotime($BidDate));
       $BidDate = date('Y-m-d',strtotime($BidDate));


       if (strtotime($BidDate) < strtotime($this->getNextBidDate())) {
         $validator->getMessageBag()->add('Date', 'Invalid Bid-Date found! Check Excel Sheet');
         return redirect()->back()->withErrors($validator->getMessageBag());
       }
       $bidsubmissiontime = $exchangeusertemp->bid_submission_time;
      // if(strtotime(date("H:i:s")) > strtotime($bidsubmissiontime)){
      //   $validator->getMessageBag()->add('Date', 'You Cant save New bid after '.date('H:s A',strtotime($bidsubmissiontime)).' of Today Date! Check Excel Sheet');
      //   return redirect()->back()->withErrors($validator->getMessageBag());
      //  }
       $BidType = explode(" ", trim($sheetData[6]["E"]));

        if((strtoupper(trim($BidType[1])) != "SINGLE")&&(strtoupper(trim($BidType[1])) != "BLOCK")) {
           $validator->getMessageBag()->add('Bidtype', 'Invalid Bid type! Check Excel-Sheet');
           return redirect()->back()->withErrors($validator->getMessageBag());
       }
       if (!strtoupper(trim($checkType)) == "BUY" && !strtoupper(trim($checkType)) == "SELL") {
           $validator->getMessageBag()->add('Checktype', 'Please select type of bid! Check Excel-Sheet');
           return redirect()->back()->withErrors($validator->getMessageBag());
       }

       // *******************START***********************
        // | Validation setting for Exchange, NOC and PPA 
        // ***********************************************
        $validationSetting = Validationsetting::where('user_id',$client_id)->get()->first();
        if($validationSetting){
            //Exchange Validation setting and Exchange expire
            if($validationSetting->exchange=='Exchange'){
                $exchangeData = DB::table('exchange')
                  ->select('exchange.*')
                  ->where('exchange.client_id',$client_id)
                  ->where('exchange.ex_type','iex')
                  ->whereRaw("exchange.validity_from <="."'".date('Y-m-d',strtotime('-1 day', strtotime($formattedBidDate)))."'")
                  ->whereRaw("exchange.validity_to >="."'".date('Y-m-d',strtotime('-1 day', strtotime($formattedBidDate)))."'")
                  ->first();
                if(empty($exchangeData)){
                    $msg = 'Your Exchange has been expired or not uploaded. Please contact Trader Admin';
                    return response()->json(['status' => '1', 'msg'=>$msg],400);
                }
            }
            //NOC Setting and validation
            if($validationSetting->noc=='NOC'){
                $nocData = Noc::selectRaw('*')
                    ->where('client_id',$client_id)
                    ->whereRaw("validity_from <="."'".$formattedBidDate."'")
                    ->whereRaw("validity_to >="."'".$formattedBidDate."'")
                    ->where('noc_type',strtolower($checkType))
                    ->first();
                if(empty($nocData)){
                    $msg = 'Your NOC has been expired or not uploaded. Please contact Trader Admin';
                    return response()->json(['status' => '1', 'msg'=>$msg],400);
                }
                // else{
                //     $nocData = Noc::select('*')
                //                 ->where('client_id',$client_id)
                //                 ->where('exchange','iex')
                //                 ->where('noc_type',strtolower($checkType))
                //                 ->whereRaw("validity_from <="."'".$formattedBidDate."'")
                //                 ->whereRaw("validity_to >="."'".$formattedBidDate."'")
                //                 ->first();
                //     if($nocData->noc_quantum < $totalMwFinal){
                //         $msg = 'You cannot place bid more than your maximum NOC quantum. Your maximum NOC quantum is set to '.strtoupper($nocData->noc_quantum).' for '.$request->input('bid_action').' trade type.';
                //         return response()->json(['status' => '1', 'msg'=>$msg],400);
                //     }
                // }
            }
            //PPA Setting and validation
            if($validationSetting->ppa=='PPA'){
                $ppaData = DB::table('ppa_details')
                    ->select('validity_from','validity_to')
                    ->where('client_id',$client_id)
                    ->whereRaw("validity_from <="."'".$formattedBidDate."'")
                    ->whereRaw("validity_to >="."'".$formattedBidDate."'")
                    ->first();
                if(empty($ppaData)){
                    $msg = 'Your PPA has been expired or not uploaded. Please contact Trader Admin';
                    return response()->json(['status' => '1', 'msg'=>$msg],400);
                }
            }
        }
        // ***********************************************
        // | Validation setting for Exchange, NOC and PPA
        // ********************END************************
       // if($noc){

       //   $nocDetail=$this->validate_noc($exchangeusertemp['client_id'], $formattedBidDate, "iex", strtolower($checkType));

       //    if($nocDetail== "FALSE"){
       //      $validator->getMessageBag()->add('NOC', 'Your NOC has been expired ! Check Excel-Sheet');
       //      return redirect()->back()->withErrors($validator->getMessageBag());
       //    }
       // }
       // if($ppa){
       //   if(!$this->validate_ppa($exchangeusertemp['client_id'], $formattedBidDate)){
       //     $validator->getMessageBag()->add('ppa', 'Your PPA has been expired ! Check Excel-Sheet');
       //     return redirect()->back()->withErrors($validator->getMessageBag());
       //   }
       // }
       // if($exchange){
       //   if(!$this->validate_exchange($exchangeusertemp['client_id'],'iex', $formattedBidDate)){
       //     $validator->getMessageBag()->add('Exchange_reg', 'Your Exchange Registration has been expired ! Check Excel-Sheet');
       //     return redirect()->back()->withErrors($validator->getMessageBag());
       //   }
       // }
       $isBarredHint=0;


      // $nocDetailAr = explode("~", $nocDetail);
      $biddt = date("ymd",strtotime($BidDate));
      $biduniqueid = $this->generatebidUniqueid($client_id.$biddt);
//                $g->deleteQuery("DELETE FROM `$table_name` WHERE `client_id`='" . $client_id . "' AND `date`='" . $BidDate . "' and `type`='IEX' and `btype`='$checkType'");
      // $query = "INSERT INTO `$table_name` ( `client_id`, `type`, `date`, `blockfrom`, `blockto`, `price`, `bid`, `btype`,`biduniqueid`,`staff_id`,`login_type`) VALUES ";
        $totalBidArray = array(); $bidplaced = 0;
      for ($k = 6; trim($sheetData[$k]["AB"]) !== ''; $k++) {
        if(@$sheetData[$k]["AC"]){
          $hint = 2;
          if ($sheetData[$k]["AD"] < 0 || $sheetData[$k]["AD"] > 20000) {
            $validator->getMessageBag()->add('bidding_price', 'Bidding Price for slot" . $sheetData[$k]["AB"] . "is not between 100 - 20,000 ! Check Excel-Sheet');
            return redirect()->back()->withErrors($validator->getMessageBag());
          }


          if (strtoupper(trim($BidType[1])) == "BLOCK") {
              if (abs($sheetData[$k]["AE"]) < 0.01 || abs($sheetData[$k]["AE"]) > 100) {
                  $validator->getMessageBag()->add('bidding_price', 'Bidding quantum for slot'. $sheetData[$k]["AB"] . 'is not between 0.01 - 100 ! Check Excel-Sheet');
                  return redirect()->back()->withErrors($validator->getMessageBag());
              }
          }
          $quantumExcel = abs($sheetData[$k]["AE"]);
          if ($checkType == "SELL") {
              $quantumExcel = $quantumExcel * -1;
          }

          $totalBidArray[] = array($this->time_formate($sheetData[$k]["AB"]), $this->time_formate($sheetData[$k]["AC"]), $sheetData[$k]["AD"], $quantumExcel);
          $fromTime = $this->time_formate($sheetData[$k]["AB"]);
          $toTime = $this->time_formate($sheetData[$k]["AC"]);
          $timeslice = $this->gettimeslice1();

          if (!in_array($fromTime, $timeslice)) {
            $validator->getMessageBag()->add('invalid_block', 'Invalid Block List.Please correct and Upload again ! Check Excel-Sheet');
            return redirect()->back()->withErrors($validator->getMessageBag());
          }
          if (!in_array($toTime, $timeslice)) {
            $validator->getMessageBag()->add('invalid_block', 'Invalid Block List.Please correct and Upload again ! Check Excel-Sheet');
            return redirect()->back()->withErrors($validator->getMessageBag());
          }
          /********19-04-2017**********/
          if ($toTime < $fromTime) {
            $validator->getMessageBag()->add('invalid_block', 'Invalid Block List.Please correct and Upload again ! Check Excel-Sheet');
            return redirect()->back()->withErrors($validator->getMessageBag());
          }

          // $query = "INSERT INTO `$table_name` ( `client_id`, `type`, `date`, `blockfrom`, `blockto`, `price`, `bid`, `btype`,`biduniqueid`,`staff_id`,`login_type`) VALUES ";
          $bidplaced=1;
          $placebid = new Placebid();
          $placebid->exchange = "iex";
          $placebid->trading = "power";
          // $placebid->exchange = $request->input('exchange');
          $placebid->client_id = $client_id;
          $placebid->bid_date = $BidDate;
          $placebid->bid_type = strtolower($BidType[1]);
          $placebid->bid_action = strtolower($checkType);
          $placebid->time_slot_from = $fromTime;
          $placebid->time_slot_to = $toTime;
          $placebid->bid_mw = $sheetData[$k]["AE"];
          $placebid->bid_price = $sheetData[$k]["AD"];
          $placebid->status = '0';
          if($isBarredHint){
            $placebid->psm_status = '0';
          }

        }


      if(@$nocDetailAr){
        $compareQuantum = $this->compareBidQuantumWithNocQuantum($checkType, trim($BidType[1]), $timeslice, $nocDetailAr, $totalBidArray);
       // exit;
        if ($compareQuantum == "FALSE") {

          $validator->getMessageBag()->add('quantum_exceed', 'Your Bidding Quantum Excedding from Noc Quantum . Check Excel-Sheet');
          return redirect()->back()->withErrors($validator->getMessageBag());
        }
      }
      $ValidateMsg = $this->ValidateBid($timeslice, $totalBidArray, $checkType, trim($BidType[1]));
      if ($ValidateMsg <> "TRUE") {
        $validator->getMessageBag()->add('something_wrong ', 'Something Wrong with bid count..! Check Excel-Sheet');
        return redirect()->back()->withErrors($validator->getMessageBag());
      }
      $placebid->save();
      }
      if(!$bidplaced){
        $validator->getMessageBag()->add('bidding_quantity', 'Please select atleast one bid before uploading');
        return redirect()->back()->withErrors($validator->getMessageBag());
      }



      $msg = "Bid Placed Successfully";
      if($psm){
          if(strtolower($checkType)=='buy'){
         $isBarredHint=$this->validate_psm($exchangeusertemp['client_id'],$portfolio_id,'iex', $formattedBidDate);
      }
    }

      if($isBarredHint==1){
        $msg .= " But Your PSM amount is low";
      }else if($isBarredHint==2){
        $msg .= " But Your PSM is not available";
      }

      return redirect()->back()->with('success',$msg);
    }


    function compareBidQuantumWithNocQuantum($bType, $type, $timeslice, $nocDetailAr, $totalBidArray) {
      $total=0;
      if(strtolower($type)=='single'){
          foreach($totalBidArray as $array){
              if($nocDetailAr[1]<$array[3]){
                return "FALSE";
              }
          }
      }else{
        foreach($totalBidArray as $array){
            $total+=$array[3];
        }
        if($total>$nocDetailAr[1]){
            return "FALSE";
        }
      }
      return "TRUE";
}

function ValidateBid($timeslice, $totalBidArray, $btype, $bidtype) {
      if(strtolower($btype)!='single'){
          if(count($totalBidArray)>=60){
              return "FALSE";
          }else{
            return "TRUE";
          }
      }
}

    public function validate_noc($client_id, $BidDate, $exchange_type, $checkType){



      $data=DB::table('noc_registration')
                 ->selectRaw('id,noc_type,noc_quantum,MAX(final_noc_quantum)')
                 ->where('client_id',$client_id)
                 ->where('exchange',$exchange_type)
                 ->where('noc_type',$checkType)
                 ->whereRaw("validity_from <="."'".$BidDate."'")
                 ->whereRaw("validity_to >="."'".$BidDate."'")
                 ->first();

                 if($data->id){
                    return "TRUE~" . $data->noc_quantum;
                  }else{
                    return "FALSE";
                  }
    }
    public function validate_ppa($client_id, $BidDate){

      $ppaData = DB::table('ppa_details')
      ->select('validity_from','validity_to')
      ->where('client_id',$client_id)
      ->whereRaw("validity_from <="."'".$BidDate."'")
      ->whereRaw("validity_to >="."'".$BidDate."'")
      ->first();
      return $ppaData;
    }

    public function validate_psm($client_id,$portfolio_id,$exchange_type, $BidDate){
      $psmapprovalaccept = PsmApproval::where('client_id',$client_id)->where('status',1)->whereDate('psm_date',$BidDate)->get()->first();
      if(!$psmapprovalaccept){
          if($exchange_type){
            if($this->getpsmamount($client_id)){
              $obligation=$this->getfullobgdetails($client_id,$portfolio_id,$exchange_type, $BidDate);
              $totalAmtFinal=$this->getinvoiceamount($client_id,$portfolio_id,$exchange_type, $BidDate);
              $outstandingBalance=$this->getoutstandingbalace($client_id,$portfolio_id,$exchange_type);
              $totalBillAmount = $outstandingBalance + $totalAmtFinal + $obligation;
              $psmamount = $this->getpsmamount($client_id);
              if(floatval($totalBillAmount) > floatval($psmamount)){

                $clientmaster = Clientmaster::where("id",$client_id)->first();
                $clientmaster->block_warning='1';
                $clientmaster->blocked = '1';
                $clientmaster->blocked_at=date('Y-m-d H:i:s');
                $clientmaster->save();
                $psmapproval = new PsmApproval();
                $psmapproval->client_id=$client_id;
                $psmapproval->outstanding_bal=$outstandingBalance;
                $psmapproval->psm_date=$BidDate;
                $psmapproval->unbilled_energy=$obligation;
                $psmapproval->average_bill_bal=$totalAmtFinal;
                $psmapproval->required_exposer=$totalBillAmount;
                $psmapproval->psm_exposer=$psmamount;
                $psmapproval->save();
                return 1;
              }else{
                return 0;
              }
            }else{
              $obligation=$this->getfullobgdetails($client_id,$portfolio_id,$exchange_type, $BidDate);
              $totalAmtFinal=$this->getinvoiceamount($client_id,$portfolio_id,$exchange_type, $BidDate);
              $outstandingBalance=$this->getoutstandingbalace($client_id,$portfolio_id,$exchange_type);
              $totalBillAmount = $outstandingBalance + $totalAmtFinal + $obligation;
              $psmamount = $this->getpsmamount($client_id);
              $clientmaster = Clientmaster::where("id",$client_id)->first();
              $clientmaster->block_warning='1';
              $clientmaster->blocked = '1';
              $clientmaster->blocked_at=date('Y-m-d H:i:s');
              // $clientmaster->blocked_at=date('Y-m-d H:i:s');
              $clientmaster->save();
              $psmapproval = new PsmApproval();
              $psmapproval->client_id=$client_id;
              $psmapproval->outstanding_bal=$outstandingBalance;
              $psmapproval->psm_date=$BidDate;
              $psmapproval->unbilled_energy=$obligation;
              $psmapproval->average_bill_bal=$totalAmtFinal;
              $psmapproval->required_exposer=$totalBillAmount;
              $psmapproval->psm_exposer=$psmamount;
              $psmapproval->save();
              $clientmaster = Clientmaster::where("id",$client_id)->first();
              $clientmaster->block_warning='1';
              $clientmaster->blocked = '1';
              $clientmaster->blocked_at=date('Y-m-d H:i:s');
              $clientmaster->save();
              return 2;
            }
          }
          }
    }

    public function getfullobgdetails($client_id,$portfolio_id,$exchange_type, $BidDate){
        $obligations=DB::table('iex_obligation_imported')->join('bill','bill.portfolio_id','=','iex_obligation_imported.portfolio_id')->where('iex_obligation_imported.portfolio_id',$portfolio_id)->whereRaw('bill.bill_date < iex_obligation_imported.date')->get();
        $total=0;
        foreach($obligations as $obligation){
          $total += str_replace(',','',$obligation->totalamount);
        }
        return $total;
    }

    public function getpsmamount($client_id){
      $client = Clientmaster::select(['exposure','psm_days','psm_amount'])->where("id",$client_id)->get()->first();
      return (@$client['exposure'])?$client['exposure']:0;
    }

    public function getinvoiceamount($client_id,$portfolio_id,$exchange_type, $BidDate){
      $LastFifteenDays = date('Y-m-d', strtotime('-15 days', strtotime($BidDate)));
        $bill = Bill::selectRaw('sum(amount) as total,count(amount) as count_number')->where("client_id",$client_id)->whereDate('from_date','>=',$LastFifteenDays)->whereDate('to_date','<=',$BidDate)->get();
        if($bill[0]['count_number']){
        return $bill[0]['total']/ $bill[0]['count_number'];
      }else{
        return 0;
      }
    }

    public function getoutstandingbalace($client_id){
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

    public function validate_exchange($client_id,$exchange_type, $BidDate){
      $exchange_data = DB::table('exchange_user')
      ->join('exchange_registration', 'exchange_user.id', '=', 'exchange_registration.exchange_id')
      ->select('exchange_user.*', 'exchange_registration.validitiy_from', 'exchange_registration.validitiy_to')
      ->where('exchange_user.client_id',$client_id)
      ->where('exchange_user.exchange_type',$exchange_type)
      ->whereRaw("validitiy_from <="."'".date('Y-m-d',strtotime('-1 day', strtotime($BidDate)))."'")
      ->whereRaw("validitiy_to >="."'".date('Y-m-d',strtotime('-1 day', strtotime($BidDate)))."'")
      ->first();
      return $exchange_data;
    }

    function generatebidUniqueid($bidid) {
        $r = '';
        for ($i= strlen($bidid); $i <=9 ; $i++) {
          $r .= "0";
        }
        return 'TPTBID'.$r.$bidid;
    }
    function time_formate($t) {
    if (strlen($t) == 4) {
        $temp = substr($t, 0, -2);
        $temp1 = substr($t, 2);
        return $temp . ":" . $temp1;
    } else {
        return $t;
    }
}
function getBidValueOnPerticularTimeSlice($main_array, $from, $to, $price) {
    $myFullArray = array();
    for ($k = 0; isset($main_array[$k]); $k++) {
        if (strtotime($main_array[$k][0]) <= strtotime($from) && strtotime($main_array[$k][1]) >= strtotime($to) && abs($main_array[$k][2]) == abs($price) && $main_array[$k][3] > 0) {
            $myFullArray[] = $main_array[$k][3];
        }
        if (strtotime($main_array[$k][0]) <= strtotime($from) && strtotime($main_array[$k][1]) >= strtotime($to) && abs($main_array[$k][2]) == abs($price) && $main_array[$k][3] < 0) {
            $myFullArray[] = $main_array[$k][3];
        }
    }
    return $myFullArray;
}
public function validate_user_status($client_id,$exchange){

  if($exchange=='iex'){
       $data = Client::where(['id'=>$client_id,'iex_status'=>'Active'])->get()->first();
       if($data){
         return 0;
       }else{
         return 1;
       }
  }else{
       $data = Client::where(['id'=>$client_id,'pxil_status'=>'Active'])->get()->first();
       if($data){
         return 0;
       }else{
         return 1;
       }
  }

}
}



        // $dateFolderName = date("dmY", strtotime("+ 1 day"));
        // $filenameMain = public_path("downloadcsv/");
        // $filenameType = public_path("downloadcsv/".$type);
        // $filenameDate = public_path("downloadcsv/".$type.'/'.$dateFolderName);
        // $filenameBb = public_path("downloadcsv/".$type.'/'.$dateFolderName.'/BB');
        // // Check file otherwide create
        // if (!is_dir($filenameMain)) {
        //     mkdir('downloadcsv', 0777);
        // }
        // if (!is_dir($filenameType)) {
        //     mkdir($filenameType, 0777);
        // }
        // if (!is_dir($filenameDate)) {
        //     mkdir($filenameDate, 0777);
        // }
        // if (!is_dir($filenameBb)) {
        //     mkdir($filenameBb, 0777);
        // }
        //  $csvFileName = $filenameBb."/BB.csv";
        // // exit();

        // // $csvFileName = public_path('PIYUSH_Data.csv');
        // if (is_dir($csvFileName)) {
        //     rmdir($csvFileName);
        // }
        // // if(!is_dir($csvFileName)){
        // //     mkdir($csvFileName, 0777);
        // // }
        // // $csvFileName = public_path($filename . "/" .$order_no. "_BB.csv");
        // $fp = fopen($csvFileName, 'w');
        // $header = array('W2MH0TPT0000','TPT01','S1TG0TPT0170','INDIA');
        // fputcsv($fp, $header);
        // foreach ($bidData as $key => $value) {
        //     if($value->bid_action=='sell'){
        //         $bid_price = '-'.$value->bid_price;
        //     }else{
        //         $bid_price = $value->bid_price;
        //     }
        //     $P_Data  = array($value->time_slot_from, $value->time_slot_to, $value->bid_mw, $bid_price);
        //     fputcsv($fp, $P_Data);
        // }
        //     fclose($csvFileName);
