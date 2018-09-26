@extends('theme.layouts.default')

@section('content')
{!! Html::style('js/newbid/index.css') !!}
{!! Html::style('autocomplete/jquery-ui.css') !!}
{{ Html::script('autocomplete/jquery-1.10.2.js') }}
{{ Html::script('autocomplete/jquery-ui.js') }}
<section>
<style>
  .close{line-height: 0.9;}
</style>
  <div class="col-md-12">
    <div class="col-md-3 mt7">
  <h5><label  class="control-label"><u>PLACE BID</u></label></h5>
</div>
<div class="col-md-5 mt7">
  <span class="fs15 bidtime">  @php  date_default_timezone_set("Asia/Kolkata"); @endphp  <span class="bidtest">Bidding Time Left For Delivery Date:</span> <b class="text-info available-date-for-bidding"> @if(strtotime($bidallowedperiod)>=strtotime(date('H:i')))  @php $i=0; $date=date("d/m/Y", strtotime(date("Y-m-d") . ' + 1 days')); @endphp {{ $date  }}  @else @php $i=1; $date= date("d/m/Y", strtotime(date("Y-m-d") . ' + 2 days')) @endphp {{ $date }}    @endif </b><b id="time"></b> &nbsp;  <b class="text-danger"><span id='time-left' style="display:none"> {{ $bidallowedperiod }} </span> </span></b>
</div>
<div class="col-md-4">
  <section class="content-header">
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
    <li><a href="#">DAM</a></li>
    <li><a href="#">IEX</a></li>
    <li><a href="active">PLACE BID</a></li>
  </ol>
</section>
</div>
</div>

  <div class="tab-content text-center placebidtab" id="myTabContent">
    <!-- POWER Tab Start  -->

    <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
          <div class="panel-heading topheading mr10 top-head1 p0">
            <!-- <b>PLACE BID</b> -->
            <div id="timer" class="pull-right hidden">
              <div id="seconds" class="col-md-2 pull-right"></div>
              <div id="minutes" class="col-md-2 pull-right"></div>
              <div id="hours" class="col-md-2 pull-right"></div>
            </div>
            <!-- <span class="pull-right fs15 bidtime">  @php  date_default_timezone_set("Asia/Kolkata"); @endphp  Bidding Time Left For Delivery Date: <b class="text-info available-date-for-bidding"> @if(strtotime($bidallowedperiod)>=strtotime(date('H:i')))  @php $i=0; $date=date("d/m/Y", strtotime(date("Y-m-d") . ' + 1 days')); @endphp {{ $date  }}  @else @php $i=1; $date= date("d/m/Y", strtotime(date("Y-m-d") . ' + 2 days')) @endphp {{ $date }}    @endif </b><b id="time"></b> &nbsp;  <b class="text-danger"><span id='time-left' style="display:none"> {{ $bidallowedperiod }} </span> </span></b> -->
            <span id="day-left" class="hidden">
              @php  date_default_timezone_set("Asia/Kolkata"); @endphp @if(strtotime($bidallowedperiod)>=strtotime(date('H:i')))  @php $i=0; $date=date("M d, Y", strtotime(date("Y-m-d") . ' + 1 days')); @endphp {{ $date  }}  @else @php $i=1; $date= date("M d, Y", strtotime(date("Y-m-d") . ' + 2 days')) @endphp {{ $date }}  @endif
            </span>
          </div>
        </div>
        </div>
      </div>
      <div class="col-md-12 iextab">
        <div class="col-md-12 box">
        <div class="col-md-8 mt5 plr0">
          <div class="container-lg">
            <div class="panel panel-default">
             <div id="message">
               @if($errors->any())
               <div class="alert alert-danger alert-dismissable" style="margin-top:5px">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  @foreach($errors->all() as $err)
                    <li> {{ $err }} </li>
                  @endforeach
               </div>
               @endif
               @if (\Session::has('success'))
                <div class="alert alert-success  alert-dismissable" style="margin-top:5px" id="successMessage">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  <li>{!! \Session::get('success') !!}</li>
              </div>
              @endif
             </div>
              <div class="panel-body np">
                <div>
                   <div class="tab-content navsb">
                    <!-- main bid form start -->
                    @include("dam.iex.placebid.mainform")
                    <!-- main bid form end -->
                    <!-- preview Bid start-->

                    <!-- preview Bid end-->
                  </div>
                </div>
            </div>
            </div>
          </div>

          <!-- place bid form start -->

          <!-- place bid form end -->
            <!-- addbid form code start -->
            @include("dam.iex.placebid.placebidform")
            @include("dam.iex.placebid.editplacebid")
            <!-- addbid form code end -->
          <div class="card mlr5 np mt-20 recordtable" id="show-new-bid-form">
            <div class="row p5">
              <div class="col-md-12 mr20 bid-modifier-buttons">
                <button type="button"  class="btn btn-xs btn-raised btn-info pull-right mr5 delete-all-bid">
                  <span class="rows_selected" id="delete_all">Delete</span>
                </button>
                <button type="button" class="btn btn-xs btn-raised btn-info pull-right mr5 submit-all-bid" id="confirm_place_bid">
                  <span class="" >Submit Bid</span>
                </button>

              </div>
            </div>
            <div class="card-body np table-responsive recordtable table-colored">
              <table class="table-datatable table table-striped table-hover" id="" >
                <thead class="tablehead">
                  <tr>
                    <th class="text-center">
                      <label class="mda-checkbox">
                        <input type="checkbox" class="checked_all"><em class="bg-blue-500"></em>
                      </label>
                    </th>
                    <th class="text-center">Bidding Type</th>
                    <th class="text-center">Trade Type</th>
                    <th colspan="2" class="text-center">Time Slot</th>
                    <th class="text-center">Bid(MW)</th>
                    <th class="text-center">Price(Rs)</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody class="show-new-bid">
                 <tr>
                  <td colspan="7">
                    <b class="text-center">Record Not Found</b>
                  </td>
                 </tr>
                </tbody>
              </table>
            </div>
            <div id="biddatarecord" style="padding-top:20px"></div>
          </div>
        </div>
          <!-- upload excel code modal start -->

          <div id="uploadexcel" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
              <!-- Modal content-->
              <div class="modal-content">
                <form action="{{ url('uploadbidteamplateexcel') }}" method="post" enctype='multipart/form-data' id="upload-bid-form">
                  {{ csrf_field() }}
                <div class="modal-header bg-basic">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title"><u><label>Upload file to place bid</label></u></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="mda-form-group float-label">
                          <input onchange="checkfile(this);" type="file" name="uploadedexcel" id="uploadex" class="form-control" style="padding: 3px 0px;">
                        </div>
                    </div>
                    <div class="loading" style="display:none">
                      <img src="{{ asset('img/loading.gif') }}" height="33px" width="33">
                    </div>
                    <div class="col-md-6">
                        <div class="mda-form-group float-label">
                          <label class='mt10'>Please select only .xlsx,.xls</label>
                        </div>
                    </div>

                    <div class="col-md-12">

                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="clearfix"></div>
                  <div class="col-md-6">
                    <input type="submit" class="btn btn-raised btn-primary pull-right btn-xs" id="sub" value="Submit">
                  </div>
                  <div class="col-md-6">
                    <input type="button" value="Close" data-dismiss="modal" class="btn-xs btn btn-raised btn-danger pull-left">
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
          <!-- upload excel code end -->

          <!-- Confirm & Place bid modal code modal start -->
          <div id="confirmmodal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Your Internal order reference number is <span class="text-primary">236454876637</span></label><br>
                      <label><b>Status:</b> Sent to Exchange</label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="clearfix"></div>
                  <div class="col-md-6">
                    <a href="order_book.php"><input type="submit" class="btn btn-raised btn-primary pull-right" value="View Order"></a>
                  </div>
                  <div class="col-md-6">
                    <input type="button" value="Close" data-dismiss="modal" class="btn btn-raised btn-danger pull-left">
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- Confirm & Place bid modal code end -->
        <div class="col-md-4 mt5 pr0">
          <!-- <div class="panel-group" id="accordion">
            <div class="panel-heading tabhead"><b>TOTAL BID DETAILS</b></div>
            <div class="panel-body previous_bids">
              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading delivery_date bids" id="headingOne" role="tab">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">DELIVERY DATE <span id="set_delivery_date"></span>
                        <span class=" clndr pull-right" data-pack="default"></span>
                      </a>
                    </h4>
                  </div>
                  <div class="panel-collapse collapse in" id="collapseOne1" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body np nm">
                      <label class="text-info">IEX || Single</label>
                      <img style="cursor: pointer;" src="/img/assets/edit.svg" bid-type="single" class="edit-bid-data" set-delivery-date="" height="18px" width="22px">
                      <div class="dashed-borderd-table">
                        <table class="table table-striped table-sm bid-status">
                          <thead class="tablehead">
                            <tr>
                              <th class="text-center">From</th>
                              <th class="text-center">To</th>
                              <th class="text-center">Quantum</th>
                              <th class="text-center">Rate</th>
                            </tr>
                          </thead>
                          <tbody id="single-bid-data">

                          </tbody>
                        </table>
                      </div>
                      <label class="text-info">IEX || Block</label>
                      <img style="cursor: pointer;" src="/img/assets/edit.svg" bid-type="block" set-delivery-date="" class="edit-bid-data" height="18px" width="22px">
                      <div class="dashed-borderd-table">
                        <table class="table table-striped table-sm bid-status">
                            <thead class="tablehead">
                              <tr>
                                <th class="text-center">From</th>
                                <th class="text-center">To</th>
                                <th class="text-center">Quantum</th>
                                <th class="text-center">Rate</th>
                              </tr>
                            </thead>
                            <tbody id="block-bid-data">

                            </tbody>
                        </table>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div> -->

        <div class="panel bds navsbs" id="panelDemo13" style="border:1px solid #ddd">
            <div class="panel-heading tabhead text-center" style="text-align:center;font-size:14px"><b class="text-center">TOTAL BID DETAILS</b></div>
            <div class="panel-body previous_bids pt0">
              <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="fs12">DELIVERY DATE</a>
                  </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <label class="text-info">IEX || Single</label>
                    <img style="cursor: pointer;" src="/img/assets/edit.svg" bid-type="single" class="edit-bid-data" set-delivery-date="" height="18px" width="22px">
                    <div class="dashed-borderd-table">
                      <table class="table table-striped table-sm bid-status">
                        <thead class="tablehead">
                          <tr>
                            <th class="text-center">From</th>
                            <th class="text-center">To</th>
                            <th class="text-center">Quantum</th>
                            <th class="text-center">Rate</th>
                          </tr>
                        </thead>
                        <tbody id="single-bid-data">

                        </tbody>
                      </table>
                    </div>
                    <label class="text-info">IEX || Block</label>
                    <img style="cursor: pointer;" src="/img/assets/edit.svg" bid-type="block" set-delivery-date="" class="edit-bid-data" height="18px" width="22px">
                    <div class="dashed-borderd-table">
                      <table class="table table-striped table-sm bid-status">
                          <thead class="tablehead">
                            <tr>
                              <th class="text-center">From</th>
                              <th class="text-center">To</th>
                              <th class="text-center">Quantum</th>
                              <th class="text-center">Rate</th>
                            </tr>
                          </thead>
                          <tbody id="block-bid-data">

                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>


        </div>
    </div>
      </div>
    </div>
      <div class="col-md-12 pxiltab">
        <h1 class="text-center">Under Proceed</h1>
      </div>
    </div>
    <!-- POWER Tab End -->
    <!-- REC Tab Satart -->
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <div class="card mt10">
        <div class="card-body mt10">
            <img src="img/ok.svg" height="255px" width="255px">
            <h5>Currently we're are working on this page</h5>
            <h5>We will come soon be there</h5>
            <h5>stay tuned !</h5>
        </div>
      </div>
    </div>
    <!-- REC Tab End -->
    <!-- ESCERT Tab Start -->
    <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
      <div class="card mt10">
        <div class="card-body mt10">
          <img src="img/ok.svg" height="255px" width="255px">
          <h5>Currently we're are working on this page</h5>
          <h5>We will come soon be there</h5>
          <h5>stay tuned !</h5>
        </div>
      </div>
    </div>
    <!-- ESCERT Tab End -->
  </div>
 <form action="{{ url('downloadbidteamplateexcel') }}" class="hidden" id="downloadtemplteform" method="post">
 <div class="modal-body">
   {{ csrf_field() }}
   <input type="hidden" name="userselected" id="userselected" value="Null">
   <input type="hidden" name="deliverydate" id="deliverydate" value="Null">
   <input type="hidden" name="exchange_type" id="exchange_type" value="Null">

     <br>
 </div>
 <!-- <input type="submit" id="submit-excel-templte-form" class="btn btn-info pull-right"  value="download excel"> -->
 </form>

  <div class="clearfix"></div>
</section>
{{ Html::script('js/newbid/newbid.js') }}
<script>

jQuery(document).ready(function(){
  jQuery("#message").fadeOut(6000);
});

jQuery(document).delegate("#submitexceltemplateform",'click',function(){
   jQuery("#downloadtemplteform").submit();
});

jQuery("#downloadtemplteform").submit(function(){
  if(jQuery("#exchange_iex").prop("checked")==true){
      jQuery("#exchange_type").val('iex');
  }
  if(jQuery("#exchange_pxil").prop("checked")==true){
      jQuery("#exchange_type").val('pxil');
  }
    if(jQuery("#userselected").val()=='Null'||jQuery("#userselected").val()==''){
        swal('Error!', 'Please select user before proceed', 'error');
        return false;
    }else if(jQuery("#deliverydate").val()=='Null'||jQuery("#deliverydate").val()==''){
        swal('Error!', 'Please select delivery date before proceed', 'error');
      return false;
    }
});
jQuery(document).delegate('.piyush_datepicker','change',function(){
  if(jQuery(this).val()){

    jQuery('#deliverydate').val(jQuery(this).val());
  }
});

        src = "{{ route('searchajax') }}";
         jQuery(".search_text").autocomplete({
            source: function(request, response) {
                jQuery.ajax({
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
              //console.log(ui.item.id);
              jQuery("#client_id").val(ui.item.id); // display the selected text

              jQuery('#userselected').val(ui.item.id);
              $("#piyush_datepicker").datepicker('destroy');
              $("#earlierdate").datepicker('destroy');
              jQuery.ajax({
                    type: 'get',
                    url: '/placebid/getbidsubmissiontime/'+jQuery('#client_id').val(),
                    success: function(data) {
                      var currentdate = new Date();
                      var currHours = currentdate.getHours();
                      var currMinutes = currentdate.getMinutes();
                      var currSeconds = currentdate.getSeconds();
                      var datetime = '';
                            if(currHours < 10){
                              datetime += '0'+currHours+':';
                            }else{
                              datetime += currHours+':';
                            }
                            if(currMinutes < 10){
                              datetime += '0'+currMinutes+':';
                            }else{
                              datetime += currMinutes+':';
                            }
                            if(currSeconds < 10){
                              datetime += '0'+currSeconds;
                            }else{
                              datetime += currSeconds;
                            }
                       // alert(data.bidSubmissionTime[0].bid_submission_time);
                       // alert(datetime);
                      if(data.bidSubmissionTime[0].bid_submission_time_trader < datetime){
                         var startdate = '+2d';
                         var enddate = '+1d';
                      }else{
                        var startdate = '+1d';
                         var enddate = '+0d';
                      }
                      $('.piyush_datepicker').datepicker({
                          startDate: startdate,
                          autoclose: true,
                          format: 'dd/mm/yyyy'
                      });
                      $('.earlierdate').datepicker({
                          endDate:enddate,
                          autoclose: true,
                          format: 'dd/mm/yyyy'
                      });
                      // console.log(startdate,enddate);
                    },
                    error: function (response) {
                      var valHtml = '<div class="alert alert-danger alert-dismissable" style="margin-top:5px">'+
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                  if(response.responseJSON.errors){
                                      jQuery.each( response.responseJSON.errors , function(key, value){
                                        valHtml+= '<li>'+value+'</li>';
                                      });
                                    }else{
                                      valHtml+= '<li>Serve error occurred !!!</li>';
                                    }
                        valHtml += '</div>';
                      jQuery("#message").html(valHtml);
                      jQuery("#message").FadeIn(2000);
                    }

                  });
            },
            minLength: 1,

        });
    </script>
<script type="text/javascript">
  jQuery(document).ready(function() {
  jQuery(".bidaction").change(function(){
    if(jQuery(".bidaction").val() == "buy")
      {
        jQuery(".navsb-s.bdclr,.deleteob,.addbtns").css('border-color','#388838cc');
      }
      if(jQuery(".bidaction").val() == "sell")
      {
        jQuery(".navsb-s.bdclr,.deleteob,.addbtns").css('border-color','#88385fad');
      }
  });
});
  jQuery(document).ready(function(){
    jQuery(document).on("click",".addbtns",function(){
      jQuery(".mainPlaceBidTab").append('<div><div class="placeBidSecond"> <div class="tab-content navsb-s bdclr"> <div class="tab-pane active" role="tabpanel"> <div class="row"> <img src="img/assets/delete.svg" height="34" width="55" class="pull-right deleteob"> </div><div class="row"> <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"> <div class="col-md-3"> <div class="mda-form-group float-label"> <div class="mda-form-control"> <select class="form-control" type="text" name="bid_type" id="bid_type"> <option value="single">Single</option> <option value="block">Block</option> </select> <div class="mda-form-control-line"></div><label>Bidding Type</label> </div></div></div><div class="col-md-3"> <div class="mda-form-group float-label"> <div class="mda-form-control"> <input class="form-control" type="text" name="bid_mw" id="bid_mw"> <div class="mda-form-control-line"></div><label>Bid (MW)</label> </div></div></div><div class="col-md-3"> <div class="mda-form-group float-label"> <div class="mda-form-control"> <input class="form-control" type="text" name="bid_price" id="bid_price"> <div class="mda-form-control-line"></div><label>Price (Rs)</label> </div></div></div><div class="col-md-3"> <div class="mda-form-group float-label"> <div class="mda-form-control"> <select class="form-control bidaction" type="text" name="bid_action" id="bid_action"> <option value="buy">Buy</option> <option value="sell">Sell</option> </select> <div class="mda-form-control-line"></div><label>Action</label> </div></div></div><div class="col-md-3"> <div class="mda-form-group float-label"> <div class="mda-form-control"> <select class="form-control" type="text" name="time_slot_from" id="time_slot_from"> <option>00:00</option> </select> <div class="mda-form-control-line"></div><label>Time Slot(from)</label> </div></div></div><div class="col-md-3"> <div class="mda-form-group float-label"> <div class="mda-form-control"> <select class="form-control" type="text" name="time_slot_to" id="time_slot_to"> <option>00:15</option> </select> <div class="mda-form-control-line"></div><label>Time Slot(to)</label> </div></div></div><div class="col-md-3" id="no_of_block_div" style="display:none"> <div class="mda-form-group float-label"> <div class="mda-form-control"> <input class="form-control" type="text" name="no_of_block" id="no_of_block"> <div class="mda-form-control-line"></div><label>No. of Block</label> </div></div></div><div class="col-md-3"> </div><div class="col-md-3"> <div class="pull-left"> <button type="button" class="savebtnr mt20 btn btn-raised btn-info pull-right mr5">Save</button> </div><div class="addbtnb"> <input type="button" class="addbtns btn btn-raised btn-info pull-right" value="Add"> </div></div></div></div></div><br></div>');
    });
  });

// <!-- remove place bid code start -->

 jQuery(document).ready(function(){
  jQuery(document).on("click",".deleteob", function(e) {
    jQuery(this).parents("div.placeBidSecond").remove();
  });
});

// <!-- remove place bid code end -->
</script>
<!--sh-->
<script>


var dt = jQuery("#day-left").html().trim() +" "+jQuery("#time-left").html().trim();


var countDownDate = new Date(dt).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now an the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  // document.getElementById("times").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

   document.getElementById("time-left").innerHTML = hours + " H :"+ minutes + " M :" + seconds + " S ";


   document.getElementById("time-left").style.display = "block";
   document.getElementById("time-left").style.float = "right";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time-left").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
@endsection

<!-- wget --mirror --convert-links --adjust-extension --page-requisites
--no-parent https://www.w3schools.com/ -->
