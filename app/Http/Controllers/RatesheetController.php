<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Validator;
use Storage;
use App\Placebid;
use App\Clientmaster;
use Illuminate\Support\Facades\Redirect;
use App\Exchangeuser;
use App\ExcMoneyClearance;
use App\ExMoneyClearence;
use App\exc_moneyclearance_detail;
use App\exc_money_relation_detail;
use DB;
use PHPExcel;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use PHPExcel_Chart_DataSeriesValues;
use PHPExcel_Chart_DataSeries;
use PHPExcel_Chart_PlotArea;
use PHPExcel_Chart_Legend;
use PHPExcel_Chart_Title;
use PHPExcel_Chart;
use PHPExcel_IOFactory;
use App\Excelgraph;
use Excel;
use App\Ratesheetlog;

class RatesheetController extends Controller
{
    public function index()
    {

    	$start = "01";
		$end = date("d",strtotime("now"));
		$append=date("-m-Y",strtotime("now"));
		$prepend=date("Y-m-",strtotime("now"));
		if(($end==date("t",strtotime("now"))) && (strtotime("now") <= strtotime("12:00:00")))
		{
		    $end = date("d",strtotime("now +1 day"));
		    $append=date("-m-Y",strtotime("now +1 day"));
		    $prepend=date("Y-m-",strtotime("now +1 day"));
		}
		if(strtotime("now") <= strtotime("12:00:00"))
		{
		     $end = date("d",strtotime("now +1 day"));
		}
		$date = array_map(function($item){ return str_pad($item,2,'0',STR_PAD_LEFT);}, range($start,$end));
		rsort($date);
		$rst_log = Ratesheetlog::whereDate('date', 'LIKE', date("Y-m").'-%')->get()->toArray();
		$date_list = array();
		foreach($date as $list){
			$key=null;
			$key = array_search($prepend.$list, array_column($rst_log, 'date'));
			if(gettype($key) == "integer"){ 
				$date_list[$list.$append]=$rst_log[$key]['filename'];
			}
			else{ $date_list[$list.$append]=''; }
		}
		$date=$rst_log=null;
		$year = date('Y',strtotime("now"));
        $month = date('m_M',strtotime("now"));
		$directory_path['IEX'] = 'files/dam/uploads/IEX/ratesheet/';
		$directory_path['PXIL'] = 'files/dam/uploads/PXIL/ratesheet/'.$year.'/'.$month;
       	return view('dam.import.ratesheet',compact('date_list','directory_path'));
    }

    /**
     * Upload the ratesheet.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fileToUpload' => 'max:2048|required|mimes:csv,txt',
            'date'	=>	'date_format:d-m-Y',
            //'exchange'	=>	['required','regex:/(^IEX$)|(^PXIL$)/'],
        ],
        [
            'fileToUpload.required' => 'Please choose csv to upload.',
            //'date' => 'Date is not selected',
            //'exchange' => 'Exchange is not setted.',
        ]);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        //dd($request->date);
       //dd($request->exchange);
        $year = date('Y',strtotime($request->date));

        //$month = date('m_M',strtotime($request->date));
        $ratesheet = 'rate'.$request->date.'.'.request()->fileToUpload->getClientOriginalExtension();
        $date_ratesheet = Ratesheetlog::where(array('date'=>date('Y-m-d', strtotime($request->date))))->get();
        if($date_ratesheet->count()>0){
        	$ratesheet = 'rate'.$request->date.'_'.time().''.request()->fileToUpload->getClientOriginalExtension();
        	$old_filename = $date_ratesheet[0]->filename;
        }
		//$request->fileToUpload->storeAs('storage/files/dam/uploads/IEX/ratesheet',$ratesheet);
		request()->fileToUpload->move(storage_path('files/dam/uploads/IEX/ratesheet'), $ratesheet); 
		if($this->import( $ratesheet,$request->date)){
			@unlink(storage_path('files/dam/uploads/IEX/ratesheet')."/".$old_filename);
	        return back()
	            ->with('success','You have successfully uploaded the ratesheet.')
	            ->with('fileToUpload',$ratesheet);
	    }
	    else{
	    	@unlink(storage_path('files/dam/uploads/IEX/ratesheet')."/".$ratesheet);
	    	return back()
	            ->withErrors(['Failed To Import Ratesheet. Invalid File.']);
	    }
	    return back()
	            ->withErrors(['Failed To Upload Ratesheet.']);
    }

       /**
     * Import the ratesheet.
     *
     * @return \Illuminate\Http\Response
     */
    protected function import($filename,$dt)
    {
    	$dt=date('Y-m-d',strtotime($dt));
		$filePath = storage_path('files/dam/uploads/IEX/ratesheet/'. $filename);
		if(file_exists($filePath))
		{
			try{
		        $count = 0;
			    if (($handle = fopen($filePath, "r")) !== FALSE) {
			        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			            $myArray[] = $data;
			            $count++;
			        }
			        fclose($handle);
			    }
			    if (count($myArray) < 0) {
			        return false;
			    } else {
			    	$result = false;
			        for ($i = 1; isset($myArray[0][$i]); $i++) {
			            $money_clearence = array(
			            	'date'=>$dt,
				            'region'=>trim(str_replace("-Price", "", $myArray[0][$i])), 
				            'type'=>'IEX', 
				            'min'=>$myArray[97][$i], 
				            'max'=>$myArray[98][$i], 
				            'avg'=>$myArray[99][$i], 
				            'entryby'=>'1');
			            $id = \App\MoneyClearence::insertGetId($money_clearence);
			            if($id<>null){
			            	$money_relation_details = array();
				            for ($j = 1; $j < 97; $j++) {
				            	$timeSlice = explode("-", $myArray[$j][0]);
				                $money_relation_details[] = array(
				                	'money_id'=>$id,
					            	'fromtime'=>$timeSlice[0] ,
					            	'totime'=>$timeSlice[1],
					            	'price'=>$myArray[$j][$i],
					            	'entry_by'=>'1'
				                );
				            }
				             $result = \App\MoneyRelationDetails::insert($money_relation_details);
				        }
			        }
			       
			    }
		        if ($result) {
		            $rsl = Ratesheetlog::firstOrNew(array('date'=>$dt));
			        $rsl->date = $dt;
			        $rsl->filename = $filename;
			        $rsl->save();
					return true;
		        } else {
					return false;
		        }
		    }
		    catch(\Exception $ex){
		    	return false;
		    }
	    }
	    return false;
    }



    public function download(Request $request, $filename)
	{
	   $filepath = storage_path('files/dam/uploads/IEX/ratesheet/'. $filename);
	   if (file_exists($filepath))
	   {
	       // Send Download
	       return response()->download($filepath, $filename, [
	           'Content-Length: '. filesize($filepath)
	       ]);
	   }
	   else
	   {
	        exit('File not found!');
	   }
	}
    /**
     * Download the ratesheet.
     *
     * @return \Illuminate\Http\Response
     */
  //   public function download(Request $request,$exchange, $fileName)
  //   {
  //       $year = date('Y',strtotime($fileName));

  //       $month = date('m_M',strtotime($fileName));

  //       $ratesheet = $fileName.'.csv';

  //       $filepath = 'files/dam/uploads/IEX/ratesheet/'.'rate'.$ratesheet;
  //      // dd($filepath);
		// if(File::exists(storage_path($filepath)))
		// {
			
		// 	return Storage::download($filepath);
		// }
		// else{
		// 	echo "failed";
		// }
  //   }
}
