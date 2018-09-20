<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Tmdetails;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Response;
class TmNameController extends Controller
{
public function view()
  {
    $tmData = Tmdetails::all();
    return view('tm.tmsetting',compact('tmData'));
  }

public function update(Request $request){
    if(count(@$request->segment) > 0){
      foreach ($request->segment as $value) {
          $gst = "gst_".$value;
          $tm = "tm_".$value;
          $tmData = Tmdetails::findOrFail($value);
          $tmData->tmname = $request->$tm;
          $tmData->gst = $request->$gst;
          $tmData->save();
          print_r($tmData->toArray());
      }
    }
    return redirect()->route('tmnameview')->with('addmsg', 'Updated Successfully!');
}

}
