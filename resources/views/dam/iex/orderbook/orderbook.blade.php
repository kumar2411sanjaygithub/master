@extends('theme.layouts.default')
@section('content')
{!! Html::style('autocomplete/jquery-ui.css') !!}
{{ Html::script('autocomplete/jquery-1.10.2.js') }}
{{ Html::script('autocomplete/jquery-ui.js') }}
<style>
/*    #steps-uid-0-t-0:focus,#steps-uid-0-t-1:focus,#steps-uid-0-t-2:focus,#steps-uid-0-t-3:focus,#steps-uid-0-t-4:focus,#steps-uid-0-t-5:focus,#steps-uid-0-t-6:focus,#steps-uid-0-t-7:focus,#steps-uid-0-t-8:focus,#steps-uid-0-t-0:active,#steps-uid-0-t-1:active,#steps-uid-0-t-2:active,#steps-uid-0-t-3:active,#steps-uid-0-t-4:active,#steps-uid-0-t-5:active,#steps-uid-0-t-6:active,#steps-uid-0-t-7:active,#steps-uid-0-t-8:active,
    .manage-client-wizard .wizard > .steps .current a, .manage-client-wizard .wizard > .steps .current a:hover {
        color: #fff;
        background: #1976D2;
        font-size: 15px;
        height: 37px;
        border-radius: 4px;
        text-align: center;
        box-shadow: 0px 0px 20px 0px rgba(54, 140, 244, 0), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(189, 189, 189, 0);

    }
    .manage-client-wizard .wizard > .steps .done a{
        background: transparent;
        color: #525252;
        background: #40C4FF;
        font-size: 15px;
        font-weight: 500;
        height: 37px;
        border-radius: 4px;
        text-align: center;
        box-shadow: 0 0 8px 0px #bbbbbb;

    }
    .manage-client-wizard .wizard > .steps > ul > li {
        width: 33.33%;
    }
    #steps-uid-0-t-1,#steps-uid-0-t-1,#steps-uid-0-t-2,#steps-uid-0-t-3,#steps-uid-0-t-4,#steps-uid-0-t-5,#steps-uid-0-t-6,#steps-uid-0-t-7,#steps-uid-0-t-8,
    .manage-client-wizard .wizard > .steps .disabled a, .manage-client-wizard .wizard > .steps .disabled a:hover, .manage-client-wizard .wizard > .steps .disabled a:active
    {
      background: #F2F2F2;
      height: 37px;
      color: #525252;
      border-radius: 4px;
      font-size: 15px;
      text-align: center;
      font-weight: 500;
      box-shadow: 0px 0px 6px 20px rgba(54, 140, 244, 0), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(189, 189, 189, 0);
    }
        .manage-client-wizard .wizard > .steps .done a, .manage-client-wizard .wizard > .steps .done a:hover, .manage-client-wizard .wizard > .steps .done a:active {
            background: #F2F2F2;
            color: #525252;
            border: 1px solid #197EC2;
        }
    .wizard ul{height:35px;border-bottom: 10px solid #F2F2F2;}
    .wizard> .steps a,.wizard> .steps a:hover{padding:7px 5px;}
    .wizard > .steps ul li a,.wizard > .steps ul li a:hover{margin-top:10px;}
    .wizard ul{margin-left: -7px!important;margin-right: -7.24px!important;}
    ul[role="menu"]{border:0px!important;}
.wizard > .steps .current a,
.wizard > .steps .current a:hover,
.wizard > .steps .current a:active {
  /*border-bottom: 2px solid #448AFF!important;*//*
  cursor: default!important;
  color: #fff!important;
  background: #1976D2!important;
  font-size: 15px!important;
  height: 37px!important;
  border-radius: 4px!important;
  text-align: center!important;
  box-shadow: 0px 0px 20px 0px rgba(54, 140, 244, 0), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(189, 189, 189, 0)!important;
}*/

      .nav-tabs > li{width:50%;
        text-align: center;
        font-weight: 700;
        font-size: 18px;
      }
      .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover, .nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:focus
      {
        border-bottom:4px solid;
      }
      .nav-tabs > li a:hover{background:#fff;}
      .nav-tabs{border:0px;}
      /* div[role='tabpanel']{border: 3px dashed #8080802b;} */
    .wizard > .content > .body ul {
        list-style: none !important;
    }
    .wizard ul.nav-tabs{border:0!important;}
    .nav-pills{background: #fff!important;}
    .nav-pills li.active{border-bottom:4px solid;}
    </style>
<section>
  <div class="">
    <!-- <div class="container container-lg"> -->
    <div class="panel panel-default">
      <div class="panel-heading topheading">Order Book</div>
      <div class="panel-body pt0 pb0">

        <div class="tab-content navsb1">
        <!-- main bid form start -->
         <div class="tab-pane active" id="home1" role="tabpanel">
          <div class="form-group">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  text-center">
              <label class="radio-inline c-radio">
                <input id="exchange_iex" class="iex_radio checkbox_check1" name="exchange" type="radio" value="yes" checked="checked"><span class="ion-record"></span> IEX
              </label>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  text-center">
              <label class="radio-inline c-radio">
                <input id="exchange_pxil" disabled="disabled" name="exchange" class="pxil_radio checkbox_check2" type="radio" value="yes"><span class="ion-record"></span> PXIL
              </label>
            </div>
          </div><br>
            <!-- <h4>POWER</h4>
            <fieldset> -->
              <!-- <div class="col-md-12">
                <div class="col-md-6 col-md-offset-3">
                  <div class="form-group">
                    <div class="col-sm-6">
                      <label class="radio-inline c-radio">
                        <input id="inlineradioIEX" class="checkbox_check1" type="radio" name="i-radio" value="yes"><span class="ion-record"></span> IEX
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <label class="radio-inline c-radio">
                        <input id="inlineradioPXIL" class="checkbox_check2" type="radio" name="i-radio" value="no" checked><span class="ion-record"></span> PXIL
                      </label>
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="clearfix"></div><br>
              <div class="card mb0">
                <div class="card mb0" id="loading">
                  <div class="card-body">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <div class="row">
                      @if(\Auth::user()->member_type!='CLIENT')
                      <div class="col-sm-4">
                        <div class="mda-form-group float-label">
                          <div class="mda-form-control">
                            <input class="form-control search_text" name="search_text" id="" value="">
                            <div class="mda-form-control-line"></div>
                            <label>Search User</label>
                          </div>
                        </div>
                      </div>
                     @endif

                      <div class="col-sm-7 np nm">
                        <div class="col-sm-6">
                          <div class="rel-wrapper ui-datepicker-popup dp-theme-primary" id="example-datepicker-container-4">
                            <div class="mda-form-control">
                              <input class="form-control" id="date_from" type="text" data-date="12/13/2016" placeholder="From Date" name="from_date">
                              <div class="mda-form-control-line"></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="rel-wrapper ui-datepicker-popup dp-theme-primary" id="example-datepicker-container-5">
                            <div class="mda-form-control">
                              <input class="form-control" id="date_to" type="text" data-date="12/13/2016" placeholder="To Date" name="to_date">
                              <div class="mda-form-control-line"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-1">
                        <div class="col-sm-6">
                          <input type="submit" class="btn btn-raised btn-info pull-left searchBidDeatils mt20" value="Go">
                          <!-- <input type="submit" class="btn btn-info pull-right mt20" value="Export"> -->
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row"> -->
                      <!-- <div class="col-sm-2">
                        <div class="mda-form-group float-label">
                          <div class="mda-form-control">
                            <select class="form-control" required="" tabindex="0" aria-required="true" aria-invalid="true" id="bid_type" name="bid_type">
                              <option value="">Select Bid Type</option>
                              <option value="all">All</option>
                              <option value="single">Single</option>
                              <option value="block">Block</option>
                            </select>
                            <div class="mda-form-control-line"></div>
                            <label>Bid Type</label>
                          </div>
                        </div>
                      </div> -->
                      <!-- <div class="col-sm-10 np">
                        <div class="col-sm-3">
                          <div class="mda-form-group float-label">
                            <div class="mda-form-control">
                              <select class="form-control" required="" tabindex="0" aria-required="true" aria-invalid="true" id="order_status" name="order_status">
                                <option value="">Select Order Status</option>
                                <option value="all">All</option>
                                <option value="pending">Pending</option>
                                <option value="cleared">Cleared</option>
                                <option value="not cleared">Not Cleared</option>
                              </select>
                              <div class="mda-form-control-line"></div>
                              <label>Order Status</label>
                            </div>
                          </div>
                        </div> -->
                        <!-- <div class="col-sm-3">
                          <div class="mda-form-group float-label">
                            <div class="mda-form-control">
                              <select class="form-control" required="" tabindex="0" aria-required="true" aria-invalid="true" id="sort_status" name="sort_statuss">
                                <option value="">Select Sort Order</option>
                                <option value="all">All</option>
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                              </select>
                              <div class="mda-form-control-line"></div>
                              <label>Sort Order</label>
                            </div>
                          </div>
                        </div> -->
                        <!-- <div class="col-sm-3">
                          <div class="mda-form-group float-label">
                            <div class="mda-form-control">
                              <select class="form-control" required="" tabindex="0" aria-required="true" aria-invalid="true" id="exchange" name="exchange">
                                <option value="">Select Exchange</option>
                                <option value="all">All</option>
                                <option value="IEX">IEX</option>
                                <option value="PXIL">PXIL</option>
                              </select>
                              <div class="mda-form-control-line"></div>
                              <label>Exchange</label>
                            </div>
                          </div>
                        </div> -->
                        <!-- <div class="col-sm-3">
                          <div class="mda-form-group float-label">
                            <div class="mda-form-control">
                              <select class="form-control" required="" tabindex="0" aria-required="true" aria-invalid="true" id="order_nature" name="order_nature">
                                <option value="">Select Order Nature</option>
                                <option value="all">All</option>
                                <option value="buy">Buy</option>
                                <option value="sell">Sell</option>
                              </select>
                              <div class="mda-form-control-line"></div>
                              <label>Order Nature</label>
                            </div>
                          </div>
                        </div> -->
                      <!-- </div>                     -->
                    </div>
                    <!-- <br>
                    <div class="row">
                      <div class="col-sm-2 pull-right">
                        <input type="submit" class="btn btn-info pull-left searchBidDeatils" value="Go">
                        <input type="submit" class="btn btn-info pull-right" value="Export">
                      </div>
                    </div> -->
                  </div>
                </div>
                <div class="card np mt10">
                  <div class="card-body pt0">
                    <div class="row">
                      <!-- START panel-->
                      <div class="panel-body pt0">
                        <div>
                          <!-- Nav tabs-->
                          <!-- <ul class="nav nav-tabs np" role="tablist">
                            <li class="active" role="presentation"><a href="#iexdataview" aria-controls="home" role="tab" data-toggle="tab"><b>IEX</b></a></li> -->
                            <!-- <li role="presentation"><a href="#pxildataview" aria-controls="profile" role="tab" data-toggle="tab">PXIL</a></li>
                          </ul> -->
                          <!-- Tab panes-->
                          <div class="tab-content np nm bd">
                            <div class="tab-pane active" id="iexdataview" role="tabpanel">
                              <div class="downloadfiles1 row">
                                <div class="col-md-12 pr20">
                                  <div class="pull-right">
                                  <a href="{{ URL::to('/orderbook/downloadExcel/xls') }}">
                                    <img data-placement="bottom" class="ml40" data-toggle="tooltip" title="" src="/img/assets/download2.svg" height="28px" width="28px" data-original-title="Export xls">
                                  </a>
                                  <!-- <button type="button" class="btn btn-default">CSV</button> -->
                                  </div>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="card-body1 table-responsive h260 np">
                                <table class="table-datatable table table-striped table-hover">
                                  <thead>
                                    <tr>
                                      <th class="text-center">Sr. No</th>
                                      <th class="text-center">Reference No</th>
                                      <th class="sort-alpha text-center">Date</th>
                                      <th class="text-center">Portfolio Id</th>
                                      <th class="text-center">Users</th>
                                      <th class="text-center">Single</th>
                                      <!-- <th>Placed time</th> -->
                                      <th class="text-center">Block</th>
                                      <!-- <th>Placed time</th> -->
                                      <!-- <th>Quantum</th> -->
                                      <!-- <th>Price</th> -->
                                      <th class="text-center">Order Placed By</th>
                                      <!-- <th class="sort-alpha">Status</th> -->
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
                            <!-- <div class="tab-pane" id="pxildataview" role="tabpanel"><br>
                              <div class="col-md-12 pr20">
                                <div class="pull-right">
                                  <button type="button" class="btn btn-default">XLS</button>
                                  <button type="button" class="btn btn-default">CSV</button>
                                </div>
                              </div>
                              <div class="card-body table-responsive h350">
                                <table class="table-datatable table table-striped table-hover mv-lg" id="datatable1">
                                  <thead>
                                    <tr>
                                      <th>S.No</th>
                                      <th>Reference No</th>
                                      <th>Date</th>
                                      <th>Portfolio Id</th>
                                      <th>Users</th>
                                      <th>Single</th>
                                      <th>Placed Time</th>
                                      <th>Block</th>
                                      <th>Place Time</th>
                                      <th>Quantum</th>
                                      <th>Price</th>
                                      <th class="sort-numeric">Order Placed</th>
                                      <th class="sort-alpha">Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr class="gradeX">
                                      <td>1sdf</td>
                                      <td>23433sdf</td>
                                      <td>11/11/2018</td>
                                      <td>IEXHG2514</td>
                                      <td>sdsdfsdff</td>
                                      <td><span data-toggle="modal" data-target="#single" class="text-info">View</span></td>
                                      <td>sdfsdsdfsdff</td>
                                      <td><span data-toggle="modal" data-target="#block" class="text-info">View</span></td>
                                      <td>sdfdsf</td>
                                      <td>sdssdfsdfsdffsf</td>
                                      <td>sdfdf</td>
                                      <td>sdfdf</td>
                                      <td>sdfsdf</td>
                                    </tr>
                                    <tr class="gradeC">
                                      <td>1</td>
                                      <td>23433</td>
                                      <td>11/11/2018</td>
                                      <td>IEXHG2514</td>
                                      <td>sdf</td>
                                      <td><span data-toggle="modal" data-target="#single" class="text-info">View</span></td>
                                      <td>sdfsdf</td>
                                      <td><span data-toggle="modal" data-target="#block" class="text-info">View</span></td>
                                      <td>sdfdsf</td>
                                      <td>sdsdfsdffsf</td>
                                      <td>sdfdf</td>
                                      <td>sdfdf</td>
                                      <td>sdfsdf</td>
                                    </tr>
                                    <tr class="gradeA">
                                      <td>1</td>
                                      <td>23433</td>
                                      <td>11/11/2018</td>
                                      <td>IEsdfsdfXHG2514</td>
                                      <td>sdf</td>
                                      <td><span data-toggle="modal" data-target="#single" class="text-info">View</span></td>
                                      <td>sdfsdf</td>
                                      <td><span data-toggle="modal" data-target="#block" class="text-info">View</span></td>
                                      <td>sdfdsf</td>
                                      <td>sdfsf</td>
                                      <td>sdfdf</td>
                                      <td>sdfdf</td>
                                      <td>sdfsdf</td>
                                    </tr>
                                    <tr class="gradeA">
                                      <td>1</td>
                                      <td>23433</td>
                                      <td>11/11/2018</td>
                                      <td>IEsdfsdfXHG2514</td>
                                      <td>sdf</td>
                                      <td><span data-toggle="modal" data-target="#single" class="text-info">View</span></td>
                                      <td>sdfsdf</td>
                                      <td><span data-toggle="modal" data-target="#block" class="text-info">View</span></td>
                                      <td>sdfdsf</td>
                                      <td>sdfsf</td>
                                      <td>sdfdf</td>
                                      <td>sdfdf</td>
                                      <td>sdfsdf</td>
                                    </tr>

                                  </tbody>
                                </table>
                              </div>
                            </div> -->
                          </div>
                        </div>
                      </div>
                      <!-- END panel-->
                    </div>
                  </div>
                </div>
              </div>
            <!-- </fieldset>
            <h4>REC</h4>
            <fieldset> -->

            <!-- </fieldset>
            <h4>ESCERT</h4>
            <fieldset>

            </fieldset> -->
      </div>
    </div>
  </div>
</div>
</div>
  <!-- single box start -->
  <div id="bid-details" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
    </div>
  </div>
  <!-- end single -->
    <!-- single box start -->
  <div id="block" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <div class="panel bds" id="panelDemo13">
              <div class="panel-heading tabhead"><b>TOTAL BID DETAILS</b></div>
              <div class="panel-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" id="headingOne" role="tab">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">DELIVERY DATE <span id="set_delivery_date"></span>
                          <span class=" clndr pull-right" data-pack="default"></span>
                        </a>
                      </h4>
                    </div>
                    <div class="panel-collapse collapse in" id="collapseOne1" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body np nm">
                        <label class="text-info">IEX || Single</label>
                        <!-- <a href="#"><img src="img/assets/edit.svg" height="18px" width="22px"></a>                           -->
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
                        <!-- <a href="#"><img src="img/assets/edit.svg" height="18px" width="22px"></a>                           -->
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
        <div class="modal-footer">
          <button type="button" class="btn btn-raised btn-info text-center" data-dismiss="modal">Submit</button>
          <button type="button" class="btn btn-raised btn-danger text-center" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
<!-- end single -->
</section>
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
              // console.log(ui.item.id);
              $("#user_id").val(ui.item.id); // display the selected text
            },
            minLength: 1,
        });
    </script>

{{ Html::script('js/orderbook/orderbook.js') }}
@endsection
