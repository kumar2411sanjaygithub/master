<?php
namespace App\Common;
use App\AccountStatement;
use App\Basicinformation;
use App\User;
use App\Exchangeuser;
use DB;
use App\Obligations;
class Bid
{

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

  public static function getportfolio_id_by_client($client_id,$exchange_type='iex'){
    $ClientmastertempData = DB::table('clients')
        ->selectRaw("COALESCE(GROUP_CONCAT(iex_portfolio)) as value")
        ->where('clients.id',$client_id)
        ->get()->first();
    return $ClientmastertempData->value;
  }

  public static function getobligationimported($portfolio,$start,$end){
    $obligation = Obligations::where('portfolio_id',$portfolio)->whereBetween('date', [$start, $end])->get()->toArray();
    if($obligation){
      return 1;
    }else{
      return 0;
    }
  }

}
