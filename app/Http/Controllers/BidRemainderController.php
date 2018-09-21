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
		 $data['clients'] = Client::select('id','name as company_name')->get();
		 foreach ($data['clients'] as $key => $value) {
//dd($value->id);
			$d = Placebid::select('*')->where('status','0')->orderBy('bid_date','desc')->take(1)->get()->toArray();
			//$d = DB::table('place_bid')->orderBy('bid_date','desc')->where('status','1')->where('client_id',$value->id)->orderBy('bid_date','desc')->take(1)->get();
			//dd($d);

			//**********************************
			// $sms = $value->sms()->where('status','1')->where('client_id',[$value->id])->orderBy('created_at','desc')->take(1)->get()->toArray();
			// $email = $value->email()->where('status','1')->where('client_id',[$value->id])->orderBy('created_at','desc')->take(1)->get()->toArray();
			//**********************************

			// dd($d);
			$a[]= array(
				'client_id' => $value->id,
				'company_name' => $value->company_name,
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
		 	$data['clients'] = Client::select('id','name as company_name')->where('id',$id)->get();
		 	//dd($data['clients'][0]['company_name']);
			$d = Placebid::where('client_id',$id)->where('status','0')->orderBy('bid_date','desc')->take(1)->get()->toArray();
			//$d = DB::table('place_bid')->orderBy('bid_date','desc')->where('status','1')->where('client_id',$value->id)->orderBy('bid_date','desc')->take(1)->get();
			//dd($d);
			
			//**********************
			// $sms = SmsLog::where('status','1')->where('client_id',$id)->orderBy('created_at','desc')->take(1)->get()->toArray();
			// $email = EmailLog::where('status','1')->where('client_id',$id)->orderBy('created_at','desc')->take(1)->get()->toArray();
			//**********************
			$a[]= array(
				'client_id' => $id,
				'company_name' => $data['clients'][0]['company_name'],
				'bid_submission_date' => isset($d[0])?$d[0]['bid_date']:'',
				'bid_submission_time' => isset($d[0])?$d[0]['created_at']:'NA',
				'sms_submission_time' =>explode(" ",(isset($sms[0])?$sms[0]['created_at']:'')),
				'email_submission_time' =>explode(" ",(isset($email[0])?$email[0]['created_at']:'')),
			);
		


		return view('dam.iex.bidplacement.bidplacement',['a'=>$a,'id'=>$id]); 
		}
		 
	}


	// public function sending_mail($id){
 //      $client_mail = Contactdetail::select('email','name')->where('client_id', $id)->where('bid_alert','yes')->get()->toArray();
 //      // dd($client_mail);
     
 //      $data = array('name'=>"Virat Gandhi");
 //      $out = Mail::send('email.email', $data, function($message) use ($client_mail) {
 //         foreach ($client_mail as $key => $user) {
 //           $message->to($user['email'], $user['name']);
 //         }
 //         $message->subject('BID Not Recieved  for DD '.date('d-M-Y'));
 //         $message->cc('php11@cybuzzsc.com');
 //         $message->bcc('php9@cybuzzsc.com');
 //         $message->from('php5@cybuzzsc.com','shalu gupta');
 //      });
 //      // print_r($out);
 //      //echo "Mail sent successfully"; 
 //      return redirect()->back()->with('message', 'Mail has been sent successfully');

     //}


	

}	
