@extends('theme.layouts.default')
@section('content')

<section class="content-header">
        <h5><label  class="control-label"><u>SET</u>  <u>EXCHANGE</u>  <u>RATIO</u> </label></h5>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
    <li><a href="#">MANAGE CLIENT</a></li>
    <li><a href="#">REC</a></li>
    <li><a href="#">EXCHANGE</a></li>
    <li><a href="#"><u>RATIO</u></a></li>
  </ol>
</section>
   @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="glyphicon glyphicon-ok"></span> <strong>Success!</strong>&nbsp; {!! \Session::get('success') !!}
    </div>

   @endif
<!-- Main content -->
<form method="post" action="{{ route('rec-exchange.exchangeStore')}}">
  {{csrf_field()}}
    <input type="hidden" class="form-control pull-right input-sm" name='exchange_id' value="{{(isset($exchange_setting->id)&& $exchange_setting->id)?$exchange_setting->id:''}}" autocomplete="off">

<section class="content">
  <div class="row">
    <div class="col-xs-12">
<div class="row">
<div class="col-md-3 {{ $errors->has('validate_start') ? 'has-error' : '' }}">
<label  class="control-label">VALIDITY START DATE</label><span class="text-danger"><strong>*</strong></span>
<div class="input-group date" id="zsw1" name="zsw1">
<div class="input-group-addon">
 <i class="fa fa-calendar"></i>
</div>
<input type="text" class="form-control pull-right input-sm" id="datepicker" name="validate_start" value="{{(isset($exchange_setting->id)&& $exchange_setting->validate_start)?date('d/m/Y',strtotime($exchange_setting->validate_start)):old('validate_start')}}" autocomplete="off">
</div>
<span class="text-danger">{{ $errors->first('validate_start') }}</span>
</div>
</div>
<div class="box">
<div class="box-body  table-responsive">
<table class="table table-bordered table-striped table-hover text-center">
   <thead>
     <tr>
       <th></th>
       <th>IEX</th>
       <th>PXIL</th>
     </tr>
   </thead>
   <tbody>
     <tr>
       <td>SOLAR BUY(%)</td>
       <td><div class="col-md-8 {{ $errors->has('iex_buy_solar_per') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm numberinput iex" type="text" placeholder="IEX SOLAR BUY (%)" id="der1" name="iex_buy_solar_per"  value="{{(isset($exchange_setting->id)&& $exchange_setting->iex_buy_solar_per)?$exchange_setting->iex_buy_solar_per:''}}" autocomplete="off"></div><span class="text-danger">{{ $errors->first('iex_buy_solar_per') }}</span></td>
        <td><div class="col-md-8 {{ $errors->has('pxil_buy_solar_per') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm numberinput pxil" type="text" placeholder="PXIL SOLAR BUY (%)" id="der2" name="pxil_buy_solar_per"  value="{{(isset($exchange_setting->id)&& $exchange_setting->pxil_buy_solar_per)?$exchange_setting->pxil_buy_solar_per:''}}" autocomplete="off"></div><span class="text-danger">{{ $errors->first('pxil_buy_solar_per') }}</span></td>
     </tr>
     <tr>
       <td>NON-SOLAR BUY(%)</td>
       <td><div class="col-md-8 {{ $errors->has('iex_buy_nonsolar_per') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm numberinput iex" type="text" placeholder="IEX NON-SOLAR BUY (%)" id="der3" name="iex_buy_nonsolar_per"  value="{{(isset($exchange_setting->id)&& $exchange_setting->iex_buy_nonsolar_per)?$exchange_setting->iex_buy_nonsolar_per:''}}" autocomplete="off"></div><span class="text-danger">{{ $errors->first('iex_buy_nonsolar_per') }}</span></td>
       <td><div class="col-md-8 {{ $errors->has('pxil_buy_nonsolar_per') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm numberinput pxil" type="text" placeholder="PXIL NON-SOLAR BUY (%)" id="der4" name="pxil_buy_nonsolar_per"  value="{{(isset($exchange_setting->id)&& $exchange_setting->pxil_buy_nonsolar_per)?$exchange_setting->pxil_buy_nonsolar_per:''}}" autocomplete="off"></div><span class="text-danger">{{ $errors->first('pxil_buy_nonsolar_per') }}</span></td>
     </tr>
     <tr>
       <td>SOLAR SELL(%)</td>
     <td><div class="col-md-8 {{ $errors->has('iex_sell_solar_per') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm numberinput iex" type="text" placeholder="IEX SOLAR SELL (%)" id="der5" name="iex_sell_solar_per"  value="{{(isset($exchange_setting->id)&& $exchange_setting->iex_sell_solar_per)?$exchange_setting->iex_sell_solar_per:''}}" autocomplete="off"></div><span class="text-danger">{{ $errors->first('iex_sell_solar_per') }}</span></td>
       <td><div class="col-md-8 {{ $errors->has('pxil_sell_solar_per') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm numberinput pxil" type="text" placeholder="PXIL SOLAR SELL (%)" id="der6" name="pxil_sell_solar_per"  value="{{(isset($exchange_setting->id)&& $exchange_setting->pxil_sell_solar_per)?$exchange_setting->pxil_sell_solar_per:''}}" autocomplete="off"></div><span class="text-danger">{{ $errors->first('pxil_sell_solar_per') }}</span></td>
     </tr>
     <tr>
       <td>NON SOLAR SELL(%)</td>
        <td><div class="col-md-8 {{ $errors->has('iex_sell_nonsolar_per') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm numberinput iex" type="text" placeholder="IEX NON-SOLAR SELL (%)" id="der7" name="iex_sell_nonsolar_per"  value="{{(isset($exchange_setting->id)&& $exchange_setting->iex_sell_nonsolar_per)?$exchange_setting->iex_sell_nonsolar_per:''}}" autocomplete="off"></div><span class="text-danger">{{ $errors->first('iex_sell_nonsolar_per') }}</span></td>
       <td><div class="col-md-8 {{ $errors->has('pxil_sell_nonsolar_per') ? 'has-error' : '' }}" style="margin-left:18%;"><input class="form-control input-sm numberinput pxil" type="text" placeholder="IEX NON-SOLAR SELL (%)" id="der8" name="pxil_sell_nonsolar_per"  value="{{(isset($exchange_setting->id)&& $exchange_setting->pxil_sell_nonsolar_per)?$exchange_setting->pxil_sell_nonsolar_per:''}}" autocomplete="off"></div><span class="text-danger">{{ $errors->first('pxil_sell_nonsolar_per') }}</span></td>
     </tr>
   </tbody>
 </table>
   </div>
 <div class="row">&nbsp;</div>
  <div class="row">
     <div class="col-md-6"></div>
      <div class="col-md-1 "><button type="submit" class="btn btn-block btn-info btn-xs" id="hyu" name="hyu">SAVE</button></div>
      <div class="col-md-5"></div>
  </div>
  <div class="row">&nbsp;</div>
</div>
</section>
</form>
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
<script type="text/javascript">
     $(document).ready(function () {
        $(".numberinput").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {     
                alert("Alphabates and special characters are not allowed.");
                return false;
            }
        });
        $('.numberinput').on('focusout keyup',function(e) {
            if($(this).val() > 100 || isNaN($(this).val())){
                e.preventDefault(); 
                $(this).parents('tr').find('.numberinput').val('');
                alert("Plese enter a numeric value between 0 to 100");
                $(this).focus();              
                return false;
            }
            else if($(this).val()=='')
            {
                e.preventDefault();
                $(this).parents('tr').find('.numberinput').val('');
                return false;
            }
            else
            {
                var other_exc_value = (100-(this.value));
                if($(this).hasClass('iex')){
                    $(this).parents('tr').find('.numberinput.pxil').val(other_exc_value);
                }
                else if($(this).hasClass('pxil')){
                    $(this).parents('tr').find('.numberinput.iex').val(other_exc_value);
                }
            }
        });
    });


</script>

  @endsection