<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Client;
use App\Placebid;
// use App\User;
// use Excel;
use Session;
use Auth;
class OrderbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderbook()
    {
            return view('dam.iex.orderbook.orderbook');
    }

    public function orderbookdata(Request $request)
    {
      $fromDate = date('Y-m-d',strtotime(str_replace('/','-',$request->input('date_from'))));

      $toDate = date('Y-m-d',strtotime(str_replace('/','-',$request->input('date_to'))));

      // if(\Auth::user()->member_type=='ADMIN'){
        $client_id = $request->input('client_id');
      // }else{
      //   $id = Auth::id();
      //   $client_id = User::select('client_id')->where('id',$id)->get()->toArray();
      //   $client_id = $client_id[0]['client_id'];
      // }
       $placebidData = DB::table('place_bid')
        ->join('clients', 'place_bid.client_id', '=', 'clients.id')
        ->selectRaw("place_bid.bid_date, place_bid.order_no, place_bid.status, clients.cin as cin_no, clients.name as company_name,concat(SUBSTRING(bid_date, 9, 2),'/',SUBSTRING(bid_date, 6,2),'/',SUBSTRING(bid_date, 1,4)) as biddate")
        ->groupBy('place_bid.bid_date')
        ->where('place_bid.client_id', $client_id)
        ->where('place_bid.status', '!=', 0)
        ->whereBetween('place_bid.bid_date',[$fromDate, $toDate])
        ->get();
        //dd($placebidData);
        $portfolio_id = 'TEST';#\App\Common\Bid::getportfolio_id_by_client($client_id,'iex');

        return response()->json(['placebidData'=> $placebidData,'portfolio_id'=>$portfolio_id]);
    }

    public function vieworderdetails($orderno, $bid_type)
    {
        // get all iex place bid data
        $orderbookdetails = DB::table('place_bid')
        ->select('*')
        ->where('order_no', $orderno)
        ->where('bid_type', $bid_type)
        ->get();
        return view('dam.iex.orderbook.vieworderdetails',compact('orderbookdetails'));
    }

    public function downloadExcel($type)
    {
        $data = Placebid::get()->toArray();
        return Excel::create('orderbook', function($excel) use ($data) {
            $excel->sheet('sheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}