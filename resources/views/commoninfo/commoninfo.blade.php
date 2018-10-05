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
   <h5><label  class="control-label"><u>Common Information</u></label></h5>
   <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="/commonInfo/connoninfo">Trader's Setting</a></li>
      <li class="#"><u>Common Information</u></li>
      <!-- <li><a href="#">IEX</a></li>
      <li><a href="#"><u> BID SETTING</u></a></li> -->
   </ol>

</section>
  <div class="clearfix"></div>
    <div class="col-md-12">
     @if(session()->has('updatemsg'))
       <div class="alert alert-success mt10" id="success">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
           {{ session()->get('updatemsg') }}
       </div>
     @endif
    </div>
<section class="content">
  <!-- Main content -->
  <form method="post" action="{{ route('commonupdate') }}">
    {{ csrf_field() }}
  <div class="row">
     <div class="col-xs-12">
        <div class="box">
           <div class="box-body">

              <div class="row">&nbsp;</div>
              <div class="row">
                 <div class="col-md-3 {{ $errors->has('saac_code') ? 'has-error' : '' }}">
                    <label  class="control-label">HSN/SAAC Code</label><span class="text-danger"><strong>*</strong></span>
                    <input class="form-control input-sm" type="text" id="saac_code" name="saac_code" placeholder="ENTER HSN/SAAC Code" value="{{isset($commonData->saac_code)?$commonData->saac_code:''}}">
                    <span class="text-danger">{{ $errors->first('saac_code') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('tm_out_dues') ? 'has-error' : '' }}">
                    <label  class="control-label">Trading Margin Outstanding Dues</label><span class="text-danger"><strong>*</strong></span>
                    <input class="form-control input-sm" type="text" id="tm_out_dues" name="tm_out_dues" placeholder="ENTER Trading Margin Outstanding Dues" value="{{isset($commonData->tm_out_dues)?$commonData->tm_out_dues:''}}">
                    <span class="text-danger">{{ $errors->first('tm_out_dues') }}</span>
                 </div>
                  <div class="col-md-1" style="margin-top:22px;"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
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

@endsection
