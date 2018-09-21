@extends('theme.layouts.default')
@section('content')
<style type="text/css">
   .divhidee{
      display:none;
   }
</style>
<section class="content-header">
   <h5><label  class="control-label"><u>BIDDING</u>  <u>SETTING</u></label></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">MANAGE CLIENT</a></li>
      <li><a href="#">REC</a></li>
      <li><a href="{{route('rec-bidding.biddingSearchindex')}}"><u>BIDDING</u>  <u>SETTING</u></a></li>
      <li>
   </ol>
</section>
<!-- Main content -->
   @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="glyphicon glyphicon-ok"></span> <strong>Success!</strong>&nbsp; {!! \Session::get('success') !!}
    </div>

   @endif


<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-body">
               <div class="row">
                  <div class="col-md-12">
                  <select class="" name="client_id" id="select-client" data-live-search="true">
                      <option>Search Client</option>
                       @foreach ($clientData as $key => $value)
                       <option value="{{ $value->id }}" data-tokens="{{ $value->id }}.{{ $value->id }}.{{ $value->id }};?>" @if($client_id==$value->id) selected  @endif> [{{$value->company_name}}] [{{$value->short_id}}] [{{$value->crn_no}}]</option>
                      @endforeach

                    </select>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-xs-12">
         <form method="post" action="{{ route('rec-bidding.biddingStore')}}">
            {{csrf_field()}}
         <input type="hidden" class="form-control pull-right input-sm" name='bidding_id' value="{{(isset($bidding_sett->id)&& $bidding_sett->id)?$bidding_sett->id:''}}" autocomplete="off">
          <input type="hidden" class="form-control pull-right input-sm" name='client_id' value="{{(isset($client_id))?$client_id:''}}" autocomplete="off">

         <div class="box">
            <div class="box-body">
               <div class="row">&nbsp;</div>
               <div class="row">
                  <div class="col-md-3 {{ $errors->has('bidding_cut_off_time') ? 'has-error' : '' }}">
                     <label  class="control-label">BIDDING CUFF OFF TIME</label><span class="text-danger"><strong>*</strong></span>
                     <input class="form-control input-sm" type="text" placeholder="ENTER BIDDING CUTT OFF TIME" id="jhq1" name="bidding_cut_off_time" value="{{(isset($bidding_sett->id)&& $bidding_sett->bidding_cut_off_time)?$bidding_sett->bidding_cut_off_time:old('bidding_cut_off_time')}}">
                    <span class="text-danger">{{ $errors->first('bidding_cut_off_time') }}</span>               
                  </div>
                  <div class="col-md-3 {{ $errors->has('iex_ca_client_id') ? 'has-error' : '' }}">
                     <label  class="control-label">IEX CA CLIENT ID <span class="text-danger"><strong>*</strong></label>
                     <input class="form-control input-sm" type="text" placeholder="ENTER IEX CA CLIENT ID" id="jhq2" name="iex_ca_client_id" value="{{(isset($bidding_sett->id)&& $bidding_sett->iex_ca_client_id)?$bidding_sett->iex_ca_client_id:old('iex_ca_client_id')}}">
                    <span class="text-danger">{{ $errors->first('iex_ca_client_id') }}</span>               
                  </div>
                  <div class="col-md-3 {{ $errors->has('pxil_ca_client_id') ? 'has-error' : '' }}">
                     <label  class="control-label">PXIL CA CLIENT ID <span class="text-danger"><strong>*</strong></label>
                     <input class="form-control input-sm" type="text" placeholder="ENTER PXIL CA CLIENT ID" id="jhq3" name="pxil_ca_client_id" value="{{(isset($bidding_sett->id)&& $bidding_sett->pxil_ca_client_id)?$bidding_sett->pxil_ca_client_id:old('pxil_ca_client_id')}}">
                    <span class="text-danger">{{ $errors->first('pxil_ca_client_id') }}</span>               
                  </div>
                  <div class="col-md-3 {{ $errors->has('rec_exchange_type') ? 'has-error' : '' }}">
                     <label  class="control-label">REC EXCHANGE TYPE <span class="text-danger"><strong>*</strong></label>
                     <select class="form-control input-sm" style="width: 100%;" id="jhq4" name="rec_exchange_type">
                        <option value=''>SELECT</option>
                        <option value="iex" @if((isset($bidding_sett->rec_exchange_type) && $bidding_sett->rec_exchange_type=="iex")||old('rec_exchange_type')=='iex') selected @endif>IEX</option>
                        <option value="pxil" @if((isset($bidding_sett->rec_exchange_type) && $bidding_sett->rec_exchange_type=="pxil")||old('rec_exchange_type')=='pxil') selected @endif>PXIL</option>
                        <option value="both" @if((isset($bidding_sett->rec_exchange_type) && $bidding_sett->rec_exchange_type=="both")||old('rec_exchange_type')=='both') selected @endif>Both</option>
                     </select>
                    <span class="text-danger">{{ $errors->first('rec_exchange_type') }}</span>               
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 {{ $errors->has('rec_energy_type') ? 'has-error' : '' }}">
                     <label  class="control-label">REC ENERGY TYPE <span class="text-danger"><strong>*</strong></label>
                     <select class="form-control input-sm " style="width: 100%;" id="jhq5" name="rec_energy_type">
                        <option value="">SELECT</option>
                        <option value="solar" @if((isset($bidding_sett->rec_energy_type) && $bidding_sett->rec_energy_type=="solar")||old('rec_energy_type')=='solar') selected @endif>Solar</option>
                        <option value="none-solar" @if((isset($bidding_sett->rec_energy_type) && $bidding_sett->rec_energy_type=="none-solar")||old('rec_energy_type')=='none-solar') selected @endif>None-Solar</option>
                        <option value="both" @if((isset($bidding_sett->rec_energy_type) && $bidding_sett->rec_energy_type=="both")||old('rec_energy_type')=='both') selected @endif>Both</option>
                     </select>
                    <span class="text-danger">{{ $errors->first('rec_energy_type') }}</span>               
                  </div>
                  <div class="col-md-3 {{ $errors->has('red_bid_type') ? 'has-error' : '' }}">
                     <label  class="control-label">REC BID TYPE <span class="text-danger"><strong>*</strong></label>
                     <select class="form-control input-sm " style="width: 100%;" id="jhq6" name="red_bid_type">
                        <option value="">SELECT</option>
                        <option value="buy" @if((isset($bidding_sett->red_bid_type) && $bidding_sett->red_bid_type=="buy")||old('red_bid_type')=='buy') selected @endif>Buy</option>
                        <option value="sell" @if((isset($bidding_sett->red_bid_type) && $bidding_sett->red_bid_type=="sell")||old('red_bid_type')=='sell') selected @endif>Sell</option>
                        <option value="both" @if((isset($bidding_sett->red_bid_type) && $bidding_sett->red_bid_type=="both")||old('red_bid_type')=='both') selected @endif>Both</option>
                     </select>
                    <span class="text-danger">{{ $errors->first('red_bid_type') }}</span>               
                  </div>
                  <div class="col-md-3 @if(@$bidding_sett->red_bid_type=='buy' ||@$bidding_sett->red_bid_type=='both') @else divhidee @endif" id="jhq77">
                     <label  class="control-label">REC BUY CATEGORY</label>
                     <select class="form-control input-sm " style="width: 100%;" id="jhq7" name="rec_but_category">
                        <option value="">SELECT</option>
                        <option value="obligated" @if((isset($bidding_sett->rec_but_category) && $bidding_sett->rec_but_category=="obligated")||old('rec_but_category')=='obligated') selected @endif>Obligated</option>
                        <option value="voluntary" @if((isset($bidding_sett->rec_but_category) && $bidding_sett->rec_but_category=="voluntary")||old('rec_but_category')=='voluntary') selected @endif>Voluntary</option>
                     </select>

                  </div>
                  <div class="col-md-3 {{ $errors->has('rec_iex_status') ? 'has-error' : '' }}">
                     <label  class="control-label">REC IEX STATUS <span class="text-danger"><strong>*</strong></label>
                     <select class="form-control input-sm" style="width: 100%;" id="jhq8" name="rec_iex_status">
                        <option value="">SELECT</option>
                        <option value="active" @if((isset($bidding_sett->rec_iex_status) && $bidding_sett->rec_iex_status=="active")||old('rec_iex_status')=='active') selected @endif>Active</option>
                        <option value="inactive" @if((isset($bidding_sett->rec_iex_status) && $bidding_sett->rec_iex_status=="inactive")||old('rec_iex_status')=='inactive') selected @endif>Inactive</option>
                        <option value="suspended" @if((isset($bidding_sett->rec_iex_status) && $bidding_sett->rec_iex_status=="suspended")||old('rec_iex_status')=='suspended') selected @endif>Suspended</option>
                     </select>
                    <span class="text-danger">{{ $errors->first('rec_iex_status') }}</span>               
                  </div>
                  <div class="col-md-3 {{ $errors->has('rec_pxil_status') ? 'has-error' : '' }}">
                     <label  class="control-label">REC PXIL STATUS <span class="text-danger"><strong>*</strong></label>
                     <select class="form-control input-sm select2" style="width: 100%;" name="rec_pxil_status">
                        <option value="">SELECT</option>
                        <option value="active" @if((isset($bidding_sett->rec_pxil_status) && $bidding_sett->rec_pxil_status=="active")||old('rec_pxil_status')=='active') selected @endif>Active</option>
                        <option value="inactive" @if((isset($bidding_sett->rec_pxil_status) && $bidding_sett->rec_pxil_status=="inactive")||old('rec_pxil_status')=='inactive') selected @endif>Inactive</option>
                        <option value="suspended" @if((isset($bidding_sett->rec_pxil_status) && $bidding_sett->rec_pxil_status=="suspended")||old('rec_pxil_status')=='suspended') selected @endif>Suspended</option>
                     </select>
                    <span class="text-danger">{{ $errors->first('rec_pxil_status') }}</span>               
                  </div>
               </div>
               <div class="row">&nbsp;</div>
               <div class="row">
                  <div class="col-md-5"></div>
                  <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs" id="jui" name="jui">SAVE</button></div>
                  <div class="col-md-1"><button type="button" class="btn btn-block btn-danger btn-xs" id="can" name="can">CANCEL</button></div>
                  <div class="col-md-5"></div>
               </div>
               <div class="row">&nbsp;</div>
            </div>
         </div>
      </form>
      </div>
   </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script>
$(document).ready(function() {
     $("#select-client").change(function(e) {
           var id = this.value;
           var url = "{{url('/rec/bidding-setting')}}/"+id;

           window.location = url;
     });
 });
</script>
<script type="text/javascript">
 setTimeout(function() {
   $('#successMessage').fadeOut('fast');
   }, 2000); // <-
</script>
<script>
   $(function () {

     //Date picker
     $('#datepicker').datepicker({
       autoclose: true,
       format: 'dd/mm/yyyy',
       startDate: "+0d"
     });
   });
</script>
<script type="text/javascript">
     $(function() {
      $('#jhq6').change(function(){
         if($('#jhq6').val()=='buy' ||$('#jhq6').val()=='both')
         {
            $('#jhq77').show();
         }
         else
         {
            $('#jhq77').hide();
            $("#jhq77").empty('');
         }
         
        
      });
      });

</script>
<script type="text/javascript">
    $(document).ready(function() {
   $('#select-client').select2();
});
</script>
  @endsection