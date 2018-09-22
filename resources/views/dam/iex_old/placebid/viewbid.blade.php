<div class="tab-pane" id="profile1" role="tabpanel">
  <div class="card1 mt10">
    <div class="card-body1 mt10">
        <label>Bid Summary : <span class="text-warning">XYZ Services Pvt Ltd</span></label>
        <div class="panel-collapse collapse in" id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body np nm">
            <div class="dashed-borderd-table">
              <table class="table table-striped table-sm bid-status">
                <tr>
                  <th>Delivery Date</th>
                  <td id="set_delivery_date"></td>
                  <th>Exchange</th>
                  <td>IEX</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <label>Bidding Type <span class="text-info">Single</span></label>
        <div class="panel-collapse collapse in" id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body np nm">
            <div class="dashed-borderd-table">
              <table class="table table-striped table-sm bid-status">
                <thead>
                  <tr>
                    <th class="text-center">Form</th>
                    <th class="text-center">To</th>
                    <th class="text-center">Quantum</th>
                    <th class="text-center">Rate</th>
                  </tr>
                </thead>
                <tbody id="single-bid-data">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <label>Bidding Type <span class="text-info">Block</span></label>
        <div class="panel-collapse collapse in" id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body np nm">
            <div class="dashed-borderd-table">
              <table class="table table-striped table-sm bid-status">
                <thead>
                  <tr>
                    <th class="text-center">Form</th>
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
    </div><br>
    <div class="row">
      <div class="col-md-12">
        <div class="pull-right">
          <input type="button" class="btn btn-raised btn-info modify" value="Modify">
          <input  type="button" class="btn btn-raised btn-info" id="confirm_place_bid" value="Confirm & Place Bid">
          <!-- data-toggle="modal" data-target="#confirmmodal" -->
        </div>
      </div>
    </div>
  </div>
</div>
