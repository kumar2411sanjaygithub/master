<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Discomdetails;
use Carbon\Carbon;
use DB;
use Validator;
use App\StateDiscom;
use Illuminate\Support\Facades\Redirect;
use Response;

class DiscomController extends Controller
{
  public function viewdiscomdetails(){
    $discomData = Discomdetails::get();
      return view('discom.discom_details',compact('discomData'));
  }
  public function savediscom(Request $request){
    $validator = Validator::make($request->all(), [
        'date_from' => 'required',
        'date_to' => 'required',
        'region' => 'required',
        'regional_entity' => 'required',
        'injection_poc_loss' => 'required',
        'withdraw_poc_loss' => 'required',
    ]
  );
  if($validator->fails())
  {
      return Redirect::back()->withErrors($validator);
  }
       $pocdetails = new Discomdetails();
       $pocdetails->date_from = $request->input('date_from');
       $pocdetails->date_to = $request->input('date_to');
       $pocdetails->region = $request->input('region');
       $pocdetails->regional_entity = $request->input('regional_entity');
       $pocdetails->injection_poc_loss = $request->input('injection_poc_loss');
       $pocdetails->withdraw_poc_loss = $request->input('withdraw_poc_loss');

       $pocdetails->save();
       return redirect()->back()->with('message', 'Data Save Successfully!');
  }
// edit pocdetails


  public function editdiscom($id)
    {

        $discomData = Discomdetails::select('*')->where('id', $id)->first();
        $voltage_array=array();
        $sldc=StateDiscom::where('state',@$discomData->region)->first();
        $voltage_data=json_decode(@$sldc->voltage);
                if(isset($voltage_data))
                {
            foreach($voltage_data as $voltage)
            {
               foreach($voltage as $sk=>$voltage_value)
               {
                   if($voltage_value!=NULL)
                   {
                       array_push($voltage_array,$voltage_value);
                   }

               }

            }
                }
        return view('discom.discom_edit',compact('discomData','voltage_array'));
    }

    public function updatediscomdata(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
          'date_from' => 'required',
          'date_to' => 'required',
          'region' => 'required',
          'regional_entity' => 'required',
          'injection_poc_loss' => 'required',
          'withdraw_poc_loss' => 'required',
        ]);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        $pocdetails = Discomdetails::find($id);
        $pocdetails->date_from = $request->input('date_from');
        $pocdetails->date_to = $request->input('date_to');
        $pocdetails->region = $request->input('region');
        $pocdetails->regional_entity = $request->input('regional_entity');
        $pocdetails->injection_poc_loss = $request->input('injection_poc_loss');
        $pocdetails->withdraw_poc_loss = $request->input('withdraw_poc_loss');

        $pocdetails->save();
        // dd("radhe");
        return redirect()->route('discomdetails')->with('updatemsg', 'Data Update Successfully!');
    }

    public function deletediscom($id)
    {

        $ppa = Discomdetails::find($id);
        $ppa->delete($id);
        return redirect()->back()->with('delmsg', 'Data Deleted Successfully!');
    }


}
