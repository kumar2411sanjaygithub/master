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
      <label  class="control-label">Edit Discom</label>
   </h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="/discom">POC & DISCOM LOSSES</a></li>
     <li class="#"><u>EDIT DISCOM</u></li>
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
    <form method="post" action="{{url('/updatediscom/'.$discomData->id)}}" enctype='multipart/form-data'>
      {!! csrf_field() !!}
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
                       <input type="text" autocomplete="off" class="form-control pull-right input-sm" value="{{ @date('d/m/Y',strtotime($discomData->date_from)) }}" id="datepicker" name="date_from">
                    </div>
                    <span class="text-danger">{{ $errors->first('date_from') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('date_to') ? 'has-error' : '' }}">
                    <label  class="control-label">APPLICATION TO DATE</label><span class="text-danger"><strong>*</strong></span>
                    <div class="input-group date">
                       <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                       </div>
                       <input type="text" autocomplete="off" class="form-control pull-right input-sm" value="{{ @date('d/m/Y',strtotime($discomData->date_to)) }}" id="datepicker1" name="date_to">
                    </div>
                    <span class="text-danger">{{ $errors->first('date_to') }}</span>

                 </div>
                 <div class="col-md-3 {{ $errors->has('region') ? 'has-error' : '' }}">
                    <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
                    <select class="form-control input-sm" name="region" id="region" value="{{old('region')}}">
                        <option value="">SELECT</option>
                        <?php
                          $state_list = \App\Common\StateList::get_states();
                        ?>
                        @foreach($state_list as $state_code=>$state_ar)
                         <option value="{{ $state_code }}" {{ isset($discomData) && $discomData->region == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                        @endforeach
                      </select>
                    <span class="text-danger">{{ $errors->first('region') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('regional_entity') ? 'has-error' : '' }}">
                    <label  class="control-label">VOLTAGE LEVEL</label><span class="text-danger"><strong>*</strong></span>
                    <select class="form-control input-sm" name="regional_entity" id="regional_entity" value="{{old('regional_entity')}}">
                      <option value=''>SELECT</option>
                      @foreach($voltage_array as $vol_list)
                         <option value='{{$vol_list}}' @if((isset($discomData->regional_entity)&& $discomData->regional_entity==$vol_list))? selected="selected" @endif>{{$vol_list}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('regional_entity') }}</span>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-3 {{ $errors->has('injection_poc_loss') ? 'has-error' : '' }}">
                    <label  class="control-label">STU LOSSES</label><span class="text-danger"><strong>*</strong></span>
                    <input class="form-control input-sm num" value="{{ $discomData->injection_poc_loss }}" type="text" placeholder="VALUE" id="injection_poc_loss" name="injection_poc_loss">
                    <span class="text-danger">{{ $errors->first('injection_poc_loss') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('withdraw_poc_loss') ? 'has-error' : '' }}">
                    <label  class="control-label">DISCOM LOSSES</label><span class="text-danger"><strong>*</strong></span>
                    <input class="form-control input-sm num" value="{{ $discomData->withdraw_poc_loss }}" type="text" placeholder="VALUE" id="withdraw_poc_loss" name="withdraw_poc_loss">
                    <span class="text-danger">{{ $errors->first('withdraw_poc_loss') }}</span>
                 </div>
                 <div class="col-md-3"></div>
                 <div class="col-md-3 mt23">
                   <div class="col-md-6"><button type="submit" class="btn btn-block btn-info btn-xs">UPDATE</button></div>
                   <div class="col-md-6"><a href="/discom"><button type="button" class="btn btn-block btn-danger btn-xs">CANCEL</button></a></div>
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
   })
</script>
<script>
$(document).ready(function(){
  $('#region').on('change', function() {

    var state=this.value;
    if(state!='')
    {
      $.ajax({
          url: '{{ url()->to("noc_discom_s") }}',
          type: 'GET',
          data: {'state':state},
          dataType: 'JSON',
          success: function(data)
          {
            html1='';
            html1+='<option value="">CHOOSE</option>';
            $.each(data.voltage, function(key1, value1){
              html1+='<option value="'+value1+'">'+value1+'</option>';
            });
            $('#regional_entity').html(html1);

            // html='';
            // html+='<option value="">CHOOSE</option>';
            // $.each(data.discom, function(key, value){
            //   html+='<option value="'+value+'">'+value+'</option>';
            // });
            // $('#discom').html(html);
          }
      });
    }
  });

});
</script>
@endsection
