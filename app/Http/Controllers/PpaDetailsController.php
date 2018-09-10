<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Ppadetails;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
class PpaDetailsController extends Controller
{

  public function ppadetails()
  {
    $ppaData = Ppadetails::where('status','0')->paginate(1);
    return view('ppa.ppa_details',compact('ppaData'));
  }
  public function saveppa(Request $request){
    $validator = Validator::make($request->all(), [
        'validity_from' => 'required',
        'validity_to' => 'required',
        'file_path' => 'required',
    ]
    // ,
    // [
    //     'validity_from' => 'Please Choose From Date',
    //     'validity_to' => 'Please Choose To Date',
    //     'file_path' => 'Please Choose File',
    // ]
  );
    if($validator->fails())
    {
        return Redirect::back()->withErrors($validator);
    }
    if(isset(request()->file_path))
       {
           $imageName = time().'.'.request()->file_path->getClientOriginalName();
           request()->file_path->move(public_path('ppa/'), $imageName);
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
            'file_path' => 'required',
        ]
        // ,
        // [
        //     'validity_from' => 'Please Choose From Date',
        //     'validity_to' => 'Please Choose To Date',
        //     'file_path' => 'Please Choose File',
        // ]
      );
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        if(isset(request()->file_path))
           {
               $imageName = time().'.'.request()->file_path->getClientOriginalName();
               request()->file_path->move(public_path('ppa/'), $imageName);
           }
           else
           {
               $imageName = "";
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
        $ppa->destroy($id);
        return redirect()->back()->with('delmsg', 'Data Deleted Successfully!');
    }



}
