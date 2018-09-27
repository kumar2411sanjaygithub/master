<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\NocApp;
use App\NocBilling;
use App\StateDiscom;
use App\Client;
use Response;
use PDF;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Mail;
use Session;
use Validator;
use Illuminate\Support\Facades\Input;
use File;

class NocAppController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientData = Client::all();
        $approved_noc=NocApp::orderBy('id','desc')->where('status',2)->paginate(10);
        return view('noc.noc_search',compact('clientData','approved_noc'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
    public function nocstore(Request $request)
    {
        $client_id=request('client_id');

        $validator = Validator::make(Input::all(), [
            'sldc' => 'required',
            'noc_type' => 'required',
            'exchange_type' => 'required',
            'quantum' => 'required|integer',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
        ]);

        if ( $validator->fails()) 
        {
        return Redirect::to('getclientData/'. $client_id )->withErrors($validator)->withInput();
        }

        $url=$request->input('client_name');
                // Convert Date Format
        $commerce_date = strtr($request->input('start_date'), '/', '-');
        $new_start_date = date("Y-m-d", strtotime($commerce_date));

        // Convert Date Format
        $commerce_end_date = strtr($request->input('end_date'), '/', '-');
        $new_end_date = date("Y-m-d", strtotime($commerce_end_date));

        // $noc_application=DB::table('tbl_leave_assign')
        //     ->where('client_id', '=', request('client_id'))
        //     ->where('start_date', '<=',$new_start_date,'and')
        //     ->Where('end_date', '>=',$new_end_date)
        //     ->Where('end_date', '>=',$new_end_date)
        //     ->Where('status', '!=',5)
        //     ->get();
        //     //print_r($leave_data);die;
        // if(count($noc_application)>0)
        // {
        // return redirect()->route('getclientData', ['s' => $url])->with('error','Noc already added between this date'.);
        // }


        if(isset(request()->noc_file))
        {
            $imageName = time().'.'.request()->noc_file->getClientOriginalName();
            $noc_path = storage_path().'/FILES/TPTCL/NOC';
            File::isDirectory($noc_path) or File::makeDirectory($noc_path, 0777, true, true);
            request()->noc_file->move($noc_path, $imageName);
        }
        else
        {
            $imageName = "";
        }
        $last = NocApp::orderBy('id', 'desc')->get();        
        if ($last) {
            $application_no=count($last)+1;
        }else{
            $application_no = 1;
        }
        $date=date('y')+1;
        $app_num="FY".date("y").'/'.strtoupper(date('M')).'/CI_'.str_pad($application_no, 4, '0', STR_PAD_LEFT)."";

        $noc = new NocApp;
        $noc->application_no = $app_num;
        $noc->client_id = request('client_id');
        $noc->sldc =request('sldc');
        $noc->noc_type = request('noc_type');
        $noc->exchange_type =request('exchange_type');
        $noc->quantum = request('quantum');
        $noc->noc_file =$imageName;                
        $noc->start_date = $new_start_date;
        $noc->end_date =$new_end_date;  
        $noc->start_time =request('start_time');
        $noc->end_time = request('end_time');
        $noc->status =1;                               
        $noc->save();  


        return redirect()->route('getclientData', ['id' => $client_id])->with('success','Noc added successfully');

    }

    public function editnoc($id='')
    {
        $noc_data=NocApp::where('id',$id)->first();
        $client_id=$noc_data->client_id;
        $client_detail=Client::where('id',$client_id)->first();
        $sldc_array=array();
        if($client_detail!=NULL)
        {
            $state_discom = StateDiscom::orderBy('created_at','desc')->where('state',$client_detail->conn_state)->first();
            if($state_discom!=NULL)
            {
                $sldc_data=json_decode($state_discom->sldc);
                foreach($sldc_data as $sldc)
                {
                    foreach($sldc as $sk=>$sldc_value)
                    {
                        if($sldc_value!=NULL)
                        {
                            array_push($sldc_array,$sldc_value);
                        }

                    }
                    
                }
            }
        }

        return view('noc.edit_noc_app',compact('client_id','sldc_array','str','noc_data'));
    }

    public function updatenoc(Request $request,$id='')
    {
        $client_id=request('client_id');

        $validator = Validator::make(Input::all(), [
            'sldc' => 'required',
            'noc_type' => 'required',
            'exchange_type' => 'required',
            'quantum' => 'required|integer',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
        ]);

        if ( $validator->fails()) 
        {
        return Redirect::to('noc/edit/'. $id )->withErrors($validator)->withInput();
        }

        $url=$request->input('client_name');
                // Convert Date Format
        $commerce_date = strtr($request->input('start_date'), '/', '-');
        $new_start_date = date("Y-m-d", strtotime($commerce_date));

        // Convert Date Format
        $commerce_end_date = strtr($request->input('end_date'), '/', '-');
        $new_end_date = date("Y-m-d", strtotime($commerce_end_date));

        // $noc_application=DB::table('tbl_leave_assign')
        //     ->where('client_id', '=', request('client_id'))
        //     ->where('start_date', '<=',$new_start_date,'and')
        //     ->Where('end_date', '>=',$new_end_date)
        //     ->Where('end_date', '>=',$new_end_date)
        //     ->Where('status', '!=',5)
        //     ->get();
        //     //print_r($leave_data);die;
        // if(count($noc_application)>0)
        // {
        // return redirect()->route('getclientData', ['s' => $url])->with('error','Noc already added between this date'.);
        // }


        if(isset(request()->noc_file))
        {
            $imageName = time().'.'.request()->noc_file->getClientOriginalName();
            $noc_path = storage_path().'/FILES/TPTCL/NOC';
            File::isDirectory($noc_path) or File::makeDirectory($noc_path, 0777, true, true);
            request()->noc_file->move($noc_path, $imageName);         
        }
        else
        {
            $imageName = request('old_noc_file');
        }


        $noc = NocApp::find($id);
        $noc->sldc =request('sldc');
        $noc->noc_type = request('noc_type');
        $noc->exchange_type =request('exchange_type');
        $noc->quantum = request('quantum');
        $noc->noc_file =$imageName;                
        $noc->start_date = $new_start_date;
        $noc->end_date =$new_end_date;  
        $noc->start_time =request('start_time');
        $noc->end_time = request('end_time');
        $noc->status =1;                               
        $noc->save();  


        return redirect()->route('getclientData', ['id' => $client_id])->with('success','Noc updated successfully');

    }
    public function emailnoc($id='',$c_id='')
    {
        $client=Client::where('id',$c_id)->first();
        $client_mail=$client->email;
        $client_name=$client->name;
        $trader_mail='cybuzzsc@gmail.com';

        $out = Mail::send('noc.noc_email',array('name'=> $client_name,'text'=>'generated') , function($message) use ($client_mail,$trader_mail,$client_name) {
                $message->to($client_mail);                        
                $message->subject($client_name.' noc generate.');
                  //$message->bcc($trader_mail);
                  $message->from($trader_mail,$client_name);           
        });
        return redirect()->route('getclientData', ['id' => $c_id])->with('success','Email succesfully generated.');
    }

   public function emailDebitNoc($id='',$c_id='')
    {
        $client=Client::where('id',$c_id)->first();
        $client_mail=$client->email;
        $client_name=$client->name;
        $trader_mail='cybuzzsc@gmail.com';

        $out = Mail::send('noc.noc_email',array('name'=> $client_name,'text'=>'debited') , function($message) use ($client_mail,$trader_mail,$client_name) {
                $message->to($client_mail);                        
                $message->subject($client_name.' noc debit note.');
                  //$message->bcc($trader_mail);
                  $message->from($trader_mail,$client_name);           
        });
        return redirect()->route('getclientData', ['id' => $c_id])->with('success','Email succesfully generated.');
    }
    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }


    public function show()
    {

    }
    public function destroy($id)
    {

    }
    
    public function clientSearch(Request $request)
    {
        $client=Client::where('company_name','LIKE','%'.$request['term'].'%')->get();
        
        $results = array();
        foreach ($client as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->company_name.' ['.$query->id.']'];
        }
        if(count($results))
        {
            return Response::json($results);
        }
        else
        {
            $res=['value'=>'No Result Found','id'=>''];
            return Response::json($res);
        }
        
    } 
    public function clientData(Request $request,$s='')
    {
        if($s=='clientdata')
        {
            $str = $request->client_name; 
            preg_match_all("/\\[(.*?)\\]/", $str, $matches); 
            $client_id=@$matches[1][0];
        }
        else
        {
            $str =$s; 
            $client_id =$s; 

        }


        //var_dump($s);
        //dd('dfh');
        if($client_id!='')
        {
            //dd($client_id);
            $client_detail=Client::where('id',$client_id)->first();
            $sldc_array=array();
            if($client_detail!=NULL)
            {
                $state_discom = StateDiscom::orderBy('created_at','desc')->where('state',$client_detail->conn_state)->first();
                if($state_discom!=NULL)
                {
                    $sldc_data=json_decode($state_discom->sldc);
                    foreach($sldc_data as $sldc)
                    {
                        foreach($sldc as $sk=>$sldc_value)
                        {
                            if($sldc_value!=NULL)
                            {
                                array_push($sldc_array,$sldc_value);
                            }

                        }
                        
                    }
                }
            }



            $noc_data=NocApp::with(['client'=>function($query){$query->with('nocbilling');}])->orderBy('id','desc')->where('client_id',$client_id)->paginate(10);
            $clientData = Client::all();
            return view('noc.noc_app',compact('client_id','sldc_array','str','noc_data','clientData'));
                
        }
        else
        {
           return redirect()->route('noc-applications.index')->with('error','Sorry, No client details find');
        }


        
    }   

    public function nocbilllist()
    {
       $nocBillingList=NocBilling::orderBy('id','desc')->paginate(10);
        $state_arr1=NocBilling::orderBy('state','asc')->get()->toArray();
        $inset_state=array_column($state_arr1, 'state');

        return view('noc.noc_billing',compact('nocBillingList','inset_state'));
    }
    public function nocbillsearch(Request $request)
    {
        $sldc_array=array();
        if($request['noc_application_for']=='sldc')
        {
            $sldc=StateDiscom::where('state',$request['state'])->first();
            $sldc_data=json_decode($sldc->sldc);
            foreach($sldc_data as $sldc)
            {
                foreach($sldc as $sk=>$sldc_value)
                {
                    if($sldc_value!=NULL)
                    {
                        array_push($sldc_array,$sldc_value);
                    }

                }
                
            }
        }
        $discom_array=array();
        if($request['noc_application_for']=='discom')
        {
            $get_state_discom = StateDiscom::where('state',$request['state'])->first();
            $json_discom=json_decode($get_state_discom->discom);
            foreach($json_discom as $discom)
            {
                foreach($discom as $sk=>$discom_value)
                {
                    if($discom_value!=NULL){
                        array_push($discom_array,$discom_value);
                    }
                }
                
            }
        }
        if($request['noc_application_for']=='both')
        {
            $get_state_discom = StateDiscom::where('state',$request['state'])->first();
            $json_discom=json_decode($get_state_discom->discom);
            foreach($json_discom as $discom)
            {
                foreach($discom as $sk=>$discom_value)
                {
                    if($discom_value!=NULL){
                        array_push($discom_array,$discom_value);
                    }
                }
                
            }
            $sldc_data=json_decode($get_state_discom->sldc);
            foreach($sldc_data as $sldc)
            {
                foreach($sldc as $sk=>$sldc_value)
                {
                    if($sldc_value!=NULL)
                    {
                        array_push($sldc_array,$sldc_value);
                    }

                }
                
            }

        }

       return response()->json(['sldc' => $sldc_array, 'discom' => $discom_array],200);
    }

    public function nocbillingcreate(Request $request)
    {
        $this->validate($request, [
            'state' => 'required',
            'noc_application_for' => 'required',
            'discom_cgst_value' => 'nullable|integer',
            'discom_sgst_value' => 'nullable|integer',
            'discom_utgst_value' => 'nullable|integer',
            'discom_igst_value' => 'nullable|integer',
            'sldc_cgst_amt' => 'nullable|integer',
            'sldc_sgst_amt' => 'nullable|integer',
            'sldc_utgst_amt' => 'nullable|integer',
            'sldc_igst_amt' => 'nullable|integer',
        ]);

        $noc_bill_sett = new NocBilling;
        $noc_bill_sett->state = request('state');
        $noc_bill_sett->noc_application_for = request('noc_application_for');
        $noc_bill_sett->discom = request('discom');
        $noc_bill_sett->discom_amt = request('discom_amt');     
        $noc_bill_sett->discom_gst_applicabale = request('discom_gst_applicabale');
        $noc_bill_sett->discom_cgst_value = request('discom_cgst_value');
        $noc_bill_sett->discom_sgst_value = request('discom_sgst_value');
        $noc_bill_sett->discom_utgst_value = request('discom_utgst_value');
        $noc_bill_sett->discom_igst_value = request('discom_igst_value');
        $noc_bill_sett->sldc = request('sldc');
        $noc_bill_sett->sldc_amt = request('sldc_amt');   
        $noc_bill_sett->sldc_gst_applicable = request('sldc_gst_applicable');
        $noc_bill_sett->sldc_cgst_amt = request('sldc_cgst_amt');
        $noc_bill_sett->sldc_sgst_amt = request('sldc_sgst_amt');        
        $noc_bill_sett->sldc_utgst_amt = request('sldc_utgst_amt');             
        $noc_bill_sett->sldc_igst_amt = request('sldc_igst_amt');                               
        $noc_bill_sett->save();

        return redirect()->route('billsetting.nocbilllist')->with('success', 'NOC Billing Setting Added Successfully.');

    }
    public function nocbillingdelete($id)
    {
        
        $del = NocBilling::findOrFail($id);
        $del->delete();

        return redirect()->back()->with('success', 'NOC Billing Setting Deleted Successfully.');
    }
    public function nocbillingedit($id='')
    {
        $edit_nocBilling=NocBilling::where('id',$id)->first();
        $nocBillingList=NocBilling::orderBy('id','desc')->paginate(10);
        $state_arr1=NocBilling::orderBy('state','asc')->get()->toArray();
        $inset_state=array_column($state_arr1, 'state');

        return view('noc.noc_billing',compact('edit_nocBilling','nocBillingList','inset_state'));
    }

    public function nocbillingupdate(Request $request,$id='')
    {
        $this->validate($request, [
            'state' => 'required',
            'noc_application_for' => 'required',
            'discom_cgst_value' => 'nullable|integer',
            'discom_sgst_value' => 'nullable|integer',
            'discom_utgst_value' => 'nullable|integer',
            'discom_igst_value' => 'nullable|integer',
            'sldc_cgst_amt' => 'nullable|integer',
            'sldc_sgst_amt' => 'nullable|integer',
            'sldc_utgst_amt' => 'nullable|integer',
            'sldc_igst_amt' => 'nullable|integer',
        ]);

        $noc_bill_sett = NocBilling::find($id);
        $noc_bill_sett->noc_application_for = request('noc_application_for');
        $noc_bill_sett->discom = request('discom');
        $noc_bill_sett->discom_amt = request('discom_amt');     
        $noc_bill_sett->discom_gst_applicabale = request('discom_gst_applicabale');
        $noc_bill_sett->discom_cgst_value = request('discom_cgst_value');
        $noc_bill_sett->discom_sgst_value = request('discom_sgst_value');
        $noc_bill_sett->discom_utgst_value = request('discom_utgst_value');
        $noc_bill_sett->discom_igst_value = request('discom_igst_value');
        $noc_bill_sett->sldc = request('sldc');
        $noc_bill_sett->sldc_amt = request('sldc_amt');   
        $noc_bill_sett->sldc_gst_applicable = request('sldc_gst_applicable');
        $noc_bill_sett->sldc_cgst_amt = request('sldc_cgst_amt');
        $noc_bill_sett->sldc_sgst_amt = request('sldc_sgst_amt');        
        $noc_bill_sett->sldc_utgst_amt = request('sldc_utgst_amt');             
        $noc_bill_sett->sldc_igst_amt = request('sldc_igst_amt');                               
        $noc_bill_sett->save();

        return redirect()->route('billsetting.nocbilllist')->with('success', 'NOC Billing Setting Updated Successfully.');

    }

    public function nocApproval()
    {
       $noc_for_approval=NocApp::orderBy('id','desc')->where('status',1)->paginate(10);
       $approved_noc=NocApp::orderBy('id','desc')->where('status',2)->paginate(10);
       $rejected_noc=NocApp::orderBy('id','desc')->where('status',5)->paginate(10);

        return view('noc.noc_approval',compact('noc_for_approval','approved_noc','rejected_noc'));
    }
    public function nocApprovalReq($id='',$status_id='')
    {
       $status = NocApp::find($id);
       $status->status = $status_id;
       $status->save();

        return redirect()->back()->with('success','Noc Application Successfully Approved.');
    }
    public function nocReq($id='',$status_id='')
    {
       $status = NocApp::find($id);
        $c_id=$status->client_id;
       $status->status = $status_id;
       $status->save();
       if($status_id==4)
       {
        return redirect()->route('getclientData', ['id' => $c_id])->with('success', 'NOC accepted successfully.');
       }
       else
       {
        return redirect()->route('getclientData', ['id' => $c_id])->with('success', 'NOC rejected successfully.');        
       }

    }

    public function addPayment(Request $request)
    {
                $url=$request->input('client_name');

        $commerce_end_date = strtr($request->input('transcation_date'), '/', '-');
        $transcation_date_n = date("Y-m-d", strtotime($commerce_end_date));

        $noc_bill_sett = NocApp::find($request->noc_id);
        $noc_bill_sett->payment_challan_number = request('payment_challan_number');
        $noc_bill_sett->bank_name = request('bank_name');
        $noc_bill_sett->transcation_date = $transcation_date_n;     
        $noc_bill_sett->amount = request('amount');    
        $noc_bill_sett->status = 3;                         
        $noc_bill_sett->save();

        return redirect()->route('getclientData', ['id' => $url])->with('success', 'NOC payment added successfully.');

    }

    public function generateNocPdf($id='')
    {
        $get_data=NocApp::with('client')->where('id',$id)->first();
        $get_client=NocApp::find(1)->client()->where('id',$get_data->client_id)->get();
        if($get_data->exchange_type=='both')
        {
            $exchange='IEX/PXIL';
        }
        else
        {
            $exchange=$get_data->exchange_type;
        }

        $pdf_name=$get_data['client']->id.'_'.$get_data['client']->company_name.'_'.date('d_m_Y').'.pdf';

        $update_pdf=NocApp::find($id);
        $update_pdf->generate_noc_application=$pdf_name;
        $update_pdf->save();

        $generate_noc = storage_path().'/files/tptcl/noc/generate_noc_application';
        File::isDirectory($generate_noc) or File::makeDirectory($generate_noc, 0777, true, true);


        $pdf=PDF::loadView('noc.generate_noc_app',['date'=>date('d.m.Y'),'application_no'=>$get_data->application_no,'sldc'=>$get_data->sldc,'exchange'=>strtoupper($exchange),'quantum'=>$get_data->quantum,'from_date'=>date('d.m.Y',strtotime($get_data->start_date)),'end_date'=>date('d.m.Y',strtotime($get_data->end_date)),'amount'=>$get_data->amount,'challan_no'=>$get_data->payment_challan_number,'transcation_date'=>date('d.m.Y',strtotime($get_data->transcation_date))]);
         $pdf->save($generate_noc.'/'.$pdf_name);
        return redirect()->route('getclientData', ['id' => $get_data->client_id])->with('success','Noc generate successfully');
        //return $pdf->download('noc-applicaiton.pdf');
    }

    public function nocPdfDelete(Request $request,$id='')
    {
        $url=$request->input('client_name');
        $file_path=$request->input('noc_file_pdf');
        $discom_path=$request->input('noc_discom_pdf');
        $sldc_path=$request->input('noc_sldc_pdf');
        if(isset($file_path))
        {
            if($file_path!=''&&file_exists(storage_path('/files/tptcl/noc/generate_noc_application/'.$file_path)))
             {
               unlink(storage_path('/files/tptcl/noc/generate_noc_application/'.$file_path));
             }
            $pdf = NocApp::find($id);
            $client_id=$pdf->client_id;
            $pdf->generate_noc_application='';                         
            $pdf->save();

            return redirect()->route('getclientData', ['id' => $url])->with('success', 'NOC Application pdf Deleted.');
        }
        if(isset($sldc_path))
        {
            if($sldc_path!=''&&file_exists(storage_path('/files/tptcl/noc/bill/'.$sldc_path)))
             {
               unlink(storage_path('/files/tptcl/noc/bill/'.$sldc_path));
             }
            $pdf = NocApp::find($id);
            $client_id=$pdf->client_id;
            $pdf->generate_sldc_debit='';                         
            $pdf->save();

            return redirect()->route('getclientData', ['id' => $url])->with('success', 'NOC SLDC Debit pdf Deleted.');
        }
        if(isset($discom_path))
        {
            if($discom_path!=''&&file_exists(storage_path('/files/tptcl/noc/bill/'.$discom_path)))
             {
               unlink(storage_path('/files/tptcl/noc/bill/'.$discom_path));
             }
            $pdf = NocApp::find($id);
            $client_id=$pdf->client_id;
            $pdf->generate_discom_debit='';                         
            $pdf->save();

            return redirect()->route('getclientData', ['id' => $url])->with('success', 'NOC DISCOM Debit pdf Deleted.');
        }

    }
    public function generateSldcPdf($id='',$c_id='')
    {
        $get_data=NocApp::where('id',$id)->first();
        $client=Client::where('id',$c_id)->first();
        $get_client=Client::find(1)->nocbilling()->where('id',$c_id)->first();
        //NocBilling

        if($get_data->exchange_type=='both')
        {
            $exchange='IEX/PXIL';
        }
        else
        {
            $exchange=$get_data->exchange_type;
        }

        $pdf_name=$client->id.'_DEB_SLDC_'.time().'_'.date('d_m_Y').'.pdf';
        $update_pdf=NocApp::find($id);
        $update_pdf->generate_sldc_debit=$pdf_name;
        $update_pdf->save();

        $generate_noc = storage_path().'/files/tptcl/noc/bill';
        File::isDirectory($generate_noc) or File::makeDirectory($generate_noc, 0777, true, true);

        $pdf=PDF::loadView('noc.bill_view',['date'=>date('d-m-Y'),'application_no'=>$get_data->application_no,'sldc'=>$get_data->sldc,'client_name'=>strtoupper($client->name),'from_date'=>date('d-m-Y',strtotime($get_data->start_date)),'end_date'=>date('d-m-Y',strtotime($get_data->end_date)),'amount'=>$get_data->amount,'challan_no'=>$get_data->payment_challan_number,'transcation_date'=>date('d-m-Y',strtotime($get_data->transcation_date))]);
        $pdf->save($generate_noc.'/'.$pdf_name);

        return redirect()->route('getclientData', ['id' => $get_data->client_id])->with('success','SLDC Debit generate successfully');
    }
    public function generateDiscomPdf($id='',$c_id='')
    {
        $get_data=NocApp::where('id',$id)->first();
        $client=Client::where('id',$c_id)->first();
        $get_client=Client::find(1)->nocbilling()->where('id',$c_id)->first();
        //NocBilling

        if($get_data->exchange_type=='both')
        {
            $exchange='IEX/PXIL';
        }
        else
        {
            $exchange=$get_data->exchange_type;
        }

        $pdf_name=$client->id.'_DEB_DISCOM_'.time().'_'.date('d_m_Y').'.pdf';
        $update_pdf=NocApp::find($id);
        $update_pdf->generate_discom_debit=$pdf_name;
        $update_pdf->save();

        $generate_noc = storage_path().'/files/tptcl/noc/bill';
        File::isDirectory($generate_noc) or File::makeDirectory($generate_noc, 0777, true, true);

        $pdf=PDF::loadView('noc.discomBill',['date'=>date('d-m-Y'),'application_no'=>$get_data->application_no,'sldc'=>$get_data->sldc,'client_name'=>strtoupper($client->name),'from_date'=>date('d-m-Y',strtotime($get_data->start_date)),'end_date'=>date('d-m-Y',strtotime($get_data->end_date)),'amount'=>$get_data->amount,'challan_no'=>$get_data->payment_challan_number,'transcation_date'=>date('d-m-Y',strtotime($get_data->transcation_date))]);
        $pdf->save($generate_noc.'/'.$pdf_name);

        return redirect()->route('getclientData', ['id' => $get_data->client_id])->with('success','DISCOM Debit generate successfully');
    }

    public function downloadGenPdfn($filename='')
    {
            $file_path = storage_path() .'/files/tptcl/noc/generate_noc_application/'. $filename;
            if (file_exists($file_path))
            {
                // Send Download
                return Response::download($file_path, $filename, [
                    'Content-Length: '. filesize($file_path)
                ]);
            }
            else
            {
                 exit('Requested file does not exist on our server!');
            }
    }
    public function downloadNewDownWord($filename='')
    {
            $file_path = storage_path() .'/files/tptcl/noc/bill/'. $filename;
            if (file_exists($file_path))
            {
                // Send Download
                return Response::download($file_path, $filename, [
                    'Content-Length: '. filesize($file_path)
                ]);
            }
            else
            {
                 exit('Requested file does not exist on our server!');
            }
    }


}
