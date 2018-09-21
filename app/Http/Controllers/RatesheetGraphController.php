<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use DB;
use App\MoneyClearence;
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
use Excel;

class RatesheetGraphController extends Controller
{

    public function graphindex(Request $request, $exchange = '', $year = '', $month_o = '', $day = '')
    {
        if ($exchange == '')
        {
            $exchange = 'IEX';
        }
        if ($year == '')
        {
            $year = date('Y');
        }
        if ($month_o == '')
        {
            $month_o = "" . date('m') . "";
        }
        if ($day == '')
        {
            $day = "" . date('d') . "";
        }
        $bidding_dt = date("Y-m-d", strtotime($year . "-" . $month_o . "-" . $day));
        $month = date("m_M", strtotime($year . "-" . $month_o . "-" . $day));
        $dt = date('Y-m-d', strtotime($bidding_dt));
        $dtBack = date('Y-m-d', strtotime($dt . ' - 1 days'));
        $bid_client = $clientmaster = Client::all();
        if (\Auth::guard('web')->check())
        {
            $bid_client = Client::has('place_bid')->with(['place_bid' => function ($query) use ($dt)
            {
                $query->where('bid_date', $dt); //you may use any condition here or manual select operation
                $query->select(); //select operation
                
            }
            ])
                ->get();
            // dd($bid_client[1]->place_bid()->where('bid_date',$dt)->get()->toArray());
            
        }
        else if (\Auth::guard('client')
            ->check())
        {
            $bid_client = Client::has('place_bid')->with(['place_bid' => function ($query) use ($dt)
            {
                $query->where('bid_date', $dt); //you may use any condition here or manual select operation
                $query->select(); //select operation
                
            }
            ])
                ->where('id', \Auth::guard('client')
                ->id())
                ->get();

        }
        if (isset($request->status))
        {
            return view('dam.import.ratesheetgraph', ['bidclient' => $bid_client, 'clientmaster' => $clientmaster, 'dilivery_date' => array(
                $year,
                $month_o,
                $day
            ) , 'status' => $request->status, 'dt' => $dt]);
        }
        return view('dam.import.ratesheetgraph', ['bidclient' => $bid_client, 'dilivery_date' => array(
            $year,
            $month_o,
            $day
        ) , 'dt' => $dt]);

    }

    public function downloadgraph(Request $request, $id, $exchange, $row_id)
    {
        ob_start();
        $client_id = $id;
        $rate_path = \App\PlaceBid::find($row_id);
        $dt = date("Y-m-d", strtotime($rate_path->bid_date));
        if ($dt == "")
        {
            exit();
        }
        $y = date("Y", strtotime($dt));
        $d = date("d", strtotime($dt));
        $m = date("m_M", strtotime($dt));

        $fileName = $output_path = storage_path('files/dam/generate/IEX/ratesheetgraph/') . $y . "/" . $m . "/" . $d . "/";

        if (!file_exists($fileName))
        {
            \File::makeDirectory($fileName, 0777, true);
        }
        $directory = storage_path("ratefile/01/" . $exchange . "/rate_sheet/" . $dt);
        $mainArrClient = Client::select('id', 'company_name', 'iex_region', 'pxil_region')->where('id', $client_id)->get()
            ->toArray();

        if (count($mainArrClient) > 0)
        {
            for ($i = 0;isset($mainArrClient[$i]);$i++)
            {

                $iexRegion = $mainArrClient[$i]['iex_region'];
                $pxilRegion = $mainArrClient[$i]['pxil_region'];
                $iexArray = array();
                $pxilArray = array();
                $iexTempArray = array();
                $pxilTempArray = array();
                if ($iexRegion <> "")
                {
                    $str = DB::table('money_clearence as emcd')->leftjoin('money_relation_detail as emrd', 'emrd.money_id', '=', 'emcd.id')
                        ->select('emrd.money_id', 'emrd.fromtime', 'emrd.totime', 'emrd.price', 'emcd.date', 'emcd.region', 'emcd.type', 'emcd.id')
                        ->where('emcd.date', $dt)->where('emcd.region', $iexRegion)->where('emcd.type', 'IEX')
                        ->orderBy('emrd.fromtime', 'DESC')
                        ->orderBy('emrd.totime', 'DESC')
                        ->get()
                        ->toArray();
                    if (count($str) > 0)
                    {

                        $count = 0;
                        $total = 0;
                        for ($j = 0;$j < count($str);$j++)
                        {

                            $total = $str[$j]->price;
                            $iexTempArray[] = $str[$j]->price;
                            $count++;

                            $iexArray[$j]['price'] = round($total, 2);
                            $iexArray[$j]['from'] = $str[$j]->fromtime;
                            $iexArray[$j]['totime'] = $str[$j]->totime;
                            $count = 0;
                            $total = 0;

                        }

                    }

                }
                if ($pxilRegion <> "")
                {

                    $str = DB::table('money_clearence as emcd')->leftjoin('money_relation_detail as emrd', 'emcd.id', '=', 'emrd.money_id')
                        ->select('emrd.money_id', 'emcd.date', 'emcd.region', 'emcd.type', 'emrd.fromtime', 'emrd.totime', 'emrd.price', 'emcd.id')
                        ->where('emcd.date', $dt)->where('emcd.region', $iexRegion)->where('emcd.type', 'PXIL')
                        ->orderBy('emrd.fromtime', 'DESC')
                        ->orderBy('emrd.totime', 'DESC')
                        ->get()
                        ->toArray();
                    if (count($str) > 0)
                    {
                        $count = 0;
                        $total = 0;
                        for ($j = 0;$j < count($str);$j++)
                        {
                            $total = $total + $str[$j]->price;
                            $pxilTempArray[] = $str[$j]->price;
                            $count++;
                            if ($count == 4)
                            {
                                $pxilArray[] = ashishnumberround(($total / 4));
                                $count = 0;
                                $total = 0;
                            }
                        }
                    }
                }

                $objPHPExcel = new \PHPExcel();
                // $filename = 'just_some_random_name.xlsx';
                $objWorksheet = $objPHPExcel->getActiveSheet();
                $BoldAndBorderTable = array(
                    'borders' => array(
                        'outline' => array(
                            'style' => \PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                                'argb' => 'black'
                            ) ,
                        ) ,
                    ) ,
                    'font' => array(
                        'size' => 11,
                    )
                );
                $excelTitle = '';
                $dateName = date("d.m.Y", strtotime($dt));
                if (count($iexArray) > 0 && count($pxilArray) > 0)
                {
                    $excelTitle = "IEX/PXIL LINE CHART FOR (DD $dateName)";
                    $tempArr = array();
                    $tempArr[] = array(
                        '',
                        "IEX-" . $iexRegion,
                        "PXIL-" . $pxilRegion
                    );
                    for ($j = 0;isset($iexArray[$j]);$j++)
                    {
                        $objPHPExcel->getActiveSheet()
                            ->getStyle("A" . ($j + 1) . ":C" . ($j + 1))->applyFromArray($BoldAndBorderTable);
                        $tempArr[] = array(
                            $j + 1,
                            $iexArray[$j],
                            $pxilArray[$j]
                        );
                    }
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("B1:B25")
                        ->applyFromArray($BoldAndBorderTable);
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("C1:C25")
                        ->applyFromArray($BoldAndBorderTable);

                    $objWorksheet->fromArray($tempArr);
                    $dataseriesLabels = array(
                        new \PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', null, 1) , //    IEX
                        new \PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', null, 1) , //    PXIL
                        
                    );
                    $xAxisTickValues = array(
                        new \PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$25', null, 24) , // Q1 to Q4
                        
                    );
                    $dataSeriesValues = array(
                        new \PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$2:$B$25', null, 24) ,
                        new \PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$2:$C$25', null, 24) ,
                    );

                    // extra values like avg , min ,max
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("H1", 'Type');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("I1", 'Min(Rs/Kwh)');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("J1", 'Max(Rs/Kwh)');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K1", 'Avg(Rs/Kwh)');

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("H2", 'IEX');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("I2", ashishnumberround(min($iexArray)));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("J2", ashishnumberround(max($iexArray)));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K2", ashishnumberround(array_sum($iexTempArray) / count($iexTempArray)));

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("H3", 'PXIL');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("I3", ashishnumberround(min($pxilArray)));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("J3", ashishnumberround(max($pxilArray)));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K3", ashishnumberround(array_sum($pxilTempArray) / count($pxilTempArray)));
                    //border
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("H1:K3")
                        ->applyFromArray($BoldAndBorderTable);
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("H1:h3")
                        ->applyFromArray($BoldAndBorderTable);
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("I1:I3")
                        ->applyFromArray($BoldAndBorderTable);
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("J1:J3")
                        ->applyFromArray($BoldAndBorderTable);
                }
                else if (count($iexArray) > 0)
                {
                    $excelTitle = "IEX LINE CHART FOR (DD $dateName)";
                    $tempArr = array();
                    $tempArr[] = array(
                        'Block',
                        "From",
                        "To",
                        "" . $iexRegion . "-(Rs/Kwh)"
                    );
                    for ($j = 0;isset($iexArray[$j]);$j++)
                    {
                        $tempArr[] = array(
                            $j + 1,
                            $iexArray[$j]['from'],
                            $iexArray[$j]['totime'],
                            $iexArray[$j]['price']
                        );
                        $objPHPExcel->getActiveSheet()
                            ->getStyle("A" . ($j + 1) . ":B" . ($j + 1))->applyFromArray($BoldAndBorderTable);
                    }
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:D97')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    //            $objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
                    //            $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:D97')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objWorksheet->fromArray($tempArr);

                    $dataseriesLabels = array(
                        new \PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', null, 1) , //    IEX
                        
                    );
                    $xAxisTickValues = array(
                        new \PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$97', null, 24) , // Q1 to Q4
                        
                    );
                    $dataSeriesValues = array(
                        new \PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$97', null, 24) ,
                    );
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K28", 'Time Slots');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("H1", 'Type');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("I1", 'Min(Rs/Kwh)');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("J1", 'Max(Rs/Kwh)');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K1", 'Avg(Rs/Kwh)');

                    $min = $this->getMin($iexRegion, $dt) / 1000;
                    $max = $this->getMax($iexRegion, $dt) / 1000;
                    $AVG = $this->getAvg($iexRegion, $dt) / 1000;
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("H2", 'IEX');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("I2", round($min, 2));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("J2", round($max, 2));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K2", round($AVG, 2));
                    //border
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("H1:K2")
                        ->applyFromArray($BoldAndBorderTable);
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("H1:h2")
                        ->applyFromArray($BoldAndBorderTable);
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("I1:I2")
                        ->applyFromArray($BoldAndBorderTable);
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("J1:J2")
                        ->applyFromArray($BoldAndBorderTable);
                }
                else if (count($pxilArray) > 0)
                {
                    $excelTitle = "PXIL LINE CHART FOR (DD $dateName)";
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("C1:C25")
                        ->applyFromArray($BoldAndBorderTable);
                    $tempArr = array();
                    $tempArr[] = array(
                        '',
                        "PXIL-" . $pxilRegion
                    );
                    for ($j = 0;isset($pxilArray[$j]);$j++)
                    {
                        $tempArr[] = array(
                            $j + 1,
                            $pxilArray[$j]
                        );
                        $objPHPExcel->getActiveSheet()
                            ->getStyle("A" . ($j + 1) . ":B" . ($j + 1))->applyFromArray($BoldAndBorderTable);
                    }
                    $objWorksheet->fromArray($tempArr);
                    $dataseriesLabels = array(
                        new \PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', null, 1) , //    IEX
                        
                    );
                    $xAxisTickValues = array(
                        new \PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$97', null, 24) , // Q1 to Q4
                        
                    );
                    $dataSeriesValues = array(
                        new \PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$97', null, 24) ,
                    );
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("H1", 'Type');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("I1", 'Min(Rs/Kwh)');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("J1", 'Max(Rs/Kwh)');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K1", 'Avg(Rs/Kwh)');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("H2", 'PXIL(Rs/Kwh)');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("I2", ashishnumberround(min($pxilArray)));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("J2", ashishnumberround(max($pxilArray)));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K2", ashishnumberround(array_sum($pxilTempArray) / count($pxilTempArray)));
                    //border
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("H1:K2")
                        ->applyFromArray($BoldAndBorderTable);
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("H1:h2")
                        ->applyFromArray($BoldAndBorderTable);
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("I1:I2")
                        ->applyFromArray($BoldAndBorderTable);
                    $objPHPExcel->getActiveSheet()
                        ->getStyle("J1:J2")
                        ->applyFromArray($BoldAndBorderTable);
                }
                else
                {
                    echo '{"status":"ERR","value":"-1","message":"No Data Found."}';
                    exit();
                }
                $series = new \PHPExcel_Chart_DataSeries(PHPExcel_Chart_DataSeries::TYPE_LINECHART, // plotType
                PHPExcel_Chart_DataSeries::GROUPING_STANDARD, // plotGrouping
                range(0, count($dataSeriesValues) - 1) , // plotOrder
                $dataseriesLabels, // plotLabel
                $xAxisTickValues, // plotCategory
                $dataSeriesValues
                // plotValues
                );

                //  Set the series in the plot area
                $plotarea = new \PHPExcel_Chart_PlotArea(null, array(
                    $series
                ));
                $legend = new \PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_TOPRIGHT, null, false);
                $title = new \PHPExcel_Chart_Title($excelTitle);
                $yAxisLabel = new \PHPExcel_Chart_Title('');
                $chart = new \PHPExcel_Chart('chart1', // name
                $title, // title
                $legend, // legend
                $plotarea, // plotArea
                true, // plotVisibleOnly
                0, // displayBlanksAs
                null, // xAxisLabel
                $yAxisLabel
                // yAxisLabel
                );
                $chart->setTopLeftPosition('E7');
                $chart->setBottomRightPosition('R26');
                $objWorksheet->addChart($chart);
                // $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                // $objWriter->setIncludeCharts(TRUE);
                $saveFileName = $mainArrClient[$i]['company_name'] . ".xlsx";
                // $fileNameTemp = $fileName . "/" . $saveFileName;
                // // $objWriter->save(storage_path()."/".$saveFileName);
                //   // $abc=$objWriter->save('results.xlxs');
                // $objWriter->save('php://output');
                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->setIncludeCharts(true);
                $output = $output_path . "/" . $saveFileName;
                $objWriter->save($output);
                \App\Ratesheetgraph::where('client_id', $mainArrClient[$i]['id'])->where('date', $dt)->delete();
                $data = array(
                    'client_id' => $mainArrClient[$i]['id'],
                    'date' => date('Y-m-d', strtotime($dt)) ,
                    'filename' => $saveFileName,
                    'entry_by' => \Auth::guard('web')->id()
                );
                \App\Ratesheetgraph::insert($data);
                ob_end_clean();
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.xlsx');
                header('Content-Disposition: attachment;filename="' . $saveFileName . '"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                exit;
            }
            echo '{"status":"SUCCESS","value":"' . substr($fileNameTemp, 3) . '","message":" successfull !"}';

        }
        else
        {

            return redirect()->back()->with('message', 'No Data Found!');
        }
    }

    function ashishnumberround($number)
    {
        return number_format(round($number, 2) , 2);
    }

    public function getMin($region, $date)
    {
        $resultmin = MoneyClearence::select('*')->where('date', $date)->where('region', $region)->get();
        if (count($resultmin) > 0)
        {
            return $resultmin[0]->min;
        }
        else
        {
            return false;
        }
    }

    public function getMax($region, $date)
    {
        $resultmax = MoneyClearence::select('*')->where('date', $date)->where('region', $region)->get();
        if (count($resultmax) > 0)
        {

            return $resultmax[0]->max;
        }
        else
        {
            return false;
        }
    }

    public function getAvg($region, $date)
    {
        $resultavg = MoneyClearence::select('*')->where('date', $date)->where('region', $region)->get();
        if (count($resultavg) > 0)
        {
            return $resultavg[0]->avg;
        }
        else
        {
            return false;
        }
    }

}

