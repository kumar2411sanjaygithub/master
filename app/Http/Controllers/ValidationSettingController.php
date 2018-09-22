<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Validationsetting;
use App\Client;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Response;
// Manage officials module created by AKS

class ValidationSettingController extends Controller
{


    //*********************Validation Setting code start here**********

     /**
     * validationsetting Data is Save here Coding Start.
     * @param  \Illuminate\Http\Request  $request
     * @return \Success Message
     */
    public function savevalidationsetting(Request $request)
    {
        $validator = $this->validate($request, [
            'user_id' => 'required',
        ],
        [
            'user_id' => 'Please Select User',
        ]);

        $user = Validationsetting::where('user_id', '=', Input::get('user_id'))->take(1)->get();

        if(count($user) > 0)
        {
            $user[0]->noc = $request->input('noc');
            $user[0]->ppa = $request->input('ppa');
            $user[0]->exchange = $request->input('exchange');
            $user[0]->psm = $request->input('psm');
            $user[0]->save();
            return redirect()->back()->with('message', 'Data Upadated Successfully!');
        }
       else{
            $validationsettingtempt = new Validationsetting();
            $validationsettingtempt->user_id = $request->input('user_id');
            $validationsettingtempt->noc = $request->input('noc');
            $validationsettingtempt->ppa = $request->input('ppa');
            $validationsettingtempt->exchange = $request->input('exchange');
            $validationsettingtempt->psm = $request->input('psm');
            $validationsettingtempt->save();
            return redirect()->back()->with('message', 'Data Save Successfully!');
       }
    }
     /**
     * validationsetting Data is Save here Coding End.
     * validationsetting Data is View here Coding Start.
     * @return \Data for view
     */
    public function validationsettingview()
    {
        $validationsettingData = Validationsetting::all();
        $users = Client::select('id','company_name','short_id','crn_no')->get();
        // print_r($users->toArray());
        return view('validationSetting.validationSetting',compact('validationsettingData','users'));
    }
    /**
     * validationsetting Data is View here Coding End.
     * validationsetting Data is View for Edit here Coding Start.
     * @param  int  $id
     * @return \Data for edit
     */
    public function editvalidationsetting($id)
    {
        // $validationsettingData = Validationsetting::select('*')->where('id', $id)->first();
        $validationsettingData = Validationsetting::find($id);
        // dd($validationsettingData->client_master_temp['company_name']);
        $users = Client::select('id','company_name','short_id','crn_no')->get();
        return view('validationSetting.editValidationSetting',compact('validationsettingData','users'));
    }
    /**
     * validationsetting Data is View for Edit here Coding End.
     * validationsetting Data is Update here Coding Start.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Success Message
     */
    public function updateValidationSetting(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);
        $validationsettingtempttemp = Validationsetting::find($id);
        $validationsettingtempttemp->user_id = $request->input('user_id');
        $validationsettingtempttemp->noc = $request->input('noc');
        $validationsettingtempttemp->ppa = $request->input('ppa');
        $validationsettingtempttemp->exchange = $request->input('exchange');
        $validationsettingtempttemp->psm = $request->input('psm');
        $validationsettingtempttemp->save();
        return redirect()->route('validationSetting')->with('message', 'Data Update Successfully!');
    }
    /**
     * validationsetting Data is Update here Coding End.
     * validationsetting Data is Delete here Coding Start.
     * @param  int  $id
     * @return \Success Message
     */
    public function deletevalidation($id)
    {
        Validationsetting::destroy($id);
        return redirect()->back()->with('delmsg', 'Data Deleted Successfully!');
    }

}
