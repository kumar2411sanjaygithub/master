<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Excel;
use File;
use GuzzleHttp\Psr7;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\NamedRange;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Obligation;
use App\OblComponents;
use App\FtpFiles;
use App\Auth;
use App\FtpDatePickUp;

class ObligationController extends Controller
{
    public function home(Request $request, $exchange='', $year='', $month_o='', $day=''){
    	 $d = strtotime(date('d-m-Y') . ' + 1 days');
        if($exchange==''){
            $exchange='IEX';
        }
        if($year==''){
            $year=date('Y',$d);
        }
        if($month_o==''){
            $month_o =  "".date('m',$d)."";
        }
        if($day==''){
            $day = "".date('d',$d)."";
        }

        $iex_portfolio =  $this->getAllPortfolioArray();

        $bidding_dt = date("Y-m-d",strtotime($year."-".$month_o."-".$day));
        $month = date("m_M",strtotime($year."-".$month_o."-".$day));
        $directory = storage_path("files/dam/import/".$exchange."/obl_sch_xls/".$year."/".$month."/".$day);
       
        $dt = date('Y-m-d', strtotime($bidding_dt));
        $dtBack = date('Y-m-d', strtotime($dt . ' - 1 days'));

       
        $obl_ftp = FtpFiles::all()->where('type','OBL')->where('date',$dt);
       // dd($obl_ftp);
       
        if(isset($request->status)){
            
            return view('dam.import.obligation',['obligations' => $obl_ftp, 'dilivery_date' => array($year,$month_o,$day),'status' => $request->status]);
        }

        return view('dam.import.obligation',['obligations' => $obl_ftp, 'dilivery_date' => array($year,$month_o,$day)]);

    
    }
    function getAllPortfolioArray()
    {
        $portfolio_id = Client::select('iex_portfolio')->groupBy('id')->get()->toArray();
        return $port = array_column($portfolio_id,'iex_portfolio');
    }

    public function downloadObligation(Request $request, $id){
        try{
            $obl_ftp_path = FtpFiles::findOrFail($id);
            return response()->download(
                $obl_ftp_path->filepath."/".$obl_ftp_path->filename,
                $obl_ftp_path->filename
            );
        }
        catch(Exception $ex)
        {
           return Redirect::back()->with('status', 'File not found!');
        }
    }

    function importObligation(Request $request, $id)
    {
       $obl_ftp_path = FtpFiles::findOrFail($id);

        $dt = date("Y-m-d",strtotime($obl_ftp_path->date));

        // print_r($obl_ftp_path->toArray());die();
        $path = $obl_ftp_path->filepath."/".$obl_ftp_path->filename;

        $mimetype = \GuzzleHttp\Psr7\mimetype_from_filename($path);

        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($path);

        /**  Create a new Reader of the type that has been identified  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($path);

        $array_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $message = $this->generateArrayObligationOld($array_data,$obl_ftp_path->date,$obl_ftp_path->portfolio_id);


        return redirect(url()->previous())->with('status', $message);
    }
     public function updateFtpDetails(Request $request, $exchange, $year, $month, $day)
    {
        $iex_portfolio =  $this->getAllPortfolioArray();
        $delivery_dt = date("Y-m-d",strtotime($year."-".$month."-".$day));
        $ftpTraderName = "TPT";
        $entry_by = 1;
        $dt = date('Y-m-d', strtotime($delivery_dt));
        // $dtBack = date('Y-m-d', strtotime($dt . ' - 1 days'));
        $dtBack = date('Y-m-d',  strtotime($dt . ' - 1 days'));
        $month = date("m_M",strtotime($dt));
        $day = date("d",strtotime($dtBack));
        $path = "files/dam/import/".$exchange."/obl_sch_xls/".$year."/".$month."/".$day;
        $directory = storage_path($path);
        $files = File::allFiles($directory);
        $directory = str_replace('//','/',$directory);
        $directory = str_replace('\\','/',$directory);


        // $tirFile = 'IEX' . date('dmy', strtotime($dtBack)) . 'TIR_TPT.pdf';
        // $marPdfFile = 'IEX' . date('dmy', strtotime($dtBack)) . 'MAR_W2MH0TPT0000.pdf';
        // $marCsvFile = 'IEX' . date('dmy', strtotime($dtBack)) . 'MAR_W2MH0TPT0000.csv';
        // $operationalLimitFile = 'Operational_Limit_W2MH0TPT0000(TPT)_' . date('Ymd', strtotime($dtBack)) . '.csv';
        // $fileNameArr = array($tirFile, $marCsvFile, $marPdfFile, $operationalLimitFile);
        $remain= array();
        // $this->print_data($fileNameArr);
        $user = array();
        // $f1 = $files->toArray();
        $fileNameArray = array();
        // foreach ($files as $file){
        //     $fileNameArray[] = $file->getFilename();
        // }
        // echo trim("IEX" . date("dmy", strtotime($dtBack)) . "DOR" . strchr('N2WB0TPT0024', "$ftpTraderName"));
        // dd($fileNameArray);

        $ftp_file = array();
        foreach($iex_portfolio as $j=>$portfolio_id) {
            $hint = 0;
            $enterFileName = "";
            $client_id = $this->client_id_by_portfolio($portfolio_id);
            if(count($client_id)>0)
            {
                $client_id = $client_id[0];
            }
            else{
                continue;
            }
            foreach($files as $file) {
                $path = $file->getRealPath();
                $file_name = File::basename($path);
                $file_name_str = File::name($path);
                $tempFilePath = $file_ext = strtolower(File::extension($path));
                if(strpos($file_name_str, 'DOR') && $file_ext=="xls"){
                    $file_name_ar = explode("/", $file_name);
                    $file_name_str1 = end($file_name_ar);
                    $tempFileName = explode("_", $file_name_str1);
                    if (trim("IEX" . date("dmy", strtotime($dtBack)) . "DOR" . strchr($portfolio_id, "$ftpTraderName")) == trim($tempFileName[0] . $tempFileName[1])) {
                        $user[$portfolio_id]["OBL"] =  $path;
                        $ftp_file[]=array("date"=>$dt, "client_id"=>$client_id, "portfolio_id"=>$portfolio_id, "filename"=>$file_name, "filepath"=>$directory, "type"=>"OBL", "status"=>"FOUND","entry_by"=>$entry_by);
                        continue;
                    } else if (($portfolio_id == "W2GJ0MPL0175" || $portfolio_id == "S1TG0TPT0405" || $portfolio_id == "W2GJ0MPL0176" ) && trim("IEX" . date("dmy", strtotime($dt)) . "DOR" . strchr($portfolio_id, "$ftpTraderName")) == trim($tempFileName[0] . $tempFileName[2])) {
                        $user[$portfolio_id]["OBL"] =  $path;
                        $ftp_file[]=array("date"=>$dt, "client_id"=>$client_id, "portfolio_id"=>$portfolio_id, "filename"=>$file_name, "filepath"=>$directory, "type"=>"OBL", "status"=>"FOUND","entry_by"=>$entry_by);
                        continue;
                    } else if (substr($portfolio_id, 5) == trim($tempFileName[2])) {
                        $user[$portfolio_id]["OBL"] =  $path;
                        $ftp_file[]=array("date"=>$dt, "client_id"=>$client_id, "portfolio_id"=>$portfolio_id, "filename"=>$file_name, "filepath"=>$directory, "type"=>"OBL", "status"=>"FOUND","entry_by"=>$entry_by);
                        continue;
                    }
                    continue;
                }
                elseif(strpos($file_name_str, 'SCH') && $file_ext=="xlsx"){
                    $file_name_ar = explode("/", $file_name);
                    $file_name_str1 = end($file_name_ar);
                    $tempFileName = explode("_", $file_name_str1);
                    if (trim("IEX" . date("ymd", strtotime($dt)) . "SCH" . strchr($portfolio_id, "$ftpTraderName")) == trim($tempFileName[0] . $tempFileName[1])) {
                        $user[$portfolio_id]["SCH"] =  $path;
                        $ftp_file[]=array("date"=>$dt, "client_id"=>$client_id, "portfolio_id"=>$portfolio_id, "filename"=>$file_name, "filepath"=>$directory, "type"=>"SCH", "status"=>"FOUND","entry_by"=>$entry_by);
                        continue;
                    }
                    continue;
                }
                elseif(strpos($file_name_str, 'DOR') && $file_ext=="pdf"){
                    $file_name_ar = explode("/", $file_name);
                    $file_name_str1 = end($file_name_ar);
                    $tempFileName = explode("_", $file_name_str1);
                    if (trim("IEX" . date("dmy", strtotime($dtBack)) . "DOR" . strchr($portfolio_id, "$ftpTraderName")) == trim($tempFileName[0] . $tempFileName[1])) {
                        $user[$portfolio_id]["PDF"] =  $path;
                        $ftp_file[]=array("date"=>$dt, "client_id"=>$client_id, "portfolio_id"=>$portfolio_id, "filename"=>$file_name, "filepath"=>$directory, "type"=>"PDF", "status"=>"FOUND","entry_by"=>$entry_by);
                        continue;
                    } else if (($portfolio_id == "W2GJ0MPL0175" || $portfolio_id == "W2GJ0MPL0176") && trim("IEX" . date("dmy", strtotime($dt)) . "DOR" . strchr($portfolio_id, "$ftpTraderName")) == trim($tempFileName[0] . $tempFileName[2])) {
                        $user[$portfolio_id]["PDF"] =  $path;
                        $ftp_file[]=array("date"=>$dt, "client_id"=>$client_id, "portfolio_id"=>$portfolio_id, "filename"=>$file_name, "filepath"=>$directory, "type"=>"PDF", "status"=>"FOUND","entry_by"=>$entry_by);
                        continue;
                    } else if (substr($portfolio_id, 5) == trim($tempFileName[2])) {
                        $user[$portfolio_id]["PDF"] =  $path;
                        $ftp_file[]=array('date'=>$dt, "client_id"=>$client_id, "portfolio_id"=>$portfolio_id, "filename"=>$file_name, "filepath"=>$directory, "type"=>"PDF", "status"=>"FOUND","entry_by"=>$entry_by);
                        continue;
                    }
                    continue;
                }
                if(!in_array($path,$remain)){
                    $remain[]=$path;
                }
            }
        }
        if(count($ftp_file)>0){
            // dd($ftp_file);
            FtpFiles::insert($ftp_file);
            die("Files Updated in Database.");
        }
        else{
             die("No file found.");
        }
    }


    function generateArrayObligationOld($sheetData,$dt,$portfolio_id,$entryBy = 1){

        $firstIndex = 13;
        for ($i = 0; $i <= 21; $i++) {
        if (isset($sheetData[$i]) && (trim($sheetData[$i]["D"]) == "Funds Payin(-) / Payout(+)")) {
                $firstIndex = $i;
                break;
            }
        }
        $secondIndex = 44;
        for ($i = 44; $i <= 94; $i++) {
            if (trim($sheetData[$i]["C"]) == "Period") {
                $secondIndex = $i + 1;
                break;
            }
        }
       // dd($sheetData[$firstIndex]);
        $fundPayIn = $sheetData[$firstIndex]["M"];
        $nldcAppFee =$sheetData[$firstIndex+2]["M"];
        $ctuTC =$sheetData[$firstIndex+3]["M"];
        $NldcSchOPeratingCharges =$sheetData[$firstIndex+4]["M"];
        $NldcSchOPeratingChargesSell=explode("*",$sheetData[$firstIndex+5]["M"]);
        $STUTransCharges = $sheetData[$firstIndex+6]["M"];
        $DistrinbutionCharges =$sheetData[$firstIndex+7]["M"];
        $anyOtherCharges = $sheetData[$firstIndex+8]["M"];
        $sldcSchedandOC = $sheetData[$firstIndex+9]["M"];
        $aldcSchedandOC =$sheetData[$firstIndex+10]["M"];
        $fees = $sheetData[$firstIndex+11]["M"];

        $igst = $sheetData[$firstIndex+12]["M"];
        $sgst = $sheetData[$firstIndex+13]["M"];
        $cgst = $sheetData[$firstIndex+14]["M"];
        $utgst = $sheetData[$firstIndex+15]["M"];
        $total = $sheetData[$firstIndex+16]["M"];

        $tempNoSuccessPortArr = explode("/",$sheetData[$firstIndex+21]["C"]);
        $tempNoSuccessPort = preg_replace('/\D/', '', $tempNoSuccessPortArr[1]);

        $ctu_chargesInj = preg_replace('/\D/', '',$sheetData[$firstIndex+22]["C"]);
        $ctu_chargesDrw = preg_replace('/\D/', '', $sheetData[$firstIndex+23]["C"]);
        $ctu_chargesInj = $ctu_chargesInj / 100;
        $ctu_chargesDrw = $ctu_chargesDrw / 100;
        $myNldcAppFeeStr = $sheetData[$firstIndex+24]["C"];
        $myNldcAppFeeStrArr = explode("NLDC Scheduling & Operating Charges", $myNldcAppFeeStr);
        preg_match_all('!\d+!', $myNldcAppFeeStr, $matches);
        $buyNLDCfee=($matches[0][0].".".$matches[0][1])/100;
        $sellNLDCfee=($matches[0][2].".".$matches[0][3])/100;

        $noofentity = preg_replace('/\D/', '', $myNldcAppFeeStrArr);
        $totalMw = $sheetData[$secondIndex+48]["P"];
        $totalAmount =$sheetData[$secondIndex+48]["W"];

        $countOne = 0;
        $totalMW = 0;
        $tempTotalMW = 0;
        $out_n = array(1=>array());

        for ($i = $secondIndex; $i <= ($secondIndex + 47); $i++) {
            $totalMW = $totalMW + $sheetData[$i]["E"] + $sheetData[$i]["P"];
            $tempTotalMW = $tempTotalMW + abs($sheetData[$i]["E"]) + abs($sheetData[$i]["P"]);
            $out_n[$countOne+1]['obligation_id'] = '';
            $out_n[$countOne+1]['block_no'] = $countOne+1;
            $out_n[$countOne+1]['qty_in_mw'] = $sheetData[$i]["E"];
            $out_n[$countOne+1]['rates_mwh'] = $sheetData[$i]["I"];
            $out_n[$countOne+1]['amount_in_rs'] = $sheetData[$i]["J"];
            $out_n[$countOne+1]['entry_by'] = $entryBy;
            $out_n[$countOne+49]['obligation_id'] = '';
            $out_n[$countOne+49]['block_no'] = $countOne+49;
            $out_n[$countOne+49]['qty_in_mw'] = $sheetData[$i]["P"];
            $out_n[$countOne+49]['rates_mwh'] = $sheetData[$i]["T"];
            $out_n[$countOne+49]['amount_in_rs'] = $sheetData[$i]["W"];
            $out_n[$countOne+49]['entry_by'] = $entryBy;
            $countOne++;
        }
        ksort($out_n);

        if ($totalMW < 0) {
            $tempTotalMW = $tempTotalMW * -1;
        } else {
            $tempTotalMW = $tempTotalMW;
        }

        \DB::beginTransaction();

        try{

            $obl = new Obligation();

            $obl->portfolio_id = $portfolio_id;

            $obl->date = date('Y-m-d',strtotime($dt));
            $obl->fundpayin = $fundPayIn;
            $obl->nldcappfee = $nldcAppFee;
            $obl->ctutranscharges = $ctuTC;
            $obl->nldcschoc = $NldcSchOPeratingCharges;
            $obl->stutranc = $STUTransCharges;
            $obl->distric = $DistrinbutionCharges;
            $obl->anyotherc = $anyOtherCharges;
            $obl->sldcsoc = $sldcSchedandOC;
            $obl->aldcsoc = $aldcSchedandOC;

            $obl->fees = $fees;
            $obl->total = $total;
            $obl->totalmw = $totalMw;
            $obl->new_mwh = ($tempTotalMW / 4);
            $obl->totalamount = $totalAmount;
            $obl->entry_by = $entryBy;
            $obl->ctu_charges_inj = $ctu_chargesInj;
            $obl->ctu_charges_drw = $ctu_chargesDrw;

            $obl->nosp = $tempNoSuccessPort;
            $obl->noofentity = $myNldcAppFeeStr;
            $obl->nldcsellcharges = $NldcSchOPeratingChargesSell[0];
            $obl->nldcappfees = $buyNLDCfee;
            $obl->nldcappfeessell = $sellNLDCfee;
            $obl->igst = $igst;
            $obl->sgst = $sgst;
            $obl->cgst = $cgst;
            $obl->utgst = $utgst;


            $obl->save();

            // dd($sheetData);

            foreach ($out_n as $key => $value) {

                $out_n[$key]['obligation_id'] = $obl->id;
            }
            OblComponents::insert($out_n);
            \DB::commit();

            return "Congratulations! Obligations imported successfully!";
        }
        catch(\Exception $ex){
            \DB::rollBack();
            return "Opps! Obligation import failed. Kindly try after sometime.";
        }
    }
    function print_data($data,$style="")
    {
        echo "<pre style='$style'>";
        print_r($data);
        echo "</pre>";
    }
    function client_id_by_portfolio($portfolio_id)
    {
       return $client_id = Client::where('iex_portfolio',$portfolio_id)->pluck('id')->toArray();

    }
}
