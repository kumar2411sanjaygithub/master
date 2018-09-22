@extends('theme.layouts.default')
@section('content_head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
   <h5><label  class="control-label"><u>BID SETTING</u></label></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">MANAGE CLIENT</a></li>
      <li><a href="#">DAM</a></li>
      <li><a href="#">IEX</a></li>
      <li><a href="active"><u>Bid Setting</u></a></li>
   </ol>
</section>
  <div class="clearfix"></div>
   <!-- <br> -->
   <!-- success msg -->
   @if(session()->has('addmsg'))
     <div class="alert alert-success mt10" id="success">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
         {{ session()->get('addmsg') }}
     </div>
   @endif
<section class="content">
  <!-- Main content -->
  <form method="post" action="{{ route('addbidsetting') }}">
    {{ csrf_field() }}
  <div class="row">
     <div class="col-xs-12">
        <div class="box">
           <div class="box-body">
              <div class="row">
                 <div class="col-md-12">
                  <select class="" name="client_id" id="select-client" data-live-search="true">
                    <option>Search Client</option>
                     @foreach ($clientData as $key => $value)
                     <option value="{{ $value->id }}" data-tokens="{{ $value->company_name }}.{{ $value->id }}.{{ $value->crn_no }};?>">  [{{$value->company_name}}] [{{$value->short_id}}] [{{$value->crn_no}}]</option>
                    @endforeach

                  </select>
                  <!-- <script>
                  $(document).ready(function() {
                       $("#select-client").change(function(e) {
                             var id = this.value;
                             var url = '{{url('addppadetailsfind')}}/'+id;

                             window.location = url;
                       });
                   });
                  </script> -->
                 </div>
              </div>
              <div class="row">&nbsp;</div>
              <div class="row">
                 <div class="col-md-3 {{ $errors->has('bid_cut_off_time') ? 'has-error' : '' }}">
                    <label  class="control-label">BIDDING CUTT OFF TIME</label><span class="text-danger"><strong>*</strong></span>
                    <input class="form-control input-sm timepicker" type="text" id="bid_cut_off_time" name="bid_cut_off_time" placeholder="ENTER BIDDING CUTT OFF TIME">
                    <span class="text-danger">{{ $errors->first('bid_cut_off_time') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('trader_type') ? 'has-error' : '' }}">
                    <label  class="control-label">POWER TRADE TYPE</label><span class="text-danger"><strong>*</strong></span>
                    <select class="form-control input-sm" id="trader_type" name="trader_type" style="width: 100%;">
                       <option value="">PLEASE SELECT</option>
                       <option>Buy</option>
                       <option>Sell</option>
                       <option>Both</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('trader_type') }}</span>
                 </div>

                  <div class="col-md-1" style="margin-top:22px;"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
                  <!-- <div class="col-md-1" style="margin-top:19px;"><button type="button" class="btn btn-block btn-danger btn-xs">CANCEL</button></div> -->
              </div>
             </div>
        </div>
     </div>
  </div>
  </form>
</section>
<script type="text/javascript">
 setTimeout(function() {
   $('#success').fadeOut('fast');
   }, 2000); // <-
</script>
<script>
   $(function () {

     //Date picker
     $('#datepicker').datepicker({
       autoclose: true
     })
     $('#datepicker1').datepicker({
       autoclose: true
     })
     $('#datepicker2').datepicker({
       autoclose: true
     })
     $('#datepicker3').datepicker({
       autoclose: true
     });
     $('.timepicker').timepicker({
        showInputs: false
      });
   })
   </script>
   <script>
   $(document).ready(function(){
     $("#select-client").change(function(){
          var id = $("#select-client").val();
           $.ajax({    //create an ajax request to display.php
             type: "GET",
             url: "{{url('/ppa/biddata')}}",
             data:{'id':id},
             dataType: "JSON",   //expect html to be returned
             success: function(response){
               $("#bid_cut_off_time").val(response.bid_cut_off_time);
               $("#trader_type").val(response.trader_type);
             }

         });
     });
   });
   $(document).ready(function() {
       $('#select-client').select2();
   });
   </script>
@endsection
