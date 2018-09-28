<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillDetails;
use App\Invoice;
use App\BillCycle;
use App\BillGeneration;
use App\Obligation;

class InvoiceController extends Controller
{
   public function index(Request $request, $exchange='', $year='', $month_o='', $day='')
   {
   	 $d = strtotime(date('d-m-Y') . ' + 1 days');
   	if($exchange==''){
            $exchange='IEX';
        }
        if($year==''){
            $year=date('Y',$d);
        }
        if($month_o==''){
            $month_o =  "".date('m',$d)."";
        }
        if($day==''){
            $day = "".date('d',$d)."";
        }
        $date = date("Y-m-d",strtotime($year."-".$month_o."-".$day));
        $day = date('D', strtotime($date));
        $month = date('M', strtotime($date));
        $clients =array(); 
        //$invoice_list = Invoice::all()->where('date',$date);
        $client_list = BillCycle::where('date',$date)->get();
        $all_bill_string='';
         foreach($client_list as $client){
            if($client->cycle_type == 'DAYWISE'){
                $clients[$client->client_id]['company_name'] = $client->client_details->company_name;
                $clients[$client->client_id]['iex_portfolio'] = $client->client_details->iex_portfolio;
                // $clients[$client->client_id]['bill'][$client->bill_type] = array(
                //       'fromDate' => $date,
                //       'toDate' => $date,
                //       'billDate' => $date
                // );
                $clients[$client->client_id]['bill_string'] = isset($clients[$client->client_id]['bill_string'])? $clients[$client->client_id]['bill_string'].'`'.$client->client_id.'~'.$client->bill_type.'~'.$date.'~'.$date.'~'.$date:$client->client_id.'~'.$client->bill_type.'~'.$date.'~'.$date.'~'.$date;
                $all_bill_string .= '`'.$client->client_id.'~'.$client->bill_type.'~'.$date.'~'.$date.'~'.$date;
            }elseif($client->cycle_type == 'WEEKLY'){
                if($this->getDayStr($client->cycle_string) == $day){
                  $fromDate = date('Y-m-d', strtotime('-7 days', strtotime($date)));
                  $clients[$client->client_id]['company_name'] = $client->client_details->company_name;
                  $clients[$client->client_id]['iex_portfolio'] = $client->client_details->iex_portfolio;
                  // $clients[$client->client_id]['bill'][$client->bill_type] = array(
                  //       'fromDate' => $fromDate,
                  //       'toDate' => $date,
                  //       'billDate' => $date
                  // );
                   $clients[$client->client_id]['bill_string'] = isset($clients[$client->client_id]['bill_string'])? $clients[$client->client_id]['bill_string'].'`'.$client->client_id.'~'.$client->bill_type.'~'.$fromDate.'~'.$date.'~'.$date : $client->client_id.'~'.$client->bill_type.'~'.$fromDate.'~'.$date.'~'.$date;
                    $all_bill_string .= '`'.$client->client_id.'~'.$client->bill_type.'~'.$fromDate.'~'.$date.'~'.$date;
                }
            }elseif($client->cycle_type == 'MONTHLY'){
              $cycle_string = str_replace("LastDay", date('t', strtotime($date)), $client->cycle_string);
              $d = date('j', strtotime($date));
              if($cycle_string == $d){
                  $fromDate = date('Y-m-d', strtotime($date.' -1 month'));
                  $toDate = date('Y-m', strtotime($date)) . '-' . date('d', strtotime($date));
                  $portFolioId = $client->client_details->iex_portfolio;
                  $clients[$client->client_id]['company_name'] = $client->client_details->company_name;
                  $clients[$client->client_id]['iex_portfolio'] = $client->client_details->iex_portfolio;
                  // $clients[$client->client_id]['bill'][$client->bill_type] = array(
                  //       'fromDate' => $fromDate,
                  //       'toDate' => $toDate,
                  //       'billDate' => $toDate
                  // );
                  $clients[$client->client_id]['bill_string'] = isset($clients[$client->client_id]['bill_string'])? $clients[$client->client_id]['bill_string'].'`'.$client->client_id.'~'.$client->bill_type.'~'.$fromDate.'~'.$toDate.'~'.$toDate : $client->client_id.'~'.$client->bill_type.'~'.$fromDate.'~'.$toDate.'~'.$toDate;
                  $all_bill_string .= '`'.$client->client_id.'~'.$client->bill_type.'~'.$fromDate.'~'.$toDate.'~'.$toDate;

              }
            }elseif($client->cycle_type == 'CUSTOM'){
              $cycle_string = str_replace("LastDay", date('t', strtotime($date)), $client->cycle_string);
              $monthDateArr = explode(',', $cycle_string);
              $d = date('j', strtotime($date));
              if (in_array($d, $monthDateArr)) {
                  $dayIndex = array_search($d, $monthDateArr);
                  $fromDate = "";
                  $toDate = "";
                  if ($dayIndex == 0 && count($monthDateArr) > 1 && count($monthDateArr)!=8) {
                      $fromDate = date('Y-m-01', strtotime($date));
                      $toDate = date('Y-m', strtotime($date)) . '-' . date('d', strtotime($date));
                  } else if (count($monthDateArr) > 1 && count($monthDateArr)!=8) {
                      $fromDate = date('Y-m', strtotime($date)) . '-' . $monthDateArr[$dayIndex - 1];
                      $fromDate = date('Y-m-d', strtotime($fromDate . ' + 1 days'));
                      $toDate = date('Y-m', strtotime($date)) . '-' . date('d', strtotime($date));
                  } else if (count($monthDateArr) == 1 && count($monthDateArr)!=8) {
                      $fromDate = date('Y-m-01', strtotime($date));
                      $toDate = date('Y-m', strtotime($date)) . '-' . date('d', strtotime($date));
                  } else if ($dayIndex == 0 && count($monthDateArr)==8) {
                      $lmd = date("t", strtotime($date . ' - 1 month'));
                      $lmdday = date("Y-m-t", strtotime($date . ' - 1 month'));
                      $dateInterval = $lmd - 28;
                      $fromDate = date('Y-m-d', strtotime($lmdday .'-'. $dateInterval.'days'));
                      $fromDate = date('Y-m-d', strtotime($fromDate . ' + 1 days'));
                      $toDate = date('Y-m', strtotime($date)) . '-' . date('d', strtotime($date));

                  } else if ($dayIndex > 0 && count($monthDateArr)==8) {
                      $fromDate = date('Y-m', strtotime($date)) . '-' . $monthDateArr[$dayIndex - 1];
                      $fromDate = date('Y-m-d', strtotime($fromDate . ' + 1 days'));
                      $toDate = date('Y-m', strtotime($date)) . '-' . date('d', strtotime($date));
                  }
                  $portFolioId = $client->client_details->iex_portfolio;
                  $clients[$client->client_id]['company_name'] = $client->client_details->company_name;
                  $clients[$client->client_id]['iex_portfolio'] = $client->client_details->iex_portfolio;
                  // $clients[$client->client_id]['bill'][$client->bill_type] = array(
                  //       'fromDate' => $fromDate,
                  //       'toDate' => $toDate,
                  //       'billDate' => $toDate
                  // );
                  $clients[$client->client_id]['bill_string'] = isset($clients[$client->client_id]['bill_string'])? 
                  $clients[$client->client_id]['bill_string'].'`'.$client->client_id.'~'.$client->bill_type.'~'.$fromDate.'~'.$toDate.'~'.$toDate : $client->client_id.'~'.$client->bill_type.'~'.$fromDate.'~'.$toDate.'~'.$toDate;
                  $all_bill_string .= '`'.$client->client_id.'~'.$client->bill_type.'~'.$fromDate.'~'.$toDate.'~'.$toDate;
              }
            }
         }
        if(isset($request->status)){
         return view('invoice.list',['list' => $clients,'client'=>$client_list,'status' => $request->status]);
        }
        return view('invoice.list',compact('client_list','clients','all_bill_string'));

   }

    public function client_list(Request $request){
        $list = $request->client_value;
        $list3 = explode('`',$list);
        foreach($list3 as $key => $value){
          $val = explode('~',$value);
          /*
          *   $val[0] = client_id
          *   $val[1] = bill_type
          *   $val[2] = from_date
          *   $val[3] = to_date
          *   $val[4] = bill_date
          */
          $count = BillGeneration::where('client_id',$val[0])->where('bill_type',$val[1])->where('bill_date',$val[4])->get();
            if(count($count) > 0){
               $count1 = Obligation::select('fundpayin')->where('client_id',$val[0])->where('bill_date',$val[4])->get();
                 if($count1->fundpayin > 0){
                    return response()->json(array('data'=>'0'));
            }else{
              return response()->json(array('data'=>'1'));
            }
          
         }else{
          return response()->json(array('data'=> $list3));
         }
        }
    }

   public function create($client_id){
      $fy = \App\Common\FinancialFunctions::getIntFinancialYear(date('Y-m-d'));
      
      $billnumber = BillDetails::max('bill_no');
      //dd($billnumber);
      if($billnumber == "")
      {
          $billnumber = 1;
      }
      else
      {
          $billnumber = $billnumber + 1;
      }
     	$invoice = new Invoice();
      $description = BillDetails::select('json')->where('id',$client_id)->get();
     	$invoice->client_id = $client_id;
      $invoice->invoice_type = 'en';//$request->input('invoice_type');
      $invoice->description = $description;
      $invoice->billnumber = $billnumber;
      $invoice->fy = $fy;

      //more to be added when table created
      $invoice->save();
      return redirect()->back()->with('message','successfully');

      //return view('invoice.view',compact('invoice'));
     // dd(3);
   }
   public function view_invoice($id){
    $invoice = Invoice::select('*')->where('client_id',$id)->get();
    // dd($invoice);
    return view('invoice.view',compact('invoice'));
   }

    public function regenerate($id){
        $invoice = Invoice::where('id',$id);
        $description = BillDetails::select('json')->where('id',$id);
        $invoice->invoice_type = $request->input('invoice_type');
        $invoice->description = $description;
        //more to add when table created
        $invoice->update();
        return redirect('/')->with('updatemsg', 'Record Updated Successfully!');

    }

   public function edit($id){
        $invoice = Invoice::select('*')->where('id', $id)->first();
        return view('invoice.edit',compact('invoice'));
   }

   public function update(Request $request,$id){
        $invoice = Invoice::find($id);
        $invoice->invoice_type = $request->input('invoice_type');
        $invoice->description = $request->input('description');
        //more to add when table created
        $invoice->update();
        return redirect('/')->with('updatemsg', 'Record Updated Successfully!');
     
   }
   public function delete($id){
        $invoice = Invoice::find($id);
        $invoice->destroy($id);
        return redirect()->back()->with('delmsg', 'Record Deleted Successfully!');
   }
    public function isBillGenerate($client_id,$date){
    $result = DB::table('exc_bill_generation')->select('bill_date')->where('client_id',$client_id)->where('bill_status','DOWNLOADED')->where('bill_date',$date);

    return $result;
   }
   function getDetailByCycleBill() {
    $cycleQuery = BillCycle::select('client_id','cycle_type','cycle_string')->get()->toArray();
    for ($j = 0; $j < count($cycleQuery); $j++) {
        $cycleDetail[$j]['id'] = $cycleQuery[$j]['client_id'];
        $cycleDetail[$j]['cycle_type'] = $cycleQuery[$j]['cycle_type'];
        $cycleDetail[$j]['cycle_string'] = $cycleQuery[$j]['cycle_string'];
    }
    return $cycleDetail;
}
//   function CheckbillAgain($client_id,$fromdate, $todate, $type) {
//     $Arr = array();
//     $sumoftotalbidResult = DB::table('exc_bill_generation')->select('bill_date')->where('client_id',$client_id)->where('bill_date',$fromdate)->where('bill_status','DOWNLOADED')->where('bill_date',$date)->where('type',$type);
//     if ($sumoftotalbidResult > 0) {
//         for ($i = 0; $i < $dbname->rowcount; $i++) {
//             $Arr[] = $dbname->singleDataSet->bill_date;
//             $dbname->getNextRow();
//         }
//         return $Arr;
//     } else {
//         return $Arr;
//     }
// }
function getDayStr($dayStr) {
    $m = trim($dayStr);
    switch ($m) {
        case "1":
            $m = "Mon";
            break;
        case "2":
            $m = "Tue";
            break;
        case "3":
            $m = "Wed";
            break;
        case "4":
            $m = "Thu";
            break;
        case "5":
            $m = "Fri";
            break;
        case "6":
            $m = "Sat";
            break;
        case "7":
            $m = "Sun";
            break;
        default:
            break;
    }
    return $m;
}

}
