@extends('theme.layouts.default')
@section('content')

<section class="content-header">
   <h5>
      <label  class="control-label"><u>EDIT NOC</u> <u>APPLICATON</u></label>
   </h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">NOC </a></li>
      <li><a href="{{route('getclientData',['id'=>$client_id])}}"><u>NOC</u> <u>APPLICATION DETAIL</u></a></li>
   </ol>
</section>
   @if (\Session::has('error'))
      <div class="alert alert-danger" id="successMessage">
         <ul>
             <li>{!! \Session::get('error') !!}</li>
         </ul>
      </div>
   @endif
   @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
         <ul>
             <li>{!! \Session::get('success') !!}</li>
         </ul>
      </div>
   @endif

<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-body">
               <div class="row">&nbsp;</div>
               <div class="" >
                <form method="post" action="{{url('noc/update/'.$noc_data->id)}}" enctype="multipart/form-data">
                  {{csrf_field()}}

                  <input type="hidden" value="{{isset($client_id)?$client_id:''}}" name="client_id">
                  <input type="hidden" value="{{isset($str)?$str:''}}" name="client_name">

               <div class="row">
                  <div class="col-md-3 {{ $errors->has('sldc') ? 'has-error' : '' }}">
                     <label  class="control-label">SLDC <span class="text-danger">*</span></label>
                    <select class="form-control input-sm" style="width: 100%;" id="sldc" name="sldc">
                        <option value="">PLEASE SELECT SLDC</option>
                        @if (count($sldc_array) > 0)
                          @foreach($sldc_array as $sldc)
                              <option value="{{$sldc}}" {{ isset($noc_data) && $noc_data->sldc == $sldc ? 'selected="selected"' : '' }}>{{$sldc}}</option>
                          @endforeach
                        @else
                          <option value="">No data.</option>
                        @endif
                    </select>
                    <span class="text-danger">{{ $errors->first('sldc') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('noc_type') ? 'has-error' : '' }}">
                     <label  class="control-label">NOC TYPE <span class="text-danger">*</span></label>
                     <select class="form-control input-sm" style="width: 100%;" id="noc_type" name="noc_type">
                        <option value="">SELECT NOC TYPE</option>
                        <option value="buy" {{ isset($noc_data) && $noc_data->noc_type == "buy" ? 'selected="selected"' : '' }}>BUY</option>
                        <option value="sell" {{ isset($noc_data) && $noc_data->noc_type == "sell" ? 'selected="selected"' : '' }}>SELL</option>
                     </select>
                    <span class="text-danger">{{ $errors->first('noc_type') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('exchange_type') ? 'has-error' : '' }}">
                     <label  class="control-label">EXCHANGE TYPE <span class="text-danger">*</span></label>
                     <select class="form-control input-sm" style="width: 100%;" id="exchange_type" name="exchange_type">
                        <option value="">SELECT</option>
                        <option value="iex" {{ isset($noc_data) && $noc_data->exchange_type == "iex" ? 'selected="selected"' : '' }}>IEX</option>
                        <option value="pxil" {{ isset($noc_data) && $noc_data->exchange_type == "pxil" ? 'selected="selected"' : '' }}>PXIL</option>
                     </select>
                    <span class="text-danger">{{ $errors->first('exchange_type') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('quantum') ? 'has-error' : '' }}">
                     <label  class="control-label">QUANTUM <span class="text-danger">*</span></label>
                     <input class="form-control input-sm" type="text" placeholder="VALUE" id="quantum" name="quantum" value="{{ isset($noc_data) ? $noc_data->quantum : '' }}">
                    <span class="text-danger">{{ $errors->first('quantum') }}</span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2 {{ $errors->has('start_date') ? 'has-error' : '' }}">
                     <label  class="control-label">VALIDITY START DATE <span class="text-danger">*</span></label>
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right input-sm" id="datepicker"  name="start_date" autocomplete="off" placeholder="DD/MM/YYYY" value="{{ isset($noc_data) ? date('d/m/Y',strtotime($noc_data->start_date)) : '' }}">
                     </div>
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                  </div>
                  <div class="col-md-1 {{ $errors->has('start_time') ? 'has-error' : '' }} mlpl0">
                     <label  class="control-label">TIME <span class="text-danger">*</span></label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker" name="start_time" value="{{ isset($noc_data) ? $noc_data->start_time : '' }}">
                     </div>
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                  </div>
                  <div class="col-md-2 {{ $errors->has('end_date') ? 'has-error' : '' }}">
                     <label  class="control-label">VALIDITY END DATE <span class="text-danger">*</span></label>
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right input-sm" id="datepicker1"  name="end_date" autocomplete="off" placeholder="DD/MM/YYYY" value="{{ isset($noc_data) ? date('d/m/Y',strtotime($noc_data->end_date)) : '' }}">
                     </div>
                      <span class="text-danger">{{ $errors->first('end_date') }}</span>
                  </div>
                  <div class="col-md-1 {{ $errors->has('end_time') ? 'has-error' : '' }} mlpl0">
                     <label  class="control-label">TIME <span class="text-danger">*</span></label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker" name="end_time" value="{{ isset($noc_data) ? $noc_data->end_time : '' }}">
                     </div>
                      <span class="text-danger">{{ $errors->first('end_time') }}</span>
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">ATTACH NOC REQUEST</label>
                     <input class="form-control input-sm" type="file" placeholder="" id="noc_file" name="noc_file">
                     <input class="form-control input-sm" type="hidden" placeholder="" id="old_noc_file" name="old_noc_file"  value="{{ isset($noc_data) ? $noc_data->noc_file : '' }}">
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-1 mt23"><button type="submit" class="btn btn-block btn-info btn-xs">UPDATE</button></div>
                <div class="col-md-1 mt23"><a href="{{route('getclientData',['id'=>$client_id])}}"><button class="btn btn-danger btn-xs" value="Cancel" type="button">CANCEL</button></a>
                </div>

               </div>

             </form>
             </div>
            </div>
         </div>
    </section>
    <!-- /.content -->
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
           $('#datepicker2').datepicker({
             autoclose: true,
              format: 'dd/mm/yyyy'
           });
           $('#datepicker3').datepicker({
             autoclose: true,
              format: 'dd/mm/yyyy'
           });
        $('.timepicker').timepicker({
             showInputs: false
           });
         });
      </script>



  @endsection
