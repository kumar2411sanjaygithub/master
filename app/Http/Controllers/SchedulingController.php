<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;   
use App\Http\Controllers\Controller;
use Excel;
use File;
use Storage;
use GuzzleHttp\Psr7;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\NamedRange;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
// use PhpOffice\PhpSpreadsheet\Reader\IReader;
// use PhpOffice\PhpSpreadsheet\IOFactory;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\NamedRange;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Obligations;
use App\OblComponents;
use App\FtpFiles;
use App\FtpDatePickUp;
use App\Scheduling;
use Illuminate\Support\Facades\Redirect;
use App\ScheduleLosses;
use App\Client;

class SchedulingController extends Controller
{

    //
    public function index(Request $request, $exchange='', $year='', $month_o='', $day='')
    {
        if($exchange==''){
            $exchange='IEX';
        }
        if($year==''){
            $year=date('Y');
        }
        if($month_o==''){
            $month_o =  "".date('m')."";
        }
        if($day==''){
            $day = "".date('d')."";
        }



        $iex_portfolio =  $this->getAllPortfolioArray();
        $bidding_dt = date("Y-m-d",strtotime($year."-".$month_o."-".$day));
        $month = date("m_M",strtotime($year."-".$month_o."-".$day));
        $directory = storage_path("files/dam/import/".$exchange."/obl_sch_xls/".$year."/".$month."/".$day);
        
        $dt = date('Y-m-d', strtotime($bidding_dt));
        $dtBack = date('Y-m-d', strtotime($dt . ' - 1 days'));       
        $sedul_ftp = FtpFiles::all()->where('type','SCH')->where('date',$dt);
        if(isset($request->status)){
            return view('dam.import.schedule',['schedule' => $sedul_ftp, 'dilivery_date' => array($year,$month_o,$day),'status' => $request->status]);
        }  
        return view('dam.import.schedule',['schedule' => $sedul_ftp, 'dilivery_date' => array($year,$month_o,$day)]);
    }

    public function downloadScheduling(Request $request, $id){

        try{
            $sedul_ftp_path = FtpFiles::findOrFail($id);
            return response()->download(
                $sedul_ftp_path->filepath."/".$sedul_ftp_path->filename,
                $sedul_ftp_path->filename
            );
        }
        catch(Exception $ex)
        {
            die("File not found");
        }
    }

    public function downloadAmbScheduling(Request $request, $id){
    	//dd(1);
        try{
            $sedul_ftp_path = FtpFiles::findOrFail($id);
            
            $path_fol = explode('files/dam/import/iex/obl_sch_xls/', $sedul_ftp_path->filepath);
            // dd($path_fol); 
            $path = storage_path('app/public/generate/IEX/scheduling/'.$path_fol.'/');
           
            $file_name = explode(".",$sedul_ftp_path->filename);

            $path = $path.$file_name[0]."_d.".$file_name[1];
            // dd($path);
            return response()->download(
                $path,
                $file_name[0]."_d.".$file_name[1]
            );
        }
        catch(\Exception $ex)
        {
            //die("File not found");

              return Redirect::back()->with('status', 'File not found!');
        }
    }
    
    function importScheduling(Request $request,$id){
       
        $sedul_ftp_path = FtpFiles::findOrFail($id);
        //dd($sedul_ftp_path);
        $dt = date("Y-m-d",strtotime($sedul_ftp_path->date));
        // print_r($obl_ftp_path->toArray());die();
        $path = $sedul_ftp_path->filepath."/".$sedul_ftp_path->filename;
       
        $mimetype = \GuzzleHttp\Psr7\mimetype_from_filename($path);
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($path);
        /**  Create a new Reader of the type that has been identified  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($path);
        $array_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        //dd($spreadsheet);
        $message = $this->generateArraySchedule($array_data,$sedul_ftp_path->date,$sedul_ftp_path->portfolio_id,$sedul_ftp_path->filename);
        //dd($message);
        return redirect()->back()->with('status', $message); 
    }

    function generateArraySchedule($sheetData,$dt,$portfolio_id,$fileName='text.xlsx',$entryBy = 1){

            // make a duplicate excel of schedule scheduling
            $dtBack = date('Y-m-d', strtotime($dt . ' - 1 days'));
            $year = date('Y',strtotime($dtBack));
            $month = date('m_M',strtotime($dtBack));
            $day = date('d',strtotime($dtBack));
            // dd(storage_path('generate/scheduling/iex/$year/$month/$date/').$fileName);
            // \Storage::disk('local')->put($fileName, $objWriter);
            $file_name = explode('.',$fileName);
            $path = storage_path('files/dam/generate/IEX/scheduling/'.$year.'/'.$month.'/'.$day.'/');
            File::isDirectory($path) or \File::makeDirectory($path,'0777', true);
            $csvFileName = $path.str_replace(".xlsx", "_d.xlsx", $fileName);
           
            $objPHPExcel = new \PHPExcel();
            $objPHPExcel->getProperties()->setCreator("shalu gupta")
                    ->setLastModifiedBy("shalu gupta")
                    ->setTitle("Sheet1");
            $objPHPExcel->getDefaultStyle()->getFont()
                    ->setSize(11);
            $objPHPExcel->getActiveSheet()->getStyle('A7:A106')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('B7:B106')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('C7:C106')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D7:D106')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E7:E106')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('F7:F106')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            if (\File::exists($csvFileName)) {
           
                File::delete($csvFileName);// file permission issue
                 //Storage::delete($csvFileName);
                 //\File::delete(public_path($csvFileName));
                 //unlink($csvFileName);
            }
         
            if (!file_exists($csvFileName)) {

                $Border = array(
                    'borders' => array(
                        'outline' => array(
                            'style' => \PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => 'black'),
                        ),
                    ),
                );
                $SizeAndBold = array(
                    'font' => array(
                        'bold' => true,
                        'size' => 11,
                    )
                );

                $BoldAndBorder = array(
                    'borders' => array(
                        'outline' => array(
                            'style' => \PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => 'black'),
                        ),
                    ),
                    'font' => array(
                        'bold' => true,
                        'size' => 11,
                    )
                );


                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A1", 'Issue Date:')
                        ->setCellValue("B1", $sheetData[1]["B"])
                        ->setCellValue("A2", 'Issue Time:')
                        ->setCellValue("B2", $sheetData[2]["B"])
                        ->setCellValue("A3", 'Scheduling Request for')
                        ->setCellValue("B3", $sheetData[3]["B"])
                        ->setCellValue("A4", 'Participant Name')
                        ->setCellValue("B4", $sheetData[4]["B"])
                        ->setCellValue("A5", '*All figures are in MW')
                        ->setCellValue("A6", 'Traded quantity')
                        ->setCellValue("B6", $sheetData[6]["B"])
                        ->setCellValue("A8", 'Portfolio')
                        ->setCellValue("B8", $sheetData[8]["B"]);
                       


                $objPHPExcel->setActiveSheetIndex()->getStyle("A3")->getAlignment()->setWrapText(true);
                $objPHPExcel->setActiveSheetIndex()->getStyle("A4")->getAlignment()->setWrapText(true);

                $CheckInjRegPeri = false;
                for ($i = 10; $i <= 105; $i++) {
                    $count = $i - 1;
                    if ($sheetData[$i]["B"] == "0.00") {
                     
                    } else {
                        $CheckInjRegPeri = true;
                       
                    }
                }

                $CheckDrawalRegPeri = false;
                for ($i = 10; $i <= 105; $i++) {
                    $count = $i - 1;
                    if ($sheetData[$i]["C"] == "0.00") {
                     
                    } else {
                        $CheckDrawalRegPeri = true;
                        
                    }
                }

                if ($CheckInjRegPeri == true && $CheckDrawalRegPeri == false) {

                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A9", "Time Period");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B9", "Injection at Regional periphery");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C9", "Injection at Interface point");
                } else if ($CheckInjRegPeri == false && $CheckDrawalRegPeri == true) {
                 
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A9", "Time Period");

                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B9", "Drawal at Regional periphery");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C9", "Drawal at Interface point");
                } else if ($CheckInjRegPeri == true && $CheckDrawalRegPeri == true) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A9", "Time Period");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B9", "Injection at Regional periphery");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C9", "Injection at Interface point");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D9", "Time Period");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E9", "Drawal at Regional periphery");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F9", "Drawal at Interface point");
                }
                $totalRecSchVolumedBuy = 0;
                $totalRecSchVolumedSell = 0;
                for ($i = 10; $i <= 105; $i++) {
                    $count = $i ;
                    if ($CheckInjRegPeri == true && $CheckDrawalRegPeri == false) {
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A$count", $sheetData[$i]["A"]);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B$count", $sheetData[$i]["B"]);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C$count", $sheetData[$i]["F"]);
                        $totalRecSchVolumedSell+=abs($sheetData[$i]["F"]);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("A$count")->applyFromArray($Border);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("B$count")->applyFromArray($Border);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("C$count")->applyFromArray($Border);
                    } else if ($CheckInjRegPeri == false && $CheckDrawalRegPeri == true) {
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A$count", $sheetData[$i]["E"]);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B$count", $sheetData[$i]["C"]);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C$count", $sheetData[$i]["G"]);
                        $totalRecSchVolumedBuy+=abs($sheetData[$i]["G"]);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("A$count")->applyFromArray($Border);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("B$count")->applyFromArray($Border);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("C$count")->applyFromArray($Border);
                    } else if ($CheckInjRegPeri == true && $CheckDrawalRegPeri == true) {
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A$count", $sheetData[$i]["A"]);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B$count", $sheetData[$i]["B"]);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C$count", $sheetData[$i]["F"]);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D$count", $sheetData[$i]["E"]);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E$count", $sheetData[$i]["C"]);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F$count", $sheetData[$i]["G"]);
                        $totalRecSchVolumedBuy+=abs($sheetData[$i]["G"]);
                        $totalRecSchVolumedSell+=abs($sheetData[$i]["F"]);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("A$count")->applyFromArray($Border);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("B$count")->applyFromArray($Border);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("C$count")->applyFromArray($Border);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("D$count")->applyFromArray($Border);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("E$count")->applyFromArray($Border);
                        $objPHPExcel->setActiveSheetIndex()->getStyle("F$count")->applyFromArray($Border);
                    }
                }
 
                if ($CheckInjRegPeri == true && $CheckDrawalRegPeri == false) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A106", "Total(In MWh)");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A107", $sheetData[108]["A"]);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C107", $sheetData[108]["E"]);

                    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(32);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);
                    $objPHPExcel->getActiveSheet()->getStyle("A8")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->mergeCells("B8:C8");

                    $objPHPExcel->getActiveSheet()->getStyle("B8:C8")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("A9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("B9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("C9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("A106")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("A107")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("C107")->applyFromArray($BoldAndBorder);
                } else if ($CheckInjRegPeri == false && $CheckDrawalRegPeri == true) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A106", "Total(In MWh)");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B106", $sheetData[106]["C"]);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C106", $sheetData[106]["G"]);

                    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(32);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);
                    $objPHPExcel->getActiveSheet()->getStyle("A9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("B9:C9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->mergeCells("B9:C9");
                    $objPHPExcel->getActiveSheet()->getStyle("A9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("B9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("C9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("A106")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("B106")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("C106")->applyFromArray($BoldAndBorder);
                } else if ($CheckInjRegPeri == true && $CheckDrawalRegPeri == true) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A106", "Total(In MWh)");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B106", $sheetData[106]["B"]);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C106", $sheetData[106]["F"]);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D106", "Total(In MWh)");
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E106", $sheetData[106]["C"]);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F106", $sheetData[106]["G"]);

                    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(32);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(32);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(32);
                    $objPHPExcel->getActiveSheet()->getStyle("A9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("B9:F9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->mergeCells("B9:F9");
                    $objPHPExcel->getActiveSheet()->getStyle("A9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("B9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("C9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("D9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("E9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("F9")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("A106")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("B106")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("C106")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("D106")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("E106")->applyFromArray($BoldAndBorder);
                    $objPHPExcel->getActiveSheet()->getStyle("F106")->applyFromArray($BoldAndBorder);
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A107", $sheetData[107]["A"]);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C107", $sheetData[107]["E"]);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A108", $sheetData[108]["A"]);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B108", $sheetData[108]["B"]);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A109", $sheetData[109]["A"]);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B109", $sheetData[109]["B"]);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A110", $sheetData[110]["A"]);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B110", $sheetData[110]["B"]);
                $regionalLossesArr = explode("%", $sheetData[108]["B"]);
                $stateLossesArrr = explode("%", $sheetData[109]["B"]);
                $areaLossesArrr = explode("%", $sheetData[110]["B"]);
                $ttlsch = $sheetData[106]["F"];

                $clientId = $this->getclientidfromportfolioid($portfolio_id);
              

               
                $deleteRecSechVoulme = Scheduling::where('client_id',$clientId)->where('type','IEX')->where('date',$dt)->delete();
                 $data = array(
                    array('client_id'=> $clientId,'date'=>$dt,'type'=>'IEX','buy_qty'=>$totalRecSchVolumedBuy,'sell_qty'=>$totalRecSchVolumedSell,'ttlamnt'=>$ttlsch,'entry_by'=>'-1')
                    );
                $resScheduleInsert = Scheduling::insert($data);

                $deleteStr =  ScheduleLosses::where('portfolio_id', $portfolio_id)->where('date',$dt);
                $datas = array(
                    array('portfolioid'=>$portfolio_id,'date'=>$dt,'regional_seller_loss'=>$regionalLossesArr[0],'regional_buyer_loss'=>$regionalLossesArr[0],'state_seller_loss'=>$stateLossesArrr[0],'state_buyer_loss'=>$stateLossesArrr[0],'area_losses_buyer'=>$areaLossesArrr[0],'area_losses_seller'=>$areaLossesArrr[1])
                    );

                $insertStr = ScheduleLosses::insert($datas);
               
                // $g->deleteQuery($deleteStr);
                // $g->insertQuery($insertStr);
                $objPHPExcel->getActiveSheet()->setTitle("Sheet1");
                $objPHPExcel->setActiveSheetIndex(0);
                $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save($path.$file_name[0].'_d.'.$file_name[1]);
       // $objWriter->download('xlsx');

                 
                    // // $excel->setTitle('Ambendent Excel File');
                    // $excel->setCreator('PETS')->setCompany('Cybuzz');
                    // $excel->setDescription('Scheduling File');
                    // $excel->addExternalSheet($objPHPExcel);
                //})->download('xlsx');
            // }
    
       
     }

   } 
   
    function getAllPortfolioArray()
    {
        $portfolio_id = Client::select('iex_portfolio')->groupBy('id')->get()->toArray();
        return $port = array_column($portfolio_id,'iex_portfolio');
    }
        
    
    function getclientidfromportfolioid($portfolio_id){
       
        $client_id = Client::where('iex_portfolio',$portfolio_id)->pluck('id')->toArray();
        //dd($client_id);
        return $string = implode(' ', $client_id);
        // return $client_id = Client::where('iex_portfolio',$portfolio_id)->pluck('id')->toArray();

       
    }
}
    // shalu ends here//
   


  