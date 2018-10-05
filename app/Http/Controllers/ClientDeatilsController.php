<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\StateDiscom;

use App\Bank;
use Carbon\Carbon;
use DB;
use App\Client;
use App\BankTemp;
use Validator;
use App\Approvalrequest;
use App\Groupusersetting;
use Illuminate\Support\Facades\Redirect;



class ClientDeatilsController extends Controller
{
	public function viewlist()
	{
		$clientdata = Client::latest()->where('client_app_status','1')->paginate(15);

		return view('ManageClient.addclient',compact('clientdata'));
	}

	public function addclient()
	{


		return view('ManageClient.basicdetails');
	}
	public function saveclient(Request $request){

		$validator = validator::make($request->all(),[

			'company_name' => 'required|max:100',
            'gstin' => 'required|regex:/^[0-9]{2}[A-z]{3}[PCAFHTG][A-z][0-9]{4}[A-z][0-9A-z]{3}$/|unique:clients|max:15',
            'pan' => 'required|regex:/^[a-zA-Z]{3}[ABCEFGHJLTabcefghjl]{1}[a-zA-Z]{1}\d{4}[a-zA-Z]{1}$/|unique:clients|max:10',
            'short_id' => 'nullable|max:15|regex:/^[\w-]*$/',
            'old_sap'=>'nullable|regex:/^[\w-]*$/|max:15',
            'new_sap'=>'nullable|regex:/^[\w-]*$/|max:15',
            'pri_contact_no'=>'required|regex:/^[0-9]{10}$/',
            'cin' => 'required|regex:/^[LU][0-9]{5}[A-z]{2}[0-9]{4}[A-z]{3}[0-9]{6}$/|unique:clients|min:21|max:21',
            'email'=>'required|email|max:81',
            'reg_line1' => 'required|max:100',
            'reg_line2' => 'min:0|max:100',
            'reg_country' => 'required',
            'reg_state' => 'required',
            'reg_city' => 'required|regex:/^[a-zA-Z0-9 ,]+$/u|max:30',
            'reg_pin' => 'required|regex:/^[1-9][0-9]{5}$/',
            'reg_mob' => 'required|regex:/^[0-9]{10}$/',
            'reg_telephone' => 'nullable|min:5|max:15',
            'bill_line1'=>'nullable|max:50',
            'bill_line2'=>'nullable|max:50',
            'bill_country'=>'nullable',
            'bill_state'=>'nullable',
            'bill_city'=>'nullable|regex:/^[A-z]+$/|max:25',
            'bill_pin'=>'nullable|regex:/^[1-9][0-9]{5}$/',
            'bill_mob'=>'nullable|regex:/^[0-9]{10}$/',
            'bill_telephone'=>'nullable|min:5|max:15',
            'del_lin1'=>'nullable|max:50',
            'del_lin2'=>'nullable|max:50',
            'del_country'=>'nullable',
            'del_state'=>'nullable',
            'del_city'=>'nullable|regex:/^[A-z]+$/|max:25',
            'del_pin'=>'nullable|regex:/^[1-9][0-9]{5}$/',
            'del_mob'=>'nullable|regex:/^[0-9]{10}$/',
            'del_telephone'=>'nullable|min:5|max:15',
            'iex_client_name'=>'nullable|max:100',
            'iex_portfolio'=>'nullable|regex:/^[\w-]*$/|max:20',
            'pxil_client_name'=>'nullable|max:100',
            'iex_status'=>'nullable',
            'pxil_portfolio'=>'nullable|regex:/^[\w-]*$/|max:20',
            'pxil_status'=>'nullable',
            'iex_region'=>'nullable',
            'pxil_region'=>'nullable',
            'discom'=>'nullable',
            'voltage'=>'nullable',
            'state_type'=>'nullable',
            'name_of_substation'=>'nullable|regex:/^[\w-]*$/|max:30',
            'inter_discom'=>'nullable',
            'inter_stu'=>'nullable',
            'inter_poc'=>'nullable',
            'common_feeder_option'=>'nullable|regex:/^[\w-]*$/|max:30',
            'feeder_name'=>'nullable|regex:/^[\w-]*$/|max:30',
            'feeder_code'=>'nullable|max:30',
            'conn_discom'=>'nullable',
            'conn_state'=>'nullable',
            'maxm_injection'=>'nullable|between:0,99.99|max:7',
            'maxm_withdrawal'=>'nullable|between:0,99.99|max:7',
            'payment'=>'nullable|numeric',
            'obligation'=>'nullable',
            'noc_punched_by'=>'nullable'

			]);
		 if($validator->fails())
        {

            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }
        //dd($request->input('bill_state'));
        $client = new Client;
        $client->company_name = $request->input('company_name');
        $client->gstin = $request->input('gstin');
        $client->pan = $request->input('pan');
        $client->cin = $request->input('cin');
        $client->short_id = $request->input('short_id');
        $client->email = $request->input('email');
        $client->new_sap = $request->input('new_sap');
        $client->old_sap = $request->input('old_sap');
        $client->crn_no = $request->input('crn_no');
        $client->pri_contact_no = $request->input('pri_contact_no');
        $client->reg_line1 = $request->input('reg_line1');
        $client->reg_line2 = $request->input('reg_line2');
        $client->reg_country= $request->input('reg_country');
        $client->reg_state = $request->input('reg_state');
        $client->reg_city = $request->input('reg_city');
        $client->reg_pin = $request->input('reg_pin');
        $client->reg_mob = $request->input('reg_mob');
        $client->reg_telephone = $request->input('reg_telephone');

        $client->bill_line1 = $request->input('bill_line1');
        $client->bill_line2 = $request->input('bill_line2');
        $client->bill_country= $request->input('bill_country');
        $client->bill_state = $request->input('bill_state');
        $client->bill_city = $request->input('bill_city');
        $client->bill_pin = $request->input('bill_pin');
        $client->bill_mob = $request->input('bill_mob');
        $client->bill_telephone = $request->input('bill_telephone');

        $client->del_lin1 = $request->input('del_lin1');
        $client->del_lin2 = $request->input('del_lin2');
        $client->del_country= $request->input('del_country');
        $client->del_state = $request->input('del_state');
        $client->del_city = $request->input('del_city');
        $client->del_pin = $request->input('del_pin');
        $client->del_mob = $request->input('del_mob');
        $client->del_telephone = $request->input('del_telephone');

        $client->iex_client_name = $request->input('iex_client_name');
        $client->iex_portfolio = $request->input('iex_portfolio');
        $client->pxil_client_name = $request->input('pxil_client_name');
        $client->iex_status = $request->input('iex_status');
        $client->pxil_portfolio = $request->input('pxil_portfolio');
        $client->pxil_status = $request->input('pxil_status');
        $client->iex_region = $request->input('iex_region');
        $client->pxil_region = $request->input('pxil_region');
        $client->discom = $request->input('discom');
        $client->voltage = $request->input('voltage');
        $client->state_type = $request->input('state_type');
        $client->name_of_substation = $request->input('name_of_substation');
        $client->inter_discom = $request->input('inter_discom');
        $client->inter_stu = $request->input('inter_stu');
        $client->inter_poc = $request->input('inter_poc');
        $client->common_feeder_option = $request->input('common_feeder_option');
        $client->feeder_name = $request->input('feeder_name');
        $client->feeder_code = $request->input('feeder_code');
        $client->conn_discom = $request->input('conn_discom');
        $client->conn_state = $request->input('conn_state');
        $client->maxm_injection = $request->input('maxm_injection');
        $client->maxm_withdrawal = $request->input('maxm_withdrawal');
        $client->payment = $request->input('payment');
        $client->obligation = $request->input('obligation');
        $client->noc_punched_by = $request->input('noc_punched_by');
        $client->barred_status = 1;
        $client->save();

        //$lsatinsertedId = $clien->id;
		return redirect('basicdetails')->with('message', 'Client details saved successfully and submitted for approval.!');
	}

    public function viewclient($id='',$tag=''){

            $clientdata = Client::select('*')->where('client_app_status','1')->where('id',$id)->first();


				$voltage_array=array();
				$sldc=StateDiscom::where('state',@$clientdata->conn_state)->first();
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
				$discom_array=array();
				$json_discom=json_decode(@$sldc->discom);
                if(isset($json_discom))
                {
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
//dd($voltage_array);

        return view('ManageClient.viewbasic',compact('clientdata','id','discom_array','voltage_array','action_info'));
    }

    public function viewclientPrint($id='',$tag=''){

        $action_info='view';
            $clientdata = Client::select('*')->where('id',$id)->first();
           
                $voltage_array=array();
                $sldc=StateDiscom::where('state',@$clientdata->conn_state)->first();
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
                $discom_array=array();
                $json_discom=json_decode(@$sldc->discom);
                if(isset($json_discom))
                {
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
//dd($voltage_array);

        return view('ApprovalRequest.client.approve_rej',compact('clientdata','id','discom_array','voltage_array','action_info'));
    }

    public function updateclient(Request $request,$basic_id){

        $validator = validator::make($request->all(),[

            'company_name' => 'required|max:100',
            'gstin' => 'required|regex:/^[0-9]{2}[A-z]{3}[PCAFHTG][A-z][0-9]{4}[A-z][0-9A-z]{3}$/|max:15',
            'pan' => 'required|regex:/^[a-zA-Z]{3}[ABCEFGHJLTabcefghjl]{1}[a-zA-Z]{1}\d{4}[a-zA-Z]{1}$/|max:10',
            'short_id' => 'nullable|max:15|regex:/^[\w-]*$/',
            'old_sap'=>'nullable|regex:/^[\w-]*$/|max:15',
            'new_sap'=>'nullable|regex:/^[\w-]*$/|max:15',
            'pri_contact_no'=>'required|regex:/^[0-9]{10}$/',
            'cin' => 'required|regex:/^[LU][0-9]{5}[A-z]{2}[0-9]{4}[A-z]{3}[0-9]{6}$/|min:21|max:21',
            'email'=>'required|email|max:81',
            'reg_line1' => 'required|max:100',
            'reg_line2' => 'min:0|max:100',
            'reg_country' => 'required',
            'reg_state' => 'required',
            'reg_city' => 'required|regex:/^[a-zA-Z0-9 ,]+$/u|max:30',
            'reg_pin' => 'required|regex:/^[1-9][0-9]{5}$/',
            'reg_mob' => 'required|regex:/^[0-9]{10}$/',
            'reg_telephone' => 'nullable|min:5|max:15',
            'bill_line1'=>'nullable|max:50',
            'bill_line2'=>'nullable|max:50',
            'bill_country'=>'nullable',
            'bill_state'=>'nullable',
            'bill_city'=>'nullable|regex:/^[A-z]+$/|max:25',
            'bill_pin'=>'nullable|regex:/^[1-9][0-9]{5}$/',
            'bill_mob'=>'nullable|regex:/^[0-9]{10}$/',
            'bill_telephone'=>'nullable|min:5|max:15',
            'del_lin1'=>'nullable|max:50',
            'del_lin2'=>'nullable|max:50',
            'del_country'=>'nullable',
            'del_state'=>'nullable',
            'del_city'=>'nullable|regex:/^[A-z]+$/|max:25',
            'del_pin'=>'nullable|regex:/^[1-9][0-9]{5}$/',
            'del_mob'=>'nullable|regex:/^[0-9]{10}$/',
            'del_telephone'=>'nullable|min:5|max:15',
            'iex_client_name'=>'nullable|max:100',
            'iex_portfolio'=>'nullable|regex:/^[\w-]*$/|max:20',
            'pxil_client_name'=>'nullable|max:100',
            'iex_status'=>'nullable',
            'pxil_portfolio'=>'nullable|regex:/^[\w-]*$/|max:20',
            'pxil_status'=>'nullable',
            'iex_region'=>'nullable',
            'pxil_region'=>'nullable',
            'discom'=>'nullable',
            'voltage'=>'nullable',
            'state_type'=>'nullable',
            'name_of_substation'=>'nullable|regex:/^[\w-]*$/|max:30',
            'inter_discom'=>'nullable',
            'inter_stu'=>'nullable',
            'inter_poc'=>'nullable',
            'common_feeder_option'=>'nullable|regex:/^[\w-]*$/|max:30',
            'feeder_name'=>'nullable|regex:/^[\w-]*$/|max:30',
            'feeder_code'=>'nullable',
            'conn_discom'=>'nullable',
            'conn_state'=>'nullable',
            'maxm_injection'=>'nullable|between:0,99.99|max:7',
            'maxm_withdrawal'=>'nullable|between:0,99.99|max:7',
            'payment'=>'nullable|numeric',
            'obligation'=>'nullable',
            'noc_punched_by'=>'nullable'



            ]);
         if($validator->fails())
        {

            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }


          //  ]);
        $basic = Client::find($basic_id)->toArray();
        $client_id = $basic['id'];
        $datas =array();

		$datas['company_name'] = $basic['company_name'];
        $datas['gstin'] = $basic['gstin'];
        $datas['pan'] = $basic['pan'];
        $datas['pri_contact_no'] = $basic['pri_contact_no'];
        $datas['email'] = $basic['email'];
        $datas['short_id'] = $basic['short_id'];
        $datas['old_sap'] = $basic['old_sap'];
		$datas['new_sap'] = $basic['new_sap'];
		//$datas['crn_no'] = $basic['crn_no'];

        $datas['reg_line1'] = $basic['reg_line1'];
        $datas['reg_line2'] = $basic['reg_line2'];
        $datas['reg_country'] = $basic['reg_country'];
        $datas['reg_state'] = $basic['reg_state'];
        $datas['reg_city'] = $basic['reg_city'];
        $datas['reg_pin'] = $basic['reg_pin'];
        $datas['reg_mob'] = $basic['reg_mob'];
        $datas['reg_telephone'] = $basic['reg_telephone'];

        $datas['bill_line1'] = $basic['bill_line1'];
        $datas['bill_line2'] = $basic['bill_line2'];
        $datas['bill_country'] = $basic['bill_country'];
        $datas['bill_city'] = $basic['bill_city'];
        $datas['bill_mob'] = $basic['bill_mob'];
        $datas['bill_telephone'] = $basic['bill_telephone'];
        $datas['bill_state'] = $basic['bill_state'];
        $datas['bill_pin'] = $basic['bill_pin'];

        $datas['del_lin1'] = $basic['del_lin1'];
        $datas['del_lin2'] = $basic['del_lin2'];
        $datas['del_country'] = $basic['del_country'];
        $datas['del_state'] = $basic['del_state'];
        $datas['del_city'] = $basic['del_city'];
        $datas['del_pin'] = $basic['del_pin'];
        $datas['del_mob'] = $basic['del_mob'];
        $datas['del_telephone'] = $basic['del_telephone'];
        $datas['iex_client_name'] = $basic['iex_client_name'];

        $datas['iex_portfolio'] = $basic['iex_portfolio'];
        $datas['iex_status'] = $basic['iex_status'];
        $datas['pxil_client_name'] = $basic['pxil_client_name'];
        $datas['pxil_portfolio'] = $basic['pxil_portfolio'];
        $datas['pxil_status'] = $basic['pxil_status'];
        $datas['iex_region'] = $basic['iex_region'];
        $datas['pxil_region'] = $basic['pxil_region'];
        $datas['discom'] = $basic['discom'];

        $datas['voltage'] = $basic['voltage'];
        $datas['state_type'] = $basic['state_type'];
        $datas['name_of_substation'] = $basic['name_of_substation'];

        $datas['inter_connection'] = $basic['inter_connection'];
        $datas['feeder_name'] = $basic['feeder_name'];
        $datas['feeder_code'] = $basic['feeder_code'];
        $datas['conn_state'] = $basic['conn_state'];
        $datas['maxm_injection'] = $basic['maxm_injection'];
        $datas['maxm_withdrawal'] = $basic['maxm_withdrawal'];
        $datas['payment'] = $basic['payment'];
        $datas['inter_poc'] = $basic['inter_poc'];
        $datas['inter_stu'] = $basic['inter_stu'];
        $datas['inter_discom'] = $basic['inter_discom'];
        $datas['common_feeder_option'] = $basic['common_feeder_option'];
		$datas['obligation'] = $basic['obligation'];
        $datas['cin'] = $basic['cin'];
        $datas['noc_punched_by'] = $basic['noc_punched_by'];

        $dataArray =array();
		$dataArray['company_name'] = $request->input('company_name');
        $dataArray['gstin'] = $request->input('gstin');
        $dataArray['pan'] = $request->input('pan');
        $dataArray['pri_contact_no'] = $request->input('pri_contact_no');
        $dataArray['email'] = $request->input('email');
        $dataArray['short_id'] = $request->input('short_id');
        $dataArray['old_sap'] = $request->input('old_sap');
		$dataArray['new_sap'] = $request->input('new_sap');
		//$dataArray['crn_no'] = $request->input('crn_no');
        $dataArray['reg_line1'] = $request->input('reg_line1');
        $dataArray['reg_line2'] = $request->input('reg_line2');
        $dataArray['reg_country'] = $request->input('reg_country');
        $dataArray['reg_state'] = $request->input('reg_state');
        $dataArray['reg_city'] = $request->input('reg_city');
        $dataArray['reg_pin'] = $request->input('reg_pin');
        $dataArray['reg_mob'] = $request->input('reg_mob');
        $dataArray['reg_telephone'] = $request->input('reg_telephone');

        $dataArray['bill_line1'] = $request->input('bill_line1');
        $dataArray['bill_line2'] = $request->input('bill_line2');
        $dataArray['bill_country'] = $request->input('bill_country');
        $dataArray['bill_city'] = $request->input('bill_city');
        $dataArray['bill_mob'] = $request->input('bill_mob');
        $dataArray['bill_telephone'] = $request->input('bill_telephone');
        $dataArray['bill_state'] = $request->input('bill_state');
        $dataArray['bill_pin'] = $request->input('bill_pin');

        $dataArray['del_lin1'] = $request->input('del_lin1');
        $dataArray['del_lin2'] = $request->input('del_lin2');
        $dataArray['del_country'] = $request->input('del_country');
        $dataArray['del_state'] = $request->input('del_state');
        $dataArray['del_city'] = $request->input('del_city');
        $dataArray['del_pin'] = $request->input('del_pin');
        $dataArray['del_mob'] = $request->input('del_mob');
        $dataArray['del_telephone'] = $request->input('del_telephone');
        $dataArray['iex_client_name'] = $request->input('iex_client_name');

        $dataArray['iex_portfolio'] = $request->input('iex_portfolio');
        $dataArray['iex_status'] = $request->input('iex_status');
        $dataArray['pxil_client_name'] = $request->input('pxil_client_name');
        $dataArray['pxil_portfolio'] = $request->input('pxil_portfolio');
        $dataArray['pxil_status'] = $request->input('pxil_status');
        $dataArray['iex_region'] = $request->input('iex_region');
        $dataArray['pxil_region'] = $request->input('pxil_region');
        $dataArray['discom'] = $request->input('discom');

        $dataArray['voltage'] = $request->input('voltage');
        $dataArray['state_type'] = $request->input('state_type');
        $dataArray['name_of_substation'] = $request->input('name_of_substation');

        $dataArray['inter_connection'] = $request->input('inter_connection');
        $dataArray['feeder_name'] = $request->input('feeder_name');
        $dataArray['feeder_code'] = $request->input('feeder_code');
        $dataArray['conn_state'] = $request->input('conn_state');
        $dataArray['maxm_injection'] = $request->input('maxm_injection');
        $dataArray['maxm_withdrawal'] = $request->input('maxm_withdrawal');
        $dataArray['payment'] = $request->input('payment');
        $dataArray['inter_poc'] = $request->input('inter_poc');
        $dataArray['inter_stu'] = $request->input('inter_stu');
        $dataArray['inter_discom'] = $request->input('inter_discom');
        $dataArray['common_feeder_option'] = $request->input('common_feeder_option');
		$dataArray['obligation'] = $request->input('obligation');
        $dataArray['cin'] = $request->input('cin');
         $dataArray['noc_punched_by'] = $request->input('noc_punched_by');

        $result=array_diff_assoc($dataArray,$datas);
        $this->generateApprovalrequest($result, 'client', $client_id, $basic_id,$datas);
        return Redirect::back()->with('message', 'Your update request has been successfully submitted for approval..');
    }


    public function edit_bankdetails($id='',$eid=''){
        $bank_id=$eid;
        $client_id=$id;
        $get_bank_details = Bank::where('id',$bank_id)->where('status',1)->withTrashed()->first();
        $bankdetails = Bank::where('client_id',$client_id)->where('status',1)->withTrashed()->paginate(15);
        $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$id)->get();

        return view('ManageClient.bankdetails',compact('bankdetails','client_id','get_bank_details','client_details'));
    }

    public function bankdetails($id){
        $client_id=$id;
       // $bankdetails = Bank::where('client_id',$id)->where('status',1)->get();
        $bankdetails = DB::table('bank')->select('*')->where(function($q) { $q->where('del_status',0)->orwhere('del_status',1)->orwhere('del_status',4); })->where('client_id',$id)->where('status',1)->paginate(15);

       $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$id)->get();

        return view('ManageClient.bankdetails',compact('bankdetails','client_id','client_details'));
    }
    public function add_bankdetails(Request $request){
        // dd();
        $this->validate($request, [
             'virtual_account_number' => 'nullable|alpha_num|max:20',
            'account_number' => 'required|alpha_num|max:20',
            'bank_name' => 'required|regex:/^[a-zA-Z ]*$/|max:50',
            'branch_name' => 'required|regex:/^[a-z\d\-_\s]+$/i|max:50',
            'ifsc' => 'required|regex:/^[A-Za-z]{4}[a-zA-Z0-9]{7}$/|max:11',
        ]);
        $bankdetail = new BankTemp();
        $bankdetail->client_id = $request->client_id;
        $bankdetail->account_number = $request->input('account_number');
        $bankdetail->bank_name = $request->input('bank_name');
        $bankdetail->branch_name = $request->input('branch_name');
        $bankdetail->ifsc = $request->input('ifsc');
        $bankdetail->virtual_account_number = $request->input('virtual_account_number');
        //dd(3);
        $bankdetail->save();
        return redirect()->back()->with('message','Client details saved successfully and submitted for Approval');

    }

    public function update_bankdetails(Request $request ,$bank_detail_id)
    {
         $this->validate($request, [
             'virtual_account_number' => 'nullable|alpha_num|max:20',
            'account_number' => 'required|alpha_num|max:20',
            'bank_name' => 'required|regex:/^[a-zA-Z ]*$/|max:50',
            'branch_name' => 'required|regex:/^[a-z\d\-_\s]+$/i|max:50',
            'ifsc' => 'required|regex:/^[A-Za-z]{4}[a-zA-Z0-9]{7}$/|max:11',
        ]);
 
        $client_id=$request->input('client_id');
        $bankdetailtemp = Bank::find($bank_detail_id)->toArray();

        $datas =array();
        $datas['account_number'] = $bankdetailtemp['account_number'];
        $datas['bank_name'] = $bankdetailtemp['bank_name'];
        $datas['branch_name'] = $bankdetailtemp['branch_name'];
        $datas['ifsc'] = $bankdetailtemp['ifsc'];
        $datas['virtual_account_number'] = $bankdetailtemp['virtual_account_number'];

        $dataArray =array();
        $dataArray['account_number'] = $request->input('account_number');
        $dataArray['bank_name'] = $request->input('bank_name');
        $dataArray['branch_name'] = $request->input('branch_name');
        $dataArray['ifsc'] = $request->input('ifsc');
        $dataArray['virtual_account_number'] = $request->input('virtual_account_number');
        $result=array_diff($dataArray,$bankdetailtemp);

        if($this->generateApprovalrequestbank($result,'bank',$client_id,$bank_detail_id,$datas)==false){
           // dd(1);
            return redirect()->route('bankdetails', ['id' => $client_id])->with(['message'=>'There is already a change request pending for approval.']);
        }
        
          return redirect()->route('bankdetails', ['id' => $client_id])->with('message','Detail added successfully and sent for approval.');
    }


    public function delete_bankdetails(Request $request ,$bank_detail_id)
    {
        $client_id=$request->input('client_id');
        $contact = Bank::find($bank_detail_id);
        $contact->del_status = 1;
        $contact->update();

        return redirect()->back()->with('message','Delete Request has been submitted successfully for approval');
    }
    public function search_discom(Request $request)
    {
        $voltage_array=array();
       $sldc=StateDiscom::where('state',$request['state'])->first();
       $voltage_data=json_decode($sldc->voltage);
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

       $discom_array=array();
       $json_discom=json_decode($sldc->discom);
       foreach($json_discom as $discom)
       {
           foreach($discom as $sk=>$discom_value)
           {
               if($discom_value!=NULL){
                   array_push($discom_array,$discom_value);
               }
           }

       }
      return response()->json(['voltage' => $voltage_array, 'discom' => $discom_array],200);
    }
    function generateApprovalrequest($data, $type, $client_id, $reference_id='',$datas){
        $arrayKey = array_keys($data);

        $arrayValue = array_values($data);
        //$keys = array('bill_address_line_2'=>'Address Line 1');

         foreach($data as $key=>$value){
          //dd($key);
           $approvalRequest = New Approvalrequest();
            $approvalRequest->client_id       = $client_id;
            $approvalRequest->attribute_name  = $key;
            $approvalRequest->updated_attribute_value =  $value;
            $approvalRequest->approval_type   = $type;
            $approvalRequest->old_att_value   = isset($datas[$key])?$datas[$key]:'-';
            //$approvalRequest->updated_by      = \Auth::id();
            //$approvalRequest->approved_by      = '';
            $approvalRequest->status          = '0';
            $approvalRequest->reference_id    = $reference_id;
            $approvalRequest->save();
        }

    }
     function generateApprovalrequestbank($data, $type, $client_id, $reference_id='',$datas)
    {
        $apprval_req_pending = Approvalrequest::where('client_id',$client_id)->where('status','0')->where('approval_type','bank')->get();

     
//dd($apprval_req_pending);
        if($apprval_req_pending->count()>0)
        {
          return false;
        }
        else
        {
         $arrayKey = array_keys($data);
         $arrayValue = array_values($data);
           foreach($data as $key=>$value)
           {
              $approvalRequest = new Approvalrequest();
              $approvalRequest->client_id       = $client_id;
              $approvalRequest->attribute_name  = $key;
              $approvalRequest->updated_attribute_value =  $value;
              $approvalRequest->approval_type   = $type;
              $approvalRequest->old_att_value   = isset($datas[$key])?$datas[$key]:'-';
              //$approvalRequest->approved_by      = '';
              $approvalRequest->status          = '0';
              $approvalRequest->reference_id    = $reference_id;
              $approvalRequest->save();
          }
          return true;
        }
    }

    public function barreddetails()
    {
        $client_list=Client::orderBy('id','DESC')->paginate(10);

        return view('ManageClient.barred_client',compact('client_list'));
    }
    public function barredChangeStatus($c_id='',$status_id='')
    {
        $status = Client::find($c_id);
        $status->barred_status = $status_id;
        $status->save();
        return redirect()->back()->with('success','Client status change successfully.');
    }
    public function accountGroupDetails()
    {
        $Clientsdetails = Client::select('barred_status','short_id','crn_no','iex_portfolio','pxil_portfolio','company_name','group_id','group_role','id')->where('barred_status',"1")
        ->where(function($query){
            $query->where('group_role', '!=', 'MainMember','AND')->orWhereNull('group_role');
        })->get()->toArray();

        $get_client_id = Client::all()->where('group_role','Member')->toArray();;
        $role_off = array_column($get_client_id, 'id');


        $Groupuserdetails = Groupusersetting::where('status',0)->get()->toArray();
           // dd($Clientsdetails);
        return view('ManageClient.account_group',compact('Clientsdetails','role_off','Groupuserdetails'));
    }
    public function creategroup(Request $request)
    {
        $clientid = $request->input('clientid');
        $clintdetails = Client::where('id',$clientid)->first();
        $group_name   = $clintdetails['company_name'];
        $user         = Groupusersetting::where('client_id', '=', $clientid)->first();
        if ($user === null) {
            // user doesn't exist
            $usergroupsetting = new Groupusersetting();
            $usergroupsetting->group_name = $group_name;
            $usergroupsetting->client_id  = $clientid;
            $usergroupsetting->status = '0';
            $usergroupsetting->save();
        }
        else
        {
            $usergroupsetting = Groupusersetting::where('client_id',$clientid)->first();
            $usergroupsetting->status = '0';
            $usergroupsetting->update();
        }


        $clientmaster_newusermapping = Client::where('id',$clientid)->first();
        $clientmaster_newusermapping->group_id = $clientid;
        $clientmaster_newusermapping->group_role = "MainMember";
        $clientmaster_newusermapping->save();
    }

    public function addnewusersforgroup(Request $request)
    {
        $clientid     = $request->input('clientid');
        $group_id     = $request->input('group_id');
        $group_name   = $request->input('group_name');
        $clientmaster_newusermapping = Client::where('id',$clientid)->first();
        $clientmaster_newusermapping->group_id = $group_id;
        $clientmaster_newusermapping->group_role = "Member";
        $clientmaster_newusermapping->save();


        return redirect()->back()->with('success', 'your data saved');
    }

    public function deletenewuser_usegroupsetting(Request $request, $clientid=null)
    {
        $clientmaster_newusermapping = Client::where('id',$clientid)->first();
        if($clientmaster_newusermapping != ''){
        $clientmaster_newusermapping->group_id = "Null";
        $clientmaster_newusermapping->group_role = "Null";
        $clientmaster_newusermapping->save();
        }
        return redirect('/agsetting')->with('deletesuccess', 'User Deleted Successfully');
    }

    public function deletegroup(Request $request)
    {
        $group_id = $request->input('group_id');
        $group_role = "Member";
        $Clientsdetails = Client::where('group_id',$group_id, 'AND')
                            ->where('group_role','Member')
                            ->get()
                            ->toArray();
        if(count($Clientsdetails) > 0)
        {
            return response()->json(0);
        }
        else
        {
            $Groupuserdetails = Groupusersetting::where('client_id',$group_id)->first();
            $Groupuserdetails->status = "1";
            $Groupuserdetails->save();

            Client::where('group_id',$group_id)->update(['group_role'=>'']);

            return response()->json(1);
        }
    }
}
