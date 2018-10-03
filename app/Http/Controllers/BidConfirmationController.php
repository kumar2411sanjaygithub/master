<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\NoBid;
use App\BidDeleted;
use App\Unsubmitted;
use App\PlaceBid;
use App\Client;
use Carbon\Carbon;
use Datatables;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Response;
class BidConfirmationController extends Controller
{
    public function viewunsubmittedbid()
    {
        $bidData    = PlaceBid::where('status', 0)->where('deleted_at', NULL)->paginate(15);
        $clients = Client::select('id','company_name')->get();
        return view('dam.iex.bidconfirmation.unsubmitted', compact('bidData','clients'));
    }
    public function deletedbid()
    {
        $bidData    = PlaceBid::onlyTrashed()->paginate(16);
        $clients = Client::select('id','company_name')->get();
        return view('dam.iex.bidconfirmation.biddeleted', compact('bidData','clients'));
    }
    public function nobid()
    {
      return view('dam.iex.bidconfirmation.nobid');
    }

}
