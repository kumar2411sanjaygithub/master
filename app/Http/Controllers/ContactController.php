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
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function edit_contactdetails($id='',$eid=''){
        $contact_id=$eid;
        $client_id=$id;
        $get_contact_details = Contact::where('id',$contact_id)->where('status',1)->first();
        $contactdetails = Contact::where('client_id',$client_id)->where('status',1)->get();

        return view('ManageClient.contactdetails',compact('contactdetails','client_id','get_contact_details'));
    }

    public function contactdetails($id){

        $client_id=$id;
        //$contactdetails = Exchange::where('client_id',$id)->where('status',1)->get();
        $contactdetails = DB::table('contact')->select('*')->where(function($q) { $q->where('del_status',0)->orwhere('del_status',2); })->where('client_id',$id)->where('status',1)->get();
        $alert_type = ServiseAlert::select('*')->where('client_id',$id)->get();
        //dd($alert_type);
        return view('ManageClient.contactdetails',compact('contactdetails','client_id','alert_type'));
    }
    public function add_contactdetails(Request $request){
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|regex:/^[a-zA-Z ]*$/|max:100',
        //     'designation' => 'required|regex:/^[a-zA-Z ]*$/|max:100',
        //     'email' => 'required|unique:contact|email',
        //     //'required|min:1|unique:department,depatment_name,NULL,id,deleted_at,NULL',
        //     'mob_num' => 'required|unique:contact|regex:/^[0-9]{10}$/',
        // ]);
        // if($validator->fails())
        // {
        //     return Redirect::back()->withErrors($validator);
        // }
         
        
       
        $contactdetail = new ContactTemp();
        $contactdetail->client_id = $request->client_id;
        $contactdetail->name = $request->input('name');
        $contactdetail->designation = $request->input('designation');
        $contactdetail->email = $request->input('email');
        $contactdetail->mob_num = $request->input('mob_num');
        $contactdetail->status = 0;
        //dd(3);
        $contactdetail->save();
        return redirect()->back()->with('message','Detail added successfully and sent to Approver');
        
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
        $this->generateApprovalrequest($result,'contact',$client_id,$contact_detail_id,$datas);
        return redirect()->route('contactdetails', ['id' => $client_id])->with('message','Detail added successfully and sent to Approver'); 
    }


    public function delete_contactdetails(Request $request ,$contact_detail_id)
    {
        $client_id=$request->input('client_id');
        Contact::destroy($contact_detail_id);

        return redirect()->back()->with('message','contact detail request successfully and sent to approver');
    }
    function generateApprovalrequest($data, $type, $client_id, $reference_id='',$datas){
        $arrayKey = array_keys($data);

        $arrayValue = array_values($data);
        //$keys = array('bill_address_line_2'=>'Address Line 1');
         foreach($data as $key=>$value){
          //dd($key);
           $approvalRequest = New Approvalrequest();
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

    }
}