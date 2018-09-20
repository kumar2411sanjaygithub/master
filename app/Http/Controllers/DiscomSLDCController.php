<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\StateDiscom;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class DiscomSLDCController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $stateDiscomData=StateDiscom::orderBy('id','desc')->paginate(10);
       $state_arr=StateDiscom::orderBy('state','asc')->get()->toArray();
       $inset_stateDiscom=array_column($state_arr, 'state');

        return view('trader-setting.state_discom',compact('stateDiscomData','inset_stateDiscom'));
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
        $this->validate($request, [
            'state' => 'required',
        ]);

        $blk_sldc=array();
        foreach(request('sldc') as $k=>$sldc_name)
        {
            $kk=$k+1;
            $new_array=array($kk=>$sldc_name);
            array_push($blk_sldc,$new_array);
        }
        $json_sldc=json_encode($blk_sldc);

        $blk_discom=array();
        foreach(request('discom') as $key=>$discom_name)
        {
            $kkey=$key+1;
            $discom_array=array($kkey=>$discom_name);
            array_push($blk_discom,$discom_array);
        }
        $json_discom=json_encode($blk_discom);

        $blk_voltage=array();
        foreach(request('voltage') as $keys=>$voltage_name)
        {
            $kkeys=$keys+1;
            $vol_array=array($kkeys=>$voltage_name);
            array_push($blk_voltage,$vol_array);
        }
        $json_voltage=json_encode($blk_voltage);


        $statediscom = new StateDiscom;
        $statediscom->state = request('state');
        $statediscom->sldc =$json_sldc;
        $statediscom->discom = $json_discom;
        $statediscom->voltage =$json_voltage;                               
        $statediscom->save();  

        return redirect()->back()->with('success', 'Data Added Successfully.');
    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $get_state_discom = StateDiscom::where('id',$id)->first();
        $stateDiscomData=StateDiscom::orderBy('state','asc')->paginate(10);

        return view('trader-setting.state_discom',compact('stateDiscomData','get_state_discom'));
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
        $blk_sldc=array();
        foreach(request('sldc') as $k=>$sldc_name)
        {
            $kk=$k+1;
            $new_array=array($kk=>$sldc_name);
            array_push($blk_sldc,$new_array);
        }
        $json_sldc=json_encode($blk_sldc);

        $blk_discom=array();
        foreach(request('discom') as $key=>$discom_name)
        {
            $kkey=$key+1;
            $discom_array=array($kkey=>$discom_name);
            array_push($blk_discom,$discom_array);
        }
        $json_discom=json_encode($blk_discom);

        $blk_voltage=array();
        foreach(request('voltage') as $keys=>$voltage_name)
        {
            $kkeys=$keys+1;
            $vol_array=array($kkeys=>$voltage_name);
            array_push($blk_voltage,$vol_array);
        }
        $json_voltage=json_encode($blk_voltage);

        $statediscom = StateDiscom::find($id);
        $statediscom->sldc = $json_sldc;
        $statediscom->discom = $json_discom;
        $statediscom->voltage = $json_voltage;                               
        $statediscom->save();   

        return redirect()->route('discom-sldc-state.index')->with('success', 'Data Updated Successfully.');
    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $del = StateDiscom::findOrFail($id);
        $del->delete();

        return redirect()->route('discom-sldc-state.index')->with('success', 'Data Deleted Successfully.');
    }
    
    public function delsldc($id='',$eid='')
    {
        $get_state_discom = StateDiscom::where('id',$id)->first();
        $json_sldc=json_decode($get_state_discom->sldc);

        $sldc_array=array();
        foreach($json_sldc as $sldc)
        {
            foreach($sldc as $sk=>$sldc_value)
            {
                if($sk!=$eid){
                    $new_array=array($sk=>$sldc_value);
                    array_push($sldc_array,$new_array);
                }
            }
            
        }

        $json_sldc=json_encode($sldc_array);

        $save_sldc = StateDiscom::findOrFail($id);
        $save_sldc->sldc =$json_sldc;
        $save_sldc->save();

        return redirect()->back()->with('success', 'SLDC Deleted Successfully.');
    }

    public function deldiscom($id='',$eid='')
    {
        $get_state_discom = StateDiscom::where('id',$id)->first();
        $json_discom=json_decode($get_state_discom->discom);

        $discom_array=array();
        foreach($json_discom as $discom)
        {
            foreach($discom as $sk=>$discom_value)
            {
                if($sk!=$eid){
                    $new_array=array($sk=>$discom_value);
                    array_push($discom_array,$new_array);
                }
            }
            
        }

        $json_discom=json_encode($discom_array);

        $save_discom = StateDiscom::findOrFail($id);
        $save_discom->discom = $json_discom;
        $save_discom->save();

        return redirect()->back()->with('success', 'DISCOM Deleted Successfully.');
    }
    public function delvoltage($id='',$eid='')
    {
        $get_state_voltage = StateDiscom::where('id',$id)->first();
        $json_voltage=json_decode($get_state_voltage->voltage);

        $voltage_array=array();
        foreach($json_voltage as $voltage)
        {
            foreach($voltage as $sk=>$voltage_value)
            {
                if($sk!=$eid){
                    $new_array=array($sk=>$voltage_value);
                    array_push($voltage_array,$new_array);
                }
            }
            
        }

        $json_voltage=json_encode($voltage_array);

        $save_voltage = StateDiscom::findOrFail($id);
        $save_voltage->voltage = $json_voltage;
        $save_voltage->save();

        return redirect()->back()->with('success', 'Voltage Deleted Successfully.');
    }
}
