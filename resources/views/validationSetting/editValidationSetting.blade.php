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
      <label  class="control-label">Validation Setting</label>
   </h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">MANAGE CLIENT</a></li>
      <li><a href="#">DAM</a></li>
      <li><a href="#">IEX</a></li>
      <li><a href="#"><u> EDIT VALIDATION SETTING</u></a></li>
   </ol>
</section>
<!-- Content Header (Page header) -->
<!-- Main content -->
  <section class="content">
    <div class="clearfix"></div>
     @if(session()->has('updatemsg'))
       <div class="alert alert-success  mt10">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
           {{ session()->get('updatemsg') }}
       </div>
     @endif
      <div class="row">
        <div class="col-xs-12">
          <form method="post" action="{{ url('updateValidationSetting/'.$validationsettingData->id)}}">
            {{ csrf_field()}}
          <div class="box">
             <div class="box-body">
                <div class="row">
                   <div class="col-md-12">
                      <div class="mda-form-control bb0 mt10  {{ $errors->has('user_id') ? 'has-error' : '' }}">

                          <select class="" name="user_id" id="select-client" data-live-search="true">
                              <option>Search Client</option>
                               @foreach ($users as $key => $aa)
                               <option value="{{ $aa['id'] }}" data-tokens="{{ $aa['id'] }}.{{ $aa['id'] }}.{{ $aa['id'] }};?>" @if((isset($validationsettingData->user_id)&&$validationsettingData->user_id==$aa['id'])) selected @endif> [{{$aa['company_name']}}] [{{$aa['short_id']}}] [{{$aa['crn_no']}}]</option>
                              @endforeach

                            </select>

                          <span class="text-danger">{{ $errors->first('user_id') }}</span>
                       </div>
                   </div>
                </div>
                <div class="row">&nbsp;</div>
                <!-- <div class="row ">
                   <div class="col-md-2"><label class="control-label">VALIDATIONS</label></div>
                   <div class="col-md-8"></div>
                   <div class="col-md-2 text-right"><span ><input type="checkbox" class="minimal" id="vg1" name="vg1"></span> <label class="control-label" for="vg1">SELLECT ALL</label></div>
                </div> -->
                <div class="well well-sm">
                   <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-1"><span><input type="checkbox" {{ isset($validationsettingData) && $validationsettingData->noc == 'NOC' ? 'checked="checked"' : '' }} name="noc" id="noc" value="NOC"></span> <label class="control-label" for="noc">NOC</label></div>
                      <div class="col-md-1"></div>
                      <div class="col-md-1"><span><input type="checkbox" {{ isset($validationsettingData) && $validationsettingData->ppa == 'PPA' ? 'checked="checked"' : '' }} name="ppa" id="ppa" value="PPA"></span> <label class="control-label" for="ppa">PPA</label></div>
                      <div class="col-md-1"></div>
                      <div class="col-md-2"><span><input type="checkbox" {{ isset($validationsettingData) && $validationsettingData->exchange == 'Exchange' ? 'checked="checked"' : '' }} name="exchange" id="exchange" value="Exchange"></span> <label class="control-label" for="exchange">EXCHANGE</label></div>
                      <div class="col-md-1" ><span><input type="checkbox" {{ isset($validationsettingData) && $validationsettingData->psm == 'PSM' ? 'checked="checked"' : '' }} name="psm" id="psm" value="PSM"></span> <label class="control-label" for="psm">PSM</label></div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-5"></div>
                   <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs" id="vg6" name="vg6">SAVE</button></div>
                   <div class="col-md-1"><a href="/validationSetting/validationSetting" class="btn btn-block btn-danger btn-xs" id="vg7" name="vg7">CANCEL</a></div>
                   <div class="col-md-5"></div>
                </div>
             </div>
          </div>
        </form>
       </div>
      </div>
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
<script type="text/javascript">
    $(document).ready(function() {
   $('#select-client').select2();
});
</script>
@endsection
