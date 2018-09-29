@extends('theme.layouts.default')
@section('content')

<!-- Order Book HTML Strat -->
  <!-- Header Start -->
  <section class="content-header">
    <h5><label  class="control-label"><u>Bid Confirmation</u></label></h5>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">DEM</a></li>
      <li><a href="#">IEX</a></li>
      <li><a href="#">BID CONFIRMATION</a></li>
      <li><a href="#"><u>UN-SUBMITTED</u></a></li>
    </ol>
  </section>
  <!-- Header End -->
  <!-- Body Start -->
  <section class="content">
     <div class="row">
     <div class="col-xs-12">
     <div class="box">
        <div class="box-body">
           <div class="row">
              <div class="col-md-3">
                 <label class="control-label">Select Date</label>
                 <div class="input-group date">
                    <div class="input-group-addon">
                       <i class="fa fa-calendar"></i>
                    </div>
                    <!-- <input type="text" class="form-control pull-right input-sm" id="datepicker1" name="" id=""> -->
                    <input class="form-control pull-right input-sm" id="date_to" type="text" data-date="12/13/2016" placeholder="To Date" name="to_date">
                 </div>
              </div>
              <div class="col-md-1">
                 <label  class="control-label"></label>
                 <button type="button" class="btn btn-block btn-info btn-xs searchBidDeatils" name="" id="" style="margin-top:6px;">GO</button>
              </div>
           </div>
        </div>
     </div>
     <div class="box">
        <div class="box-body table-responsive">
           <table id="example1" class="table table-bordered table-striped table-hover text-center">
              <thead>
                 <tr>
                    <th class="srno">SR.NO</th>
                    <th>CLIENT NAME</th>
                    <th>PORTFOLIO ID</th>
                    <th>STATUS</th>
                    <th>EMAIL/SMS</th>
                 </tr>
              </thead>
              <tbody>
                @forelse($bidData as $key => $value)
                <tr>
                  <td class="text-center">{{$key+1}}</td>
                  <td class="text-center">{{$value->Client['company_name']}}</td>
                  <td class="text-center">{{$value->Client['iex_portfolio']}}</td>
                  <td class="text-center">UnSubmitted</td>
                  <td class="text-center"><a>Send</a></td>
                </tr>
                @empty
                <tr class="gradeX">
                  <td class="text-center" colspan="5">Data Not Found</td>
                </tr>
                @endforelse
              </tbody>
           </table>
        </div>
     </div>
  </section>

@endsection
