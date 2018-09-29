<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\PpaApprovedetails;
use App\Ppadetails;
use App\Client;
use Carbon\Carbon;
use App\Approvalrequest;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Response;



class PpaApprovalController extends Controller
{
  // public function approveppadetailsfind($id)
  // {
  //   $id = $id;
  //   $ppaData = PpaApprovedetails::where('client_id',$id)->paginate(10);
  //   $delData = Ppadetails::where('del_status',1)->paginate(10);
  //   $headData = Client::where('id',$id)->first();
  //   $clientData = Client::all();

  //   return view('ApprovalRequest.PPA.aprovePpa',compact('ppaData','id','clientData','headData','delData'));
  // }

    public function approveppadetailsfind(Request $request,$id)
    {
        $user_id = $id;
        //dd($request['id']);
        $client_id  =  $user_id;
        $ppaData = Approvalrequest::select('id','updated_attribute_value','attribute_name','approval_type','old_att_value','client_id','created_at','updated_by')->where(function($q) { $q->where('approval_type','ppa'); })->where('client_id',$id)->where('status', 0)->orderBy('created_at','desc')->get();
        //dd($ppaData);
        $Addexchangedata = PpaApprovedetails::select('*')->where('client_id',$id)->where('status', 0)->orderBy('created_at','desc')->get();
        //dd($AddcontactData);

        // $delcontact = Contact::select('*')->where('client_id',$id)->where('del_status',1)->orderBy('created_at','desc')->withTrashed()->get();
        $delexcgData = Ppadetails::select('*')->where(function($q) { $q->where('del_status',1); })->where('client_id',$id)->orderBy('created_at','desc')->withTrashed()->get();
        //dd($delcontact);
        $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$id)->get();
         $clientData = Client::all();


        return view('ApprovalRequest.PPA.aprovePpa',compact('ppaData','Addexchangedata','delexcgData','client_details','clientData','client_id'));
    }

  public function approveppa()
  {
    // $ppaData = PpaApprovedetails::where('status','0')->paginate(10);
    $ppaData=array();
    $clientData = Client::all();
    return view('ApprovalRequest.PPA.aprovePpa',compact('ppaData','clientData'));
  }
  public function newapprove(Request $request, $id,$type)
  {

    if($id!='' && $type=='Approved')
    {
         $ppa = PpaApprovedetails::find($id);
         $ppadetails = new Ppadetails();
         $ppadetails->client_id = $ppa->client_id;
         $ppadetails->validity_to = $ppa->validity_to;
         $ppadetails->validity_from = $ppa->validity_from;
         $ppadetails->file_path = $ppa->file_path;
         $ppadetails->remarks = $ppa->remarks;
         $ppadetails->remarks = $ppa->remarks;
         $ppadetails->created_by = $ppa->created_by;
         $ppadetails->status= 1;
         $ppadetails->save();
         $ppa->status = 1;
         $ppa->update();
        return Redirect::back()->with('success', 'Client details approved successfully.');
        }
        elseif($id!='' && $type=='Rejected')
        {
        $mm = new PpaApprovedetails;
        $mm::where('id', $id)->update(['status'=> '2']);
        return Redirect::back()->with('success', 'Client details rejected successfully.');
        }
    }
     public function Modifiedapprove($id,$type)
    {
         if($id!='' && $type=='Approved'){
            // $model = array('excahnge'=> 'Exchange',
            //           'client'=>'Client');
            $updatestemp = Approvalrequest::find($id);
            //$selectedmodel= '\\App\\'.$model[$updatestemp->approval_type];
            $selectedmodel = new Ppadetails;
            $exchange = $selectedmodel::find($updatestemp->reference_id);
            $attribute_name = $updatestemp->attribute_name;
            $exchange->$attribute_name = $updatestemp->updated_attribute_value;
            $exchange->update();
            $updatestemp->status = 1;
            $updatestemp->update();
            return Redirect::back()->with('success', 'User details successfully approved.');

         }elseif ($id!='' && $type=='Rejected') {

            Approvalrequest::where('id', $id)->update(['status'=> '2']);
            return Redirect::back()->with('success', 'User details successfully rejected.');
        }
    }
     public function delete_PPA($id,$type){

        if($id!='' && $type=='Approved'){

                  $new_bnc = new Ppadetails;
                   $new =  $new_bnc::withTrashed()->find($id);
                   Ppadetails::destroy($id);
                   $new->del_status = 2;
                   $new->update();

            return Redirect::back()->with('success', 'User details successfully approved.');
           }elseif ($id!='' && $type=='Rejected') {

                  $new_bnc = new Ppadetails;;
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 4 ;
                  $new->update();
                  return Redirect::back()->with('success', 'User details successfully rejected.');
        }
     }


}
