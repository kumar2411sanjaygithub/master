
<div class="tab-pane active" id="home1" role="tabpanel">
  <div class="form-group hidden">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <label class="radio-inline c-radio">
        <input id="exchange_iex" class="iex_radio checkbox_check1m" name="exchange"  type="radio" value="yes" checked="checked"><span class="ion-record"></span> IEX
      </label>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <label class="radio-inline c-radio">
        <input id="exchange_pxil" disabled="disabled" name="exchange" class="pxil_radio checkbox_check2" type="radio" value="yes"><span class="ion-record"></span> PXIL
      </label>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8">
    <input type="hidden" name="client_id" id="client_id" value="">
      <div class="mda-form-group float-label">
        <div class="mda-form-control">
          <!-- <select> -->
            <label class="control-label tal">Select Client</label>
            <input  class="form-control input-sm search_text" autocomplete="off"  name="client" id="client" value="">
          <!-- </select>  -->
          <!-- <input class="form-control" type="text"> -->
          <div class="mda-form-control-line"></div>

        </div>
      </div>
    </div>
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <div class="col-sm-4">
      <div class="mda-form-group float-label rel-wrapper ui-datepicker-popup dp-theme-primary" id="example-datepicker-container-4">
        <div class="mda-form-control">
          <label class="control-label">Select Delivery Date</label>
          <input class="form-control input-sm piyush_datepicker valid" autocomplete="off"  name="bid_date" id="bid_date" type="text">
          <div class="mda-form-control-line"></div>

        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
      <span class="control-label text-left fs">
        <label>Do you want to place similar bids as any earlier date?</label>
      </span>
    </div>
    <div class="form-group">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        <label class="radio-inline c-radio">
          <input id="inlineradio1" class="checkbox_check1 oneyes" type="radio" name="i-radio" value="yes"> Yes
        </label>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        <label class="radio-inline c-radio">
          <input id="inlineradio2" class="checkbox_check2 twono" type="radio" name="i-radio" value="no" checked> No
        </label>
      </div>
    </div>
  </div>
  <div class="row hdate">
    <div class="col-sm-4">
      <div class="mda-form-group float-label rel-wrapper ui-datepicker-popup dp-theme-primary" id="example-datepicker-container-5">
        <div class="mda-form-control">
          <label class="control-label">Select earlier delivery date</label>
          <input class="form-control input-sm earlierdate" type="text" data-date="12/13/2016">
          <div class="mda-form-control-line"></div>

        </div>
      </div>
    </div>
    <div class="col-md-2">
      <label>&nbsp;</label>
      <div class="text-center mt3">
        <button type="button" class="btn btn-block btn-info btn-xs">Submit Bid</button>
      </div>
    </div>
  </div><br>
  <div class="row hideonearlier ml20">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 textcolor">
      <!-- <a class="showrecordtable" data-toggle="modal" data-target="#placebidmodal" href="{{ url('downloadbidteamplateexcel') }}"> -->

      <a class="showrecordtable" id="submitexceltemplateform">
        <div class="donwload pull-right ripple"></div>
      </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 textcolor ml20">
      <div data-toggle="modal" data-target="#uploadexcel" class="showrecordtable iconsetex pull-right ripple"></div>
    </div>
    <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 textcolor">
      <a class="pull-right massbidd showrecordtable" id="massbidd" onclick="updateLink()" href="javascript:void(0)">
        <div class="iconsetmas pull-right ripple"></div>
      </a>
    </div> -->
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ml20">
      <a class="pull-right addbidbtn showrecordtable" id="add_bid" href="javascript:void(0)">
        <div class="iconsetmas pull-right ripple"></div>
      </a><br>
    </div>
  </div>
  <div class="row hideonearlier ml20">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <span class="text-ui fs11">Download Excel Template</span>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 ml20">
      <span class="text-ui fs11">Upload Excel Template</span>
    </div>
    <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <span class="text-ui fs11">Mass Bid Placement</span>
    </div> -->
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <span class="text-ui fs11 ml20">Add New Bid</span>
    </div>
  </div>
</div>
