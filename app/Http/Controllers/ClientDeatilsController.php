<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
// use App\Role;
// use App\Department;
use Carbon\Carbon;
use DB;
use App\Client;
// use App\Employeeupdatestatus;
use Validator;
use Illuminate\Support\Facades\Redirect;



class ClientDeatilsController extends Controller
{
	public function viewlist()
	{
		$clientdata = Client::all()->where('client_app_status','1');
		return view('ManageClient.addclient');
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

}