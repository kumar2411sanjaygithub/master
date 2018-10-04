<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Ppadetails;
use App\PpaApprovedetails;
use App\Client;
use Carbon\Carbon;
use App\Approvalrequest;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Response;
class PpaDetailsController extends Controller
{

  public function ppadetails()
  {
    $ppaData = Ppadetails::where('status','1')->paginate(10);
    $clientData = Client::where('client_app_status','1')->get();
    return view('ppa.ppa_details',compact('ppaData','clientData'));
  }
  public function findbid($id)
  {
    $id = $id;
    $ppaData = Client::where('id',$id)->first();
    $clientData = Client::where('client_app_status','1')->get();
    return view('ppa.bidsetting',compact('ppaData','id','clientData'));
  }
public function findppa($id)
{
  $id = $id;
  // dd($id);
  // $ppaData = Client::where('id',$id)->first();
  $ppaData = Ppadetails::where('client_id',$id)->latest()->paginate(15);
  // dd($ppaData);
  $clientData = Client::where('client_app_status','1')->get();
  return view('ppa.addppa',compact('ppaData','id','clientData'));
}
  public function saveppa(Request $request)
  {
    $this->validate($request,[
        'validity_from' => 'required',
        'validity_to' => 'required',
        'file_path' => 'required',
    ]);

    if(isset(request()->file_path))
       {
           $imageName = time().'.'.request()->file_path->getClientOriginalName();
           $contact_path = public_path().'/documents/ppa/';
           File::isDirectory($contact_path) or File::makeDirectory($contact_path, 0777, true, true);
          request()->file_path->move($contact_path, $imageName);
        }
       else
       {
           $imageName = "";
       }

       // Convert Date Format
        $commerce_date = strtr($request->input('validity_from'), '/', '-');
        $new_start_date = date("Y-m-d", strtotime($commerce_date));
        $commerce_end_date = strtr($request->input('validity_to'), '/', '-');
        $new_end_date = date("Y-m-d", strtotime($commerce_end_date));

       // $ppadetails = new Ppadetails();
       $ppadetails = new PpaApprovedetails();
       $ppadetails->validity_from = $new_start_date;
       $ppadetails->validity_to = $new_end_date;
       $ppadetails->client_id = $request->input('client');
       $ppadetails->file_path = $imageName;
       $ppadetails->status = 0;
       $ppadetails->save();
       return redirect()->back()->with('message', 'Details added successfully and sent for approval');
  }

  public function editppa($id)
    {

        $ppaData = Ppadetails::select('*')->where('id', $id)->first();
        return view('ppa.editppa',compact('ppaData'));
    }

    public function updateppadata(Request $request, $ppdetailid)
    {
        $this->validate($request, [
            'validity_from' => 'required',
            'validity_to' => 'required'
            // 'file_path' => 'required',
        ]);

        if(isset(request()->file_path))
           {
               $imageName = time().'.'.request()->file_path->getClientOriginalName();
               request()->file_path->move(public_path('documents/ppa/'), $imageName);
               // unlink('documents/ppa/'.request()->old);
           }
           else
           {
               $imageName = $request->input('old');
           }
        // $ppa = Ppadetails::find($id);
        // $ppa->validity_from = date('Y-m-d', strtotime($request->input('validity_from')));
        // $ppa->validity_to = date('Y-m-d', strtotime($request->input('validity_to')));
        // $ppa->file_path = $imageName;
        // $ppa->save();
        // return redirect()->route('addppadetailsfind',['id'=>$id])->with('updatemsg', 'Data Update Successfully!');
        $client_id = $request->input('client_id');
        $ppadetail = Ppadetails::find($ppdetailid)->toArray();
        $datas =array();
        $datas['validity_from'] = $ppadetail['validity_from'];
        $datas['validity_to'] = $ppadetail['validity_to'];
        //$datas['file_path'] = $ppadetail['file_path'];
        // Convert Date Format
         $commerce_date = strtr($request->input('validity_from'), '/', '-');
         $new_start_date = date("Y-m-d", strtotime($commerce_date));
         $commerce_end_date = strtr($request->input('validity_to'), '/', '-');
         $new_end_date = date("Y-m-d", strtotime($commerce_end_date));
        $dataArray =array();
        $dataArray['validity_from'] = $new_start_date;
        $dataArray['validity_to'] = $new_end_date;
        // $dataArray['email'] = $request->input('email');
        $result=array_diff($dataArray,$datas);

        $this->generateApprovalrequest($result,'ppa',$client_id,$ppdetailid,$datas);
        return redirect()->route('addppadetailsfind',['id'=>$client_id])->with('updatemsg','Detail added successfully and sent to Approver');


    }

    public function deleteppa($id)
    {
        // $ppa = Ppadetails::find($id);
        // $ppa->del_status = 1;
        // $ppa->update();
        // // $file_path=$ppa->file_path;
        // $ppa->destroy($id);
        // unlink('documents/ppa/'.$file_path);
        //$client_id=$request->input('client_id');
        $exchange = Ppadetails::find($id);
        $exchange->del_status = 1;
        $exchange->update();


        return redirect()->back()->with('delmsg', 'Data Deleted Successfully!');
    }

// bid setting start---

public function viewbidsetting()
  {
    $clientData = Client::where('client_app_status','1')->get();
    return view('ppa.bidsetting',compact('clientData'));
  }

  public function findBidData(Request $request)
    {
      $selData = Client::select('*')->where('id', $request['id'])->first();
      return Response::json(array('bid_cut_off_time' => $selData->bid_cut_off_time, 'trader_type' => $selData->trader_type));
    }

public function addbidsetting(Request $request,$id=''){
  //$id = $request->input('client_id');
  //dd($request->all());
    $v=$this->validate($request,[
      'client_id' => 'required',
      'bid_cut_off_time' => 'required',
      'trader_type' => 'required'
    ]);

    $id = $request->input('client_id');
    $ppa = Client::find($id);
    $ppa->bid_cut_off_time = $request->input('bid_cut_off_time');
    $ppa->trader_type = $request->input('trader_type');
    $ppa->save();
    return redirect()->route('addbiddetailsfind',['id'=>$id])->with('addmsg', 'Data Add Successfully!');
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
