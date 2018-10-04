<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\TraderMail;
use Carbon\Carbon;
use App\BankTemp;
use App\Bank;
use DB;
use App\Client;
use App\Credential;
use Validator;
use Mail;
use App\Approvalrequest;

use Illuminate\Support\Facades\Redirect;

//  Approve Request module created by AKS

class ClientApprovalController extends Controller
{
	public function approvenew()
	{
		$approveclient = Client::orderBy('created_at','desc')->whereIn('client_app_status',array(0, 1, 2))->paginate(15);

		return view('ApprovalRequest.client.newclient',compact('approveclient'));
	}

	public function status($id, $type)
  {
        if($id!='' && $type=='approve'){
            $clientData = Client::findOrFail($id);
            if($clientData->count() > 0){
                //$clientData->client_app_status = 1;
                // $Clientmaster->company_name  =  $clientData->company_name;
                // $Clientmaster->gstin  =  $clientData->gstin;
                // $Clientmaster->pan           =  $clientData->pan;
                // $Clientmaster->short_id      =  $clientData->short_id;
                // $Clientmaster->email    =  $clientData->email;
                // $Clientmaster->new_sap    =  $clientData->new_sap;
                $clientData->save();
                $cid = $clientData->id;
                $crn_no = 'CRN00000'.$cid;
                $password = str_random(10);
                Client::where('id', $cid)->update(['client_app_status'=>1,'crn_no'=>$crn_no]);
                $data = array('name'=>$clientData->company_name,'email'=>$crn_no,'password'=>Hash::make($password),'id'=>$cid);
                Credential::insert($data);
                $dateName = date('d-M-Y');
                $client_mail = Client::select('email','company_name')->where('id', $cid)->get()->toArray();
                $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $clientname = $client_mail[0]['company_name'];
                $out = Mail::send('email.credential',array('crn_no'=>$crn_no,'password'=>$password,'dateName'=> $dateName,'clientname' => $clientname) , function($message) use ($client_mail,$trader_mail,$headers) {
                foreach ($client_mail as $key => $user) {
                   $message->to($user['email'], $user['company_name']);
                 }
                   $message->subject('CRM Login Details ');
                     foreach($trader_mail as $key => $email){
                       $message->cc($email['email_cc']);
                       $message->bcc($email['email_bcc']);
                       $message->from($email['mail_from']);
                     }
               });
                    return Redirect::back()->with('success', 'Client Approved Successfully.');
             }
        }elseif ($id!='' && $type=='reject') 
        {

            Client::where('id', $id)->update(['client_app_status'=>2]);
            return Redirect::back()->with('success', 'Client Rejected Successfully.');
        }

    }
  public function multipleClientstatus(Request $request,$tag='')
    {
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $id){
            $clientData = Client::findOrFail($id);
            if($clientData->count() > 0){
                //$clientData->client_app_status = 1;
                // $Clientmaster->company_name  =  $clientData->company_name;
                // $Clientmaster->gstin  =  $clientData->gstin;
                // $Clientmaster->pan           =  $clientData->pan;
                // $Clientmaster->short_id      =  $clientData->short_id;
                // $Clientmaster->email    =  $clientData->email;
                // $Clientmaster->new_sap    =  $clientData->new_sap;
                $clientData->save();
                $cid = $clientData->id;
                $crn_no = 'CRN00000'.$cid;
                $password = str_random(10);
                Client::where('id', $cid)->update(['client_app_status'=>1,'crn_no'=>$crn_no]);
                $data = array('name'=>$clientData->company_name,'email'=>$crn_no,'password'=>Hash::make($password),'id'=>$cid);
                Credential::insert($data);
                $dateName = date('d-M-Y');
                $client_mail = Client::select('email','company_name')->where('id', $cid)->get()->toArray();
                $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $clientname = $client_mail[0]['company_name'];
                $out = Mail::send('email.credential',array('crn_no'=>$crn_no,'password'=>$password,'dateName'=> $dateName,'clientname' => $clientname) , function($message) use ($client_mail,$trader_mail,$headers) {
                foreach ($client_mail as $key => $user) {
                   $message->to($user['email'], $user['company_name']);
                 }
                   $message->subject('CRM Login Details ');
                     foreach($trader_mail as $key => $email){
                       $message->cc($email['email_cc']);
                       $message->bcc($email['email_bcc']);
                       $message->from($email['mail_from']);
                     }
                  });
               }
                return Redirect::back()->with('success', 'Client Approved Successfully.');
            }
        }elseif ($tag=='Rejected') 
        {
            foreach($array as $id){
            Client::where('id', $id)->update(['client_app_status'=>2]);
        }
            return Redirect::back()->with('success', 'Client Rejected Successfully.');
      }
  }

    public function approveexisting()
    {
        $clientdata = Client::latest()->where('client_app_status','1')->paginate(15);
        return view('ApprovalRequest.client.viewclient',compact('clientdata'));
    }
     public function clientapproval(Request $request,$id)
    {
        $user_id = $request['id'];
        $client_id  =  $user_id;
        $clientData = Approvalrequest::select('id','updated_attribute_value','attribute_name','approval_type','client_id','created_at','old_att_value','updated_by')->where('approval_type','client')->where('client_id',$request['id'])->where('status', 0)->orderBy('created_at','desc')->paginate(15);
        $state_data = array_keys(\App\Common\StateList::get_states());
        $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$request['id'])->get();
        return view('ApprovalRequest.client.client_existing',compact('clientData','Addclientdata','deletedclientData','state_data','client_details'));
    }
    public function bankapproval(Request $request,$user_id)
    {
      if($request['id']!='')
      {
        $user_id = $request['id'];
        $client_id = $request['id'];
      }
      else
      {
        $client_id  =  $user_id;
      }

        $bankData = Approvalrequest::select('id','updated_attribute_value','attribute_name','approval_type','client_id','created_at','old_att_value','updated_by')->where('approval_type','bank')->where('client_id',$client_id)->where('status', 0)->orderBy('created_at','desc')->get();
        $Addbankdata = BankTemp::select('*')->where('client_id',$client_id)->where('status', 0)->orderBy('created_at','desc')->get();
        $deletedbnkData = Bank::select('*')->where(function($q) { $q->where('del_status',1); })->where('client_id',$client_id)->orderBy('created_at','desc')->withTrashed()->get();
        $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$client_id)->get();
        return view('ApprovalRequest.client.existing',compact('bankData','Addbankdata','deletedbnkData','client_details'));

    }

    public function addapprove($id,$type,$type2)
    {
         $oldmodel = array('bank_temp'=> 'BankTemp',
                    'company_details'=>'ClientTemp');
           if($id!='' && $type=='approved'){
             $newmodel = array('bank_temp'=> 'Bank',
                    'company_details'=>'Client');
                if($oldmodel[$type2] == 'BankTemp'){
                $bnc = BankTemp::find($id);
                $new_bnc = new Bank();
                $new_bnc->client_id = $bnc->client_id;
                $new_bnc->virtual_account_number = $bnc->virtual_account_number;
                $new_bnc->account_number = $bnc->account_number;
                $new_bnc->bank_name = $bnc->bank_name;
                $new_bnc->branch_name = $bnc->branch_name;
                $new_bnc->ifsc = $bnc->ifsc;
                $new_bnc->updated_by = $bnc->updated_by;
                $new_bnc->status= 1;
                $new_bnc->save();
                $bnc->status = 1;
                $bnc->update();

              }
               return Redirect::back()->with('success', 'Client details approved successfully.');
               }else{
               $mm = '\\App\\'.$oldmodel[$type2];
               $mm::where('id', $id)->update(['status'=> '2']);
            }
        return Redirect::back()->with('success', 'Client details rejected successfully.');
    }
     public function modified($id,$type)
    {
         if($id!='' && $type=='approved'){
            $model = array('bank'=> 'Bank',
                      'client'=>'Client');
            $updatestemp = Approvalrequest::find($id);
            $selectedmodel= '\\App\\'.$model[$updatestemp->approval_type];
            $banktemp = $selectedmodel::find($updatestemp->reference_id);
            $attribute_name = $updatestemp->attribute_name;
            $banktemp->$attribute_name = $updatestemp->updated_attribute_value;
            $banktemp->update();
            $updatestemp->status = 1;
            $updatestemp->update();
            return Redirect::back()->with('success', 'Client details approved successfully.');

         }elseif ($id!='' && $type=='rejected') 
         {

            Approvalrequest::where('id', $id)->update(['status'=> '2']);
            return Redirect::back()->with('success', 'Client details rejected successfully.');
         }
    }
     public function multipleApprove(Request $request,$tag='')
    {
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $v){
            $model = array('bank'=> 'Bank',
                      'client'=>'Client');
            $updatestemp = Approvalrequest::find($v);
            $selectedmodel= '\\App\\'.$model[$updatestemp->approval_type];
            $banktemp = $selectedmodel::find($updatestemp->reference_id);
            $attribute_name = $updatestemp->attribute_name;
            $banktemp->$attribute_name = $updatestemp->updated_attribute_value;
            $banktemp->update();
            $updatestemp->status = 1;
            $updatestemp->update();
            }
            return Redirect::back()->with('success', 'Client details successfully approved.');
          }
          elseif ($tag=='Rejected') {
            foreach($array as $v){
            Approvalrequest::where('id', $v)->update(['status'=> '2']);
            }
            return Redirect::back()->with('success', 'Client details successfully rejected.');
        }
    }
     public function multipleApproveBank(Request $request,$tag='',$type2='')
    {
      $oldmodel = array('bank_temp'=> 'BankTemp',
                      'company_details'=>'ClientTemp');
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $id){
             $newmodel = array('bank_temp'=> 'Bank',
                           'company_details'=>'Client');
                if($oldmodel[$type2] == 'BankTemp'){
                $bnc = BankTemp::find($id);
                $new_bnc = new Bank();
                $new_bnc->client_id = $bnc->client_id;
                $new_bnc->virtual_account_number = $bnc->virtual_account_number;
                $new_bnc->account_number = $bnc->account_number;
                $new_bnc->bank_name = $bnc->bank_name;
                $new_bnc->branch_name = $bnc->branch_name;
                $new_bnc->ifsc = $bnc->ifsc;
                $new_bnc->updated_by = $bnc->updated_by;
                $new_bnc->status= 1;
                $new_bnc->save();
                $bnc->status = 1;
                $bnc->update();

              }
            }
            return Redirect::back()->with('success', 'Client details successfully approved.');
          }
          elseif ($tag=='Rejected') 
          {
            foreach($array as $id){
              $mm = '\\App\\'.$oldmodel[$type2];
               $mm::where('id', $id)->update(['status'=> '2']);
          }
            return Redirect::back()->with('success', 'Client details successfully rejected.');
        }
    }
     public function clientBankModApp(Request $request,$type='',$tag='')
    {
        
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $id){
             $model = array('bank'=> 'Bank',
                      'client'=>'Client');
            $updatestemp = Approvalrequest::find($id);
            $selectedmodel= '\\App\\'.$model[$updatestemp->approval_type];
            $ref_id=$updatestemp->reference_id;
            $banktemp = $selectedmodel::findOrFail($ref_id);
            $attribute_name = $updatestemp->attribute_name;
            // dd($attribute_name);
            $banktemp->$attribute_name = $updatestemp->updated_attribute_value;
            $banktemp->update();
            $updatestemp->status = 1;
            $updatestemp->update();

            }
            return Redirect::back()->with('success', 'Client details successfully approved.');
          }
          elseif ($tag=='Rejected') {
            foreach($array as $id){
              Approvalrequest::where('id', $id)->update(['status'=> '2']);
            }
            return Redirect::back()->with('success', 'Client details successfully rejected.');
        }


    }

     public function deletebank($id,$type,$type2){

        $newmodel = array('bank'=> 'Bank',
                               'client'=>'Client');
        if($id!='' && $type=='approved'){

                  $new_bnc = '\\App\\'.$newmodel[$type2];
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new_bnc::destroy($id);
                  $new->del_status = 2;
                  $new->update();

            return Redirect::back()->with('success', 'Client details successfully approved.');
    }else{

                  $new_bnc = '\\App\\'.$newmodel[$type2];
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 4;
                  $new->update();
                  return Redirect::back()->with('success', 'Client details successfully rejected.');
        }


}
     public function clientBankDelApp(Request $request,$type2,$tag='')
    {

        $newmodel = array('bank'=> 'Bank',
                               'client'=>'Client');
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $id){
               $new_bnc = '\\App\\'.$newmodel[$type2];
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 2;
                  $new->update();

            }
            return Redirect::back()->with('success', 'Client details successfully approved.');
          }
          elseif ($tag=='Rejected') {
            foreach($array as $id){
              $new_bnc = '\\App\\'.$newmodel[$type2];
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 4;
                  $new->update();
            }
            return Redirect::back()->with('success', 'Client details successfully rejected.');
        }
    }


}
