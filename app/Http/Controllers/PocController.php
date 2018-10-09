<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Pocdetails;
use Carbon\Carbon;
use DB;
use Excel;
use ZipArchive;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Response;

class PocController extends Controller
{
  public function viewpocdetails(){
    $lossesData = Pocdetails::get();
      return view('poc.poc_details',compact('lossesData'));
  }


     // public function import(Request $request){
     //     	//validate the xls file
     // 		$this->validate($request, array(
     // 			'file' => 'required',
     //      'poc_date_from' => 'required',
     //      'poc_date_to' => 'required'
     // 		));
     //    $date_from = date("Y-m-d", strtotime($request->input('poc_date_from')));
     //    $date_to = date("Y-m-d", strtotime($request->input('poc_date_to')));
     //    $lossesData = DB::table('poc_losses')->select('*')->where('date_from','<=',$date_from)->where('date_to', '>=',$date_to)->get();
     //    // dd($lossesData);
     //    // echo count($lossesData);
     //    // die();
     //    if(count($lossesData)==0){
     //
     //     $file = $request->file('file');
     //
     //    $filename=$file->getClientOriginalName();
     //    $fileextension=$file->getClientOriginalExtension();
     //    if($fileextension!='xlsx'&&$fileextension!='xls'){
     //          $validator = Validator::make([], []);
     //          $validator->getMessageBag()->add('filetype', 'Invalid File type');
     //          return redirect()->back()
     //                          ->withErrors($validator->getMessageBag());
     //     }
     //  //Move Uploaded File
     //
     //  $destinationPath = storage_path('upload');
     //  $file->move($destinationPath,$file->getClientOriginalName());
     //  $filepath=$destinationPath.'/'.$file->getClientOriginalName();
     //
     //   $records = \Excel::load($filepath);
     //
     //   $sheetData = $records->getActiveSheet()->toArray(null, true, true, true);
     //   $i=1;
     //
     //   foreach ($sheetData as $key => $value) {
     //     if ($i>2) {
     //       $losses = new Pocdetails();
     //       $losses->region = $value['B'];
     //       $losses->regional_entity = $value['C'];
     //       $losses->regional_entity_code = $value['E'];
     //       $losses->injection_poc_loss = $value['H'];
     //       $losses->withdraw_poc_loss = $value['I'];
     //       $losses->date_from = $date_from;
     //       $losses->date_to = $date_to;
     //       $losses->save();
     //     }
     //     $i++;
     //   }
     //   return redirect()->back()->with('message', 'Data Save Successfully!');
     // }
     //
     // }

  public function savepoc(Request $request){
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
       $pocdetails = new Pocdetails();
       $pocdetails->date_from = date('Y-m-d',strtotime(str_replace("/","-", $request->input('date_from'))));
       $pocdetails->date_to = date('Y-m-d',strtotime(str_replace("/","-", $request->input('date_to'))));
       $pocdetails->region = $request->input('region');
       $pocdetails->regional_entity = $request->input('regional_entity');
       $pocdetails->injection_poc_loss = $request->input('injection_poc_loss');
       $pocdetails->withdraw_poc_loss = $request->input('withdraw_poc_loss');

       $pocdetails->save();
       return redirect()->back()->with('message', 'Data Save Successfully!');
  }


  public function editpoc($id)
    {

        $pocData = Pocdetails::select('*')->where('id', $id)->first();
        return view('poc.poc_edit',compact('pocData'));
    }

    public function updateppadata(Request $request, $id)
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
        $pocdetails = Pocdetails::find($id);
        $pocdetails->date_from = date('Y-m-d',strtotime(str_replace("/","-", $request->input('date_from'))));
        $pocdetails->date_to = date('Y-m-d',strtotime(str_replace("/","-", $request->input('date_to'))));
        $pocdetails->region = $request->input('region');
        $pocdetails->regional_entity = $request->input('regional_entity');
        $pocdetails->injection_poc_loss = $request->input('injection_poc_loss');
        $pocdetails->withdraw_poc_loss = $request->input('withdraw_poc_loss');

        $pocdetails->save();
        // dd("radhe");
        return redirect()->route('pocdetails')->with('updatemsg', 'Data Update Successfully!');
    }

    public function deletepoc($id)
    {

        $ppa = Pocdetails::find($id);
        $ppa->delete($id);
        return redirect()->back()->with('delmsg', 'Data Deleted Successfully!');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     /*public function import(Request $request){
         	//validate the xls file
     		$this->validate($request, array(
     			'file' => 'required',
          'date_from' => 'required',
          'date_to' => 'required'
     		));
        $date_from = date("Y-m-d", strtotime($request->input('date_from')));
        $date_to = date("Y-m-d", strtotime($request->input('date_to')));
        $lossesData = DB::table('poc_losses')->select('*')->where('date_from','<=',$date_from)->where('date_to', '>=',$date_to)->get();
        // dd($lossesData);
        // echo count($lossesData);
        // die();
        if(count($lossesData)==0){

         $file = $request->file('file');

        $filename=$file->getClientOriginalName();
        $fileextension=$file->getClientOriginalExtension();
        if($fileextension!='xlsx'&&$fileextension!='xls'){
              $validator = Validator::make([], []);
              $validator->getMessageBag()->add('filetype', 'Invalid File type');
              return redirect()->back()
                              ->withErrors($validator->getMessageBag());
         }
      //Move Uploaded File

      $destinationPath = storage_path('upload');
      $file->move($destinationPath,$file->getClientOriginalName());
      $filepath=$destinationPath.'/'.$file->getClientOriginalName();

       $records = \Excel::load($filepath);

       $sheetData = $records->getActiveSheet()->toArray(null, true, true, true);
       $i=1;

       foreach ($sheetData as $key => $value) {
         if ($i>2) {
           $losses = new Pocdetails();
           $losses->region = $value['B'];
           $losses->regional_entity = $value['C'];
           $losses->regional_entity_code = $value['E'];
           $losses->injection_poc_loss = $value['H'];
           $losses->withdraw_poc_loss = $value['I'];
           $losses->date_from = $date_from;
           $losses->date_to = $date_to;
           $losses->save();
         }
         $i++;
       }
       return redirect('/statepoclossess')->with('message', 'Data Save Successfully!');
     }

     }*/
    public function import(Request $request)
    {
        if($request->file('poc_losses_file')->isValid())
        {
          // $this->validate($request, [
          //   "poc_losses_file"=>'mimes:csv'
          // ]);
          $validator = Validator::make(
              [
                  'file'      => $request->file('poc_losses_file'),
                  'extension' => strtolower($request->file('poc_losses_file')->getClientOriginalExtension()),
              ],
              [
                  'file'          => 'required',
                  'extension'      => 'required|in:csv',
              ]
          );
          if ($validator->fails()) {
              return redirect()->back()->withErrors(['poc_losses_file'=>'Please upload a valid csv file.']);
          }
          $err_msg_array = array();
          $path = $request->file('poc_losses_file')->getRealPath();
          $import_data = \Excel::load($path, function($reader){
              $reader->select(array('date_from', 'date_to','region', 'regional_entity', 'regional_entity_code', 'injection_poc_loss', 'withdraw_poc_loss'))->get();
          })->get();
          // dd($import_data);
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
                  'regional_entity_code'=>'required',
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
                Pocdetails::insert($dataImported);
              }

            }
            if(empty($errormessage)){
              return redirect()->back()->with('msg', 'Data Imported Successfully!');
            }
            else{
              return redirect()->back()->withErrors($errormessage);
            }
          }
          else{ 
            return redirect()->back()->withErrors(['poc_losses_file'=>"Please upload a valid csv file with data."]);
          }
        }
        else{
           return redirect()->back()->withErrors(['poc_losses_file'=>'Please upload a valid csv file.']);
        }
    }
}
