@extends('theme.layouts.default')
@section('content')
<style type="text/css">
.divhide{
  display: none;
}
.divshow{
  display: block;
}
</style>
<section class="content">
   @if(session()->has('message'))
            <div class="alert alert-success mt10">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('message') }}
            </div>
          @endif

      <div class="row" >
        <div class="col-xs-12">
          <div class="row">
            <div class="col-md-5 pull-left">
                <h5><label  class="control-label"><u>NOC DETAILS</u>&nbsp&nbsp&nbsp&nbsp {{$client_details[0]['company_name']}}&nbsp<span style="color:#51c0f0;font-size:15px;">|</span> &nbsp{{$client_details[0]['crn_no']}}&nbsp<span style="color:#51c0f0;font-size:15px;">|</span> &nbsp{{$client_details[0]['iex_portfolio']}}&nbsp<span style="color:#51c0f0;font-size:15px;">|</span> &nbsp{{$client_details[0]['pxil_portfolio']}}</label></h5>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-2 text-right"><button class="btn btn-info btn-xs mt7" id="add">  <span class="glyphicon glyphicon-plus"></span>&nbsp ADD</button>
                <a href="{{ route('basic.details') }}"><button  class="btn btn-info btn-xs mt7" value=" BACK TO LIST"><span class="glyphicon glyphicon-forward"></span>&nbsp;BACK TO LIST</button></a>
            </div>
          </div>

        <form method ="post" action="{{isset($get_noc_details)?url('noc_edit/'.$get_noc_details->id):route('noc_create')}}" enctype="multipart/form-data">
           {{ csrf_field() }}

      <div class="row {{(isset($get_noc_details)||!$errors->isEmpty())?'':'divhide'}}" id="nocbox">
        <div class="col-xs-12">
     <div class="box" id="noccbox">
    <div class="box-body">
    <div class="row {{ $errors->has('noc_type') ? 'has-error' : '' }}">
      <div class="col-md-3">
      <label  class="control-label">NOC TYPE</label>
      <input type="hidden"  name="client_id" value="{{@$client_id}}" id="client">
      <select class="form-control input-sm " style="width: 100%;" id="noc_type" name="noc_type" value="{{isset($get_noc_details)?$get_noc_details->noc_type:old('noc_type')}}">
          <option value="">Select</option>
                              <option value="buy">Buy</option>
                              <option value="sell">Sell</option>
      </select>
      </div>
      <div class="col-md-3 {{ $errors->has('validity_from') ? 'has-error' : '' }}">
       <label  class="control-label">VALIDITY START DATE</label>
       <div class="input-group date"  id="datepicker" name="sde">
         <div class="input-group-addon">
           <i class="fa fa-calendar"></i>
         </div>
         <input type="text" class="form-control pull-right input-sm" id="validity_from" name="validity_from" value="{{isset($get_noc_details)?$get_noc_details->validity_from:old('validity_from')}}">
       </div>
       <span class="text-danger">{{ $errors->first('validity_from') }}</span>
      </div>
      <div class="col-md-3 {{ $errors->has('validity_to') ? 'has-error' : '' }}">
        <label  class="control-label">VALIDITY END START</label>
        <div class="input-group date" id="datepicker" name="mkl">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>

          <input type="text" class="form-control pull-right input-sm" id="validity_to" name="validity_to" value="{{isset($get_noc_details)?$get_noc_details->validity_to:old('validity_to')}}">
        </div>
        <span class="text-danger">{{ $errors->first('validity_to') }}</span>
      </div>
        <div class="col-md-3 {{ $errors->has('noc_periphery') ? 'has-error' : '' }}">
      <label  class="control-label">NOC PERIPHERY</label>
      <select class="form-control input-sm" style="width: 100%;" id="noc_periphery" name="noc_periphery" value="{{isset($get_noc_details)?$get_noc_details->noc_periphery:old('noc_periphery')}}">
         <option value="">Select</option>
                              <option value="Regional" {{(isset($get_noc_details)&& $get_noc_details->ex_type=='Regional')||old('noc_periphery')=='Regional'?'selected':''}}>Regional</option>
                              <option value="Ex-Bus" {{(isset($get_noc_details)&& $get_noc_details->ex_type=='Ex-Bus')||old('noc_periphery')=='Ex-Bus'?'selected':''}}>Ex-Bus</option>
                              <option value="stu" {{(isset($get_noc_details)&& $get_noc_details->ex_type=='stu')||old('noc_periphery')=='stu'?'selected':''}}>STU</option>
        </select>
         <span class="text-danger">{{ $errors->first('noc_periphery') }}</span>
    </div>
    </div>

    <div class="row">
       <div class="col-md-3">
        <label  class="control-label">NOC QUANTUM</label><span class="text-danger"><strong>*</strong></span>
        <input class="form-control input-sm" type="text" placeholder="ENTER NOC QUANTUM" id="noc_quantum" name="noc_quantum" value="{{isset($get_noc_details)?$get_noc_details->noc_quantum:old('noc_quantum')}}">
      </div>

      <div class="col-md-3">
      <label  class="control-label">REGION</label>
      <select class="form-control input-sm " style="width: 100%;" id="region" name="region" value="{{isset($get_noc_details)?$get_noc_details->region:old('region')}}">

          @foreach($region as $regions)
        <option value="{{$regions->id}}">{{$regions->region}}</option>
          @endForeach
                </select>

      </select>
    </div>
    <div class="col-md-3">
    <label  class="control-label">REGION ENTITY</label>
    <select class="form-control input-sm" style="width: 100%;" id="region_entity" name="region_entity" value="{{isset($get_noc_details)?$get_noc_details->region_entity:old('region_entity')}}">

          @foreach($regional as $regions)
        <option value="{{$regions->id}}">{{$regions->regional_entity}}</option>
          @endForeach
      </select>
  </div>
  @if($noc_losses->inter_poc == 'yes')
  <div class="col-md-3">
  <label  class="control-label">POC LOSSES</label>
  <input class="form-control input-sm" type="text" placeholder="ENTER POC LOSSES" id="poc_losses" name="poc_losses" value="{{isset($get_noc_details)?$get_noc_details->poc_losses:old('poc_losses')}}">
</div>
@else
<div class="col-md-3">
  <label  class="control-label">POC LOSSES</label>
  <input class="form-control input-sm" type="text" placeholder="ENTER POC LOSSES" id="poc_losses" name="poc_losses"  readonly value="{{isset($get_noc_details)?$get_noc_details->poc_losses:old('poc_losses')}}">
</div>
@endif
</div>

<div class="row">
   @if($noc_losses->inter_stu == 'yes')
  <div class="col-md-3">
  <label  class="control-label">STU LOSSES</label>
  <input class="form-control input-sm" type="text" placeholder="ENTER STU LOSSES" id="stu_losses" name="stu_losses" value="{{isset($get_noc_details)?$get_noc_details->stu_losses:old('stu_losses')}}">
</div>
@else
<div class="col-md-3">
  <label  class="control-label">STU LOSSES</label>
  <input class="form-control input-sm" type="text"  readonly placeholder="ENTER STU LOSSES" id="stu_losses" name="stu_losses" value="{{isset($get_noc_details)?$get_noc_details->stu_losses:old('stu_losses')}}">
</div>
@endif
 @if($noc_losses->inter_discom == 'yes')
  <div class="col-md-3">
  <label  class="control-label">DISCOM LOSSES</label>
  <input class="form-control input-sm" type="text" placeholder="ENTER DISCOM LOSSES" id="discom_losses" name="discom_losses" value="{{isset($get_noc_details)?$get_noc_details->discom_losses:old('discom_losses')}}">
</div>
@else
<div class="col-md-3">
  <label  class="control-label">DISCOM LOSSES</label>
  <input class="form-control input-sm" type="text" readonly placeholder="ENTER DISCOM LOSSES" id="discom_losses" name="discom_losses" value="{{isset($get_noc_details)?$get_noc_details->discom_losses:old('discom_losses')}}">
  </div>
  @endif
<div class="col-md-3">
<label  class="control-label">FINAL NOC QUANTUM</label>
  <input class="form-control input-sm" type="text" placeholder="ENTER FINAL NOC QUANTUM"id="final_quantum" name="final_quantum" value="{{isset($get_noc_details)?$get_noc_details->final_quantum:old('final_quantum')}}">
</div>
<div class="col-md-3">
<label  class="control-label">UPLOAD NOC FILE</label>
<input class="form-control input-sm" type="file" placeholder="ENTER UPLOAD NOC FILE" id="upload_noc" name="upload_noc" value="{{isset($get_noc_details)?$get_noc_details->upload_noc:old('upload_noc')}}">
</div>
</div>

     <div class="row">&nbsp;</div>
      <div class="row">
         <div class="col-md-5"></div>
          @if(isset($get_noc_details))
          <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs" id="save" name="save">UPDATE</button></div>
          @else
          <div class="col-md-1"><button type="submit" class="btn btn-block btn-success btn-xs" id="save" name="save">SAVE</button></div>
          @endif
          <div class="col-md-1"><input type="button" class="btn btn-block btn-danger btn-xs" id="bn7" name="bn7" value="Cancel" onclick="myFunction()"></div>
      </div>
      </div>
    </div>
    </div>
  </div>
    <div class="row">
        <div class="col-xs-12">

<div class="box">
  <div class="box-body table-responsive">
    <table class="table table-bordered text-center">
  <thead>
    <tr>
      <th >SR.NO</th>
      <th>NOC TYPE</th>
      <th>NOC QUANTUM</th>
      <th>VALIDITY START DATE</th>
      <th>VALIDITY END DATE</th>
      <th>NOC PERIPHERY</th>
      <th>POC LOSSES(%)</th>
      <th>DISCOM LOSSES(%)</th>
      <th>STU LOSSES</th>
      <th>FINAL NOC QUANTUM</th>
      <th>FILE</th>
      <th>STATUS</th>
      <th >ACTION</th>
    </tr>
  </thead>
  <tbody>

        @isset($nocData)
                           <?php
                             $i=1;
                           ?>
                           @foreach ($nocData as $key => $value)
                           <tr>
                              <td class="text-center">{{ $i }}</td>
                              <td class="text-center">{{ $value->noc_type }}</td>
                              <td class="text-center">{{ $value->noc_quantum }}</td>
                              <td class="text-center">{{ $value->validity_from }}</td>
                              <td class="text-center">{{ $value->validity_to }}</td>
                              <td class="text-center">{{ $value->noc_periphery }}</td>
                              <td class="text-center">{{ $value->poc_losses }}</td>
                              <td class="text-center">{{ $value->discom_losses }}</td>
                              <td class="text-center">{{ $value->stu_losses }}</td>
                              <td class="text-center">{{ $value->final_quantum }}</td>
                              <td class="text-center">{{ $value->upload_noc }}</td>
                              <td class="text-center">{{ $value->status }}</td>
                              <td class="text-center">
                                  <a href="{{url('/editnocdetail/'.$client_id.'/eid/'.$value->id)}}"><span class="glyphicon glyphicon-pencil" id="edit-noc-detail" noc_detail_id="{{$value->id}}"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="/delete/noc/{{$value->id}}"><span class="glyphicon glyphicon-trash " id="remove-noc-detail" noc_detail_id="{{$value->id}}"></span></a>
                              </td>
                           </tr>
                           <?php
                              $i++;
                           ?>
                           @endforeach
                           @endisset

                   </tbody>
                </table>
              </div>
              </div>
    </div>
  </div>
    </section>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script>

     $(document).ready(function(){
      $('#add').on('click', function(){

      $('#nocbox').removeClass('divhide').addClass('divshow');
      });
      });
     </script>
     <script>
  function myFunction(){
    //alert(1);
    $('#noccbox').addClass('divhide').removeClass('divshow');
  }
  </script>
    <script>
       $(document).ready(function(){


      $('#noc_type').change(function(){
          if($("#noc_quantum").val()){
        var p = (isNaN($("#poc_losses").val()) || $("#poc_losses").val()=='')?0:($("#noc_quantum").val()*($("#poc_losses").val())/100);

        if($("#noc_type").val() == 'buy')
         {
        $('#final_quantum').val(parseFloat($("#noc_quantum").val())+p);
         }
        if($("#noc_type").val() == 'sell')
         {
           $('#final_quantum').val(parseFloat($("#noc_quantum").val())-p);
         }
        var s = (isNaN($("#stu_losess").val()) || $("#stu_losess").val()=='')?0:($('#final_quantum').val()*($("#stu_losess").val())/100);
        if($("#noc_type").val() == 'buy')
         {
        $('#final_quantum').val(parseFloat($('#final_quantum').val())+s);
         }
        if($("#noc_type").val() == 'sell')
         {
           $('#final_quantum').val(parseFloat($('#final_quantum').val())-s);
         }

       var dl = (isNaN($("#discom_lossess").val()) || $("#discom_lossess").val()=='')?0:($("#final_quantum").val()*($("#discom_lossess").val())/100);

        if($("#noc_type").val() == 'buy')
         {

        $('#final_quantum').val((parseFloat($('#final_quantum').val())+dl).toFixed(2));
         }
        if($("#noc_type").val() == 'sell')
         {
           $('#final_quantum').val((parseFloat($('#final_quantum').val())-dl).toFixed(2));
         }
        var spd = parseInt(s) + parseInt(p) + parseInt(dl);

       $('#final_quantum').addClass('valid');
     }else{
       $('#final_quantum').val('');
     }
      });

      $('#noc_periphery').change(function(){
         var nocval = $('#noc_periphery').val();
         if(nocval == 'Ex-Bus')
         {

            // $('#discom_lossess,#poc_losses,#stu_losess').keyup(function(event) {
            $('#noc_quantum').keyup(function(event) {


               var p = (isNaN($("#poc_losses").val()) || $("#poc_losses").val()=='')?0:($("#noc_quantum").val()*($("#poc_losses").val())/100);

               if($("#noc_type").val() == 'buy')
                {
               $('#final_quantum').val(parseFloat($("#noc_quantum").val())+p);
                }
               if($("#noc_type").val() == 'sell')
                {
                  $('#final_quantum').val(parseFloat($("#noc_quantum").val())-p);
                }
               var s = (isNaN($("#stu_losess").val()) || $("#stu_losess").val()=='')?0:($('#final_quantum').val()*($("#stu_losess").val())/100);
               if($("#noc_type").val() == 'buy')
                {
               $('#final_quantum').val(parseFloat($('#final_quantum').val())+s);
                }
               if($("#noc_type").val() == 'sell')
                {
                  $('#final_quantum').val(parseFloat($('#final_quantum').val())-s);
                }

              var dl = (isNaN($("#discom_lossess").val()) || $("#discom_lossess").val()=='')?0:($("#final_quantum").val()*($("#discom_lossess").val())/100);

               if($("#noc_type").val() == 'buy')
                {

               $('#final_quantum').val((parseFloat($('#final_quantum').val())+dl).toFixed(2));
                }
               if($("#noc_type").val() == 'sell')
                {
                  $('#final_quantum').val((parseFloat($('#final_quantum').val())-dl).toFixed(2));
                }
               var spd = parseInt(s) + parseInt(p) + parseInt(dl);

               // if($("#noc_type").val() == 'buy')
               // {
               //    var total = parseInt(n) + spd;
               // }
               // if($("#noc_type").val() == 'sell')
               // {
               //    var total = parseInt(n) - spd;
               // }
              // $("#final_quantum").val(total);
              $('#final_quantum').addClass('valid');
            });
            $("#final_quantum").val('');
            $("#stu_poc_discom").removeClass('hidden');
         }
         if(nocval == 'Regional')
         {
            $("#final_quantum").val('');
            $("#stu_poc_discom").addClass('hidden');
            $('#noc_quantum').keyup(function(event) {

               var nocval = $('#noc_periphery').val();
               if(nocval == 'Regional')
               {
                  $("#final_quantum").val('');
                  $("#final_quantum").val($('#noc_quantum').val());
                  $('#final_quantum').addClass('valid');
               }
            });
         }
      });
   });
</script>
<script type="text/javascript">
$(document).ready(function(){
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
            autoclose: true
          })
          $('#datepicker3').datepicker({
            autoclose: true
          })
       $('.timepicker').timepicker({
            showInputs: false
          })
        })
</script>
<script type="text/javascript">
  $(".save ").click(function(){
    $(".hw1").focus();
  });
</script>
    @endsection
