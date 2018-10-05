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
      <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="/POC">POC & DISCOM LOSSES</a></li>
       <li class="#"><u>EDIT POC</u></li>
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
                    <label  class="control-label">APPLICATON FROM DATE</label><span class="text-danger"><strong>*</strong></span>
                    <div class="input-group date">
                       <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                       </div>
                       <input type="text" autocomplete="off" class="form-control pull-right input-sm" value="{{ @date('d/m/Y',strtotime($pocData->date_from)) }}" id="datepicker" name="date_from">
                    </div>
                    <span class="text-danger">{{ $errors->first('date_from') }}</span>

                 </div>
                 <div class="col-md-3 {{ $errors->has('date_to') ? 'has-error' : '' }}">
                    <label  class="control-label">APPLICATION TO DATE</label><span class="text-danger"><strong>*</strong></span>
                    <div class="input-group date">
                       <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                       </div>
                       <input type="text" autocomplete="off" class="form-control pull-right input-sm" value="{{ @date('d/m/Y',strtotime($pocData->date_to)) }}" id="datepicker1" name="date_to">
                    </div>
                    <span class="text-danger">{{ $errors->first('date_to') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('region') ? 'has-error' : '' }}">
                    <label  class="control-label">REGION</label><span class="text-danger"><strong>*</strong></span>
                    <select class="form-control input-sm " style="width: 100%;" id="region" name="region">
                      <option value="">Select</option>
                      <option value="Northern" {{(isset($pocData)&& $pocData->region=='Northern')?'selected':''}}>Northern</option>
                      <option value="Western" {{(isset($pocData)&& $pocData->region=='Western')?'selected':''}}>Western</option>
                      <option value="Southern" {{(isset($pocData)&& $pocData->region=='Southern')?'selected':''}}>Southern</option>
                      <option value="Eastern" {{(isset($pocData)&& $pocData->region=='Eastern')?'selected':''}}>Eastern</option>
                      <option value="North Eastern" {{(isset($pocData)&& $pocData->region=='North Eastern')?'selected':''}} >North Eastern</option>
                      </select>


                    <span class="text-danger">{{ $errors->first('region') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('regional_entity') ? 'has-error' : '' }}">
                    <label  class="control-label">REGIONAL ENTITY</label><span class="text-danger"><strong>*</strong></span>
                    <input class="form-control input-sm" value="{{ $pocData->regional_entity }}" type="text" placeholder="VALUE" id="regional_entity" name="regional_entity">
                    <span class="text-danger">{{ $errors->first('regional_entity') }}</span>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-3 {{ $errors->has('injection_poc_loss') ? 'has-error' : '' }}">
                    <label  class="control-label">INJECTION POC LOSSES(%)</label><span class="text-danger"><strong>*</strong></span>
                    <input class="form-control input-sm num" value="{{ $pocData->injection_poc_loss }}" type="text" placeholder="VALUE" id="injection_poc_loss" name="injection_poc_loss">
                    <span class="text-danger">{{ $errors->first('injection_poc_loss') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('withdraw_poc_loss') ? 'has-error' : '' }}">
                    <label  class="control-label">WITHDRAWAL POC LOSS(%)</label><span class="text-danger"><strong>*</strong></span>
                    <input class="form-control input-sm num" value="{{ $pocData->withdraw_poc_loss }}" type="text" placeholder="VALUE" id="withdraw_poc_loss" name="withdraw_poc_loss">
                    <span class="text-danger">{{ $errors->first('withdraw_poc_loss') }}</span>
                 </div>
                 <div class="col-md-6 text-right mt23">
                   <button type="submit" class="btn btn-info btn-xs">UPDATE</button>&nbsp;&nbsp;&nbsp;&nbsp;
                   <a href="/poc" type="button" class="btn btn-danger btn-xs">CANCEL</a>
                 </div>

               </div>
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
   //
   //   $('#datepicker').datepicker({
   //     autoclose: true
   //   })
   //   $('#datepicker1').datepicker({
   //     autoclose: true
   //   })
   //   $('#datepicker2').datepicker({
   //     autoclose: true
   //   })
   //   $('#datepicker3').datepicker({
   //     autoclose: true
   //   })
   //
   // })
   $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
      }).on('changeDate', function (selected) {
         var startDate = new Date(selected.date.valueOf());
         $('#datepicker1').datepicker('setStartDate', startDate);
       }).on('clearDate', function (selected) {
           $('#datepicker1').datepicker('setStartDate', null);
       });
      $('#datepicker1').datepicker({
        autoclose: true,
         format: 'dd/mm/yyyy'
      }).on('changeDate', function (selected) {
           var endDate = new Date(selected.date.valueOf());
           $('#datepicker').datepicker('setEndDate', endDate);
       }).on('clearDate', function (selected) {
           $('#datepicker').datepicker('setEndDate', null);
       });
 })
</script>
@endsection
