<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Ppadetails;
use App\Client;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Response;
class PpaDetailsController extends Controller
{

  public function ppadetails()
  {
    $ppaData = Ppadetails::where('status','0')->paginate(10);
    $clientData = Client::all();
    return view('ppa.ppa_details',compact('ppaData','clientData'));
  }
  public function findbid($id)
  {
    $id = $id;
    $ppaData = Client::where('id',$id)->first();
    $clientData = Client::all();
    return view('ppa.bidsetting',compact('ppaData','id','clientData'));
  }
public function findppa($id)
{
  $id = $id;
  // $ppaData = Client::where('id',$id)->first();
  $ppaData = Ppadetails::where('client_id',$id)->paginate(10);
  // dd($ppaData);
  $clientData = Client::all();
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
       $ppadetails = new Ppadetails();
       $ppadetails->validity_from = date('Y-m-d', strtotime($request->input('validity_from')));
       $ppadetails->validity_to = date('Y-m-d', strtotime($request->input('validity_to')));
       $ppadetails->client_id = $request->input('client');
       $ppadetails->file_path = $imageName;
       $ppadetails->save();
       return redirect()->back()->with('message', 'Data Save Successfully!');
  }

  public function editppa($id)
    {

        $ppaData = Ppadetails::select('*')->where('id', $id)->first();
        return view('ppa.editppa',compact('ppaData'));
    }

    public function updateppadata(Request $request, $id)
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
               unlink('documents/ppa/'.request()->old);
           }
           else
           {
               $imageName = $request->input('old');
           }
        $ppa = Ppadetails::find($id);
        $ppa->validity_from = date('Y-m-d', strtotime($request->input('validity_from')));
        $ppa->validity_to = date('Y-m-d', strtotime($request->input('validity_to')));
        $ppa->file_path = $imageName;
        $ppa->save();
        return redirect()->route('addppadetailsfind',['id'=>$id])->with('updatemsg', 'Data Update Successfully!');
    }

    public function deleteppa($id)
    {
        $ppa = Ppadetails::find($id);
        $file_path=$ppa->file_path;
        $ppa->destroy($id);
        unlink('documents/ppa/'.$file_path);
        return redirect()->back()->with('delmsg', 'Data Deleted Successfully!');
    }

// bid setting start---

public function viewbidsetting()
  {
    $clientData = Client::all();
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

}
