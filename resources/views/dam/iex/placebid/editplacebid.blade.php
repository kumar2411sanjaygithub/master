 <div class="container-lg" id="bid-form-edit" style="display:none;">
  <div class="panel panel-default np">
    <div class="panel-body np">
      <div class="mainPlaceBidTab">
        <div class="tab-content navsb-s bdclr">
          <div class="tab-pane active" role="tabpanel">
<!--                         <div class="row">
              <img src="img/assets/delete.svg" height="34" width="55" class="pull-right deleteob">
            </div> -->
            <div class="msg_error"></div>
            <div class="row">
              <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="bid_id_for_update" id="bid_id_for_updated" value="">
              <div class="col-md-3 bid_type_updated">
                  <div class="mda-form-group float-label">
                    <div class="mda-form-control">
                    <select class="form-control" type="text" name="bid_type_updated" id="bid_type_updated">
                      <option value="">select</option>
                      <option value="single">Single</option>
                      <option value="block">Block</option>
                    </select>
                    <div class="mda-form-control-line"></div>
                    <label>Bidding Type</label>
                    </div>
                  </div>
              </div>
              <div class="col-md-3 bid_action_updated">
                  <div class="mda-form-group float-label">
                    <div class="mda-form-control">
                    <select class="form-control bidaction" type="text" name="bid_action_updated" id="bid_action_updated">
                      <option value="">select</option>
                      <option value="buy">Buy</option>
                      <option value="sell">Sell</option>
                    </select>
                    <div class="mda-form-control-line"></div>
                    <label>Trade Type</label>
                    </div>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="mda-form-group float-label">
                  <div class="mda-form-control">
                  <select class="form-control" type="text" name="time_slot_from_updated" id="time_slot_from_updated">
                  </select>
                  <div class="mda-form-control-line"></div>
                  <label>Time Slot From</label>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mda-form-group float-label">
                  <div class="mda-form-control">
                  <select class="form-control" type="text" name="time_slot_to_updated" id="time_slot_to_updated">
                  </select>
                  <div class="mda-form-control-line"></div>
                  <label>Time Slot To</label>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mda-form-group float-label">
                  <div class="mda-form-control">
                  <input class="form-control" type="text" name="bid_mw_updated" id="bid_mw_updated">
                  <div class="mda-form-control-line"></div>
                  <label>Bid (MW)</label>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mda-form-group float-label">
                  <div class="mda-form-control">
                  <input class="form-control" type="text" name="bid_price_updated" id="bid_price_updated">
                  <div class="mda-form-control-line"></div>
                  <label>Price (Rs)</label>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-3" id="no_of_block_div" style="display:none">
                <div class="mda-form-group float-label">
                  <div class="mda-form-control">
                  <input class="form-control" type="text" name="no_of_block" id="no_of_block">
                  <div class="mda-form-control-line"></div>
                  <label>No. of Block</label>
                  </div>
                </div>
              </div> -->
              <br>
              <div class="col-md-12">
                <div class="text-center pull-right">
                  <button type="button" class="btn btn-raised btn-info text-center mt10" id="update_biddetails">Update</button>
                </div>
              </div>

<!--                           <div class="col-md-3">
                <div class="pull-left">
                  <button type="button" class="savebtnr mt20 btn btn-info pull-right mr5">Save</button>
                </div>
                <div class="addbtnb">
                  <input type="button" class="addbtns btn btn-info pull-right" value="Add">
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
