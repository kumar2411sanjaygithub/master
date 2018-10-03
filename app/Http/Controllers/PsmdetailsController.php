<?php

namespace App\Http\Controllers;
// use App\Http\Resources\Userdata as UserdataResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Client;
use Carbon\Carbon;
use DB;
use App\Psmdetails;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Gate;
use Response;


class PsmdetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewclient()
    {
        $clientData = Client::all();
        $psmData = Psmdetails::paginate(10);
        return view('psm.psmdetails',compact('psmData','clientData'));
    }
    public function viewinsuffi()
    {
        return view('psm.insufficientpsm');
    }

    public function findPsmData(Request $request,$id)
      {
        $psmData = Psmdetails::select('*')->where('client_id', $id)->paginate(10);
        $id = $request['id'];
        $clientData = Client::where('id',$id)->first();
        $last_id = Psmdetails::where('client_id',$id)->orderBy('id', 'DESC')->first();
        return view('psm.addpsmdetails',compact('psmData','id','clientData','last_id'));
      }

      public function editexposure(Request $request, $id,$client_id)
      {
        $psmData = Psmdetails::select('*')->where('client_id', $client_id)->paginate(10);
        $last_id = Psmdetails::where('id',$id)->first();
        $clientData = Client::where('id',$client_id)->first();
        //dd($last_id);
        return view('psm.addpsmdetails',compact('last_id','clientData','psmData','id'));
      }

    public function submitpsmexposure(Request $request){
       $this->validate($request,[
         "psm_amount"=>"required",
         "exposure"=>"required",
         "client_id"=>"required"
       ]);
       $psm_amount=$request['psm_amount'];
       $psm_exposer=$request['exposure'];
       $amount=0;
       if($request['exposure']&&$request['psm_amount']){
         $amount=round(($request['exposure']*$request['psm_amount'])/100,2);
       }
       $clientmaster = Clientmaster::where("id",$request['client_id'])->first();
       $clientmaster->psm_amount = $psm_amount;
       $clientmaster->exposure_percent = $psm_exposer;
       $clientmaster->exposure = $amount;
       $date = Date('Y-m-d');
       $clientmaster->psm_added_date = $date;
       $clientmaster->save();
       return redirect()->back()->with('message','PSM exposer Changed Successfully');
    }

    public function unsetpaymentsecuritymargin(Request $request){
      $clientmaster = Clientmaster::where("id",$request['id'])->first();
      //dd($clientmaster);
      $clientmaster->psm_amount = 0;
      $clientmaster->exposure_percent = 0;
      $clientmaster->exposure = 0;
      $clientmaster->psm_added_date = 0000-00-00;
      $clientmaster->save();
      return redirect()->back()->with('message','PSM exposer Changed Successfully');
    }

    public function addpsmdetailssubmit(Request $request, $id)
    {
      if($request['type'] == 0 || $request['type'] == 1)

      {
        $validator = $this->validate($request, [
        "type"=>"required",
        "received_date"=>"required|date",
        "amount"=>"required",
        "expiry_date"=>"required|date|after:received_date|after:issue_date",
      ]);
    }

      $psm = new Psmdetails();
      if($request['type'] == 2 || $request['type'] == 3)
      {
        $validator = $this->validate($request, [
        "type"=>"required",
        "received_date"=>"required|date",
        "amount"=>"required",
        "issue_date"=>"required",
        "document"=>"required",
        "expiry_date"=>"required|date|after:received_date|after:issue_date",
      ]);


        if(isset(request()->document))
           {

               $imageName = time().'.'.request()->document->getClientOriginalName();
               $contact_path = public_path().'/documents/psm/';
               File::isDirectory($contact_path) or File::makeDirectory($contact_path, 0777, true, true);
              request()->document->move($contact_path, $imageName);
           }
           else
           {
               $imageName = "";
           }
        $psm->document = $imageName;
      }
      $psm->type = $request['type'];
      // $psm->received_date = date('Y-m-d', strtotime($request['received_date']));
      $psm->received_date = ($request['received_date']!='') ? date('Y-m-d', strtotime(str_replace('/','-',$request['received_date']))) : "";
      // $request['received_date'];
      $psm->document_no = $request['document_no'];
      $psm->amount = $request['amount'];

      $request['issue_date']=($request['issue_date']!='') ? date('Y-m-d', strtotime(str_replace('/','-',$request['issue_date']))) : "";
      $request['expiry_date']=($request['expiry_date']!='') ? date('Y-m-d', strtotime(str_replace('/','-',$request['expiry_date']))) : "";
      $request['revocable_date']=($request['revocable_date']!='') ? date('Y-m-d', strtotime(str_replace('/','-',$request['revocable_date']))) : "";
      if($request['issue_date']!=''){
        $psm->issue_date = $request['issue_date'];
      }
      if($request['revocable_date']!=''){
        $psm->revocable_date = $request['revocable_date'];
      }
      $psm->expiry_date = $request['expiry_date'];
      $psm->description = $request['description'];
      $psm->client_id = $id;
      // dd($psm);
      $psm->save();

      return redirect()->back()->with('message','PSM Added Successfully');
    }

    public function deletepaymentsecuritymargin(Request $request){
      $del_psm=Psmdetails::find($request['id']);
      $file_path=$del_psm->document;
      $del_psm->delete();
      if($file_path!=''&&file_exists(public_path('documents/psm/'.$file_path)))
      {
        unlink('documents/psm/'.$file_path);
      }
      return redirect()->back()->with("message","Deleted Sucessfully");
    }

    public function editpsmdetails(Request $request, $id, $client_id){
      // $radhe = new Psmdetails::where('id',$request['id']);
      $psmData = Psmdetails::where("id",$request['id'])->first();
      $clientData = Client::where('id',$client_id)->first();
      return view('psm.psm_edit',compact('psmData','clientData'));
    }

    public function addpsmexposure(Request $request, $id){
      // $this->validate($request,[
      //   "psm_amount"=>"required",
      //   "exposure"=>"required",
      //   "client_id"=>"required"
      // ]);
      $psmData = Psmdetails::find($id);
      $psmData->psm_amount = $request['psm_amount'];
      $psmData->exposure_percent = $request['exposure_percent'];
      $psmData->exposure = $request['exposure'];
      $psmData->psm_added_date = date('d/m/Y');
      $psmData->save();
      return redirect()->back()->with('message','PSM Added Successfully');
    }

    public function updatepsm(Request $request,$id){
      if($request['type'] == 0 || $request['type'] == 1)
      {
        $validator = $this->validate($request, [
        "type"=>"required",
        "received_date"=>"required|date",
        "amount"=>"required",
        "expiry_date"=>"required|date|after:received_date|after:issue_date",
      ]);
    }
      $psm = Psmdetails::find($id);
      if($request['type'] == 2 || $request['type'] == 3)
      {
        $validator = $this->validate($request, [
        "type"=>"required",
        "received_date"=>"required|date",
        "amount"=>"required",
        "issue_date"=>"required",
        "expiry_date"=>"required|date|after:received_date|after:issue_date",
      ]);
        if(isset(request()->document))
           {
               $imageName = time().'.'.request()->document->getClientOriginalName();
               request()->document->move(public_path('documents/psm/'), $imageName);
               unlink('documents/psm/'.request()->old);

           }
           else
           {
               $imageName = $request['old'];
           }
        $psm->document = $imageName;
      }
      $psm->type = $request['type'];
      $psm->received_date = date('Y-m-d', strtotime(str_replace('/','-',$request['received_date'])));
      $psm->document_no = $request['document_no'];
      $psm->amount = $request['amount'];

      $request['issue_date']=($request['issue_date']!='') ? date('Y-m-d', strtotime(str_replace('/','-',$request['issue_date']))) : "";
      $request['expiry_date']=($request['expiry_date']!='') ? date('Y-m-d', strtotime(str_replace('/','-',$request['expiry_date']))) : "";
      $request['revocable_date']=($request['revocable_date']!='') ? date('Y-m-d', strtotime(str_replace('/','-',$request['revocable_date']))) : "";
      if($request['issue_date']!=''){
        $psm->issue_date = $request['issue_date'];
      }
      if($request['revocable_date']!=''){
        $psm->revocable_date = $request['revocable_date'];
      }
      // $psm->issue_date = $request['issue_date'];
      $psm->expiry_date = $request['expiry_date'];
      // $psm->revocable_date = $request['revocable_date'];
      $psm->description = $request['description'];
      $psm->client_id = $request['client_id'];
      $psm->save();
      // dd($psm);
      return redirect()->to('/psm/psmdetails/'.$request['client_id'])->with('updatemsg','PSM Updated Successfully');

    }

}
