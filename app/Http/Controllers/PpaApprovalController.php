<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\PpaApprovedetails;
use App\Client;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Response;



class PpaApprovalController extends Controller
{
    public function approveppa1()
    {
      return view('ApprovalRequest.PPA.aprovePpa');
    }
    public function approveppa()
    {
      $ppaData = PpaApprovedetails::where('status','0')->paginate(10);
      $clientData = Client::all();
      return view('ApprovalRequest.PPA.aprovePpa',compact('ppaData','clientData'));
    }
}
