<style>
.tableset{border:0.5px solid #95939387;}
.tableset.table > tbody > tr > td{border:0.5px solid #95939387; height: 35px !important;}
.tableset.tablehead{border-bottom:2px solid #95939387;}
</style>
<div class="modal-content" style="height: 500px; overflow-y: scroll;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h6 class="modal-title text-center"><b>Bid Details</b></h6>
  </div>
      <div class="panel-body">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <table class="table table-striped table-sm tableset">
                <thead class="tablehead tableset">
                  <tr>
                    <th class="text-center">From</th>
                    <th class="text-center">To</th>
                    <th class="text-center">Quantum</th>
                    <th class="text-center">Rate</th>
                    <!-- <th class="text-center">Status</th> -->
                    <th class="text-center">Created At</th>
                  </tr>
                </thead>
                <tbody class="tableset">
                  @foreach($orderbookdetails as $key=>$value)
                    @if($value->bid_action=='sell')
                      <tr>
                        <td class="text-danger text-center">{{ $value->time_slot_from }}</td>
                        <td class="text-danger text-center">{{ $value->time_slot_to }}</td>
                        <td class="text-danger text-center">-{{ $value->bid_mw }}</td>
                        <td class="text-danger text-center">{{ $value->bid_price }}</td>
                         <!-- @if($value->status=='1')
                        <td class="text-danger text-center">Pending</td>
                        @endif
                        @if($value->status=='0')
                        <td class="text-danger text-center">Not Submitted</td>
                        @endif -->
                        <td class="text-danger text-center">{{ $value->created_at }}</td>
                      </tr>
                    @endif
                    @if($value->bid_action=='buy')
                      <tr>
                        <td class="text-success text-center">{{ $value->time_slot_from }}</td>
                        <td class="text-success text-center">{{ $value->time_slot_to }}</td>
                        <td class="text-success text-center">{{ $value->bid_mw }}</td>
                        <td class="text-success text-center">{{ $value->bid_price }}</td>
                        <!-- @if($value->status=='1')
                        <td class="text-success text-center">Pending</td>
                        @endif
                        @if($value->status=='0')
                        <td class="text-success text-center">Not Submitted</td>
                        @endif -->
                        <td class="text-success text-center">{{ $value->created_at }}</td>
                      </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
  </div>
