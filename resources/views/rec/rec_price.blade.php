@extends('theme.layouts.default')
@section('content')
<section class="content-header">
  <h5><label  class="control-label"><u>PRICE</u> <u>SETTING</u></label></h5>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
    <li><a href="#">MANAGE CLIENT</a></li>
    <li><a href="#">REC</a></li>
    <li><a href="#"><u>PRICE</u> <u>SETTING</u></a></li>
  </ol>
</section>
   @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="glyphicon glyphicon-ok"></span> <strong>Success!</strong>&nbsp; {!! \Session::get('success') !!}
    </div>

   @endif

<!-- Main content -->
<form method="post" action="{{ route('rec-price.priceStore')}}">
  {{csrf_field()}}
    <input type="hidden" class="form-control pull-right input-sm" name='price_id' value="{{(isset($price_setting->id)&& $price_setting->id)?$price_setting->id:''}}" autocomplete="off">

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="row">
      <div class="col-md-3 {{ $errors->has('valid_from_date') ? 'has-error' : '' }}">
     <label  class="control-label">VALIDITY START DATE</label><span class="text-danger"><strong>*</strong></span>
     <div class="input-group date">
       <div class="input-group-addon">
         <i class="fa fa-calendar"></i>
       </div>
       <input type="text" class="form-control pull-right input-sm" id="datepicker" name='valid_from_date' value="{{(isset($price_setting->id)&& $price_setting->valid_from_date)?date('d/m/Y',strtotime($price_setting->valid_from_date)):old('valid_from_date')}}" autocomplete="off">
     </div>
     <span class="text-danger">{{ $errors->first('valid_from_date') }}</span>
    </div>
  </div>
<div class="box">
<div class="box-body  table-responsive">
<table class="table table-bordered table-striped table-hover text-center">
   <thead>
     <tr>
       <th></th>
       <th>SOLAR</th>
       <th>NON SOLAR</th>
     </tr>
   </thead>
   <tbody>
     <tr>
       <td>FLOOR PRICE</td>
       <td><div class="col-md-8 {{ $errors->has('floar_price') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm num"   autocomplete="off" type="text" placeholder="Amount" name='floar_price' value="{{(isset($price_setting->id)&& $price_setting->floar_price)?$price_setting->floar_price:old('floar_price')}}"></div><span class="text-danger">{{ $errors->first('floar_price') }}</span></td>
       <td><div class="col-md-8 {{ $errors->has('floar_price1') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm num"   autocomplete="off" type="text" placeholder="Amount" name='floar_price1' value="{{(isset($price_setting->id)&& $price_setting->floar_price1)?$price_setting->floar_price1:old('floar_price1')}}"></div><span class="text-danger">{{ $errors->first('floar_price1') }}</span></td>
     </tr>
     <tr>
       <td>FORBEARANCE PRICE</td>
       <td><div class="col-md-8 {{ $errors->has('forbidden_price') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm"    autocomplete="off" type="text" placeholder="Amount" name='forbidden_price' value="{{(isset($price_setting->id)&& $price_setting->forbidden_price)?$price_setting->forbidden_price:old('forbidden_price')}}"></div><span class="text-danger">{{ $errors->first('forbidden_price') }}</span></td>
       <td><div class="col-md-8 {{ $errors->has('forbidden_price1') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm"   autocomplete="off" type="text" placeholder="Amount" name='forbidden_price1' value="{{(isset($price_setting->id)&& $price_setting->forbidden_price1)?$price_setting->forbidden_price1:old('forbidden_price1')}}"></div><span class="text-danger">{{ $errors->first('forbidden_price1') }}</span></td>
     </tr>
     </tbody>
 </table>
   </div>
 <div class="row">&nbsp;</div>
  <div class="row">
     <div class="col-md-5"></div>
      <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
      <div class="col-md-5"></div>
  </div>
  <div class="row">&nbsp;</div>
</div>
</form>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

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
  @endsection