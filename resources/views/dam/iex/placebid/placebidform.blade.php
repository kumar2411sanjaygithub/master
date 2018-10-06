<div class="container-lg addbidtab hidden hideonearlier" id="demo_123">
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
             <div class="col-md-3">
                 <div class="mda-form-group float-label">
                   <div class="mda-form-control">
                    <label class="control-label">Bidding Type</label>
                   <select class="form-control input-sm" type="text" name="bid_type" id="bid_type">
                     <option value="single">Single</option>
                     <option value="block">Block</option>
                   </select>
                   <div class="mda-form-control-line"></div>
                   
                   </div>
                 </div>
             </div>
             <div class="col-md-3">
                 <div class="mda-form-group float-label">
                   <div class="mda-form-control">
                    <label class="control-label">Trade Type</label>
                   <select class="form-control input-sm" type="text" name="bid_action" id="bid_action">
                     <option value="buy">Buy</option>
                     <option value="sell">Sell</option>
                   </select>
                   <div class="mda-form-control-line"></div>
                   
                   </div>
                 </div>
             </div>
             <div class="col-md-3">
               <div class="mda-form-group float-label">
                 <div class="mda-form-control">
                 <label class="control-label">Time Slot From</label>
                 <select class="form-control input-sm" type="text" name="time_slot_from" id="time_slot_from">
                 </select>
                 <div class="mda-form-control-line"></div>
                 
                 </div>
               </div>
             </div>
             <div class="col-md-3">
               <div class="mda-form-group float-label">
                 <div class="mda-form-control">
                  <label class="control-label">Time Slot To</label>
                 <select class="form-control input-sm" type="text" name="time_slot_to" id="time_slot_to">                  </select>
                 <div class="mda-form-control-line"></div>
                 
                 </div>
               </div>
             </div>
             <div class="col-md-3">
               <div class="mda-form-group float-label">
                 <div class="mda-form-control">
                  <label class="control-label">Bid (MW)</label>
                 <input class="form-control input-sm num" type="text" name="bid_mw" id="bid_mw">
                 <div class="mda-form-control-line"></div>
                 
                 </div>
               </div>
             </div>
             <div class="col-md-3">
               <div class="mda-form-group float-label">
                 <div class="mda-form-control">
                  <label class="control-label">Price (Rs)</label>
                 <input class="form-control input-sm num" type="text" name="bid_price" id="bid_price">
                 <div class="mda-form-control-line"></div>
                 
                 </div>
               </div>
             </div>
             <div class="col-md-3" id="no_of_block_div" style="display:none">
               <div class="mda-form-group float-label">
                 <div class="mda-form-control">
                  <label class="control-label">No. of Block</label>
                 <input class="form-control input-sm num" type="text" name="no_of_block" id="no_of_block">
                 <div class="mda-form-control-line"></div>
                 
                 </div>
               </div>
             </div>
             <br>
             <div class="col-md-12">
               <div class="text-center pull-right">
                 <button type="button" class="btn btn-block btn-info btn-xs" id="save_biddetails">Add</button>
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
