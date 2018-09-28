<?php

namespace App\Http\Controllers;

use Mail;
use App\AccountStatement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use App\Client;
use App\Placebid;
use App\FtpFiles;
use App\ServiseAlert;
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

         $client = ServiseAlert::where('client_id', $id)->where('alert_type','bid_alert')->where('email','yes')->get()->toArray();

         if(count($client) > 0){

          $client_mail = Contact::select('email','name')->where('client_id', $id)->get()->toArray();
          
           $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
          // dd($trader_mail);
           $dateName = date('d-M-Y');
           $data = array('name'=>"Virat Gandhi");
           //dd($client_mail);
           $out = Mail::send('email.email',array('dateName'=> $dateName) , function($message) use($client_mail,$trader_mail) {
                foreach ($client_mail as $key => $user) {
                   $message->to('php6@cybuzzsc.com', $user['name']);
                 }
                   $message->subject('BID Not Recieved  for DD '.date('d-M-Y'));
                     foreach($trader_mail as $key => $email){
                       $message->cc($email['email_cc']);
                       $message->bcc($email['email_bcc']);
                       $message->from($email['mail_from']);
                     }
           });
           $data = array(
                     'client_id'=> $id,'date'=>date('Y-m-d'),'type'=>'bid-mail','status'=> 1
                     );
           EmailLog::insert($data);
           return redirect()->back()->with('success','Mail Sent Successfully.');
      }else{
        return redirect()->back()->with('success','Service Is Not Applicable For You.');
      }
    }
      catch(Exception $ex){
           $validator = Validator::make([], []);
           $validator->getMessageBag()->add('Email', 'Opps! Mail sending failed. Plesae try after sometime.');
           return redirect()->back()->withErrors($validator->getMessageBag());
      }
	}

  public function mail_obligation($client_id,$ftp_id){
     try {
          $client = ServiseAlert::where('client_id', $id)->where('alert_type','obligation')->where('email','yes')->get()->toArray();
         if(count($client) > 0){

      $client_mail = Contact::select('email','name')->where('client_id', $id)->get()->toArray();
      $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
      $ftp_schedule = FtpFiles::select('filename','filepath')->where('id',$ftp_id)->where('client_id',$client_id)->get()->toArray();
      //print($ftp_schedule);
      $pathToAttach = storage_path().($ftp_schedule[0]['filepath'].'\\'.$ftp_schedule[0]['filename']);
      //dd($pathToAttach);
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
      }else{
        return redirect()->back()->with('success','Service Is Not Applicable For You.');
      }}
      catch(Exception $ex){
           $validator = Validator::make([], []);
           $validator->getMessageBag()->add('Email', 'Opps! Mail sending failed. Plesae try after sometime.');
           return redirect()->back()->withErrors($validator->getMessageBag());
      }
  }



  public function mail_nocEx($id){
      $client_mail = Contact::select('email','name')->where('client_id', $id)->where('noc_sms','yes')->get()->toArray();
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

  public function mail_ppaEx($id){
      $client_mail = Contact::select('email','name')->where('client_id', $id)->where('ppa_email','yes')->get()->toArray();
      $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
      $portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
      $portfolio = $portfolio_id[0]['portfolio_id'];
      $date = date('d-m-Y');
      $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();
      $clientname = $company_name[0];

      $out = Mail::send('email.ppaExpiry',array('portfolio'=> $portfolio,'date'=> $date,'clientname' => $clientname), function($message) use ($client_mail,$portfolio,$trader_mail) {
         foreach ($client_mail as $key => $user) {
           $message->to($user['email'], $user['name']);
         }

         $message->subject("Expiration of PPA for Portfolio ID ". $portfolio ."on Delivery Date" . date('d-m-Y'));
          foreach($trader_mail as $key => $email){
          $message->cc($email['email_cc']);
          $message->bcc($email['email_bcc']);
          $message->from($email['mail_from']);
         }
      });
      // print_r($out);
      echo "Mail sent successfully";

  }

  public function mail_exReg($id){
       $client_mail = Contact::select('email','name')->where('client_id', $id)->where('exreg_email','yes')->get()->toArray();
       $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
       $portfolio_id = Exchangeuser::select('portfolio_id')->where('client_id', $id)->get()->toArray();
      $portfolio = $portfolio_id[0]['portfolio_id'];
      $date = date('d-m-Y');
      $company_name = Clientmaster::where('id', $id)->pluck('company_name')->toArray();
      $clientname = $company_name[0];

      $out = Mail::send('email.exReg',array('portfolio'=> $portfolio,'date'=> $date,'clientname' => $clientname), function($message) use ($client_mail,$portfolio,$trader_mail) {
         foreach ($client_mail as $key => $user) {
           $message->to($user['email'], $user['name']);
         }

         $message->subject("Expiration of IEX/PXIL Registration for Portfolio ID " . $portfolio . " on Trade Date " . date('d-m-Y'));
         foreach($trader_mail as $key => $email){
          $message->cc($email['email_cc']);
          $message->bcc($email['email_bcc']);
          $message->from($email['mail_from']);
         }
      });
      // print_r($out);
      echo "Mail sent successfully";

  }

  public function mail_billing($id){
      $client_mail = Contact::select('email','name')->where('client_id', $id)->where('bill_email','yes')->get()->toArray();
      $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
      $data = array('name'=>"Virat Gandhi");
      $out = Mail::send('email.email', $data, function($message) use ($client_mail,$trader_mail) {
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
      // print_r($out);
      echo "Mail sent successfully";

  }

  public function mail_acSmry($id){
      $client_mail = Contact::select('email','name')->where('client_id', $id)->where('account_email','yes')->get()->toArray();
     $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
      $data = array('name'=>"Virat Gandhi");
      $out = Mail::send('email.email', $data, function($message) use ($client_mail,$trader_mail) {
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
      // print_r($out);
      echo "Mail sent successfully";

  }

  public function mail_profitability($id){
      $client_mail = Contact::select('email','name')->where('client_id', $id)->where('profitability','yes')->get()->toArray();
      $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
      $data = array('name'=>"Virat Gandhi");
      $out = Mail::send('email.profit', $data, function($message) use ($client_mail,$trader_mail) {
         foreach ($client_mail as $key => $user) {
           $message->to($user['email'], $user['name']);
         }
         $message->subject(($clientName)."Profitibility Report for DD".date('d-M-Y'));
          foreach($trader_mail as $key => $email){
          $message->cc($email['email_cc']);
          $message->bcc($email['email_bcc']);
          $message->from($email['mail_from']);
         }
      });
      // print_r($out);
      echo "Mail sent successfully";

  }

  public function mail_rtc($id){
      $client_mail = Contact::select('email','name')->where('client_id', $id)->where('rtc_email','yes')->get()->toArray();
      $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
      $data = array('date'=> date('d-M-Y'));
      $out = Mail::send('email.rtc', $data, function($message) use ($client_mail,$trader_mail) {
         foreach ($client_mail as $key => $user) {
           $message->to($user['email'], $user['name']);
         }
         $message->subject('RTC Not Recieved  for DD '.date('d-M-Y'));
         foreach($trader_mail as $key => $email){
          $message->cc($email['email_cc']);
          $message->bcc($email['email_bcc']);
          $message->from($email['mail_from']);
         }
      });
      // print_r($out);
      echo "Mail sent successfully";

  }

 public function mail_scheduling($client_id, $ftp_id){
  try {

    $client = ServiseAlert::where('client_id', $id)->where('alert_type','scheduling')->where('email','yes')->get()->toArray();
     if(count($client) > 0){
    $client_mail = Contact::select('email','name')->where('client_id', $id)->get()->toArray();
    $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
    $company_name = Client::where('id', $client_id)->pluck('company_name')->toArray();
    $ftp_schedule = FtpFiles::select('filename','filepath')->where('id',$ftp_id)->get()->toArray();
    $dateName = date('d-m-Y');
    $clientName = $company_name[0];
    $pathToAttach = realpath($ftp_schedule[0]['filepath'].'\\'.$ftp_schedule[0]['filename']);
    $data = array('name'=>"Virat Gandhi");
    $out = Mail::send('email.schedule', array('dateName'=> $dateName), function($message) use ($client_mail,$clientName,$trader_mail,$pathToAttach) {
       foreach ($client_mail as $key => $user) {
         $message->to($user['email'], $user['name']);
       }

       $message->subject(($clientName).' Final Schduling Report for DD' .date('d-M-Y'));
        foreach($trader_mail as $key => $email){
        $message->cc($email['email_cc']);
        $message->bcc($email['email_bcc']);
        $message->from($email['mail_from']);
       }
         $message->attach($pathToAttach);
    });
    $devices = FtpFiles::find($client_id)->where('type','SCH')->where('client_id',$client_id);

             $devices->update([
               'mail_status' => 1
              ]);
    return redirect()->back()->with('success','Mail Sent Successfully.');
    }else{
      return redirect()->back()->with('success','Service Is Not Applicable For You.');
    }}
    catch(Exception $ex){
         $validator = Validator::make([], []);
         $validator->getMessageBag()->add('Email', 'Opps! Mail sending failed. Plesae try after sometime.');
         return redirect()->back()->withErrors($validator->getMessageBag());
    }

  }

  public function mail_rtSheet($client_id,$id){
     try {
    
      $client_mail = ServiseAlert::select('email','name')->where('client_id', $id)->where('alert_type','Ratesheet')->where('email','yes')->get()->toArray();
      $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
       $company_name = Client::where('id', $client_id)->pluck('company_name')->toArray();
      $clientName = $company_name[0];
      $dateName = date('d-m-Y');
     //$pathToAttach = realpath($ftp_schedule[0]['filepath'].'\\'.$ftp_schedule[0]['filename']);
      $data = array('date'=> date('d-M-Y'));
      $out = Mail::send('email.rtSheet',array('dateName'=> $dateName), function($message) use ($client_mail,$clientName,$trader_mail) {
         foreach ($client_mail as $key => $user) {
           $message->to($user['email'], $user['name']);
         }
         $message->subject(($clientName).' final Rates of IEX for'.date('d-M-Y'));
          foreach($trader_mail as $key => $email){
          $message->cc($email['email_cc']);
          $message->bcc($email['email_bcc']);
          $message->from($email['mail_from']);
         }
        //$message->attach($pathToAttach);
      });
      $devices = Client::find($client_id)->where('id',$client_id);

             $devices->update([
               'mail_status' => 1
              ]);
     return redirect()->back()->with('success','Mail Sent Successfully.');
    }
    catch(Exception $ex){
      $validator = Validator::make([], []);
         $validator->getMessageBag()->add('Email', 'Opps! Mail sending failed. Plesae try after sometime.');
         return redirect()->back()->withErrors($validator->getMessageBag());
    }

  }

  public function mail_credential($id){
      $client_mail = Contact::select('email','name')->where('client_id', $id)->where('credential','yes')->get()->toArray();
      $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
      $data = array('name'=>"Virat Gandhi");
      $out = Mail::send('email.credential', $data, function($message) use ($client_mail,$trader_mail) {
         foreach ($client_mail as $key => $user) {
           $message->to($user['email'], $user['name']);
         }
         $message->subject('Credential for DD '.date('d-M-Y'));
         foreach($trader_mail as $key => $email){
          $message->cc($email['email_cc']);
          $message->bcc($email['email_bcc']);
          $message->from($email['mail_from']);
         }
      });
      // print_r($out);
      echo "Mail sent successfully";

  }

  /*** for future purpose ****/
  public function dynamic_mail($id,$client_mail){
     $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
     $out = Mail::send('email.credential', $data, function($message) use ($client_mail,$trader_mail) {
          foreach ($client_mail as $key => $user) {
            $message->to($user['email'], $user['name']);
         }
            $message->subject('');
          foreach($trader_mail as $key => $email){
            $message->cc($email['email_cc']);
            $message->bcc($email['email_bcc']);
            $message->from($email['mail_from']);
         }
      });

      echo "Mail sent successfully";

  }

  public function manualbill_mail($id=null,$client_id=null,$paymenttype=null){
      try {
            //dd($paymenttype);
            $AmountDue =    $this->getoutstandingbalace($client_id);
            $ClientPortfolioID = Exchangeuser::where('client_id',$client_id)->get();
            $portfolio_id =      $ClientPortfolioID[0]['portfolio_id'];
            $ca_client_id =      $ClientPortfolioID[0]['ca_client_id'];
            $ClientBillData =    Manualbilltemp::where('id',$id)->get()->toArray();
            $client_de = json_decode($ClientBillData[0]['json'],true);
            //dd($client_de);
            $company_name = $client_de['client_details']['company_name'];
            $trader_name = $client_de['trader_details']['trader_name'];
            $fy =   strval($ClientBillData[0]['fy']);
            $fy = str_split($fy, 2);
            $current_fy = $fy[1];
            $arrayName = array(
                            'CF' => 'ECF',
                            'EXRC' => 'CRF',
                            'NOC' => 'SC',
                            'EXPF' => 'EPF',
                            'RENEWAL' => 'CRF',
                            'OBL' => 'OBL' );
            $billtypefornum = $arrayName[$paymenttype];
            $pdf = PDF::loadView('generate_bill.bill_view',compact('ClientBillData','AmountDue','portfolio_id','ca_client_id','current_fy','billtypefornum'));
              $path  = storage_path().'/app/public/downlaodmanualbill/'.$ClientBillData[0]['bill_date'].'/'.$ClientBillData[0]['client_id'];
             if (!file_exists($path)) {
             File::makeDirectory($path,0777,true);
            }
            $output = $pdf->save($path.'/'.$ClientBillData[0]['amount'].'_'.$ClientBillData[0]['bill_type'].'.pdf');
            $filepath = $path.'/'.$ClientBillData[0]['amount'].'_'.$ClientBillData[0]['bill_type'].'.pdf';
           $client_mail = Clientmaster::select('reg_email_id','company_name')->where('id', $client_id)->get()->toArray();
           $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
           $dateName = date('d-M-Y');
           $data = array('name'=>"Virat Gandhi");
           $out = Mail::send('email.emailmanualbill',array('dateName'=> $dateName, 'billtype' => $paymenttype, 'company_name' => $company_name, 'trader_name' => $trader_name ,
            'paymenttype' => $paymenttype) , function($message) use ($client_mail,$trader_mail,$filepath,$paymenttype,$company_name) {
                foreach ($client_mail as $key => $user) {

                   $message->to($user['reg_email_id'], $user['company_name']);
                 }
                 if($paymenttype == 'CF')
                  {
                    $sub = 'Bill for Consultancy Fee -'.$company_name;
                    $message->subject($sub);
                  }
                  elseif($paymenttype == 'EXRC')
                  {
                    $sub = 'Bill for Exchange Registration -'.$company_name;
                    $message->subject($sub);
                  }
                  elseif($paymenttype == 'NOC')
                  {
                    $sub = 'Bill for NOC -'.$company_name;
                    $message->subject($sub);
                  }
                  elseif($paymenttype == 'EXPF')
                  {
                    $sub = 'Bill for Exchange Proccessing -'.$company_name;
                    $message->subject($sub);
                  }
                  else
                  {
                    $sub = 'Bill for Renewal -'.$company_name;
                    $message->subject($sub);
                  }

                     foreach($trader_mail as $key => $email){
                       $message->cc($email['email_cc']);
                       $message->bcc($email['email_bcc']);
                       $message->from($email['mail_from']);
                     }
                     $message->attach($filepath);
           });
           $data = array(
                     'client_id'=> $client_id,'date'=>date('d-M-Y'),'type'=>'manual-mail','status'=> 1
                     );
           EmailLog::insert($data);
           Bill::where('id', $id)
          ->where('client_id', $client_id)
          ->update(['bill_status' => 1]);
           return redirect()->back()->with('success','Mail Sent Successfully.');
      }
      catch(Exception $ex){
           $validator = Validator::make([], []);
           $validator->getMessageBag()->add('Email', 'Opps! Mail sending failed. Plesae try after sometime.');
           return redirect()->back()->withErrors($validator->getMessageBag());
      }
  }

  public function manualoblbill_mail($id=null,$client_id=null,$paymenttype=null){
      try {

            $AmountDue =    $this->getoutstandingbalace($client_id);
            $ClientPortfolioID = Exchangeuser::where('client_id',$client_id)->get();
            $portfolio_id =      $ClientPortfolioID[0]['portfolio_id'];
            $ca_client_id =      $ClientPortfolioID[0]['ca_client_id'];
            $ClientBillData =    Manualbilltemp::where('id',$id)->get()->toArray();
             $client_de = json_decode($ClientBillData[0]['json'],true);
             //dd($client_de['bill_details']);
             $billnature = $client_de['bill_details'][0]['billnature'];
             $company_name = $client_de['client_details']['company_name'];
            $trader_name = $client_de['trader_details']['trader_name'];
            $fy =   strval($ClientBillData[0]['fy']);
            $fy = str_split($fy, 2);
            $current_fy = $fy[1];
            $arrayName = array(
                            'CF' => 'ECF',
                            'EXRC' => 'CRF',
                            'NOC' => 'SC',
                            'EXPF' => 'EPF',
                            'RENEWAL' => 'CRF',
                            'OBL' => 'OBL' );
            $billtypefornum = $arrayName[$paymenttype];
            $pdf = PDF::loadView('generate_bill.bill_view',compact('ClientBillData','AmountDue','portfolio_id','ca_client_id','current_fy','billtypefornum','billnature'));
              $path  = storage_path().'/app/public/downlaodmanualbill/'.$ClientBillData[0]['bill_date'].'/'.$ClientBillData[0]['client_id'];
             if (!file_exists($path)) {
             File::makeDirectory($path,0777,true);
            }
            $output = $pdf->save($path.'/'.$ClientBillData[0]['amount'].'_'.$ClientBillData[0]['bill_type'].'.pdf');
            $filepath = $path.'/'.$ClientBillData[0]['amount'].'_'.$ClientBillData[0]['bill_type'].'.pdf';
            $client_mail = Clientmaster::select('reg_email_id','company_name')->where('id', $client_id)->get()->toArray();
           $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
           $dateName = date('d-M-Y');
           $data = array('name'=>"Virat Gandhi");
           $out = Mail::send('email.emailmanualoblbill',array('dateName'=> $dateName, 'billnature' => $billnature, 'company_name' => $company_name, 'trader_name' => $trader_name) , function($message) use ($client_mail,$trader_mail,$filepath,$billnature,$company_name) {
                foreach ($client_mail as $key => $user) {
                   $message->to($user['reg_email_id'], $user['company_name']);
                 }

                   if($billnature == 'INVOICE')
                 {
                   $sub = 'Bill for Power Purchase through IEX by - '.$company_name;
                   $message->subject($sub);
                 }
                else
                {
                   $sub = 'Payment Advice for Power sold through IEX by - '.$company_name;
                   $message->subject($sub);
               }
                     foreach($trader_mail as $key => $email){
                       $message->cc($email['email_cc']);
                       $message->bcc($email['email_bcc']);
                       $message->from($email['mail_from']);
                     }
                     $message->attach($filepath);
           });
           $data = array(
                     'client_id'=> $client_id,'date'=>date('d-M-Y'),'type'=>'manual-obl-mail','status'=> 1
                     );
           EmailLog::insert($data);
           Bill::where('id', $id)
          ->where('client_id', $client_id)
          ->update(['bill_status' => 1]);
           return redirect()->back()->with('success','Mail Sent Successfully.');
      }
      catch(Exception $ex){
           $validator = Validator::make([], []);
           $validator->getMessageBag()->add('Email', 'Opps! Mail sending failed. Plesae try after sometime.');
           return redirect()->back()->withErrors($validator->getMessageBag());
      }
  }

  public function emailobligationbill(Request $request){
    $client_mail = Contact::select('email','name')->where('client_id', $request['client_id'])->get()->toArray();
    $path  = storage_path().'/app/public/obligationbills/'.date('Y-m-d',$request['enddate']).'/'.$request['client_id'].'/'.$request['charges'].'_'.$request['type'].'.pdf';
    $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
    $data = array('date'=> date('d-M-Y'));

    $out = Mail::send('email.rtc', $data, function($message) use ($client_mail,$trader_mail,$path) {
       foreach ($client_mail as $key => $user) {
         $message->to($user['email'], $user['name']);
       }
       $message->subject('Your Obligation Bill Created Successfully'.date('d-M-Y'));
       foreach($trader_mail as $key => $email){
        $message->cc($email['email_cc']);
        $message->bcc($email['email_bcc']);
        $message->from($email['mail_from']);
        $message->attach($path);
       }
    });
      return redirect()->back()->with('message','Mail sent successfully');
    // print_r($out);
    // echo "Mail sent successfully";
    // return redirect()->back()->withErrors($validator->getMessageBag());
    }
    public function emailallobligationbill(Request $request){
      $zipFileName = 'allbill'.$request['date'].'.zip';
      if(!file_exists(storage_path().'/'.$zipFileName)){
        $zip = new ZipArchive;
          $directories = glob(str_replace('\\','/',storage_path().'/app/public')."/obligationbills/".date('Y-m-d',$request['date'])."/*");
          $directories=str_replace("/","\\",$directories);
          if ($zip->open(storage_path() . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
          foreach($directories as $directory){
          if(!is_file($directory)){
            $directoryname = array_values(array_slice(explode('\\',$directory), -1))[0];
              $files = glob(str_replace('\\','/',$directory)."/*.*");
              foreach($files as $file){
                $zip->addFile($file,$directoryname.'/'.basename($file));
              }
            }
          }
            $zip->close();
        }
        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );
        $filetopath=storage_path().'/'.$zipFileName;
      }

      $client_mail = Contact::select('email','name')->where('client_id', 1)->get()->toArray();
      $path  = storage_path().'/'.$zipFileName;
      $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
      $data = array('date'=> date('d-M-Y'));

      $out = Mail::send('email.rtc', $data, function($message) use ($client_mail,$trader_mail,$path) {
         foreach ($client_mail as $key => $user) {
           $message->to($user['email'], $user['name']);
         }
         $message->subject('Your Obligation Bill Created Successfully'.date('d-M-Y'));
         foreach($trader_mail as $key => $email){
          $message->cc($email['email_cc']);
          $message->bcc($email['email_bcc']);
          $message->from($email['mail_from']);
          $message->attach($path);
         }
      });
        return redirect()->back()->with('message','Mail sent successfully');

    }
  }
