<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Placebid;
// use App\Placebiddetails;
use DB;
use App\Client;
// use Carbon\Carbon;
use App\Exchange;
// use App\Bill;
// use App\AccountStatement;
// use App\PsmApproval;
// use Auth;
use App\Noc;
// use App\Basicinformation;
use App\Validationsetting;

class PlacebidController extends Controller
{
    public function index()
    {
    	$clientData = DB::table('clients')->select('id','name')->get();
      $user_id=Auth::user();

      // switch(true){
      //   case ($user_id->member_type=="ADMIN"):
      //   case ($user_id->member_type=="TRADER"):
           $bidallowedperiod="12:00";
      //     break;
      //   case ($user_id->member_type=="CLIENT"):
          // $timeperiod = Client::where('id',$user_id->client_id)->select('bid_cut_off_time')->first();
          // $bidallowedperiod = ($timeperiod->count()>0)?$timeperiod->bid_cut_off_time :'12:00';
        //   break;
        // default:
        //   Auth::logout();
        //   return redirect('/login');
      //}
      // $timeperiod = Basicinformation::where('id',$user_id)->select('submission_time')->first()->submission_time;
      // $bidallowedperiod = (@$timeperiod)?$timeperiod:'12:00';
      return view('dam.iex.placebid.index',compact('clientData','bidallowedperiod'));
    }

    // public function placesimilarearlierdatebid(Request $request, $trading)
    // {
    //     DB::enableQueryLog();
    //
    //     $placebidData = DB::table('place_bid')
    //     ->select('*')
    //     ->where('trading',$trading)
    //     ->where('exchange',$request->input('exchange'))
    //     ->where('client_id',$request->input('client_id'))
    //     ->where('bid_date','like','%'.$request->input('earlier_delivery_date').'%')
    //     ->where('status', 1)
    //     ->get();
    //     $dataForBid = $placebidData->toArray();
    //     // print_r(DB::getQueryLog());
    //     // echo $placebidData->sql();
    //     // print_r($request->toArray());
    //     // print_r($dataForBid);
    //     // exit();
    //     if(count($dataForBid)>0){
    //         $i=0;
    //         foreach ($dataForBid as $key => $value) {
    //             if($request->input('bid_action')=='sell'){
    //                  $sign = ">=";
    //                  $action_final  = "buy";
    //             }else{
    //                 $sign = "<=";
    //                 $action_final  = "sell";
    //             }
    //             $sameTimeSlotPrice = DB::table('place_bid')
    //                 ->select('*')
    //                 ->where('client_id', $request->input('client_id'))
    //                 ->where('exchange', $request->input('exchange'))
    //                 ->where('bid_date', $request->input('bid_date'))
    //                 ->where('bid_type', $value->bid_type)
    //                 ->where('bid_action', $action_final)
    //                 ->where('bid_mw', '=', $value->bid_mw)
    //                 ->where('bid_price', $value->bid_price)
    //                 ->where('time_slot_from' ,'>=' , $value->time_slot_from)
    //                 ->where('time_slot_to','<=' , $value->time_slot_to)
    //                 ->get();
    //                 $sameTimeSlotPriceFinal = $sameTimeSlotPrice->toArray();
    //                // print_r($sameTimeSlotPriceFinal);
    //                // exit();
    //                 if(!empty($sameTimeSlotPriceFinal)){
    //                     if(count($sameTimeSlotPriceFinal) > 0){
    //                         $ValidateMsg = "You Cant buy and sell at same price " . $request->input('bid_price') . "~" . $value->time_slot_from . "-" . $value->time_slot_to    ;
    //                         return response()->json(['status' => '1', 'msg'=>$ValidateMsg],400);
    //                         // return "You Cant buy and sell at same price " . $priceArray[$i] . "~" . $timeslice[$j] . "-" . $timeslice[$j + 1];
    //                     }
    //                 }
    //         }
    //         foreach ($dataForBid as $key => $value) {
    //
    //             $placebid = new Placebid();
    //             $placebid->trading = $trading;
    //             $placebid->exchange = $request->input('exchange');
    //             $placebid->client_id = $request->input('client_id');
    //             $placebid->bid_date = $request->input('bid_date');
    //             $placebid->bid_type = $value->bid_type;
    //             $placebid->bid_action = $value->bid_action;
    //             $placebid->time_slot_from = $value->time_slot_from;
    //             $placebid->time_slot_to = $value->time_slot_to;
    //             $placebid->bid_mw = $value->bid_mw;
    //             $placebid->bid_price = $value->bid_price;
    //             $placebid->status = '0';
    //             $placebid->save();
    //         $i++;
    //         }
    //     }else{
    //         $ValidateMsg = 'No bid placed on '.$request->input('earlier_delivery_date');
    //         return response()->json(['status' => '1', 'msg'=>$ValidateMsg],400);
    //     }
    //
    //     $placebidDataProcess = DB::table('place_bid')
    //     ->select('*')
    //     ->where('trading',$trading)
    //     ->where('exchange',$request->input('exchange'))
    //     ->where('client_id',$request->input('client_id'))
    //     ->where('bid_date',$request->input('bid_date'))
    //     ->where('status','0')
    //     ->get();
    //
    //     $placebidDataSubmitted = DB::table('place_bid')
    //     ->select('*')
    //     ->where('trading',$trading)
    //     ->where('exchange',$request->input('exchange'))
    //     ->where('client_id',$request->input('client_id'))
    //     ->where('bid_date',$request->input('bid_date'))
    //     ->get();
    //
    //     return response()->json(['placebidDataProcess'=> $placebidDataProcess, 'placebidDataSubmitted'=>$placebidDataSubmitted, 'msg' => 'Bid placed successfully', 'status' => '1']);
    // }

    function getLastBidSubmisstionTime($clientID) {
        $bidSubmissionTime = DB::table('clients')->select('bid_cut_off_time as submission_time')->where('id',$clientID)->get();
        // $str = "SELECT `bidtime` FROM `exc_client_details` WHERE id='$clientID'";
        // $g->selectQuerySingleRow($str);
        if (count($bidSubmissionTime) > 0) {
            return $bidSubmissionTime[0]->submission_time;
        } else {
            return "11:00:00";
        }
    }

    function gettimeslice() {
        $a = '0000,0015,0030,0045,0100,0115,0130,0145,0200,0215,0230,0245,0300,0315,0330,0345,
    0400,0415,0430,0445,0500,0515,0530,0545,0600,0615,0630,0645,0700,0715,0730,0745,
    0800,0815,0830,0845,0900,0915,0930,0945,1000,1015,1030,1045,1100,1115,1130,1145,
    1200,1215,1230,1245,1300,1315,1330,1345,1400,1415,1430,1445,1500,1515,1530,1545,
    1600,1615,1630,1645,1700,1715,1730,1745,1800,1815,1830,1845,1900,1915,1930,1945,
    2000,2015,2030,2045,2100,2115,2130,2145,2200,2215,2230,2245,2300,2315,2330,2345';

        return explode(",", $a);
    }

    function getNextBidDate() {
        return date("Y-m-d", strtotime(date("Y-m-d") . ' + 1 days'));
    }

    public function addnewbid(Request $request, $trading)
    {
        if($request->input('bid_type')=='block'){
            $noOfBlock=$request->input('no_of_block');
        }else{
            $noOfBlock = 1;
        }
        $bidSubmissionTime = $this->getLastBidSubmisstionTime($request->input('client_id'));

        $currentDateTime = strtotime(date('H:i:s'));
        $getNextBidDate = $this->getNextBidDate();
        $date_Change =  $request->input('bid_date');


        $var = $request->input('bid_date');
        $date = str_replace('/', '-', $var);
        $biddate = date('Y-m-d', strtotime($date));
        
            $exchangeusertemp = Exchange::with(['validationsetting'=>function($query){
              $query->with(['clients'=>function($query){
                $query->selectRaw("id,bid_cut_off_time as bid_submission_time");
              }]);
            }])->where("client_id",$request->input('client_id'))->get()->first();
        
        
        $validationSetting = Validationsetting::where('user_id',$request->input('client_id'))->get()->first();

        $portfolio_id = (@$exchangeusertemp['portfolio_id'])?$exchangeusertemp['portfolio_id']:'0';

        $psm=(@$exchangeusertemp['validationsetting']['psm'])?$exchangeusertemp['validationsetting']['psm']:'0';

        if($this->validate_user_status($request->input('client_id'),'iex')){
          $msg = "Invalid IEX status";
          return response()->json(['status' => '1', 'msg'=>$msg],400);
        }

        $isBarredHint=0;


        if($getNextBidDate > $biddate){
            $msg = 'You Cant change/place bid for previous days.';
            return response()->json(['status' => '1', 'msg'=>$msg],400);
        }
        $basicinfo = Client::selectRaw("trader_type")->where("id",$request->input('client_id'))->first();

        if(!$basicinfo->trader_type){
            $msg = 'trader type not set for this client';
            return response()->json(['status' => '1', 'msg'=>$msg],400);
        }

        if((strtoupper($basicinfo->trader_type) != strtoupper($request->input('bid_action')))&&(strtoupper($basicinfo->trader_type) != 'BOTH')){
            $msg = 'Your trade type is set to '.strtolower($basicinfo->trader_type);
            return response()->json(['status' => '1', 'msg'=>$msg],400);
        }

        if($request->input('bid_action')=='sell'){
             $action_final  = "buy";
        }else{
            $action_final  = "sell";
        } 

        
        $sameTimeSlotPrice = DB::table('place_bid')
        ->select('*')
        ->where('client_id', $request->input('client_id'))
        ->where('exchange', $request->input('exchange'))
        ->where('bid_date', $biddate)
        ->where('bid_action', $action_final)
        ->where('bid_price','=', $request->input('bid_price'))
        ->whereRaw("(((time_slot_from >= CAST('".$request->input('time_slot_from').":00' AS time)) and (time_slot_from >= CAST('".$request->input('time_slot_from').":00' AS time)) and (time_slot_from <= CAST('".$request->input('time_slot_to').":00' AS time) )) or (time_slot_from <= CAST('".$request->input('time_slot_from').":00' AS time)) and (time_slot_from <= CAST('".$request->input('time_slot_from').":00' AS time)) and (time_slot_to >= CAST('".$request->input('time_slot_from').":00' AS time) ))")
        ->whereNull('deleted_at')
        ->get();


        $sameTimeSlotPriceFinal = $sameTimeSlotPrice->toArray();

        if(!empty($sameTimeSlotPriceFinal)){
            if(count($sameTimeSlotPriceFinal) > 0){
                $ValidateMsg = "You Cant buy and sell at same price  ".$request->input('bid_price')." for  ". $request->input('time_slot_from') . "-" . $request->input('time_slot_to');
                return response()->json(['status' => '1', 'msg'=>$ValidateMsg],400);
                // return "You Cant buy and sell at same price " . $priceArray[$i] . "~" . $timeslice[$j] . "-" . $timeslice[$j + 1];
            }
        }


        //count total block bid
        if($request->input('bid_type')=='block'){
            $gettotalBlockBid = DB::table('place_bid')
            ->select('*')
            ->where('client_id', $request->input('client_id'))
            ->where('exchange', $request->input('exchange'))
            ->where('bid_date', $biddate)
            ->where('bid_type', $request->input('bid_type'))
            ->whereNull('deleted_at')
            ->get();
            $gettotalBlockBidFinal = $gettotalBlockBid->toArray();

            if(!empty($gettotalBlockBidFinal)){
                $totalFinalBidCount = count($gettotalBlockBidFinal)+$request->input('no_of_block');
                if($totalFinalBidCount > 60){
                    $ValidateMsg = "You cannot place bid more than 60 blocks";
                    return response()->json(['status' => '1', 'msg'=>$ValidateMsg],400);
                    // return "You Cant buy and sell at same price " . $priceArray[$i] . "~" . $timeslice[$j] . "-" . $timeslice[$j + 1];
                }
            }
        }

        //Validate Noc MW in particular Time Slot
        $PartiCularTimeSlotData = DB::table('place_bid')
        ->select(DB::raw('sum(bid_mw) as totalBid'))
        ->where('client_id', $request->input('client_id'))
        ->where('exchange', $request->input('exchange'))
        ->where('bid_date', $biddate)
        ->where('bid_action', $request->input('bid_action'))
        ->where('time_slot_from' ,'>=' , $request->input('time_slot_from'))
        ->where('time_slot_to','<=' , $request->input('time_slot_to'))
        ->whereNull('deleted_at')
        ->first();

        $totalMwFinal = $PartiCularTimeSlotData->totalBid+$request->input('bid_mw');
        // dd($totalMwFinal);
        // if(empty($exchangeData)){
        //     $msg = 'Your Exchange has been expired or not uploaded. Please contact Trader Admin';
        //     return response()->json(['status' => '1', 'msg'=>$msg],400);
        // }

        // $particulardatedata= DB::table('place_bid')
        // ->select(DB::raw('sum(bid_mw) as totalBid'))
        // ->where('client_id', $request->input('client_id'))
        // ->where('exchange', $request->input('exchange'))
        // ->where('bid_date', $biddate)
        // ->where('bid_action', $request->input('bid_action'))
        // ->whereNull('deleted_at')
        // ->first();

        // if($request->input('bid_type')=='block'){
        //   $noOfBlock = $request->input('no_of_block');
        //   $total_bid_mw = $request->input('bid_mw')*$noOfBlock;
        // }else{
        //   $total_bid_mw = $request->input('bid_mw');
        // }

        // $totalMwFinal = $particulardatedata->totalBid+$total_bid_mw;

        // *******************START***********************
        // | Validation setting for Exchange, NOC and PPA 
        // ***********************************************
        
        if($validationSetting){
            //Exchange Validation setting and Exchange expire
            if($validationSetting->exchange=='Exchange'){
                $exchangeData = DB::table('exchange')
                  ->select('exchange.*')
                  ->where('exchange.client_id',$request->input('client_id'))
                  ->where('exchange.ex_type',$request->input('exchange'))
                  ->whereRaw("exchange.validity_from <="."'".date('Y-m-d',strtotime('-1 day', strtotime($biddate)))."'")
                  ->whereRaw("exchange.validity_to >="."'".date('Y-m-d',strtotime('-1 day', strtotime($biddate)))."'")
                  ->first();
                if(empty($exchangeData)){
                    $msg = 'Your Exchange has been expired or not uploaded. Please contact Trader Admin';
                    return response()->json(['status' => '1', 'msg'=>$msg],400);
                }
            }
            //NOC Setting and validation
            if($validationSetting->noc=='NOC'){
                $nocData = Noc::selectRaw('*')
                    ->where('client_id',$request->input('client_id'))
                    ->whereRaw("validity_from <="."'".$biddate."'")
                    ->whereRaw("validity_to >="."'".$biddate."'")
                    ->where('noc_type',$request->input('bid_action'))
                    ->first();
                if(empty($nocData)){
                    $msg = 'Your NOC has been expired or not uploaded. Please contact Trader Admin';
                    return response()->json(['status' => '1', 'msg'=>$msg],400);
                }else{
                    $nocData = Noc::select('*')
                                ->where('client_id',$request->input('client_id'))
                                ->where('exchange',$request->input('exchange'))
                                ->where('noc_type',$request->input('bid_action'))
                                ->whereRaw("validity_from <="."'".$biddate."'")
                                ->whereRaw("validity_to >="."'".$biddate."'")
                                ->first();
                    if($nocData->noc_quantum < $totalMwFinal){
                        $msg = 'You cannot place bid more than your maximum NOC quantum. Your maximum NOC quantum is set to '.strtoupper($nocData->noc_quantum).' for '.$request->input('bid_action').' trade type.';
                        return response()->json(['status' => '1', 'msg'=>$msg],400);
                    }
                }
            }
            //PPA Setting and validation
            if($validationSetting->ppa=='PPA'){
                $ppaData = DB::table('ppa_details')
                    ->select('validity_from','validity_to')
                    ->where('client_id',$request->input('client_id'))
                    ->whereRaw("validity_from <="."'".$biddate."'")
                    ->whereRaw("validity_to >="."'".$biddate."'")
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

        if($request->input('bid_type')=='single'){
          if($this->validatesinglebidbyprice($request->input('time_slot_from'),$request->input('time_slot_to'),$request->input('bid_price'),$biddate,$request->input('bid_action'),$request->input('client_id'))){
            $placebid = new Placebid();
            $placebid->trading = $trading;
            $placebid->exchange = $request->input('exchange');
            $placebid->client_id = $request->input('client_id');
            $placebid->bid_date = $biddate;
            $placebid->bid_type = $request->input('bid_type');
            $placebid->bid_action = $request->input('bid_action');
            $placebid->time_slot_from = $request->input('time_slot_from');
            $placebid->time_slot_to = $request->input('time_slot_to');
            $placebid->bid_mw = $request->input('bid_mw');
            $placebid->bid_price = $request->input('bid_price');
            $placebid->status = '0';
            $placebid->save();
          }else{
            if($request->input('bid_action')=='buy'){
              $msg = 'Buy amount cannot be greater than sell';
              return response()->json(['status' => '1', 'msg'=>$msg],400);
            }else{
              $msg = 'Sell amount cannot be smaller than buy';
              return response()->json(['status' => '1', 'msg'=>$msg],400);
            }
          }
        }

        if($request->input('bid_type')=='block'){
            $timeslice = $this->gettimeslice1();
            $blockfrom = $request->input('time_slot_from');
            $blockto = $request->input('time_slot_to');
            $diffHr =  $this->timeDiff($blockfrom,$blockto);

            $noOfBlock = $request->input('no_of_block');
            if(($diffHr*4)%$noOfBlock <> 0){
                $msg = 'Please enter valid block number !!!';
                return response()->json(['status' => '1', 'msg'=>$msg],400);
            }
            //block save
            $indexMultiplyer = ($diffHr / $noOfBlock) * 4;
            $arrayIndexBlockFrom = array_search($blockfrom, $timeslice);
            $arrayIndexBlockTo = array_search($blockto, $timeslice);
            $totalBidArray= array();
            for ($i = $arrayIndexBlockFrom; $i <= $arrayIndexBlockTo - 1; $i = $i + $indexMultiplyer) {
                $nextIndex = $diffHr < 1 ? $i + 1 : $i + $indexMultiplyer;
                // $totalBidArray[] = array($placebid->id,, , , $request->input('bid_price'));
                //save block data
                // $placebiddetails = new Placebiddetails();
                // $placebiddetails->place_bid_id  = $placebid->id;
                $placebid = new Placebid();
                $placebid->trading = $trading;
                $placebid->exchange = $request->input('exchange');
                $placebid->client_id = $request->input('client_id');
                $placebid->bid_date = $biddate;
                $placebid->bid_type = $request->input('bid_type');
                $placebid->bid_action = $request->input('bid_action');
                $placebid->time_slot_from= $timeslice[$i];
                $placebid->time_slot_to  = $timeslice[$nextIndex];
                $placebid->bid_mw        = $request->input('bid_mw');
                $placebid->bid_price     = $request->input('bid_price');
                $placebid->no_of_block = $request->input('no_of_block');
                $placebid->save();
            }
        }

        $placebidDataSubmitted = DB::table('place_bid')
        ->select('*')
        ->where('trading',$trading)
        ->where('exchange',$request->input('exchange'))
        ->where('client_id',$request->input('client_id'))
        ->where('bid_date',$biddate)
        ->whereNull('deleted_at')
        ->get();

        $placebidDataProcess = DB::table('place_bid')
        ->select('*')
        ->where('trading',$trading)
        ->where('exchange',$request->input('exchange'))
        ->where('client_id',$request->input('client_id'))
        ->where('bid_date',$biddate)
        ->where('status','0')
        ->whereNull('deleted_at')
        ->get();
        $msg ="Bid added successfully";

        // if($request['bid_action']=='buy'&&($validationSetting->psm)){
        //    $isBarredHint=$this->validate_psm($request->input('client_id'),$portfolio_id,'iex', $biddate);
        // }

        // if($isBarredHint==1){
        //   $msg .= " But Your PSM amount is low";
        // }else if($isBarredHint==2){
        //   $msg .= " But Your PSM is not available";
        // }
        return response()->json(['status' => '0','placebidDataProcess'=> $placebidDataProcess,'placebidDataSubmitted'=>$placebidDataSubmitted, 'msg' => $msg]);
    }



    public function updatebiddata(Request $request, $trading, $id)
    {
          if($request->input('bid_type')=='block'){
              $noOfBlock=$request->input('no_of_block');
          }else{
              $noOfBlock = 1;
          }
          $bidSubmissionTime = $this->getLastBidSubmisstionTime($request->input('client_id'));

          $currentDateTime = strtotime(date('H:i:s'));
          $getNextBidDate = $this->getNextBidDate();
          $date_Change =  $request->input('bid_date');


          $var = $request->input('bid_date');
          $date = str_replace('/', '-', $var);
          $biddate = date('Y-m-d', strtotime($date));

          $exchangeusertemp = Exchange::with(['validationsetting'=>function($query){
              $query->with(['clients'=>function($query){
                $query->selectRaw("id,bid_cut_off_time as bid_submission_time");
              }]);
            }])->where("client_id",$request->input('client_id'))->get()->first();

          $validationSetting = Validationsetting::where('user_id',$request->input('client_id'))->get()->first();

          $portfolio_id = (@$exchangeusertemp['portfolio_id'])?$exchangeusertemp['portfolio_id']:'0';

          $psm=(@$exchangeusertemp['validationsetting']['psm'])?$exchangeusertemp['validationsetting']['psm']:'0';

          if($this->validate_user_status($request->input('client_id'),'iex')){
            $msg = "Invalid IEX status";
            return response()->json(['status' => '1', 'msg'=>$msg],400);
          }

          $isBarredHint=0;

          if($getNextBidDate > $biddate){
              $msg = 'You Cant change/place bid for previous days.';
              return response()->json(['status' => '1', 'msg'=>$msg],400);
          }
          $basicinfo = Client::selectRaw("trader_type")->where("id",$request->input('client_id'))->first();

          if((strtoupper($basicinfo->trader_type) != strtoupper($request->input('bid_action')))&&(strtoupper($basicinfo->trader_type) != 'BOTH')){
              $msg = 'Your power trade type is set to '.strtolower($basicinfo->trader_type);
              return response()->json(['status' => '1', 'msg'=>$msg],400);
          }

          if($request->input('bid_action')=='sell'){
               // $sign = ">=";
               $action_final  = "buy";
          }else{
              // $sign = "<=";
              $action_final  = "sell";
          }

          
          $sameTimeSlotPrice = DB::table('place_bid')
          ->select('*')
          ->where('client_id', $request->input('client_id'))
          ->where('exchange', $request->input('exchange'))
          ->where('bid_date', $biddate)
          ->where('bid_action', $action_final)
          ->where('bid_price','=', $request->input('bid_price'))
          ->whereRaw("(((time_slot_from >= CAST('".$request->input('time_slot_from').":00' AS time)) and (time_slot_from >= CAST('".$request->input('time_slot_from').":00' AS time)) and (time_slot_from <= CAST('".$request->input('time_slot_to').":00' AS time) )) or (time_slot_from <= CAST('".$request->input('time_slot_from').":00' AS time)) and (time_slot_from <= CAST('".$request->input('time_slot_from').":00' AS time)) and (time_slot_to >= CAST('".$request->input('time_slot_from').":00' AS time) ))")
          ->whereNull('deleted_at')
          ->get();


          $sameTimeSlotPriceFinal = $sameTimeSlotPrice->toArray();

         // print_r($sameTimeSlotPriceFinal);
         // exit();
          if(!empty($sameTimeSlotPriceFinal)){
              if(count($sameTimeSlotPriceFinal) > 0){
                  $ValidateMsg = "You Cant buy and sell at same price  ".$request->input('bid_price')." for  ". $request->input('time_slot_from') . "-" . $request->input('time_slot_to');
                  return response()->json(['status' => '1', 'msg'=>$ValidateMsg],400);
                  // return "You Cant buy and sell at same price " . $priceArray[$i] . "~" . $timeslice[$j] . "-" . $timeslice[$j + 1];
              }
          }


          //count total block bid
          if($request->input('bid_type')=='block'){
              $gettotalBlockBid = DB::table('place_bid')
              ->select('*')
              ->where('client_id', $request->input('client_id'))
              ->where('exchange', $request->input('exchange'))
              ->where('bid_date', $biddate)
              ->where('bid_type', $request->input('bid_type'))
              ->get();
              $gettotalBlockBidFinal = $gettotalBlockBid->toArray();

              if(!empty($gettotalBlockBidFinal)){
                  $totalFinalBidCount = count($gettotalBlockBidFinal)+$request->input('no_of_block');
                  if($totalFinalBidCount > 60){
                      $ValidateMsg = "You cannot place bid more than 60 blocks";
                      return response()->json(['status' => '1', 'msg'=>$ValidateMsg],400);
                      // return "You Cant buy and sell at same price " . $priceArray[$i] . "~" . $timeslice[$j] . "-" . $timeslice[$j + 1];
                  }
              }
          }

          //Validate Noc MW in particular Time Slot
          $PartiCularTimeSlotData = DB::table('place_bid')
          ->select(DB::raw('sum(bid_mw) as totalBid'))
          ->where('client_id', $request->input('client_id'))
          ->where('exchange', $request->input('exchange'))
          ->where('bid_date', $biddate)
          ->where('bid_action', $request->input('bid_action'))
          ->where('time_slot_from' ,'>=' , $request->input('time_slot_from'))
          ->where('time_slot_to','<=' , $request->input('time_slot_to'))
          ->whereNull('deleted_at')
          ->first();

          // $PartiCularTimeSlotDataFinal = $PartiCularTimeSlotData->toArray();
          // echo $request->input('client_id').'~'.$request->input('exchange').'~'.$request->input('bid_date').'~'.$request->input('bid_action').'~'.$request->input('time_slot_from').'~'.$request->input('time_slot_to');
          // print_r($PartiCularTimeSlotData);

          $particulardatedata= DB::table('place_bid')
          ->select(DB::raw('sum(bid_mw) as totalBid'))
          ->where('client_id', $request->input('client_id'))
          ->where('exchange', $request->input('exchange'))
          ->where('bid_date', $biddate)
          ->where('bid_action', $request->input('bid_action'))
          ->whereNull('deleted_at')
          ->first();

          if($request->input('bid_type')=='block'){
            $noOfBlock = $request->input('no_of_block');
            $total_bid_mw = $request->input('bid_mw')*$noOfBlock;
          }else{
            $total_bid_mw = $request->input('bid_mw');
          }

          $totalMwFinal = $particulardatedata->totalBid+$total_bid_mw;

          // echo $totalMwFinal;
          // exit();
          // *************************
          // *************************
            if($validationSetting){
                //Exchange Validation setting and Exchange expire
                if($validationSetting->exchange=='yes'){
                    $exchangeData = DB::table('exchange')
                      ->select('exchange.*')
                      ->where('exchange.client_id',$request->input('client_id'))
                      ->where('exchange.ex_type',$request->input('exchange'))
                      ->whereRaw("exchange.validity_from <="."'".date('Y-m-d',strtotime('-1 day', strtotime($biddate)))."'")
                      ->whereRaw("exchange.validity_to >="."'".date('Y-m-d',strtotime('-1 day', strtotime($biddate)))."'")
                      ->first();
                    if(empty($exchangeData)){
                        $msg = 'Your Exchange has been expired or not uploaded. Please contact Trader Admin';
                        return response()->json(['status' => '1', 'msg'=>$msg],400);
                    }
                }
                //NOC Setting and validation
                if($validationSetting->noc=='yes'){
                    $nocData = Noc::selectRaw('*')
                        ->where('client_id',$request->input('client_id'))
                        ->whereRaw("validity_from <="."'".$biddate."'")
                        ->whereRaw("validity_to >="."'".$biddate."'")
                        ->where('noc_type',$request->input('bid_action'))
                        ->first();
                    if(empty($nocData)){
                        $msg = 'Your NOC has been expired or not uploaded. Please contact Trader Admin';
                        return response()->json(['status' => '1', 'msg'=>$msg],400);
                    }else{
                        $nocData = Noc::select('*')
                                    ->where('client_id',$request->input('client_id'))
                                    ->where('exchange',$request->input('exchange'))
                                    ->where('noc_type',$request->input('bid_action'))
                                    ->whereRaw("validity_from <="."'".$biddate."'")
                                    ->whereRaw("validity_to >="."'".$biddate."'")
                                    ->first();
                        if(@$nocData->noc_quantum >= $totalMwFinal){
                            $msg = 'You cannot place bid more than your maximum NOC quantum. Your maximum NOC quantum is set to '.strtoupper($nocData->noc_quantum).' for '.$request->input('bid_action').' trade type.';
                            return response()->json(['status' => '1', 'msg'=>$msg],400);
                        }
                    }
                }
                //PPA Setting and validation
                if($validationSetting->ppa=='yes'){
                    $ppaData = DB::table('ppa_details')
                        ->select('validity_from','validity_to')
                        ->where('client_id',$request->input('client_id'))
                        ->whereRaw("validity_from <="."'".$biddate."'")
                        ->whereRaw("validity_to >="."'".$biddate."'")
                        ->first();
                    if(empty($ppaData)){
                        $msg = 'Your PPA has been expired or not uploaded. Please contact Trader Admin';
                        return response()->json(['status' => '1', 'msg'=>$msg],400);
                    }
                }
            }
          // *************************
          // *************************

          if($request->input('bid_type')=='single'){
            if($this->validatesinglebidbyprice($request->input('time_slot_from'),$request->input('time_slot_to'),$request->input('bid_price'),$biddate,$request->input('bid_action'),$request->input('client_id'))){
              $placebid = Placebid::find($id);
              $placebid->trading = $trading;
              $placebid->exchange = $request->input('exchange');
              $placebid->client_id = $request->input('client_id');
              $placebid->bid_date = $biddate;
              $placebid->bid_type = $request->input('bid_type');
              $placebid->bid_action = $request->input('bid_action');
              $placebid->time_slot_from = $request->input('time_slot_from');
              $placebid->time_slot_to = $request->input('time_slot_to');
              $placebid->bid_mw = $request->input('bid_mw');
              $placebid->bid_price = $request->input('bid_price');
              $placebid->status = '0';
              $placebid->save();
            }else{
              if($request->input('bid_action')=='buy'){
                $msg = 'Buy amount cannot be greater than sell';
                return response()->json(['status' => '1', 'msg'=>$msg],400);
              }else{
                $msg = 'Sell amount cannot be smaller than buy';
                return response()->json(['status' => '1', 'msg'=>$msg],400);
              }
            }
          }

          if($request->input('bid_type')=='block'){
              $timeslice = $this->gettimeslice1();
              $blockfrom = $request->input('time_slot_from');
              $blockto = $request->input('time_slot_to');
              $diffHr =  $this->timeDiff($blockfrom,$blockto);

              $noOfBlock = 1;
              if(($diffHr*4)%$noOfBlock <> 0){
                  $msg = 'Please enter valid block number !!!';
                  return response()->json(['status' => '1', 'msg'=>$msg],400);
              }
              //block save
              $indexMultiplyer = ($diffHr / $noOfBlock) * 4;
              $arrayIndexBlockFrom = array_search($blockfrom, $timeslice);
              $arrayIndexBlockTo = array_search($blockto, $timeslice);
              $totalBidArray= array();
              for ($i = $arrayIndexBlockFrom; $i <= $arrayIndexBlockTo - 1; $i = $i + $indexMultiplyer) {
                  $nextIndex = $diffHr < 1 ? $i + 1 : $i + $indexMultiplyer;
                  // $totalBidArray[] = array($placebid->id,, , , $request->input('bid_price'));
                  //save block data
                  // $placebiddetails = new Placebiddetails();
                  // $placebiddetails->place_bid_id  = $placebid->id;
                  $placebid = Placebid::find($id);
                  $placebid->trading = $trading;
                  $placebid->exchange = $request->input('exchange');
                  $placebid->client_id = $request->input('client_id');
                  $placebid->bid_date = $biddate;
                  $placebid->bid_type = $request->input('bid_type');
                  $placebid->bid_action = $request->input('bid_action');
                  $placebid->time_slot_from= $timeslice[$i];
                  $placebid->time_slot_to  = $timeslice[$nextIndex];
                  $placebid->bid_mw        = $request->input('bid_mw');
                  $placebid->bid_price     = $request->input('bid_price');
                  $placebid->no_of_block = $request->input('no_of_block');
                  $placebid->save();
              }
          }

          $placebidDataSubmitted = DB::table('place_bid')
          ->select('*')
          ->where('trading',$trading)
          ->where('exchange',$request->input('exchange'))
          ->where('client_id',$request->input('client_id'))
          ->where('bid_date',$biddate)
          ->whereNull('deleted_at')
          ->get();

          $placebidDataProcess = DB::table('place_bid')
          ->select('*')
          ->where('trading',$trading)
          ->where('exchange',$request->input('exchange'))
          ->where('client_id',$request->input('client_id'))
          ->where('bid_date',$biddate)
          ->where('status','0')
          ->whereNull('deleted_at')
          ->get();
          $msg ="Bid added successfully";

          // if($request['bid_action']=='buy'&&($validationSetting->psm)){
          //    $isBarredHint=$this->validate_psm($request->input('client_id'),$portfolio_id,'iex', $biddate);
          // }

          // if($isBarredHint==1){
          //   $msg .= " But Your PSM amount is low";
          // }else if($isBarredHint==2){
          //   $msg .= " But Your PSM is not available";
          // }
          return response()->json(['status' => '0','placebidDataProcess'=> $placebidDataProcess,'placebidDataSubmitted'=>$placebidDataSubmitted, 'msg' => $msg]);

    }


    public function validatesinglebidbyprice($time_slot_from,$time_slot_to,$price,$biddate,$bid_action,$client_id){
        echo $time_slot_from.'~'.$time_slot_to.'~'.$price.'~'.$biddate.'~'.$bid_action.'~'.$client_id;
        die();
      if($bid_action=='sell'){
      $placebid = Placebid::selectRaw("max(`bid_price`) as bid_price")->where('bid_action','buy')->whereRaw("(((time_slot_from >= CAST('".$time_slot_from.":00' AS time)) and (time_slot_from >= CAST('".$time_slot_from.":00' AS time)) and (time_slot_from <= CAST('".$time_slot_to.":00' AS time) )) or (time_slot_from <= CAST('".$time_slot_from.":00' AS time)) and (time_slot_from <= CAST('".$time_slot_from.":00' AS time)) and (time_slot_to >= CAST('".$time_slot_from.":00' AS time) ))")->where('bid_date',$biddate)->orderBy('bid_price','Asc')->where('client_id',$client_id)->whereNull('deleted_at')->get()->first();
      dd($placebid);
      if($placebid->bid_price!=null){
      if($price<$placebid->bid_price){
        return 0;
      }else{
        return 1;
      }
    }else{
      return 1;
    }

      }else{
      $placebid = Placebid::selectRaw("min(bid_price) as bid_price")->where('bid_action','sell')->whereRaw("(((time_slot_from >= CAST('".$time_slot_from.":00' AS time)) and (time_slot_from >= CAST('".$time_slot_from.":00' AS time)) and (time_slot_from <= CAST('".$time_slot_to.":00' AS time) )) or (time_slot_from <= CAST('".$time_slot_from.":00' AS time)) and (time_slot_from <= CAST('".$time_slot_from.":00' AS time)) and (time_slot_to >= CAST('".$time_slot_from.":00' AS time) ))")->where('bid_date',$biddate)->orderBy('bid_price','Asc')->where('client_id',$client_id)->whereNull('deleted_at')->get()->first();
      if($placebid->bid_price!=null){
      if($price > $placebid->bid_price){
          return 0;
        }else{
          return 1;
        }
      }else{
        return 1;
      }
    }
    }

    public function validate_user_status($client_id,$exchange){

      if($exchange=='iex'){
           $data = Client::where(['id'=>$client_id,'iex_status'=>'Active'])->get()->first();
           if($data){
             return 0;
           }else{
             return 1;
           }
      }

    }

    // public function updatebiddata(Request $request, $trading, $id)
    // {
    //     $var = $request->input('bid_date');
    //     $date = str_replace('/', '-', $var);
    //     $biddate = date('Y-m-d', strtotime($date));
    //     $exchangeData = DB::table('exchange_user')
    //     ->join('exchange_registration', 'exchange_user.id', '=', 'exchange_registration.exchange_id')
    //     ->select('exchange_user.*', 'exchange_registration.validitiy_from', 'exchange_registration.validitiy_to')
    //     ->where('exchange_user.client_id',$request->input('client_id'))
    //     ->where('exchange_user.exchange_type',$request->input('exchange'))
    //     ->where('exchange_registration.validitiy_from' ,'<=' ,$biddate)
    //     ->where('exchange_registration.validitiy_to','>=' ,$biddate)
    //     ->first();
    //     if(!empty($exchangeData)){
    //             $nocData = DB::table('noc_registration')
    //             ->select('*')
    //             ->where('client_id',$request->input('client_id'))
    //             ->where('exchange',$request->input('exchange'))
    //             ->where('validity_from' ,'<=' ,$biddate)
    //             ->where('validity_to','>=' ,$biddate)
    //             ->first();
    //             //check for NOC
    //             if(!empty($nocData)){
    //                 $nocData = DB::table('noc_registration')
    //                             ->select('*')
    //                             ->where('client_id',$request->input('client_id'))
    //                             ->where('exchange',$request->input('exchange'))
    //                             ->where('noc_type',$request->input('bid_action'))
    //                             ->where('validity_from' ,'<=' ,$biddate)
    //                             ->where('validity_to','>=' ,$biddate)
    //                             ->first();
    //                 //check for NOC Type (Buy or Sell)
    //                 if($nocData->noc_type==$request->input('bid_action')){
    //                     //check for NOC exchange (IEX or PXIL)
    //                     if($nocData->exchange==$request->input('exchange')){
    //                         //check for NOC quantum
    //                         if($nocData->final_noc_quantum >= $request->input('bid_mw')){
    //                             $ppaData = DB::table('ppa_details')
    //                             ->select('validity_from','validity_to')
    //                             ->where('client_id',$request->input('client_id'))
    //                             ->where('validity_from' ,'<=' ,$biddate)
    //                             ->where('validity_to','>=' ,$biddate)
    //                             ->first();
    //                             if(!empty($ppaData)){
    //
    //                                 $placebid = Placebid::find($id);
    //                                 $placebid->bid_type = $request->input('bid_type');
    //                                 $placebid->bid_action = $request->input('bid_action');
    //                                 $placebid->time_slot_from = $request->input('time_slot_from');
    //                                 $placebid->time_slot_to = $request->input('time_slot_to');
    //                                 $placebid->bid_mw = $request->input('bid_mw');
    //                                 $placebid->bid_price = $request->input('bid_price');
    //                                 $placebid->save();
    //                                 $placebidDataSubmitted = DB::table('place_bid')
    //                                                             ->select('*')
    //                                                             ->where('trading',$trading)
    //                                                             ->where('exchange',$request->input('exchange'))
    //                                                             ->where('client_id',$request->input('client_id'))
    //                                                             ->where('bid_date',$biddate)
    //                                                             ->get();
    //
    //                                 $placebidDataProcess = DB::table('place_bid')
    //                                                 ->select('*')
    //                                                 ->where('trading',$trading)
    //                                                 ->where('exchange',$request->input('exchange'))
    //                                                 ->where('client_id',$request->input('client_id'))
    //                                                 ->where('bid_date',$biddate)
    //                                                 ->where('status','0')
    //                                                 ->get();
    //                                 return response()->json(['status' => '0','placebidDataProcess'=> $placebidDataProcess,'placebidDataSubmitted'=>$placebidDataSubmitted, 'msg' => 'Bid updated successfully']);
    //                             }else{
    //                                 //Error message for PPA
    //                                 $msg = 'Your PPA has been expired or not uploaded. Please contact Trader Admin';
    //                                 return response()->json(['status' => '1', 'msg'=>$msg],400);
    //                             }
    //                         }else{
    //                             //Error message for NOC Exchange (Buy or Sell)
    //                            $msg = 'You cannot place bid more than your maximum NOC quantum. Your maximum NOC quantum is set to '.strtoupper($nocData->final_noc_quantum).'.';
    //                            return response()->json(['status' => '1', 'msg'=>$msg],400);
    //                         }
    //                     }else{
    //                        //Error message for NOC Exchange (Buy or Sell)
    //                        $msg = 'Your NOC not registered for '.strtoupper($request->input('exchange')).'.';
    //                        return response()->json(['status' => '1', 'msg'=>$msg],400);
    //                     }
    //                 }else{
    //                   //Error message for NOC Type (Buy or Sell)
    //                   $msg = 'You are not allowed to place a bid for '.strtoupper($request->input('bid_action')).'.';
    //                     return response()->json(['status' => '1', 'msg'=>$msg],400);
    //                 }
    //             }else{
    //                 //NOC Error Message
    //                 $msg = 'Your NOC has been expired or not uploaded. Please contact Trader Admin';
    //                 return response()->json(['status' => '1', 'msg'=>$msg],400);
    //             }
    //         }else{
    //             //Exchange Error Message
    //             $msg = 'Your Exchange has been expired or not uploaded. Please contact Trader Admin';
    //             return response()->json(['status' => '1', 'msg'=>$msg],400);
    //         }
    //
    // }

    public function getallbid(Request $request, $trading)
    {
        // DB::enableQueryLog();
        // DB::getQueryLog();

        $var = $request->input('bid_date');
        $date = str_replace('/', '-', $var);
        $biddate = date('Y-m-d', strtotime($date));
        $placebidDataSubmitted=array();

        $placebidDataProcess = DB::table('place_bid')
        ->select('*')
        ->where('trading',$trading)
        ->where('exchange',$request->input('exchange'))
        ->where('client_id',$request->input('client_id'))
        ->where('bid_date', $biddate)
        ->whereNull('place_bid.deleted_at')
        ->where('status','0')
        ->get();


        // $placebidDataSubmitted = DB::table('place_bid')
        // ->select('*')
        // ->where('trading',$trading)
        // ->where('exchange',$request->input('exchange'))
        // ->where('client_id',$request->input('client_id'))
        // ->OrderBy('id','Desc')
        // ->limit('7')
        // ->get();

        $biddate = DB::table('place_bid')
        ->selectRaw('Distinct(`bid_date`) as date')
        ->where('exchange',$request->input('exchange'))
        ->where('client_id',$request->input('client_id'))
        ->whereNull('place_bid.deleted_at')
        ->OrderBy('bid_date','Desc')
        ->limit('7')
        ->get();

        foreach($biddate as $date){
          $placebidDataSubmitted[$date->date]=DB::table('place_bid')
          ->selectRaw('*,SUBSTRING(`place_bid`.`time_slot_from`,1,5) as time_slot_from,SUBSTRING(`place_bid`.`time_slot_to`,1,5) as time_slot_to')
          // ->where('trading',$trading)
          ->where('exchange',$request->input('exchange'))
          ->where('client_id',$request->input('client_id'))
          ->where('bid_date',$date->date)
          // ->where('status',1)
          ->whereNull('place_bid.deleted_at')
          ->OrderByRaw("bid_date",'Desc')
          ->get();
        }

        // dd($placebidDataSubmitted);
        return response()->json(['placebidDataProcess'=> $placebidDataProcess, 'placebidDataSubmitted'=>$placebidDataSubmitted, 'msg' => 'Bid added successfully', 'status' => '1']);
    }

    public function getbiddetailsbybidtype(Request $request, $trading)
    {
        $var = $request->input('bid_date');
        $date = str_replace('/', '-', $var);
        $biddate = date('Y-m-d', strtotime($date));
        $placebidDataForEdit = DB::table('place_bid')
        ->selectRaw('*,SUBSTRING(time_slot_from,1,5) as time_slot_from,SUBSTRING(time_slot_to,1,5) as time_slot_to')
        ->where('trading',$trading)
        ->where('exchange',$request->input('exchange'))
        ->where('client_id',$request->input('client_id'))
        ->where('bid_date',$biddate)
        ->where('bid_type',$request['bid_type'])
        ->whereNull('place_bid.deleted_at')
        ->get();

        $bid_array = $this->downloadbidexcel($request['bid_type'],$biddate,$request->input('client_id'));



        return response()->json(['placebidDataForEdit'=> $placebidDataForEdit , 'bid_array' => $bid_array , 'msg' => 'Bid added successfully' , 'status' => '1']);
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


    public function downloadbidexcel($bid_type,$date,$client_id)
    {
        // echo DB::enableQueryLog();

          /**
            * Block Bid Excel Download
            */

            // $date = date("Y-m-d",strtotime("+1 day", strtotime(date("Y-m-d"))));
            if($bid_type == 'block'){

                      // DB::enableQueryLog();
                      $singlebidarray=array();
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

                // return Excel::create($order_no, function($excel) use ($bidData) {
                //     $excel->sheet('sheet', function($sheet) use ($bidData)
                //     {
                        // $singlebidarray=[];
                        //  $singlebidarray[1]['A'] = 'W2MH0TPT0000';
                        //  $singlebidarray[1]['B'] = 'TPT01';
                        //  $singlebidarray[1]['C'] = 'S1TG0TPT0170';
                        //  $singlebidarray[1]['D'] = 'INDIA';
                         $i=1;
                         foreach ($bidData as $key => $value) {
                             $singlebidarray[$i]['A'] = trim($value->time_slot_from);
                             $singlebidarray[$i]['B'] = trim($value->time_slot_to);
                             $singlebidarray[$i]['C'] = trim($value->bid_price);
                             $singlebidarray[$i]['D'] = trim($value->bid_action=='sell' ? '-'.$value->bid_mw : $value->bid_mw);
                             $singlebidarray['count'] = 4;
                             $i++;
                         }
                        // $sheet->fromArray($data);
                //     });
                // })->store('csv', storage_path('excel/exports/blockbids/'))->download('csv');

                return $singlebidarray;
            }

            if($bid_type == 'single'){

              // DB::enableQueryLog();
              $bidData = DB::table('place_bid')
                  ->join('clients', 'place_bid.client_id', '=', 'clients.id')
                  ->selectRaw('place_bid.*')
                  ->where('place_bid.status', '1')
                  ->where('place_bid.bid_date','=', $date)
                  ->where('place_bid.bid_type','=', $bid_type)
                  ->where('place_bid.client_id','=',$client_id)
                  ->whereNull('deleted_at')
                  ->orderBy('bid_price','DESC')
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
                                  /*
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
                                  */
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
                      ksort($price_column_array);
                      $pre_sheetdata = array_merge([$price_column_array], $pre_sheetdata);
                      $pre_sheetdata['count']=count($array_values)+2;
                      return $pre_sheetdata;
                      // $this->generateCSV($pre_sheetdata,$client_id);
                  // });
              // })->store('csv', storage_path('excel/exports/singlebids'))->download('csv');


            }
    }






     /**
     * delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletebid($id)
    {
        // $bankData = Bankdetail::find($bank_detail_id);
        Placebid::where("id",$id)->delete();

        return response()->json(['msg' => 'Bid deleted successfully', 'status' => '1']);
    }


     /**
     * delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteallselectedbid(Request $request)
    {
        // $bankData = Bankdetail::find($bank_detail_id);

        Placebid::destroy($request->input('ids'));

        $var = $request->input('bid_date');
        $date = str_replace('/', '-', $var);
        $biddate = date('Y-m-d', strtotime($date));

        $placebidDataProcess = DB::table('place_bid')
        ->select('*')
        ->where('exchange',$request->input('exchange'))
        ->where('client_id',$request->input('client_id'))
        ->where('bid_date',$biddate)
        ->where('status','0')
        ->whereNull('deleted_at')
        ->get();

        $placebidDataSubmitted = DB::table('place_bid')
        ->select('*')
        ->where('exchange',$request->input('exchange'))
        ->where('client_id',$request->input('client_id'))
        ->where('bid_date',$biddate)
        ->whereNull('deleted_at')
        ->get();

        return response()->json(['placebidDataProcess'=> $placebidDataProcess, 'placebidDataSubmitted'=>$placebidDataSubmitted, 'msg' => 'Bid deleted successfully', 'status' => '1']);
    }


    /**
     * delete the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmplacebid(Request $request)
    {
        // dd($request->ids);
        // $data = array();
        $biddateData = str_replace('/', '', $request->input('bid_date'));
        $order_no = 'POWER-IEX-'.$request->input('client_id').'-'.$biddateData;
        $var = $request->input('bid_date');
        $date = str_replace('/', '-', $var);
        $biddate = date('Y-m-d', strtotime($date));

        // $validationSetting = Validationsetting::where('user_id',$request->input('client_id'))->get()->first();
        // if($validationSetting->exchange){
        // $exchangeData = DB::table('exchange_user')
        // ->join('exchange_registration', 'exchange_user.id', '=', 'exchange_registration.exchange_id')
        // ->select('exchange_user.*', 'exchange_registration.validitiy_from', 'exchange_registration.validitiy_to')
        // ->where('exchange_user.client_id',$request->input('client_id'))
        // ->whereRaw("exchange_registration.validitiy_from <="."'".date('Y-m-d', strtotime('-1 day', strtotime($biddate)))."'")
        // ->whereRaw("exchange_registration.validitiy_to >="."'".date('Y-m-d', strtotime('-1 day', strtotime($biddate)))."'")
        // ->first();

        // if(!$exchangeData){
        //     return response()->json(['msg' => 'user exchange expired', 'status' => '0']);
        // }
        // }

        // $blocked = Client::selectRaw("blocked,block_warning")->where("id",$request->input('client_id'))->first();
        // if(($blocked->blocked)&&($blocked->block_warning)){
        //   $blocked = Clientmaster::where("id",$request->input('client_id'))->first();
        //   $blocked->block_warning = 0;
        //   $blocked->save();
        // }else if($blocked->blocked){
        //     return response()->json(['msg' => 'Your account is blocked', 'status' => '3']);
        // }



        for ($i=0; $i<count($request->ids); $i++) {
            // $data['id']=$request->ids[$i];

           DB::table('place_bid')
                ->where('id',$request->ids[$i])
                ->update(['status' => '1','order_no' => $order_no]);
        }


        $placebidDataSubmitted[$biddate] = DB::table('place_bid')
        ->selectRaw('*,SUBSTRING(`place_bid`.`time_slot_from`,1,5) as time_slot_from,SUBSTRING(`place_bid`.`time_slot_to`,1,5) as time_slot_to')
        ->where('status', '1')
        ->where('bid_date',$biddate)
        ->where('client_id',$request->input('client_id'))
        ->whereNull('place_bid.deleted_at')
        ->get();


         // dd($placebidDataSubmitted);
        return response()->json(['placebidDataSubmitted'=>$placebidDataSubmitted, 'msg' => 'Bid successfully placed', 'status' => '1']);
    }


    public function placesimilarbidsasanyearlierdate(Request $request)
    {
        $placebidDataSubmitted = DB::table('place_bid')
        ->select('*')
        ->where('client_id',$request->ids)
        ->max('bid_date')
        ->get();

        return response()->json(['placebidDataSubmitted'=>$placebidDataSubmitted,]);
    }

    public function getbiddetailsbyid($id)
    {
        $placebidData = DB::table('place_bid')
        ->select('*')
        ->where('id',$id)
        ->first();
        $placebidData->time_slot_from=date('H:i',strtotime($placebidData->time_slot_from));
        $placebidData->time_slot_to=date('H:i',strtotime($placebidData->time_slot_to));
        return response()->json(['placebidData'=>$placebidData]);
    }

    public function getbidsubmissiontime($id)
    {

        $bidsubmissiontimeData = DB::table('clients')
        ->select('id','bid_cut_off_time')
        ->where('id',$id)
        ->get();

        date_default_timezone_set('Asia/Kolkata');
        $datetime = date('H:i:s');
        return response()->json(['bidSubmissionTime'=>$bidsubmissiontimeData,'datetime'=>$datetime]);
    }

    function timeDiff($firstTime,$lastTime) {
        $firstTime=strtotime($firstTime);
        $lastTime=strtotime($lastTime);
        $timeDiff=$lastTime-$firstTime;
        return $timeDiff/3600;
    }

    function get_array_index($find, $array) {
        for ($i = 0; isset($array[$i]); $i++) {
            if ($find == $array[$i]) {
                return $i;
                break;
            }
        }
        return false;
    }

    function ValidateBid($timeslice, $totalBidArray, $bidtype) {
        $priceArray = array();
        for ($km = 0; isset($totalBidArray[$km]); $km++) {
            $priceArray[] = $totalBidArray[$km][2];
        }

        $priceArray = array_values(array_unique($priceArray));
        sort($priceArray);
        // print_r($priceArray);
        //         exit();
        // print_r($timeslice);
        for ($j = 0; $j<count($timeslice)-1; $j++) {
            $buyQuantum = "NA";
            $sellQuantum = "NA";
            $myBuySellCheckArray = array();
            for ($i = 0; isset($priceArray[$i]); $i++) {
                $bid = array();
                // echo $j;
                // echo $timeslice[$j].$timeslice[$j+1];
                // exit();
                $bid = $this->getBidValueOnPerticularTimeSlice($totalBidArray, $timeslice[$j], $timeslice[$j + 1], $priceArray[$i]);
                // echo count($bid);
                // print_r($bid);
                // exit();
                if (count($bid) > 1) {
                    $buyCount = 0;
                    $sellCount = 0;
                    for ($p = 0; isset($bid[$p]); $p++) {
                        if ($bid[$p][1] =='buy') {
                            $buyCount++;
                        }

                        if ($bid[$p][1] =='sell') {
                            $sellCount++;
                        }
                    }
                    // echo $buyCount.'----'.$sellCount.'------'.$timeslice[$j + 1];
                    // exit();
                    // if ($buyCount > 0 && $sellCount > 0 && $timeslice[$j + 1] <> "") {
                    //     return "You Cant buy and sell at same price " . $priceArray[$i] . "~" . $timeslice[$j] . "-" . $timeslice[$j + 1];
                    // }
                    // echo $buyCount.'----'.$sellCount.'------'.$timeslice[$j + 1];
                    // exit();
                }
                if ($buyQuantum <> "NA" && $bid[0] > 0 && abs($buyQuantum) < abs($bid[0]) && $timeslice[$j + 1] <> "" && $bidtype == "SINGLE") {
                    return "This is illogical bid.";
                }
                if ($sellQuantum <> "NA" && $bid[0] < 0 && abs($sellQuantum) > abs($bid[0]) && $timeslice[$j + 1] <> "" && $bidtype == "SINGLE") {
                    return "This is illogical bid.";
                }
                // $myBuySellCheckArray[$i][0] = $priceArray[$i];
                // $myBuySellCheckArray[$i][1] = abs($bid[0]);
                // if ($bid[0] > 0) {
                //     $buyQuantum = $bid[0];
                //     $myBuySellCheckArray[$i][2] = "buy";
                // } else if ($bid[0] < 0) {
                //     $sellQuantum = $bid[0];
                //     $myBuySellCheckArray[$i][2] = "sell";
                // }
            }
            // echo count($bid);
                // print_r($bid);
                // echo $timeslice[$j];
                // exit();
        }
        // die;
        return "TRUE";
    }

    function gettimeslice1() {
        $a = '00:00,00:15,00:30,00:45,01:00,01:15,01:30,01:45,02:00,02:15,02:30,02:45,03:00,03:15,03:30,03:45,04:00,04:15,04:30,04:45,05:00,05:15,05:30,05:45,06:00,06:15,06:30,06:45,07:00,07:15,07:30,07:45,08:00,08:15,08:30,08:45,09:00,09:15,09:30,09:45,10:00,10:15,10:30,10:45,11:00,11:15,11:30,11:45,12:00,12:15,12:30,12:45,13:00,13:15,13:30,13:45,14:00,14:15,14:30,14:45,15:00,15:15,15:30,15:45,16:00,16:15,16:30,16:45,17:00,17:15,17:30,17:45,18:00,18:15,18:30,18:45,19:00,19:15,19:30,19:45,20:00,20:15,20:30,20:45,21:00,21:15,21:30,21:45,22:00,22:15,22:30,22:45,23:00,23:15,23:30,23:45,24:00';
        return explode(",", $a);
    }

    // function get_array_index($find, $array) {
    //     for ($i = 0; isset($array[$i]); $i++) {
    //         if ($find == $array[$i]) {
    //             return $i;
    //             break;
    //         }
    //     }
    //     return false;
    // }

    function getBidValueOnPerticularTimeSlice($main_array, $from, $to, $price) {
        // echo $price;
        // print_r($main_array);
        // exit();
        $myFullArray = array();
        for ($k = 0; isset($main_array[$k]); $k++) {
            if (strtotime($main_array[$k][0]) <= strtotime($from) && strtotime($main_array[$k][1]) >= strtotime($to) && abs($main_array[$k][2]) == abs($price) && $main_array[$k][5] =='buy') {
                $myFullArray[] = array($main_array[$k][3],$main_array[$k][5]);
            }
            if (strtotime($main_array[$k][0]) <= strtotime($from) && strtotime($main_array[$k][1]) >= strtotime($to) && abs($main_array[$k][2]) == abs($price) && $main_array[$k][5] =='sell') {
                $myFullArray[] = array($main_array[$k][3],$main_array[$k][5]);
            }
        }
        // print_r($myFullArray);
        // exit();
        return $myFullArray;
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

    public function getinvoiceamount($client_id,$portfolio_id,$exchange_type, $BidDate){
      $LastFifteenDays = date('Y-m-d', strtotime('-15 days', strtotime($BidDate)));
        $bill = Bill::selectRaw('sum(amount) as total,count(amount) as count_number')->where("client_id",$client_id)->whereDate('from_date','>=',$LastFifteenDays)->whereDate('to_date','<=',$BidDate)->get();
        if($bill[0]['count_number']){
        return $bill[0]['total']/ $bill[0]['count_number'];
      }else{
        return 0;
      }
    }

    public function getoutstandingbalace($client_id,$portfolio_id,$exchange_type){
        $outstandings=AccountStatement::where('client_id',$client_id)->orderBy("date",'ASC')->get();
        $opening_amount=0; $debit=0;  $credit=0;
        foreach($outstandings as $outstanding){
          if($outstanding['trans_type']=='OPEN-BAL'){
              $opening_amount = $outstanding['amount'];
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

    public function getpsmamount($client_id){
      $client = Clientmaster::select(['exposure','psm_days','psm_amount'])->where("id",$client_id)->get()->first();
      return (@$client['exposure'])?$client['exposure']:0;
    }

    function getBidDetailArray($clientID, $date, $type, $price) {
        $a = 0;
        $totalBidArray = array();
        // echo $str1 = "SELECT `id`,`blockfrom`,`blockto`,`price`,`bid` FROM  WHERE `client_id`='$clientID' and `date`='$date' and `type`='$type'";
        // exit();
        // $resultG = $dbname->selectQuerySingleRow($str1);
        $Data = DB::table('place_bid')
        ->select('*')
        ->where('client_id', $clientID)
        ->where('bid_date',$date)
        ->where('bid_type',$type)
        ->where('bid_price',$price)
        ->get();
        $placebidData = $Data->toArray();
        // print_r($placebidData);
        // echo $placebidData[0]['time_slot_from'];
        // exit();
        $i=0;
        foreach ($placebidData as $key => $value) {
            $totalBidArray[$i][0] = $value->time_slot_from;
            $totalBidArray[$i][1] = $value->time_slot_to;
            $totalBidArray[$i][2] = $value->bid_price;
            $totalBidArray[$i][3] = $value->bid_mw;
            $totalBidArray[$i][4] = $value->id;
            $totalBidArray[$i][5] = $value->bid_action;
            $i++;
        }


        return $totalBidArray;
    }
}
