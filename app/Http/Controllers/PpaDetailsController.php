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

  public function saveppa(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'validity_from' => 'required',
        'validity_to' => 'required',
        'file_path' => 'required',
    ]);
    if($validator->fails())
    {
        return Redirect::back()->withErrors($validator);
    }
    if(isset(request()->file_path))
       {
           $imageName = time().'.'.request()->file_path->getClientOriginalName();
           request()->file_path->move(public_path('documents/ppa/'), $imageName);
       }
       else
       {
           $imageName = "";
       }
       $ppadetails = new Ppadetails();
       $ppadetails->validity_from = $request->input('validity_from');
       $ppadetails->validity_to = $request->input('validity_to');
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
        $validator = Validator::make($request->all(), [
            'validity_from' => 'required',
            'validity_to' => 'required',
            // 'file_path' => 'required',
        ]);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        if(isset(request()->file_path))
           {
               $imageName = time().'.'.request()->file_path->getClientOriginalName();
               request()->file_path->move(public_path('documents/ppa/'), $imageName);
           }
           else
           {
               $imageName = $request->input('old');
           }
        $ppa = Ppadetails::find($id);
        $ppa->validity_from = $request->input('validity_from');
        $ppa->validity_to = $request->input('validity_to');
        $ppa->file_path = $imageName;
        // $v = $department->getDirty();
        // dd($ppa);
        $ppa->save();
        // dd("radhe");
        return redirect()->route('addppadetailss')->with('updatemsg', 'Data Update Successfully!');
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

public function addbidsetting(Request $request){
    $this->validate($request,[
      'client' => 'required',
      'bid_cut_off_time' => 'required',
      'trader_type' => 'required'
    ]);
    $id = $request->input('client');
    $ppa = Client::find($id);
    $ppa->bid_cut_off_time = $request->input('bid_cut_off_time');
    $ppa->trader_type = $request->input('trader_type');

    $ppa->save();
    return redirect()->route('bid.bidview')->with('addmsg', 'Data Add Successfully!');
}

}
