<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\PpaApprovedetails;
use App\Ppadetails;
use App\Client;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Response;



class PpaApprovalController extends Controller
{
  public function approveppadetailsfind($id)
  {
    $id = $id;
    $ppaData = PpaApprovedetails::where('client_id',$id)->paginate(10);
    $delData = Ppadetails::where('del_status',1)->paginate(10);
    $headData = Client::where('id',$id)->first();
    $clientData = Client::all();
    return view('ApprovalRequest.PPA.aprovePpa',compact('ppaData','id','clientData','headData','delData'));
  }
  public function approveppa()
  {
    $ppaData = PpaApprovedetails::where('status','0')->paginate(10);
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
        return Redirect::back()->with('success', 'User details successfully approved.');
        }
        elseif($id!='' && $type=='Rejected')
        {
        $mm = new PpaApprovedetails;
        $mm::where('id', $id)->update(['status'=> '2']);
        return Redirect::back()->with('success', 'User details successfully rejected.');
        }
    }
}
