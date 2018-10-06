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
      return Redirect::back()->withInput()->withErrors($validator);
  }
       $pocdetails = new Discomdetails();
       $pocdetails->date_from =  date('Y-m-d',strtotime(strtr($request->input('date_from'), '/', '-')));
       $pocdetails->date_to =  date('Y-m-d',strtotime(strtr($request->input('date_to'), '/', '-')));
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
       $pocdetails->date_from =  date('Y-m-d',strtotime(strtr($request->input('date_from'), '/', '-')));
       $pocdetails->date_to =  date('Y-m-d',strtotime(strtr($request->input('date_to'), '/', '-')));
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



    public function import(Request $request)
    {
        if($request->file('discom_losses_file'))
        {
          $this->validate($request, [
            "file"=>'mime:csv'
          ]);
          $err_msg_array = array();
          $path = $request->file('discom_losses_file')->getRealPath();
          $import_data = \Excel::load($path, function($reader){
              $reader->select(array("date_from", "date_to", "region", "regional_entity", "injection_poc_loss", "withdraw_poc_loss"))->get();
          })->get();
          $import_data_filter = array_filter($import_data->toArray());
          if(!empty($import_data_filter) && sizeof($import_data_filter)){
            $export_data_error = $import_data_filter;
            $err_msg_array = [];
            $datacount=sizeof($export_data_error);
            // $discomData = Discomdetails::all()->toArray();
            for($i=0;$i<$datacount;$i++){
              $rules = [
                  'date_from'=>'required', 
                  'date_to'=>'required', 
                  'region'=>'required', 
                  'regional_entity'=>'required', 
                  'injection_poc_loss'=>'required', 
                  'withdraw_poc_loss'=>'required'
              ];

              $v = Validator::make($export_data_error[$i], $rules);
              $messages = $v->messages();

              foreach ($messages->all() as $message){
                $err_msg_array[$i][]=$message;
              }

              $errormessage = [];
              $errorrow = [];
              foreach($err_msg_array as $key=>$value){
                for($k=0; $k<count($value);$k++){
                  $errorlist=$value[$k].' in row '.($key+2)."\r\n";
                  array_push($errormessage, $errorlist);
                  array_push($errorrow, $key+2);
                }
              }

              if(empty($err_msg_array[$i])){
                $dataImported = $export_data_error[$i];
                $dataImported["date_from"] =  date('Y-m-d',strtotime(str_replace("/","-",$dataImported["date_from"])));
                $dataImported["date_to"] = date('Y-m-d',strtotime(str_replace("/","-",$dataImported["date_to"])));
                unset($export_data_error[$i]);
                // dd($dataImported0);
                Discomdetails::insert($dataImported);
              }

            }
            if(empty($errormessage)){
              return redirect()->back()->with('msg', 'Data Imported Successfully!');
            }
            else{
              return redirect()->back()->withErrors($errormessage);
            }
          }
        }
    }

}
