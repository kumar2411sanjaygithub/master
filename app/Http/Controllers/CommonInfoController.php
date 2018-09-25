<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\CommonInfo;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Response;
class CommonInfoController extends Controller
{

  public function view()
    {

        $commonData = CommonInfo::select('*')->where('id', 1)->first();

        return view('commoninfo.commoninfo',compact('commonData'));
    }

    public function updatecommondata(Request $request)
    {
        $this->validate($request, [
            'saac_code' => 'required',
            'tm_out_dues' => 'required'
        ]);
        $id = 1;
        $common = CommonInfo::find($id);
        $common->saac_code = $request->input('saac_code');
        $common->tm_out_dues = $request->input('tm_out_dues');
        $common->save();
        return redirect()->route('commonview')->with('updatemsg', 'Data Update Successfully!');
    }

}
