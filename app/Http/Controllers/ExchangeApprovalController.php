<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExchangeTemp;
use App\Approvalrequest;
use App\Exchange;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;


class ExchangeApprovalController extends Controller
{
     public function exchangeapproval(Request $request)
    {
        $user_id = $request['id'];
        $client_id  =  $user_id;
         $exchangeData = Approvalrequest::select('id','updated_attribute_value','attribute_name','approval_type','old_att_value','client_id','created_at','updated_by')->where(function($q) { $q->where('approval_type','exchange')->orwhere('approval_type','pxil_details'); })->where('client_id',$request['id'])->where('status', 0)->orderBy('created_at','desc')->get();
        $Addexchangedata = Exchangetemp::select('*')->where('client_id',$request['id'])->where('status', 0)->orderBy('created_at','desc')->get();
        $delexcgData = Exchange::select('*')->where('client_id',$request['id'])->where('del_status',0)->where('deleted_at', '!=' ,'NULL')->orderBy('created_at','desc')->withTrashed()->get();
        //dd($delexcgData);

        return view('ApprovalRequest.client.ex_existing',compact('exchangeData','Addexchangedata','delexcgData'));
    }
     public function addapprove($id,$type,$type2)
       {
         
           if($id!='' && $type=='approved'){
             
                $bnc = ExchangeTemp::find($id);
                $new_bnc = new Exchange();
                $new_bnc->client_id = $bnc->client_id;
                $new_bnc->ex_type = $bnc->ex_type;
                $new_bnc->validity_from = $bnc->validity_from;
                $new_bnc->validity_to = $bnc->validity_to;
                $new_bnc->file_upload = $bnc->file_upload;
                $new_bnc->status= 1;
                $new_bnc->save();
                $bnc->status = 1; 
                $bnc->update();
            
              
               return Redirect::back()->with('success', 'User Successfully Approved.');
               }else{
               $mm = new ExchangeTemp;
               $mm::where('id', $id)->update(['status'=> '2']);
                return Redirect::back()->with('success', 'User Successfully Rejected.');
            }
    }
     public function modified($id,$type)
    {
         if($id!='' && $type=='approved'){
            // $model = array('excahnge'=> 'Exchange',
            //           'client'=>'Client');
            $updatestemp = Approvalrequest::find($id); 
            //$selectedmodel= '\\App\\'.$model[$updatestemp->approval_type];
            $selectedmodel = new Exchange;
            $exchange = $selectedmodel::find($updatestemp->reference_id); 
            $attribute_name = $updatestemp->attribute_name;
            $exchange->$attribute_name = $updatestemp->updated_attribute_value;
            $exchange->update();
            $updatestemp->status = 1;
            $updatestemp->update();          
            return Redirect::back()->with('success', 'User Successfully Approved.');

         }elseif ($id!='' && $type=='rejected') {

            Approvalrequest::where('id', $id)->update(['status'=> '2']);
            return Redirect::back()->with('success', 'User Successfully Rejected.');
        }
    }
     public function delete_exchange($id,$type,$type2){

        if($id!='' && $type=='approved'){

                  $new_bnc = new Exchange;
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 1;
                  $new->update();

            return Redirect::back()->with('success', 'User Successfully Approved.');
           }else{
            
                  $new_bnc = new Exchange;;
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 2;
                  $new->update();
                  return Redirect::back()->with('success', 'User Successfully Rejected.');
        }
     }
}
