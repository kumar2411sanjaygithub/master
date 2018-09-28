<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\ServiseAlert;
use App\Client;
use App\Sms\SendSms;
use App\Placebid;
use App\SmsLog;

class SmsController extends Controller
{

    public function bidRemainder_msg($id)
    {
         try{
            $client = ServiseAlert::where('client_id', $id)->where('alert_type','bid_alert')->where('sms','yes')->get()->toArray();

            if(count($client) > 0){
              $client_num = Contact::select('mob_num','name')->where('client_id', $id)->get()->toArray();
             $company_name = Client::select('company_name','iex_portfolio')->where('id', $id)->get()->toArray();


              $clientName = $company_name[0]['company_name'];
              $portfolio = $company_name[0]['iex_portfolio'];
              $message =  "Dear ".$clientName." (".$portfolio."),".chr(10).chr(10)."Your bid for DD ".date('d-M-Y')." has not been received yet. Request to submit it before 11:00 AM.".chr(10).chr(10)."Thank You".chr(10)."TPTCL Operations Team".chr(10)."0120-6102210/13.";
              $client_num = array_column($client_num,'mob_num');

              $output = SendSms::send($client_num, $message);
             
              $data = array(
                          'client_id'=> $id,'date'=>date('Y-m-d'),'type'=>'bid-sms','status'=> 1
                          );
              SmsLog::insert($data);
              return redirect()->back()->with('success','Sms Sent Successfully.');
         }else{
        return redirect()->back()->with('success','Service Is Not Applicable For You.');
      } }
         catch(Exception $ex){
              $validator = Validator::make([], []);
              $validator->getMessageBag()->add('Email', 'Opps! Mail sending failed. Plesae try after sometime.');
              return redirect()->back()->withErrors($validator->getMessageBag());
         }

    }

    public function bidSubmit_msg($id)
    {

        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('bid_sms','yes')->get()->toArray();
       	$bid_date = Placebid::where('client_id',$id)->select('bid_date')->take(1)->latest()->get()->toArray();

       	$date = array_column($bid_date , 'bid_date');
       	 $delivery_date = implode($date,',');

        $message =  "Dear Sir".chr(10)."We have received your bid for delivery date ".$delivery_date."and same is being processed for submission on Exchange Terminal.";
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }

    public function sms_obligation($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('obl_sms','yes')->get()->toArray();
        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0]	;

        $message =  "Dear ".$clientName." (".$portfolio."),".chr(10).chr(10)."Your bid for DD ".date('d-M-Y')." has not been received yet. Request to submit it before 11:00 AM.".chr(10).chr(10)."Thank You".chr(10)."TPTCL Operations Team".chr(10)."0120-6102210/13.";
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }

    public function sms_nocExpiry($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('noc_sms','yes')->get()->toArray();

        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0];

        $message =  "Dear ".$clientName." ".chr(10).chr(10)."Your Standing clearance/No Objection Certificate in IEX for".$clientName." for Portfolio ID". " " . $portfolio . " is valid up to Delivery Date " . date('d-m-Y') . ". To continue further bidding, Kindly update the renewed NOC at PETS portal at earliest.";
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }

    public function sms_PpaExpiry($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('ppa_sms','yes')->get()->toArray();
        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0]	;

        $message =  "Dear Sir".chr(10).chr(10)."The PPA for ".$clientName." (Portfolio ID " . $portfolio . ") is valid up to Delivery Date " . date('d-m-Y').". You are requested to take necessary action for renewal of PPA.";
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }

    public function sms_ExReg($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('exreg_sms','yes')->get()->toArray();
        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0]	;

        $message =  "Dear Sir".chr(10).chr(10)." The membership registration on IEX/PXIL for ".$clientName." (Portfolio ID ".$portfolio.") is valid up to Trade Date ". date('d-m-Y').".For extension of the membership you are requested to get in touch with TPTCL.";

        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }

    public function sms_Billing($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('bill_sms','yes')->get()->toArray();
        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0]	;

        $message =  "Dear ".$clientName." (".$portfolio."),".chr(10).chr(10)."Your bid for DD ".date('d-M-Y')." has not been received yet. Request to submit it before 11:00 AM.".chr(10).chr(10)."Thank You".chr(10)."TPTCL Operations Team".chr(10)."0120-6102210/13.";
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }

    public function sms_Profitability($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('profitability','yes')->get()->toArray();
        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0]	;

        $message =  "Dear ".$clientName." (".$portfolio."),".chr(10).chr(10)."Your bid for DD ".date('d-M-Y')." has not been received yet. Request to submit it before 11:00 AM.".chr(10).chr(10)."Thank You".chr(10)."TPTCL Operations Team".chr(10)."0120-6102210/13.";
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }

    public function sms_Rtc($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('rtc_sms','yes')->get()->toArray();
        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0]	;

        $message =  "Dear ".$clientName." (".$portfolio."),".chr(10).chr(10)."Your bid for DD ".date('d-M-Y')." has not been received yet. Request to submit it before 11:00 AM.".chr(10).chr(10)."Thank You".chr(10)."TPTCL Operations Team".chr(10)."0120-6102210/13.";
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }

    public function sms_Scheduling($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('sch_sms','yes')->get()->toArray();
        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0]	;

        $message =  "Dear Sir ".chr(10).chr(10)." Your ratesheet has been sent to your registered email id. Kindly check your mail." ;
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }

     public function sms_Ratesheet($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('ratesheet_sms','yes')->get()->toArray();
        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0]	;

        $message =  "Dear Sir ".chr(10).chr(10)." Your ratesheet has been sent to your registered email id. Kindly check your mail." ;
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }
     public function sms_Credential($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('credential','yes')->get()->toArray();
        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0]	;

        $message =  "Dear ".$clientName." (".$portfolio."),".chr(10).chr(10)."Your bid for DD ".date('d-M-Y')." has not been received yet. Request to submit it before 11:00 AM.".chr(10).chr(10)."Thank You".chr(10)."TPTCL Operations Team".chr(10)."0120-6102210/13.";
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }

     public function bidRemainder_Account($id)
    {
    	$portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
    	$portfolio = $portfolio_id[0]['portfolio_id'];


        $client_num = Contactdetail::select('mobile_no','name')->where('client_id', $id)->where('account_sms','yes')->get()->toArray();
        $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();

        $clientName = $company_name[0]	;

        $message =  "Dear ".$clientName." (".$portfolio."),".chr(10).chr(10)."Your bid for DD ".date('d-M-Y')." has not been received yet. Request to submit it before 11:00 AM.".chr(10).chr(10)."Thank You".chr(10)."TPTCL Operations Team".chr(10)."0120-6102210/13.";
        $client_num = array_column($client_num,'mobile_no');
        $output = SendSms::send($client_num, $message);
        echo "message has been sent";
    }




}
