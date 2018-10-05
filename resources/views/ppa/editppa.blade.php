@extends('theme.layouts.default')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@section('content')
<section class="content-header">
<h5><label  class="control-label"><u>EDIT PPA DETAILS</u></label></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="/basicdetails">MANAGE CLIENT</a></li>
      <li><a href="">DAM</a></li>
      <li><a href="">IEX</a></li>
      <li class="#"><u> EDIT PPA DETAILS </u></li>
   </ol>
 </section>
 <section class="content">
  <div class="clearfix"></div>
          <!-- <br> -->
          <!-- success msg -->
          @if(session()->has('updatemsg'))
            <div class="alert alert-success mt10">
                {{ session()->get('updatemsg') }}
            </div>
          @endif
          <!-- query validater     -->

            <div class="box">
              <form method="post" action="{{url('/ppa/updateppadata/'.$ppaData->id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input class="form-control input-sm" type="hidden" value="{{ $ppaData->client_id }}" name="client_id" placeholder="ENTER POC LOSSES">
               <div class="box-body">
                  <div class="row">
                     <div class="col-md-3 {{ $errors->has('validity_from') ? 'has-error' : '' }}">
                        <label  class="control-label">VALIDITY START DATE</label><span class="text-danger"><strong>*</strong></span>
                        <div class="input-group date">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" autocomplete="off" value="{{ date('d/m/Y',strtotime($ppaData->validity_from)) }}" class="form-control pull-right input-sm" id="datepicker" name="validity_from">
                        </div>
                        <span class="text-danger">{{ $errors->first('validity_from') }}</span>
                     </div>
                     <div class="col-md-3 {{ $errors->has('validity_to') ? 'has-error' : '' }}">
                        <label  class="control-label">VALIDITY END DATE</label><span class="text-danger"><strong>*</strong></span>
                        <div class="input-group date">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text"  autocomplete="off" value="{{ date('d/m/Y',strtotime($ppaData->validity_to)) }}" class="form-control pull-right input-sm" id="datepicker1" name="validity_to">
                        </div>
                        <span class="text-danger">{{ $errors->first('validity_to') }}</span>
                     </div>
                     <div class="col-md-3 {{ $errors->has('file_path') ? 'has-error' : '' }}">
                        <label  class="control-label">UPLOAD DOCUMENT</label><span class="text-danger"><strong></strong></span>
                        <input class="form-control input-sm file" type="file" value="{{ $ppaData->file_path }}" name="file_path" placeholder="ENTER POC LOSSES">
                        <input class="form-control input-sm" type="hidden" value="{{ $ppaData->file_path }}" name="old" placeholder="ENTER POC LOSSES">
                          <span class="text-danger">{{ $errors->first('file_path') }}</span>
                     </div>
                     <div class="col-md-1 mt23"><button type="submit" title="SAVE" class="btn btn-block btn-info btn-xs">SAVE</button></div>
                     <div class="col-md-1 mt23"><a title="CANCEL" href="/addppadetailsfind/{{$ppaData->client_id}}" class="btn btn-block btn-danger btn-xs">CANCEL</a></div>
                  </div>
                </div>
            </div>
</form>
 </section>

 <script>
    $(function () {

      //Date picker

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
                  format: 'dd/mm/yyyy',
                }).on('changeDate', function (selected) {
                     var endDate = new Date(selected.date.valueOf());
                     $('#datepicker').datepicker('setEndDate', endDate);
                 }).on('clearDate', function (selected) {
                     $('#datepicker').datepicker('setEndDate', null);
                 });

    })
 </script>
@endsection
