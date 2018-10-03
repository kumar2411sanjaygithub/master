<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use App\ContactTemp;
use App\Contact;
use App\Approvalrequest;
use DB;
use App\ServiseAlert;
use Validator;
use App\Client;
use App\service;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function edit_contactdetails($id='',$eid=''){
        $contact_id=$eid;
        $client_id=$id;
        $get_contact_details = Contact::where('id',$contact_id)->where('status',1)->withTrashed()->first();
        $contactdetails = Contact::where('client_id',$client_id)->where('status',1)->withTrashed()->get();
 // dd($client_id);
        $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$id)->get();
        return view('ManageClient.contactdetails',compact('contactdetails','client_id','get_contact_details','client_details'));

    }

    public function contactdetails($id){

        $client_id=$id;
        //$contactdetails = Exchange::where('client_id',$id)->where('status',1)->get();
        // $contactdetails = DB::table('contact')->select('*')->where(function($q) { $q->where('del_status',0)->orwhere('del_status',2); })->where('client_id',$id)->where('status',1)->get();
        $contactdetails = Contact::select('*')->where(function($q) { $q->where('del_status',0)->orwhere('del_status',1)->orwhere('del_status',4); })->where('client_id',$id)->where('status',1)->paginate(15);

        $alert_type = ServiseAlert::select('*')->where('client_id',$id)->get();
        $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$id)->get();
        //dd($client_details[0]['company_name']);
     //dd($client_id);
        return view('ManageClient.contactdetails',compact('contactdetails','client_id','alert_type','client_details'));
    }
    public function add_contactdetails(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\.\s]*$/|max:100',
            'designation' => 'required|regex:/^[a-zA-Z\.\s]*$/|max:100',
            'email' => 'required|unique:contact|email',
            //'required|min:1|unique:department,depatment_name,NULL,id,deleted_at,NULL',
            'mob_num' => 'required|unique:contact|regex:/^[0-9]{10}$/',
        ]);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $contactdetail = new ContactTemp();
        $contactdetail->client_id = $request->client_id;
        $contactdetail->name = $request->input('name');
        $contactdetail->designation = $request->input('designation');
        $contactdetail->email = $request->input('email');
        $contactdetail->mob_num = $request->input('mob_num');
        $contactdetail->status = 0;
        $contactdetail->save();
        return redirect()->back()->with('message','Detail added successfully and sent for approval.');
    }
    public function addservices(Request $request, $id)
    {

        $client_id=$id;
        $service = new service();
        $service->alert_type = $request->input('alert_type');
        $service->client_id = $client_id;
        $service->dam_iex_sms = $request->input('dam_iex_sms');
        $service->dam_iex_email = $request->input('dam_iex_email');
        $service->dam_pxil_sms = $request->input('dam_pxil_sms');
        $service->dam_pxil_email = $request->input('dam_pxil_email');
        $service->tam_iex_sms = $request->input('tam_iex_sms');
        $service->tam_iex_email = $request->input('tam_iex_email');
        $service->tam_pxil_sms = $request->input('tam_pxil_sms');
        $service->tam_pxil_email = $request->input('tam_pxil_email');
        $service->rec_iex_sms = $request->input('rec_iex_sms');
        $service->rec_iex_email = $request->input('rec_iex_email');
        $service->rec_pxil_sms = $request->input('rec_pxil_sms');
        $service->rec_pxil_email = $request->input('rec_pxil_email');
        $service->ec_iex_sms = $request->input('ec_iex_sms');
        $service->ec_iex_email = $request->input('ec_iex_email');
        $service->save();
        return redirect()->back()->with('message','Email/SMS request saved successfully and sent to approver');
    }
    public function update_contactdetails(Request $request ,$contact_detail_id)
    {
        //  $this->validate($request, [
        //     'name' => 'required|max:100',
        //     'designation' => 'required|max:100',
        //     'email' => 'required|email',
        //     'mobile_no' => 'required|regex:/^[0-9]{10}$/',
        // ]);

    	$client_id = $request->input('client_id');
        $contactdetail = Contact::find($contact_detail_id)->toArray();
        $datas =array();
        $datas['name'] = $contactdetail['name'];
        $datas['designation'] = $contactdetail['designation'];
        $datas['email'] = $contactdetail['email'];
        $datas['mob_num'] = $contactdetail['mob_num'];

        $dataArray =array();
        $dataArray['name'] = $request->input('name');
        $dataArray['designation'] = $request->input('designation');
        $dataArray['email'] = $request->input('email');
        $dataArray['mob_num'] = $request->input('mob_num');


        $result=array_diff($dataArray,$datas);
        if($this->generateApprovalrequest($result,'contact',$client_id,$contact_detail_id,$datas)==false){
            return redirect()->route('contactdetails', ['id' => $client_id])->withErrors(['pending'=>'There is already a change request pending for approval.']);
        }
          return redirect()->route('contactdetails', ['id' => $client_id])->with('message','Detail added successfully and sent for approval.');
    }


    public function delete_contactdetails(Request $request ,$contact_detail_id)
    {
        $client_id=$request->input('client_id');
        $contact = Contact::find($contact_detail_id);
        $contact->del_status = 1;
        $contact->update();



        return redirect()->back()->with('message','contact detail request successfully and sent to approver');
    }

    public function sevices($id)
    {
        $client_id=$id;
        $client = Client::find($client_id);
        $alert_type = ServiseAlert::select('*')->get();
        return view('ManageClient.service',compact('client_id','alert_type','client'));

    }

    function generateApprovalrequest($data, $type, $client_id, $reference_id='',$datas){
        $apprval_req_pending = Approvalrequest::where('client_id',$client_id)->where('status','0')->get();
        if($apprval_req_pending->count()>0)
        {
          return false;
        }
        else{
          $arrayKey = array_keys($data);

          $arrayValue = array_values($data);
          //$keys = array('bill_address_line_2'=>'Address Line 1');
           foreach($data as $key=>$value){
            //dd($key);
             $approvalRequest = new Approvalrequest();
              $approvalRequest->client_id       = $client_id;
              $approvalRequest->attribute_name  = $key;
              $approvalRequest->updated_attribute_value =  $value;
              $approvalRequest->approval_type   = $type;
              $approvalRequest->old_att_value   = isset($datas[$key])?$datas[$key]:'-';
              //$approvalRequest->updated_by      = \Auth::id();
              //$approvalRequest->approved_by      = '';
              $approvalRequest->status          = '0';
              $approvalRequest->reference_id    = $reference_id;
              $approvalRequest->save();
          }
          return true;
      }
    }
}
