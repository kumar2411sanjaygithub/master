<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactTemp;
use App\Approvalrequest;
use App\Contact;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;
use App\Client;


class ContactApprovalController extends Controller
{
    public function contactapproval(Request $request)
    {
        $user_id = $request['id'];
        //dd($request['id']);
        $client_id  =  $user_id;
        $contactData = Approvalrequest::select('id','updated_attribute_value','attribute_name','approval_type','old_att_value','client_id','created_at','updated_by')->where(function($q) { $q->where('approval_type','contact'); })->where('client_id',$request['id'])->where('status', 0)->orderBy('created_at','desc')->get();
        $AddcontactData = ContactTemp::select('*')->where('client_id',$request['id'])->where('status', 0)->orderBy('created_at','desc')->get();
        //dd($AddcontactData);

        // $delcontact = Contact::select('*')->where('client_id',$request['id'])->where('del_status',1)->orderBy('created_at','desc')->withTrashed()->get();
        $delcontact = Contact::select('*')->where(function($q) { $q->where('del_status',1); })->where('client_id',$request['id'])->orderBy('created_at','desc')->withTrashed()->get();
        //dd($delcontact);
        


        return view('ApprovalRequest.client.contact_existing',compact('contactData','AddcontactData','delcontact','client_details'));
    }
     public function addapprove($id,$type,$type2)
       {
         
           if($id!='' && $type=='approved'){
             
                $bnc = ContactTemp::find($id);
                $new_bnc = new Contact();
                $new_bnc->client_id = $bnc->client_id;
                $new_bnc->name = $bnc->name;
                $new_bnc->designation = $bnc->designation;
                $new_bnc->email = $bnc->email;
                $new_bnc->mob_num = $bnc->mob_num;
                $new_bnc->status= 1;
                $new_bnc->save();
                $bnc->status = 1; 
                $bnc->update();
            
              
               return Redirect::back()->with('success', 'User Successfully Approved.');
               }else{
               $mm = new ContactTemp;
               $mm::where('id', $id)->update(['status'=> '2']);
                return Redirect::back()->with('success', 'User Successfully Rejected.');
            }
    }
     public function clientContactApp(Request $request,$tag='')
    {
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $id){
                $bnc = ContactTemp::find($id);
                $new_bnc = new Contact();
                $new_bnc->client_id = $bnc->client_id;
                $new_bnc->name = $bnc->name;
                $new_bnc->designation = $bnc->designation;
                $new_bnc->email = $bnc->email;
                $new_bnc->mob_num = $bnc->mob_num;
                $new_bnc->status= 1;
                $new_bnc->save();
                $bnc->status = 1; 
                $bnc->update();
            }         
            return Redirect::back()->with('success', 'User Successfully Approved.');
          }
          elseif ($tag=='Rejected') {
            foreach($array as $id){
               $mm = new ContactTemp;
               $mm::where('id', $id)->update(['status'=> '2']);
            }
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
            $selectedmodel = new Contact;
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

     public function clientContactModApp(Request $request,$tag='')
    {
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $id){
              $updatestemp = Approvalrequest::find($id); 
              //$selectedmodel= '\\App\\'.$model[$updatestemp->approval_type];
              $selectedmodel = new Contact;
              $exchange = $selectedmodel::find($updatestemp->reference_id); 
              $attribute_name = $updatestemp->attribute_name;
              $exchange->$attribute_name = $updatestemp->updated_attribute_value;
              $exchange->update();
              $updatestemp->status = 1;
              $updatestemp->update();   
            }         
            return Redirect::back()->with('success', 'User Successfully Approved.');
          }
          elseif ($tag=='Rejected') {
            foreach($array as $id){
              Approvalrequest::where('id', $id)->update(['status'=> '2']);
            }
            return Redirect::back()->with('success', 'User Successfully Rejected.');
        }
        
    }

     public function delete_contact($id,$type,$type2){

        if($id!='' && $type=='approved'){
         
                   $new_bnc = new Contact;
                   $new =  $new_bnc::withTrashed()->find($id);
                   Contact::destroy($id);
                   $new->del_status = 2;
                   $new->update();

            return Redirect::back()->with('success', 'User Successfully Approved.');
           }else{
            
                  $new_bnc = new Contact;;
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 4 ;
                  $new->update();
                  return Redirect::back()->with('success', 'User Successfully Rejected.');
        }
     }
     public function clientContactDelApp(Request $request,$tag='')
    {
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $id){
                  $new_bnc = new Contact;
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 1;
                  $new->update();
            }         
            return Redirect::back()->with('success', 'User Successfully Approved.');
          }
          elseif ($tag=='Rejected') {
            foreach($array as $id){
               $new_bnc = new Contact;;
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 2;
                  $new->update();
            }
            return Redirect::back()->with('success', 'User Successfully Rejected.');
        }
        
    }

}
