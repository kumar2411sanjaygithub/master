@extends('theme.layouts.default')
@section('content_head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection
@section('content')

<!-- Order Book HTML Strat -->
  <!-- Header Start -->
  <section class="content-header">
    <h5><label  class="control-label"><u>BID DELETED</u></label></h5>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">DEM</a></li>
      <li><a href="#">IEX</a></li>
      <li><a href="#">BID CONFIRMATION</a></li>
      <li><a href="#"><u>BID DELETED</u></a></li>
    </ol>
  </section>
  <!-- Header End -->
  <!-- Body Start -->
  <section class="content">
     <div class="row">

           <!-- <div class="row">
              <div class="col-md-3">
                 <label class="control-label">Select Date</label>
                 <div class="input-group date">
                    <div class="input-group-addon">
                       <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control pull-right input-sm datepicker" id="date" type="text" data-date="12/13/2016" placeholder="To Date" name="to_date">
                 </div>
              </div>
              <div class="col-md-1">
                 <label  class="control-label"></label>
                 <button type="button" class="btn btn-block btn-info btn-xs searchBidDeatils" name="" id="" style="margin-top:6px;">GO</button>
              </div>
           </div> -->
               <div class="col-md-2" >
               <div class="input-group input-group-sm">
                 <input type="text" id="search" class="form-control" placeholder="SEARCH">
                     <span class="input-group-btn">
                       <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                     </span>
               </div>
             </div>
          </div>

     <div class="box mt3">
        <div class="box-body table-responsive">
           <table id="example1" class="table table-bordered table-striped table-hover text-center">
              <thead>
                 <tr>
                    <th class="srno">SR.NO</th>
                    <th>CLIENT NAME</th>
                    <th>PORTFOLIO ID</th>
                    <th>STATUS</th>
                    <th>Deleted Time</th>
                    <th>EMAIL/SMS</th>
                 </tr>
              </thead>
              <tbody>
                @forelse($bidData as $key => $value)
                <tr>
                  <td class="text-center">{{$key+1}}</td>
                  <td class="text-center">{{$value->Client['company_name']}}</td>
                  <td class="text-center">{{$value->Client['iex_portfolio']}}</td>
                  <td class="text-center">Deleted</td>
                  <td class="text-center">{{$value->deleted_at}}</td>
                  <td class="text-center"><a>Re-Send</a></td>
                </tr>
                @empty
                <tr class="gradeX">
                  <td class="text-center" colspan="6">Data Not Found</td>
                </tr>
                @endforelse
              </tbody>
           </table>
           {{ $bidData->links() }}
        </div>
     </div>
  </section>
<script>
$('.datepicker').datepicker({
  autoclose: true,
   format: 'yyyy-mm-dd'
});
</script>
<script>
  $("#search").keyup(function () {
      var value = this.value.toLowerCase().trim();

      $("table tr").each(function (index) {
          if (!index) return;
          $(this).find("td").each(function () {
              var id = $(this).text().toLowerCase().trim();
              var not_found = (id.indexOf(value) == -1);
              $(this).closest('tr').toggle(!not_found);
              return not_found;
          });
      });
  });
</script>
@endsection
