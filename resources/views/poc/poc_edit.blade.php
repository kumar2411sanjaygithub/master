@extends('theme.layouts.default')
@section('content_head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection
@section('content')

<section class="content-header">
   <h5>
      <label  class="control-label">EDIT POC LOSSES</label>
   </h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">POC & Discom Losses</a></li>
      <li><a href="#" class="active">POC Add</a></li>
   </ol>
</section>
<!-- Content Header (Page header) -->
<!-- Main content -->
  <section class="content">
    <div class="clearfix"></div>
     <!-- <br> -->
     <!-- success msg -->
     @if(session()->has('message'))
       <div class="alert alert-success mt10">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
           {{ session()->get('message') }}
       </div>
     @endif
     <!-- query validater     -->
     <!-- success msg -->
     @if(session()->has('updatemsg'))
       <div class="alert alert-success  mt10">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
           {{ session()->get('updatemsg') }}
       </div>
     @endif
     <!-- query validater     -->
     <!-- success msg -->
     @if(session()->has('delmsg'))
       <div class="alert alert-success  mt10" >
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
           {{ session()->get('delmsg') }}
       </div>
     @endif
    <form method="post" enctype="multipart/form-data" action="{{ url('updatepoc/'.$pocData->id)}}">
      {{ csrf_field()}}
      <div class="row">
      <div class="col-xs-12">
        <div class="box">
           <div class="box-body">
              <div class="row">
                 <div class="col-md-3 {{ $errors->has('date_from') ? 'has-error' : '' }}">
                    <label  class="control-label">APPLICATON FROM DATE</label>
                    <div class="input-group date">
                       <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                       </div>
                       <input type="text" class="form-control pull-right input-sm" value="{{ $pocData->date_from }}" id="datepicker" name="date_from">
                       <span class="text-danger">{{ $errors->first('date_from') }}</span>
                    </div>
                 </div>
                 <div class="col-md-3 {{ $errors->has('date_to') ? 'has-error' : '' }}">
                    <label  class="control-label">APPLICATION TO DATE</label>
                    <div class="input-group date">
                       <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                       </div>
                       <input type="text" class="form-control pull-right input-sm" value="{{ $pocData->date_to }}" id="datepicker1" name="date_to">
                       <span class="text-danger">{{ $errors->first('date_to') }}</span>
                    </div>
                 </div>
                 <div class="col-md-3 {{ $errors->has('region') ? 'has-error' : '' }}">
                    <label  class="control-label">REGION</label>
                    <input class="form-control input-sm" value="{{ $pocData->region }}" type="text" placeholder="VALUE" id="region" name="region">
                    <span class="text-danger">{{ $errors->first('region') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('regional_entity') ? 'has-error' : '' }}">
                    <label  class="control-label">REGIONAL ENTITY</label>
                    <input class="form-control input-sm" value="{{ $pocData->regional_entity }}" type="text" placeholder="VALUE" id="regional_entity" name="regional_entity">
                    <span class="text-danger">{{ $errors->first('regional_entity') }}</span>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-3 {{ $errors->has('injection_poc_loss') ? 'has-error' : '' }}">
                    <label  class="control-label">INJECTION POC LOSSES(%)</label>
                    <input class="form-control input-sm" value="{{ $pocData->injection_poc_loss }}" type="text" placeholder="VALUE" id="injection_poc_loss" name="injection_poc_loss">
                    <span class="text-danger">{{ $errors->first('injection_poc_loss') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('withdraw_poc_loss') ? 'has-error' : '' }}">
                    <label  class="control-label">WITHDRAWAL POC LOSS(%)</label>
                    <input class="form-control input-sm" value="{{ $pocData->withdraw_poc_loss }}" type="text" placeholder="VALUE" id="withdraw_poc_loss" name="withdraw_poc_loss">
                    <span class="text-danger">{{ $errors->first('withdraw_poc_loss') }}</span>
                 </div>
               </div>
               <div class="row">&nbsp;</div>
                 <div class="col-md-5"></div>
                 <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
                 <div class="col-md-5"></div>
              </div>
              <div class="row">&nbsp;</div>
           </div>
        </div>
      </div>
    </div>
    </form>

</section>

<script type="text/javascript">
 setTimeout(function() {
   $('.alert-success').fadeOut('fast');
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
     })

   })
</script>
@endsection
