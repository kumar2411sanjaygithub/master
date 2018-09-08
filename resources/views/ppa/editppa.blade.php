@extends('theme.layouts.default')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@section('content')
<section class="content-header">
<div class="">Edit PPA DETAILS</div>
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
               <div class="box-body">
                  <div class="row">
                     <div class="col-md-3 {{ $errors->has('validity_from') ? 'has-error' : '' }}">
                        <label  class="control-label">VALIDITY START DATE</label><span class="text-danger"><strong>*</strong></span>
                        <div class="input-group date">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" value="{{ $ppaData->validity_from }}" class="form-control pull-right input-sm" id="datepicker" name="validity_from">
                            <span class="text-danger">{{ $errors->first('validity_from') }}</span>
                        </div>
                     </div>
                     <div class="col-md-3 {{ $errors->has('validity_to') ? 'has-error' : '' }}">
                        <label  class="control-label">VALIDITY END DATE</label><span class="text-danger"><strong>*</strong></span>
                        <div class="input-group date">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" value="{{ $ppaData->validity_to }}" class="form-control pull-right input-sm" id="datepicker1" name="validity_to">
                            <span class="text-danger">{{ $errors->first('validity_to') }}</span>
                        </div>
                     </div>
                     <div class="col-md-3 {{ $errors->has('file_path') ? 'has-error' : '' }}">
                        <label  class="control-label">UPLOAD DOCUMENT</label><span class="text-danger"><strong>*</strong></span>
                        <input class="form-control input-sm" type="file" value="{{ $ppaData->file_path }}" name="file_path" placeholder="ENTER POC LOSSES">
                          <span class="text-danger">{{ $errors->first('file_path') }}</span>
                     </div>
                  </div>
                  <div class="row">&nbsp;</div>
                  <div class="row">
                     <div class="col-md-5"></div>
                     <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
                     <div class="col-md-1"><button type="reset" class="btn btn-block btn-danger btn-xs">CANCEL</button></div>
                     <div class="col-md-5"></div>
                  </div>
                  <div class="row">&nbsp;</div>
               </div>
            </div>
</form>
 </section>
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
