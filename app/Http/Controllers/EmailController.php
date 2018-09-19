<?php

namespace App\Http\Controllers;

use Mail;
use App\AccountStatement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contactdetail;
use App\Exchangeuser;
use App\Placebid;
use App\FtpFiles;
use App\Clientmaster;
use Validator;
use App\Manualbilltemp;
use App\TraderMail;
use App\EmailLog;
use App\Bill;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Redirect;
use File;
use ZipArchive;
// use App\Mail\SendEmail;


class EmailController extends Controller
{

    public function getoutstandingbalace($client_id)
            {
                $outstandings=AccountStatement::where('client_id',$client_id)->orderBy("date",'ASC')->get();

                $opening_amount=0; $debit=0;  $credit=0;

                foreach($outstandings as $outstanding)
                {
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
    public function bidRemainder_mail($id){
      try {
           $client_mail = Contactdetail::select('email','name')->where('client_id', $id)->where('bid_email','yes')->get()->toArray();
           $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
           $dateName = date('d-M-Y');
           $data = array('name'=>"Virat Gandhi");
           $out = Mail::send('email.email',array('dateName'=> $dateName) , function($message) use ($client_mail,$trader_mail) {
                foreach ($client_mail as $key => $user) {
                   $message->to($user['email'], $user['name']);
                 }
                   $message->subject('BID Not Recieved  for DD '.date('d-M-Y'));
                     foreach($trader_mail as $key => $email){
                       $message->cc($email['email_cc']);
                       $message->bcc($email['email_bcc']);
                       $message->from($email['mail_from']);
                     }
           });
           $data = array(
                     'client_id'=> $id,'date'=>date('d-M-Y'),'type'=>'bid-mail','status'=> 1
                     );
           EmailLog::insert($data);
           return redirect()->back()->with('success','Mail Sent Successfully.');
      }
      catch(Exception $ex){
           $validator = Validator::make([], []);
           $validator->getMessageBag()->add('Email', 'Opps! Mail sending failed. Plesae try after sometime.');
           return redirect()->back()->withErrors($validator->getMessageBag());
      }
	}

  public function mail_obligation($client_id,$ftp_id){
     try {
      $client_mail = Contact::select('email','name')->where('client_id', $client_id)->where('obl_email','yes')->get()->toArray();
      $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
      $ftp_schedule = FtpFiles::select('filename','filepath')->where('id',$ftp_id)->where('client_id',$client_id)->get()->toArray();
      $pathToAttach = realpath($ftp_schedule[0]['filepath'].'\\'.$ftp_schedule[0]['filename']);

      $dateName = date('d-M-Y');
      $data = array('name'=>"Virat Gandhi");
      $out = Mail::send('email.obligation',array('dateName'=> $dateName), function($message) use ($client_mail,$trader_mail,$pathToAttach) {
            foreach ($client_mail as $key => $user) {
              $message->to($user['email'], $user['name']);
            }
              $message->subject('Final Obligation Report for DD '.date('d-M-Y'));
            foreach($trader_mail as $key => $email){
              $message->cc($email['email_cc']);
              $message->bcc($email['email_bcc']);
              $message->from($email['mail_from']);
            }
              $message->attach($pathToAttach);
      });
             $devices = FtpFiles::find($client_id)->where('type','OBL')->where('client_id',$client_id);

             $devices->update([
               'mail_status' => 1
              ]);
             $data = array(
                     'client_id'=> $client_id,'date'=>date('d-M-Y'),'type'=>'obligation-mail','status'=> 1
                     );
           EmailLog::insert($data);


      return redirect()->back()->with('success','Mail Sent Successfully.');
      }
      catch(Exception $ex){
           $validator = Validator::make([], []);
           $validator->getMessageBag()->add('Email', 'Opps! Mail sending failed. Plesae try after sometime.');
           return redirect()->back()->withErrors($validator->getMessageBag());
      }
  }



  public function mail_nocEx($id){
      $client_mail = Contactdetail::select('email','name')->where('client_id', $id)->where('noc_sms','yes')->get()->toArray();
      $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
      $portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
      $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();
      $clientname = $company_name[0];
      $portfolio = $portfolio_id[0]['portfolio_id'];
      $dateName = date('d-m-Y');
      $out = Mail::send('email.nocexp',array('portfolio'=> $portfolio,'dateName'=> $dateName,'clientname' => $clientname), function($message) use ($client_mail,$portfolio,$trader_mail) {
             foreach ($client_mail as $key => $user) {
              $message->to($user['email'], $user['name']);
             }
             $message->subject("Expiration of Standing clearance/No Objection Certificate for Portfolio ID " . $portfolio . " on Delivery Date " . date('d-m-Y'));
             foreach($trader_mail as $key => $email){
             $message->cc($email['email_cc']);
             $message->bcc($email['email_bcc']);
             $message->from($email['mail_from']);
         }
      });
     echo " noc mail sent successfully";
  }
