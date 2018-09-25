<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NocTemp;
use App\Noc;
use App\Approvalrequest;
use App\Client;
use App\Pocdetails;
use Validator;
use App\Discomdetails;
use DB;


class NocController extends Controller
{
    public function nocdetails(Request $request, $id){
    	$client_id=$id;
    	$nocData = DB::table('noc')->select('*')->where(function($q) { $q->where('del_status',0)->orwhere('del_status',2); })->where('status',1)->where('client_id',$id)->get();
    	$noc_losses = Client::select('inter_discom','inter_poc','inter_stu')->where('client_app_status',1)->where('id',$id)->first();
    	$region = Pocdetails::select('region')->get();
    	$regional = Pocdetails::select('regional_entity')->get();
    	$poc_losses = Pocdetails::select('injection_poc_loss','withdraw_poc_loss')->get();
    	$discom = Discomdetails::select('injection_poc_loss','withdraw_poc_loss')->get();
         $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$id)->get();
//dd($regional);
    	//dd($noc_losses);
        return view('ManageClient.nocdetails',compact('nocData','client_id','noc_losses','region','regional','poc_losses','discom','client_details'));

    }

    public function add_nocdetails(Request $request){

    	 $this->validate($request, [
            //'final_quantum' => 'required',
            'noc_periphery' => 'required',
            'noc_quantum' => 'required',
            'noc_type' => 'required',
            // 'poc_losses' => 'required',
            'validity_from' => 'required',
            'validity_to' => 'required',
            //'upload_noc_doc' => 'required',
        ]);
        //  if($validator->fails())
        // {
        //     return Redirect::back()->withInput($request->input())->withErrors($validator);
        // }
        // Convert Date Format
        $from_date = strtr($request->input('validity_from'), '/', '-');
        $validity_from = date("Y-m-d", strtotime($from_date));

        // Convert Date Format
        $to_date = strtr($request->input('validity_to'), '/', '-');
        $validity_to = date("Y-m-d", strtotime($to_date));

    	 $noc = new NocTemp();
        $noc->final_quantum = $request->input('final_quantum');
        $noc->noc_periphery = $request->input('noc_periphery');
        $noc->noc_quantum = $request->input('noc_quantum');
        $noc->noc_type = $request->input('noc_type');
        $noc->poc_losses = $request->input('poc_losses');
        $noc->validity_from =$validity_from;
        $noc->validity_to = $validity_to;
        $noc->noc_periphery = $request->input('noc_periphery');
        $noc->poc_losses = $request->input('poc_losses');
        $noc->stu_losses = $request->input('stu_losses');
        $noc->discom_losses = $request->input('discom_losses');
        if(strtotime(str_replace('/','-',$request->input('validity_to')))<strtotime(date('Y-m-d'))){
        $noc->status = 'Invalid';
        }else{
        $noc->status = 'valid';
        }
        $noc->client_id = $request->client_id;
        
        if($file = $request->hasFile('upload_noc')) {
              $file = $request->file('upload_noc') ;
              $fileName = 'NOC_'.($noc->noc_type).'_'.time().'_'.$file->getClientOriginalName();
              $UID_path = storage_path('/files/client/noc');
              $destinationPath = $UID_path ;
              $file->move($destinationPath,$fileName);
              $noc->upload_noc = $fileName;
           }
        
        $noc->save();
    	//return view('ManageClient.nocdetails');
        return redirect()->back()->with('message','Detail added successfully and sent to Approver');
    }
    public function edit_nocdetails($id='',$eid=''){
        $noc_id=$eid;
        $client_id=$id;
        $get_noc_details = Noc::where('id',$noc_id)->where('status',1)->withTrashed()->first();
        $region = Pocdetails::select('region')->get();
        $regional = Pocdetails::select('regional_entity')->get();
        $poc_losses = Pocdetails::select('injection_poc_loss','withdraw_poc_loss')->get();
       // dd($get_noc_details);
        $nocdetails = Noc::where('client_id',$client_id)->where('status',1)->withTrashed()->get();
        $noc_losses = Client::select('inter_discom','inter_poc','inter_stu')->where('client_app_status',1)->where('id',$id)->first();
        $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$id)->get();

        return view('ManageClient.nocdetails',compact('client_details','nocdetails','client_id','get_noc_details','region','regional','poc_losses','noc_losses'));
    }
     public function update_nocdetails(Request $request ,$noc_detail_id)
    {
    	$client_id = $request->input('client_id');
        $nocdetail = Noc::find($noc_detail_id)->toArray();
        $datas =array();
        $datas['noc_type'] = $nocdetail['noc_type'];
        $datas['validity_from'] = $nocdetail['validity_from'];
        $datas['validity_to'] = $nocdetail['validity_to'];
        $datas['upload_noc'] = $nocdetail['upload_noc'];
        $datas['final_quantum'] = $nocdetail['final_quantum'];
        $datas['noc_quantum'] = $nocdetail['noc_quantum'];
        $datas['noc_periphery'] = $nocdetail['noc_periphery'];
        $datas['stu_losses'] = $nocdetail['stu_losses'];
        $datas['poc_losses'] = $nocdetail['poc_losses'];
        $datas['discom_losses'] = $nocdetail['discom_losses'];
        $datas['region'] = $nocdetail['region'];
        $datas['region_entity'] = $nocdetail['region_entity'];
       
               // Convert Date Format
        $from_date = strtr($request->input('validity_from'), '/', '-');
        $validity_from = date("Y-m-d", strtotime($from_date));

        // Convert Date Format
        $to_date = strtr($request->input('validity_to'), '/', '-');
        $validity_to = date("Y-m-d", strtotime($to_date));
       
        $dataArray =array();
        $dataArray['noc_type'] = $request->input('noc_type');
        $dataArray['validity_from'] = $validity_from;
        $dataArray['validity_to'] = $validity_to;
        $dataArray['upload_noc'] = $request->input('upload_noc');
        $dataArray['final_quantum'] = $request->input('final_quantum');
        $dataArray['noc_quantum'] = $request->input('noc_quantum');
        $dataArray['noc_periphery'] = $request->input('noc_periphery');
        $dataArray['stu_losses'] = $request->input('stu_losses');
        $dataArray['poc_losses'] = $request->input('poc_losses');
        $dataArray['discom_losses'] = $request->input('discom_losses');
        $dataArray['region'] = $request->input('region');
        $dataArray['region_entity'] = $request->input('region_entity');
        //$dataArray['file_upload'] = '';
        if($file = $request->hasFile('upload_noc')) {
              $file = $request->file('upload_noc') ;
              $fileName = 'NOC_'.($request->input('noc_type')).'_'.time().'_'.$file->getClientOriginalName();
              $UID_path = storage_path('/app/public/uploads/noc');
              $destinationPath = $UID_path ;
              $file->move($destinationPath,$fileName);
              $dataArray['upload_noc'] = $fileName;
           }
        
        $result=array_diff($dataArray,$datas);
        $this->generateApprovalrequest($result,'noc',$client_id,$noc_detail_id,$datas);
        return redirect()->route('nocdetails', ['id' => $client_id])->with('message','Detail added successfully and sent to Approver'); 
    }


    public function delete_nocdetails(Request $request ,$noc_detail_id)
    {
        $client_id=$request->input('client_id');
        Noc::destroy($noc_detail_id);

        
        return redirect()->back()->with('message','Detail  successfully  sent to Approver');
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
