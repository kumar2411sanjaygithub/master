@extends('theme.layouts.default')
@section('content')
{!! Html::style('autocomplete/jquery-ui.css') !!}
{{ Html::script('autocomplete/jquery-1.10.2.js') }}
{{ Html::script('autocomplete/jquery-ui.js') }}

<!-- Order Book HTML Strat -->
  <!-- Header Start -->
  <section class="content-header">
    <h5><label  class="control-label"><u>ORDER BOOK</u></label></h5>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">DEM</a></li>
      <li><a href="#">IEX</a></li>
      <li><a href="#"><u>ORDER BOOK</u></a></li>
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
              <div class="col-md-5">
                  <label class="control-label">SEARCH CLIENT</label>
                 <div class="input-group input-group-sm">
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">

                    <input type="text" class="form-control search_text" name="search_text" placeholder="Search.." name="" id="">
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat" name="" id=""> <span class="glyphicon glyphicon-search"></span></button>
                    </span>
                 </div>
              </div>
              <div class="col-md-3">
                 <label  class="control-label">START DATE</label><span class="text-danger"><strong>*</strong></span>
                 <div class="input-group date">
                    <div class="input-group-addon">
                       <i class="fa fa-calendar"></i>
                    </div>
                    <!-- <input type="text" class="form-control pull-right input-sm" id="datepicker" name="" id=""> -->
                    <input class="form-control pull-right input-sm" id="date_from" type="text" data-date="12/13/2016" placeholder="From Date" name="from_date">
                 </div>
              </div>
              <div class="col-md-3">
                 <label  class="control-label">END DATE</label><span class="text-danger"><strong>*</strong></span>
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
                    <th>BID REFERNCE NO.</th>
                    <th>DATE</th>
                    <th>CLIENT NAME</th>
                    <th>PORTFOLIO ID</th>
                    <th>SINGLE BID</th>
                    <th>BLOCK BID</th>
                    <th>ORDER PLACED BY</th>
                 </tr>
              </thead>
              <tbody id="order-list">
                <tr class="gradeX">
                  <td class="text-center" colspan="8">Data Not Found</td>
                </tr>
              </tbody>
           </table>
        </div>
     </div>
     <div id="bid-details" class="modal fade" role="dialog">
       <div class="modal-dialog">
       </div>
     </div>
  </section>
  <!-- Body End -->
<!-- Order Book HTML End -->
<script>
        src = "{{ route('searchajax') }}";
         $(".search_text").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: src,
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function(data) {
                       response(data);
                    }
                });
            },
            select: function (event, ui) {
              $("#user_id").val(ui.item.id); // display the selected text
            },
            minLength: 1,
        });
    </script>

{{ Html::script('js/orderbook/orderbook.js') }}
@endsection
