<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\RecPriceSetting;
use App\ExcExchangeRatio;
use Carbon\Carbon;
use DB;
use Validator;
use App\Client;
use App\RecBiddingSetting;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;


class RecSettingController extends Controller
{
	public function priceViewindex()
	{
    $price_setting=RecPriceSetting::first();
		return view('rec.rec_price',compact('price_setting'));
	}
  public function priceStore(Request $request,$id='')
  {
     $this->validate($request, [
          'valid_from_date' => 'required',
          'floar_price' => 'required',
          'floar_price1' => 'required',
          'forbidden_price' => 'required',
          'forbidden_price1' => 'required',
      ]);

    // change date format
    $change_valid = strtr($request->valid_from_date, '/', '-');
    $from_date = date("Y-m-d", strtotime($change_valid));
    
    if($request->price_id!='')
    {
      $price_sett = RecPriceSetting::find($request->price_id);
    }
    else
    {
      $price_sett = new RecPriceSetting();
    }
    
    $price_sett->valid_from_date = $from_date;
    $price_sett->floar_price = $request->floar_price;
    $price_sett->floar_price1 = $request->floar_price1;
    $price_sett->forbidden_price = $request->forbidden_price;
    $price_sett->forbidden_price1 = $request->forbidden_price1;
    $price_sett->save();

    if($request->price_id!='')
    {
      return redirect()->back()->with('success','Price Setting updated successfully.');
    }
    else
    {
      return redirect()->back()->with('success','Price Setting added successfully.');
    }
  }

  public function exchangeViewindex()
  {
    $exchange_setting=ExcExchangeRatio::first();
    return view('rec.rec_exchange_ratio',compact('exchange_setting'));
  }

  public function exchangeStore(Request $request,$id='')
  {

     $this->validate($request, [
          'validate_start' => 'required',
          'iex_buy_solar_per' => 'required',
          'pxil_buy_solar_per' => 'required',
          'iex_buy_nonsolar_per' => 'required',
          'pxil_buy_nonsolar_per' => 'required',
          'iex_sell_solar_per' => 'required',
          'pxil_sell_solar_per' => 'required',
          'iex_sell_nonsolar_per' => 'required',
          'pxil_sell_nonsolar_per' => 'required',
      ]);


   // change date format
    $change_valid = strtr($request->validate_start, '/', '-');
    $from_date = date("Y-m-d", strtotime($change_valid));
    
    if($request->exchange_id!='')
    {
      $exchange_sett = ExcExchangeRatio::find($request->exchange_id);
    }
    else
    {
      $exchange_sett = new ExcExchangeRatio();
    }
    
    $exchange_sett->validate_start = $from_date;
    $exchange_sett->iex_buy_solar_per = $request->iex_buy_solar_per;
    $exchange_sett->pxil_buy_solar_per = $request->pxil_buy_solar_per;
    $exchange_sett->iex_buy_nonsolar_per = $request->iex_buy_nonsolar_per;
    $exchange_sett->pxil_buy_nonsolar_per = $request->pxil_buy_nonsolar_per;
    $exchange_sett->iex_sell_solar_per = $request->iex_sell_solar_per;
    $exchange_sett->pxil_sell_solar_per = $request->pxil_sell_solar_per;
    $exchange_sett->iex_sell_nonsolar_per = $request->iex_sell_nonsolar_per;
    $exchange_sett->pxil_sell_nonsolar_per = $request->pxil_sell_nonsolar_per;
    $exchange_sett->save();

    if($request->exchange_id!='')
    {
      return redirect()->back()->with('success','Exchange ratio updated successfully.');
    }
    else
    {
      return redirect()->back()->with('success','Exchange ratio added successfully.');
    }
  }  

  public function biddingSearchindex()
  {
    $clientData = Client::all();
    return view('rec.rec_bidding',compact('clientData'));
  }
  public function biddingViewindex(Request $request,$id='')
  {
    if($id!='')
    {
      $client_id=$id;
    }
    else
    {
      $client_id=$request->client_id;
    }

    $bidding_sett=RecBiddingSetting::where('client_id',$client_id)->first();
    $clientData = Client::all();
    return view('rec.create_rec_bidding',compact('bidding_sett','client_id','clientData'));
  }
  public function biddingStore(Request $request,$id='')
  {

        $validator = Validator::make(Input::all(), [
            'bidding_cut_off_time' => 'required',
            'iex_ca_client_id' => 'required',
            'pxil_ca_client_id' => 'required',
            'rec_exchange_type' => 'required',
            'rec_energy_type' => 'required',
            'red_bid_type' => 'required',
            'rec_pxil_status' => 'required',
            'rec_iex_status' => 'required',
        ]);

        if ( $validator->fails()) 
        {
        return redirect()->route('biddingViewID', ['id' => $request->client_id])->withErrors($validator)->withInput();
        }
    
    if($request->bidding_id!='')
    {
      $bidding_sett = RecBiddingSetting::find($request->bidding_id);
    }
    else
    {
      $bidding_sett = new RecBiddingSetting();
      $bidding_sett->client_id = $request->client_id;
    }
    
    $bidding_sett->bidding_cut_off_time = $request->bidding_cut_off_time;
    $bidding_sett->iex_ca_client_id = $request->iex_ca_client_id;
    $bidding_sett->pxil_ca_client_id = $request->pxil_ca_client_id;
    $bidding_sett->rec_exchange_type = $request->rec_exchange_type;
    $bidding_sett->rec_energy_type = $request->rec_energy_type;
    $bidding_sett->red_bid_type = $request->red_bid_type;
    $bidding_sett->rec_but_category = $request->rec_but_category;
    $bidding_sett->rec_iex_status = $request->rec_iex_status;
    $bidding_sett->rec_pxil_status = $request->rec_pxil_status;
    $bidding_sett->save();

    if($request->bidding_id!='')
    {
        return redirect()->route('biddingViewID', ['id' => $request->client_id])->with('success','Bidding updated successfully.');
    }
    else
    {
        return redirect()->route('biddingViewID', ['id' => $request->client_id])->with('success','Bidding added successfully.');
    }
  }  


}