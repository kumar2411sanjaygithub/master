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
        $blk_add=array();
        foreach(request('sldc') as $k=>$sldc_name)
        {
            $kk=$k+1;
            $new_array=array($kk=>$sldc_name);
            array_push($blk_sldc,$new_array);

            $new_array_add=array($kk=>$request->sldc_add[$k]);
            array_push($blk_add,$new_array_add);
            //print_r($new_array_add);
        }
        $json_sldc=json_encode($blk_sldc);
        $json_add=json_encode($blk_add);

         //dd($json_add);   

        $blk_discom=array();
        $blk_discom_add=array();
        foreach(request('discom') as $key=>$discom_name)
        {
            $kkey=$key+1;
            $discom_array=array($kkey=>$discom_name);
            array_push($blk_discom,$discom_array);

            $discom_array_add=array($kkey=>$request->discom_add[$key]);
            array_push($blk_discom_add,$discom_array_add);

        }
        $json_discom=json_encode($blk_discom);
        $json_discom_add=json_encode($blk_discom_add);

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
        $statediscom->sldc_address =$json_add;
        $statediscom->discom = $json_discom;
        $statediscom->discom_address =$json_discom_add;
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
        $blk_add=array();
        $i1=0;$i2=0;$i3=0;
        foreach(request('sldc') as $k=>$sldc_name)
        {
            if($sldc_name!='')
            {
                $kk=$i1+1;
                echo $kk;
                $new_array=array($kk=>$sldc_name);
                array_push($blk_sldc,$new_array);
        
                $new_array_add=array($kk=>$request->sldc_add[$k]);
                array_push($blk_add,$new_array_add);


                $i1++;
            }
        }
        $json_sldc=json_encode($blk_sldc);
        $json_add=json_encode($blk_add);

        $blk_discom=array();
        $blk_discom_add=array();

        foreach(request('discom') as $key=>$discom_name)
        {   
            if($discom_name!='')
            {
                $kkey=$i2+1;
                $discom_array=array($kkey=>$discom_name);
                array_push($blk_discom,$discom_array);

               $discom_array_add=array($kkey=>$request->discom_add[$key]);
                array_push($blk_discom_add,$discom_array_add);


                $i2++;
            }    
            
        }
        $json_discom=json_encode($blk_discom);
        $json_discom_add=json_encode($blk_discom_add);

        $blk_voltage=array();
        foreach(request('voltage') as $keys=>$voltage_name)
        {
            if($voltage_name!='')
            {
                $kkeys=$i3+1;
                $vol_array=array($kkeys=>$voltage_name);
                array_push($blk_voltage,$vol_array);
                $i3++;
            }
            
        }
        $json_voltage=json_encode($blk_voltage);

        $statediscom = StateDiscom::find($id);
        $statediscom->sldc = $json_sldc;
        $statediscom->discom = $json_discom;
        $statediscom->sldc_address =$json_add;
        $statediscom->discom_address =$json_discom_add;
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
        $json_sldc_add=json_decode($get_state_discom->sldc_address);

        $sldc_array=array();
        $blk_add=array();        
        foreach($json_sldc as $s=>$sldc)
        {
            foreach($sldc as $sk=>$sldc_value)
            {
                if($sk!=$eid){
                    $new_array=array($sk=>$sldc_value);
                    array_push($sldc_array,$new_array);
                }
            }
            
        }

        foreach($json_sldc_add as $sd=>$sldc_add)
        {
            foreach($sldc_add as $sk=>$sldc_value_add)
            {
                if($sk!=$eid){

                    $new_array_add=array($sk=>$sldc_value_add);
                    array_push($blk_add,$new_array_add);
                }
            }
            
        }

        $json_sldc=json_encode($sldc_array);
        $json_add=json_encode($blk_add);
        $save_sldc = StateDiscom::findOrFail($id);
        $save_sldc->sldc =$json_sldc;
        $save_sldc->sldc_address =$json_add;        
        $save_sldc->save();

        return redirect()->back()->with('success', 'SLDC Deleted Successfully.');
    }

    public function deldiscom($id='',$eid='')
    {
        $get_state_discom = StateDiscom::where('id',$id)->first();
        $json_discom=json_decode($get_state_discom->discom);
        $json_discom_add=json_decode($get_state_discom->discom_address);

        $discom_array=array();
        $discom_array_val=array();
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

        foreach($json_discom_add as $discom_add)
        {
            foreach($discom_add as $sk=>$discom_value_add)
            {
                if($sk!=$eid){
                    $new_array_dis=array($sk=>$discom_value_add);
                    array_push($discom_array_val,$new_array_dis);
                }
            }
            
        }

        $json_discom=json_encode($discom_array);
        $json_discom_json=json_encode($discom_array_val);

        $save_discom = StateDiscom::findOrFail($id);
        $save_discom->discom = $json_discom;
        $save_discom->discom_address =$json_discom_json;        
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
