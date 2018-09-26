<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Client;
use App\Placebid;
use Excel;

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
        $client_id = $request->input('client_id');
        // $bid_type = $request->input('bid_type');
        // $order_status = $request->input('order_status');
        // $sort_status = $request->input('sort_status');
        // $exchange = $request->input('exchange');
        // $order_nature = $request->input('order_nature');

        // get all iex place bid data
        // DB::enableQueryLog();
       $placebidData = DB::table('place_bid')
        ->join('clients', 'place_bid.client_id', '=', 'clients.id')
        ->join('users', 'place_bid.staff_id', '=', 'users.id')
        ->selectRaw("place_bid.bid_date, place_bid.order_no, place_bid.status, clients.cin as cin_no, clients.name as company_name,clients.iex_portfolio as portfolio_id,concat(SUBSTRING(bid_date, 9, 2),'/',SUBSTRING(bid_date, 6,2),'/',SUBSTRING(bid_date, 1,4)) as biddate, users.name as order_placed_by")
        // ->groupBy('place_bid.bid_date')
        ->where('place_bid.client_id', $client_id)
        ->where('place_bid.status', '!=', 0)
        ->whereBetween('place_bid.bid_date',[$fromDate, $toDate])
        ->get();
// dd(DB::getQueryLog());

        // dd($placebidData);
        //get all pxil place bid data
        // $pxilPlaceBidData = array();
        // dd($exchangeData);
        return response()->json(['placebidData'=> $placebidData]);
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