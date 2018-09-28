<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use DB;
class AutoCompleteController extends Controller {

    public function index(){
        return view('autocomplete.index');
   }
    public function autoComplete(Request $request) {
        $term = $request->get('term','');
       // dd($term);

        $ClientmastertempData = DB::table('clients')
            ->selectRaw("id,concat(COALESCE(company_name,''),'[',COALESCE(iex_portfolio,''),']') as value")
            ->where('company_name','LIKE','%'.$term.'%')
            ->where('client_app_status','!=','4')
            ->get();

            // ->selectRaw("client_id,client_master.status as clientstatus,concat(COALESCE(company_name,''),'[',COALESCE(short_id,''),'][',COALESCE(crn_no,''),'][',COALESCE(GROUP_CONCAT(portfolio_id SEPARATOR ']['),''),'][',COALESCE(GROUP_CONCAT(ca_client_id SEPARATOR ']['),''),']') as value")


        $data=array(); $client_id=array();
        foreach ($ClientmastertempData as $client) {
                // $data[]=array('value'=>$client->company_name,'id'=>$client->client_id,'portfolio_id'=>$client->portfolio_id,'short_id'=>$client->short_id,"ca_client_id"=>$client->ca_client_id,"crn_no"=>$client->crn_no);
                $data[]=array('value'=>$client->value,'id'=>$client->id);
        }

        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

}
