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
use Illuminate\Support\Facades\Redirect;



class ClientDeatilsController extends Controller
{
	public function viewlist()
	{
		$clientdata = Client::all()->where('client_app_status','1');

		return view('ManageClient.addclient',compact('clientdata'));
	}

	public function addclient()
	{
        
        
		return view('ManageClient.basicdetails');
	}
	public function saveclient(Request $request){

		$validator = validator::make($request->all(),[

			'company_name' => 'required|max:100',
            'gstin' => 'required|regex:/^[0-9]{2}[A-z]{3}[PCAFHTG][A-z][0-9]{4}[A-z][0-9A-z]{3}$/|max:15',
            'pan' => 'required|regex:/^[A-z]{3}[PCAFHTG][A-z][0-9]{4}[A-z]$/|max:10',
            'short_id' => 'required|max:15',
            'pri_contact_no'=>'required',
            'cin' => 'required|regex:/^[LU][0-9]{5}[A-z]{2}[0-9]{4}[A-z]{3}[0-9]{6}$/|min:21|max:21',
            'email'=>'required|email||max:81',
            'reg_line1' => 'required|max:100',
            'reg_line2' => 'min:0|max:100',
            'reg_country' => 'required',
            'reg_state' => 'required',
            'reg_city' => 'required|regex:/^[A-z]+$/|max:25',
            'reg_pin' => 'required|regex:/^[1-9][0-9]{5}$/',
            'reg_mob' => 'required|regex:/^[0-9]{10}$/',
            'reg_telephone' => 'min:0|max:100',

			]);
		 if($validator->fails())
        {
            
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $client = new Client;
        $client->company_name = $request->input('company_name');
        $client->gstin = $request->input('gstin');
        $client->pan = $request->input('pan');
        $client->short_id = $request->input('short_id');
        $client->email = $request->input('email');
        $client->new_sap = $request->input('new_sap');
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
        $client->rt = $request->input('rt');
        $client->rt1 = $request->input('rt1');
        $client->feeder_name = $request->input('feeder_name');
        $client->feeder_code = $request->input('feeder_code');
        $client->conn_discom = $request->input('conn_discom');
        $client->conn_state = $request->input('conn_state');
        $client->maxm_injection = $request->input('maxm_injection');
        $client->maxm_withdrawal = $request->input('maxm_withdrawal');
        $client->payment = $request->input('payment');
        $client->obligation = $request->input('obligation');
        $client->save();
       
        //$lsatinsertedId = $clien->id;
		return redirect('basicdetails')->with('message', 'Data Save Successfully!');
	}
    public function edit_bankdetails($id='',$eid=''){
        $bank_id=$eid;
        $client_id=$id;
        $get_bank_details = Bank::where('id',$bank_id)->where('status',1)->first();
        $bankdetails = Bank::where('client_id',$client_id)->where('status',1)->get();

        return view('ManageClient.bankdetails',compact('bankdetails','client_id','get_bank_details'));
    }

    public function bankdetails($id){
        $client_id=$id;
       // $bankdetails = Bank::where('client_id',$id)->where('status',1)->get();
        $bankdetails = DB::table('bank')->select('*')->where(function($q) { $q->where('del_status',0)->orwhere('del_status',2); })->where('client_id',$id)->where('status',1)->get();


        return view('ManageClient.bankdetails',compact('bankdetails','client_id'));
    }
    public function add_bankdetails(Request $request){
        // dd();
        // $this->validate($request, [
        //     // 'account_holder_name' => 'required|max:100',
        //     'account_number' => 'required|regex:/^[\w-]*$/|max:20',
        //     'bank_name' => 'required|regex:/^[a-zA-Z ]*$/|max:50',
        //     'branch_name' => 'required|regex:/^[a-z\d\-_\s]+$/i|max:50',
        //     'ifsc_code' => 'required|max:11',
        // ]);
        
        // if($checkaccountnumber){
        //     $validator = Validator::make([], []);
        //     $validator->getMessageBag()->add('account_no', 'Account Number already registered');
        //         return response()->json(['errors'=>$validator->errors()],400);
        // }
        
        $bankdetail = new BankTemp();
       $bankdetail->client_id = $request->client_id;
        $bankdetail->account_number = $request->input('account_number');
        $bankdetail->bank_name = $request->input('bank_name');
        $bankdetail->branch_name = $request->input('branch_name');
        $bankdetail->ifsc = $request->input('ifsc');
        $bankdetail->virtual_account_number = $request->input('virtual_account_number');
        //dd(3);
        $bankdetail->save();
        return redirect()->back()->with('message','Detail added successfully and sent to Approver');
        
    }

    public function update_bankdetails(Request $request ,$bank_detail_id)
    {
        //  $this->validate($request, [
        //     // 'account_holder_name' => 'required|max:100',
        //     'account_number' => 'required|max:20',
        //     'bank_name' => 'required|max:50',
        //     'branch_name' => 'required|max:50',
        //     'ifsc' => 'required|max:11',
        // ]);
        //$checkaccountnumber = Bank::where(['account_number'=>$request->input('account_number'),'status'=>1])->where('id','!=',$bank_detail_id)->get()->toArray();



        // if($checkaccountnumber){
        //       $validator = Validator::make([], []);
        //       $validator->getMessageBag()->add('account_no', 'Account Number already registered');
        //         return response()->json(['errors'=>$validator->errors()],400);
        // }
        //Old Logic
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
        $dataArray['ifsc_code'] = $request->input('ifsc_code');
        $dataArray['virtual_account_number'] = $request->input('virtual_account_number');
        $result=array_diff($dataArray,$bankdetailtemp);

        $this->generateApprovalrequest($result, 'bank', $client_id, $bank_detail_id,$datas);

        return redirect()->route('bankdetails', ['id' => $client_id])->with('message','Detail added successfully and sent to Approver');
    }


    public function delete_bankdetails(Request $request ,$bank_detail_id)
    {
        $client_id=$request->input('client_id');
        Bank::destroy($bank_detail_id);

        return redirect()->back()->with('Bank detail request successfully and sent to approver');
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

    public function barreddetails()
    {
        dd('dassa');
    }

}