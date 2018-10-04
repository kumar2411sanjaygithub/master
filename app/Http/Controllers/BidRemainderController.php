<?php

namespace App\Http\Controllers;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use DB;
use Mail;
use App\SmsLog;
use App\EmailLog;
use App\Contactdetail;
use App\Client;
use App\Placebid; 
use Carbon\Carbon;
use View;


/**
* 
*/
class BidRemainderController extends Controller
{
  	
	public function client_list(Request $request){
		$id = $request['id'];
		if(!$id)
		{
		 $a = array();
		 $data['clients'] = Client::select('id','company_name','iex_portfolio')->get();
		 foreach ($data['clients'] as $key => $value) {
			$d = Placebid::select('*')->where('status','0')->orderBy('bid_date','desc')->take(1)->get()->toArray();
			$sms = $value->sms()->where('status','1')->where('client_id',[$value->id])->orderBy('created_at','desc')->take(1)->get()->toArray();
			$email = $value->email()->where('status','1')->where('client_id',[$value->id])->orderBy('created_at','desc')->take(1)->get()->toArray();
			$a[]= array(
				'client_id' => $value->id,
				'company_name' => $value->company_name,
				'iex_portfolio'=> $value->iex_portfolio,
				'bid_submission_date' => isset($d[0])?$d[0]['bid_date']:'',
				'bid_submission_time' => isset($d[0])?$d[0]['created_at']:'NA',
				'sms_submission_time' =>explode(" ",(isset($sms[0])?$sms[0]['created_at']:'')),
				'email_submission_time' =>explode(" ",(isset($email[0])?$email[0]['created_at']:'')),

			);
		}
		
		    return view('dam.iex.bidplacement.bidplacement',['a'=>$a,'id'=>$id]); 
	
	    }
		else
		{

			$a = array();
		 	$data['clients'] = Client::select('id','company_name','iex_portfolio')->where('id',$id)->get();
		 	//dd($data['clients'][0]['company_name']);
			$d = Placebid::where('client_id',$id)->where('status','0')->orderBy('bid_date','desc')->take(1)->get()->toArray();
			$sms = SmsLog::where('status','1')->where('client_id',$id)->orderBy('created_at','desc')->take(1)->get()->toArray();
			$email = EmailLog::where('status','1')->where('client_id',$id)->orderBy('created_at','desc')->take(1)->get()->toArray();
			
			$a[]= array(
				'client_id' => $id,
				'company_name' => $data['clients'][0]['company_name'],
				'iex_portfolio' => $data['clients'][0]['iex_portfolio'],
				'bid_submission_date' => isset($d[0])?$d[0]['bid_date']:'',
				'bid_submission_time' => isset($d[0])?$d[0]['created_at']:'NA',
				'sms_submission_time' =>explode(" ",(isset($sms[0])?$sms[0]['created_at']:'')),
				'email_submission_time' =>explode(" ",(isset($email[0])?$email[0]['created_at']:'')),
			);
		  return view('dam.iex.bidplacement.bidplacement',['a'=>$a,'id'=>$id]); 
		}
		 
	}

}	
