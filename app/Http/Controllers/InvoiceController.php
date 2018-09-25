<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillDetails;
use App\Invoice;
// use App\BillDetails;

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
        $invoice_list = Invoice:: all()->where('date',$date);
  
        if(isset($request->status)){
            
            return view('invoice.list',['list' => $invoice_list,'status' => $request->status]);
        }

        return view('invoice.list',['list' => $invoice_list]);


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
     // dd(3);
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
}
