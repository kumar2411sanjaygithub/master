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
<style>
.scroll-table-container {
height:auto;
overflow: scroll;
}
.scroll-table1
{
border-collapse:collapse;
min-width:260px;
}
.scroll-table4
{
border-collapse:collapse;
min-width:130px;
}
.scroll-table5
{
border-collapse:collapse;
min-width:160px;
}
.scroll-table2
{
border-collapse:collapse;
min-width:50px;
}
.scroll-table3
{
border-collapse:collapse;
min-width:100px;
}
.fnt
{
  font-size:11px!important;
  padding-left:10px!important;
  padding-right: 10px!important;
  padding-bottom:0px!important;
  padding-top:0px!important;
  font-weight:600!important;

}
</style>

<section class="content">
   @if(session()->has('message'))
            <div class="alert alert-success mt10">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('message') }}
            </div>
          @endif

    <div class="row">
        <div class="col-xs-12">

          <div class="row">
            <div class="col-md-6 pull-left">
                <h5 class="pull-left"><label class="control-label pull-right mt-1"><u>NOC DETAILS</u></h5> &nbsp;&nbsp;&nbsp; {{$client_details[0]['company_name']}}<span class="hifan">|</span> {{$client_details[0]['crn_no']}} <span class="hifan">|</span> {{$client_details[0]['iex_portfolio']}}<span class="hifan">|</span> {{$client_details[0]['pxil_portfolio']}}</label>
            </div>
            <div class="col-md-6 pull-right">
                    <a href="{{ route('basic.details') }}"><button type="button" class="btn btn-info btn-xs pull-right mt7"><span class="glyphicon glyphicon-forward"></span>BACK TO LIST</button></a>
                    @if(empty($get_noc_details))
                    <button class="btn btn-info btn-xs pull-right mr5 mt7" id="add"><span class="glyphicon glyphicon-plus"></span>&nbsp ADD</button>
                    @endif
            </div>
          </div>

      <div class="row">

        <div class="col-xs-12">

        <form method ="post" action="{{isset($get_noc_details)?url('noc_edit/'.$get_noc_details->id):route('noc_create')}}" enctype="multipart/form-data">
           {{ csrf_field() }}

      <div class="row {{(isset($get_noc_details)||!$errors->isEmpty())?'':'divhide'}}" id="nocbox">
        <div class="col-xs-12">
     <div class="box" id="noccbox">
    <div class="box-body">
    <div class="row">
      <div class="col-md-3  {{ $errors->has('noc_application_no') ? 'has-error' : '' }}">
      <label  class="control-label">NOC APPLICATION NO<span class="text-danger"><strong>*</strong></label>
      <select class="form-control input-sm " style="width: 100%;" id="noc_application_no" name="noc_application_no">
          <option value="">Select</option>
          @if(count($noc_applicaiton)>0)
            @foreach($noc_applicaiton as $application)
              <option value="{{$application->application_no}}" {{((isset($get_noc_details)&& $get_noc_details->noc_application_no==$application->application_no)||old('noc_application_no')==$application->application_no)?'selected="selected"':''}}>{{$application->application_no}}</option>
            @endforeach
          @else
            <option value="">No Record.</option>
          @endif
      </select>
        <span class="text-danger">{{ $errors->first('noc_application_no') }}</span>      
      </div>

      <div class="col-md-3  {{ $errors->has('noc_type') ? 'has-error' : '' }}">
      <label  class="control-label">NOC TYPE<span class="text-danger"><strong>*</strong></label>
      <input type="hidden"  name="client_id" value="{{@$client_id}}" id="client">
      <select class="form-control input-sm " style="width: 100%;" id="noc_type" name="noc_type" disabled>
          <option value="">Select</option>
          <option value="buy" {{((isset($get_noc_details)&&$get_noc_details->noc_type=='buy')||old('noc_type')=='buy')?'selected="selected"':''}}>Buy</option>
          <option value="sell" {{((isset($get_noc_details)&&$get_noc_details->noc_type=='sell')||old('noc_type')=='sell')?'selected="selected"':''}}>Sell</option>
      </select>
        <span class="text-danger">{{ $errors->first('noc_type') }}</span>

      </div>
      <div class="col-md-3  {{ $errors->has('exchange') ? 'has-error' : '' }}">
      <label  class="control-label">EXCHANGE TYPE<span class="text-danger"><strong>*</strong></label>
      <select class="form-control input-sm " style="width: 100%;" id="exchange" name="exchange" disabled>
          <option value="">Select</option>
          <option value="iex" {{((isset($get_noc_details)&&$get_noc_details->exchange=='iex')||old('exchange')=='iex')?'selected="selected"':''}}>IEX</option>
          <option value="pxil" {{((isset($get_noc_details)&&$get_noc_details->exchange=='pxil')||old('exchange')=='pxil')?'selected="selected"':''}}>PXIL</option>
      </select>
        <span class="text-danger">{{ $errors->first('exchange') }}</span>

      </div>

      <div class="col-md-3 {{ $errors->has('validity_from') ? 'has-error' : '' }}">
       <label  class="control-label">VALIDITY START DATE<span class="text-danger"><strong>*</strong></label>
       <div class="input-group date"  id="datepicker" name="sde">
         <div class="input-group-addon">
           <i class="fa fa-calendar"></i>
         </div>
         <input type="text" class="form-control pull-right input-sm" id="validity_from" name="validity_from" value="{{isset($get_noc_details)?date('d/m/Y',strtotime($get_noc_details->validity_from)):old('validity_from')}}" autocomplete="off" disabled>
       </div>
       <span class="text-danger">{{ $errors->first('validity_from') }}</span>
      </div>

    </div>

    <div class="row">
      <div class="col-md-3 {{ $errors->has('validity_to') ? 'has-error' : '' }}">
        <label  class="control-label">VALIDITY END START<span class="text-danger"><strong>*</strong></label>
        <div class="input-group date" id="datepicker1" name="mkl">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>

          <input type="text" class="form-control pull-right input-sm" id="validity_to" name="validity_to" value="{{isset($get_noc_details)?date('d/m/Y',strtotime($get_noc_details->validity_to)):old('validity_to')}}" autocomplete="off" disabled>
        </div>
        <span class="text-danger">{{ $errors->first('validity_to') }}</span>
      </div>

        <div class="col-md-3 {{ $errors->has('noc_periphery') ? 'has-error' : '' }}">
      <label  class="control-label">NOC PERIPHERY<span class="text-danger"><strong>*</strong></label>
      <select class="form-control input-sm" style="width: 100%;" id="noc_periphery" name="noc_periphery">
         <option value="">Select</option>
                              <option value="Regional" {{(isset($get_noc_details)&& $get_noc_details->noc_periphery=='Regional')?'selected':''}}>Regional</option>
                              <option value="Ex-Bus" {{(isset($get_noc_details)&& $get_noc_details->noc_periphery=='Ex-Bus')?'selected':''}}>Ex-Bus</option>
<!--                               <option value="stu" {{(isset($get_noc_details)&& $get_noc_details->ex_type=='stu')||old('noc_periphery')=='stu'?'selected':''}}>STU</option>
 -->        </select>
         <span class="text-danger">{{ $errors->first('noc_periphery') }}</span>
    </div>

      <div class="col-md-3">
      <label  class="control-label">REGION</label>
      <select class="form-control input-sm " style="width: 100%;" id="region" name="region" {{((isset($get_noc_details)&& $get_noc_details->noc_periphery=='Ex-Bus'))?'':'disabled'}}>
        <option value="">Select</option>
        <option value="Northern" {{(isset($get_noc_details)&& $get_noc_details->region=='Northern')?'selected':''}}>Northern</option>
        <option value="Western" {{(isset($get_noc_details)&& $get_noc_details->region=='Western')?'selected':''}}>Western</option>
        <option value="Southern" {{(isset($get_noc_details)&& $get_noc_details->region=='Southern')?'selected':''}}>Southern</option>
        <option value="Eastern" {{(isset($get_noc_details)&& $get_noc_details->region=='Eastern')?'selected':''}}>Eastern</option>
        <option value="North Eastern" {{(isset($get_noc_details)&& $get_noc_details->region=='North Eastern')?'selected':''}} >North Eastern</option>
        </select>

      </select>
    </div>
    <div class="col-md-3">
    <label  class="control-label">REGION ENTITY</label>
    <select class="form-control input-sm" style="width: 100%;" id="region_entity" name="region_entity"  {{((isset($get_noc_details)&& $get_noc_details->noc_periphery=='Ex-Bus'))?'':'disabled'}}>
          <option value="">Select</option>
          @if(count($poc_losses_data)>0)
            @foreach($poc_losses_data as $poc_losses_list)
            @if(isset($get_noc_details) && $get_noc_details->region_entity==$poc_losses_list->regional_entity)
              <option value="{{$poc_losses_list->regional_entity}}" {{(isset($get_noc_details)&& $get_noc_details->region_entity==$poc_losses_list->regional_entity)?'selected':''}}>{{$poc_losses_list->regional_entity}}</option>
              @endif
            @endforeach
          @endif
      </select>
  </div>
</div>

<div class="row">
 <div class="col-md-3 {{ $errors->has('noc_quantum') ? 'has-error' : '' }}">
  <label  class="control-label">NOC QUANTUM</label><span class="text-danger"><strong>*</strong></span>
  <input class="form-control input-sm num" type="text" placeholder="ENTER NOC QUANTUM" id="noc_quantum" name="noc_quantum" value="{{isset($get_noc_details)?$get_noc_details->noc_quantum:''}}" autocomplete="off">
   <span class="text-danger">{{ $errors->first('noc_quantum') }}</span>
    <span class="text-danger" id="error1" style="display:none;">Required</span>
</div>
<div class="col-md-3">
  <label  class="control-label">POC LOSSES</label>
  <input class="form-control input-sm" type="text" placeholder="ENTER POC LOSSES" id="poc_losses" name="poc_losses"  disabled value="{{isset($get_noc_details)?$get_noc_details->poc_losses:''}}">
</div>


<div class="col-md-3">
  <label  class="control-label">STU LOSSES</label>
  <input class="form-control input-sm" type="text"  disabled placeholder="ENTER STU LOSSES" id="stu_losses" name="stu_losses" value="{{isset($get_noc_details)?$get_noc_details->stu_losses:''}}">
</div>

<div class="col-md-3">
  <label  class="control-label">DISCOM LOSSES</label>
  <input class="form-control input-sm" type="text" disabled placeholder="ENTER DISCOM LOSSES" id="discom_losses" name="discom_losses" value="{{isset($get_noc_details)?$get_noc_details->discom_losses:''}}">
  </div>

<div class="col-md-3">
<label  class="control-label">FINAL NOC QUANTUM</label>
  <input class="form-control input-sm" type="text" placeholder="ENTER FINAL NOC QUANTUM"id="final_quantum" name="final_quantum" value="{{isset($get_noc_details)?$get_noc_details->final_quantum:''}}" disabled>
</div>
<div class="col-md-3 {{ $errors->has('upload_noc') ? 'has-error' : '' }}">
<label  class="control-label">UPLOAD NOC FILE<span class="text-danger"><strong>*</strong></span></label>
<input class="form-control input-sm" type="file" placeholder="ENTER UPLOAD NOC FILE" id="upload_noc" name="upload_noc" value="{{isset($get_noc_details)?$get_noc_details->upload_noc:''}}">
<span class="text-danger">{{ $errors->first('upload_noc') }}</span>
</div>
</div>

     <div class="row">&nbsp;</div>
      <div class="row">
         <div class="col-md-5"></div>
          @if(isset($get_noc_details))
          <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs" onclick="removeDisabled()" id="save" name="save">UPDATE</button></div>
          @else
          <div class="col-md-1"><button type="submit" class="btn btn-block btn-success btn-xs" onclick="removeDisabled()" id="save" name="save">SAVE</button></div>
          @endif
          <div class="col-md-1"><a href="/nocdetails/{{@$client_id}}" type="button" class="btn btn-block btn-danger btn-xs" id="bn7" name="bn7" value="CANCEL" >CANCEL</a></div>
      </div>
      </div>
    </div>
    </div>
    </form>
  </div>

<div class="box">
  <div class="box-body table-responsive scroll-table-container">
    <table class="table table-bordered text-center">
  <thead>
    <tr>
      <th  class="vl scroll-table2" >SR.NO</th>
      <th  class="vl scroll-table4">NOC APPLICATION NO</th>
      <th  class="vl scroll-table3">NOC TYPE</th>
      <th  class="vl scroll-table3">EXCHANGE TYPE</th>
      <th  class="vl scroll-table3">NOC QUANTUM</th>
      <th  class="vl scroll-table4">VALIDITY START DATE</th>
      <th  class="vl scroll-table4">VALIDITY END DATE</th>
      <th  class="vl scroll-table3">NOC PERIPHERY</th>
      <th  class="vl scroll-table3">POC LOSSES(%)</th>
      <th  class="vl scroll-table4">DISCOM LOSSES(%)</th>
      <th  class="vl scroll-table3">STU LOSSES(%)</th>
      <th  class="vl scroll-table4">FINAL NOC QUANTUM</th>
      <th  class="vl scroll-table2">FILE</th>
      <th  class="vl scroll-table2">STATUS</th>
      <th  class="vl scroll-table2">ACTION</th>
    </tr>
  </thead>
  <tbody>

        @if(count($nocData)>0)
                           <?php
                             $i=1;
                           ?>
                           @foreach ($nocData as $key => $value)
                           @php
                              $date1 = date("Y-m-d",strtotime("today midnight"));
                              $date2=date('Y-m-d',strtotime($value->validity_to));
                              $today = strtotime($date1);
                              $expiration_date = strtotime($date2);
                              if ( $today<=$expiration_date) {
                                   $valid = "Valid";
                              } else {
                                   $valid = "Expired";
                              }
                           @endphp


                           <tr>
                              <td class="text-center">{{ $i }}</td>
                              <td class="text-center">{{ $value->noc_application_no }}</td>
                              <td class="text-center">{{ ucfirst($value->noc_type) }}</td>
                              <td class="text-center">{{ strtoupper($value->exchange) }}</td>
                              <td class="text-center">{{ $value->noc_quantum }}</td>
                              <td class="text-center">{{ date('d/m/Y',strtotime($value->validity_from)) }}</td>
                              <td class="text-center">{{ date('d/m/Y',strtotime($value->validity_to)) }}</td>
                              <td class="text-center">{{ ucfirst($value->noc_periphery) }}</td>
                              <td class="text-center">{{ $value->poc_losses }}</td>
                              <td class="text-center">{{ $value->discom_losses }}</td>
                              <td class="text-center">{{ $value->stu_losses }}</td>
                              <td class="text-center">{{ $value->final_quantum }}</td>
                              <td class="text-center">
                                @if($value->upload_noc)
                                  <a href="{{url('noc-file-downloads/'.$value->upload_noc)}}">View</a>
                                @endif
                              </td>
                              <td class="text-center">{{ $valid }}</td>
                              <td class="text-center">
                                  @if($valid=='Valid')
                                  <a href="{{url('/editnocdetail/'.$client_id.'/eid/'.$value->id)}}"><span class="glyphicon glyphicon-pencil" id="edit-noc-detail" noc_detail_id="{{$value->id}}"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                  @endif
                                <a href="/delete/noc/{{$value->id}}"><span class="glyphicon glyphicon-trash " id="remove-noc-detail" noc_detail_id="{{$value->id}}"></span></a>
                              </td>
                           </tr>
                           <?php
                              $i++;
                           ?>
                           @endforeach
                   @else
                   <tr class="alert-danger" ><th colspan='14'>No Data Found.</th></tr>
                   @endif

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
       $('#add').hide();
      });
      });
     </script>
     <script>
  function myFunction(){
    //alert(1);
    $('#nocbox').addClass('divhide').removeClass('divshow');
    $('#add').show();
  }
  </script>
    <script>
       $(document).ready(function(){


     //  $('#noc_type').change(function(){
     //      if($("#noc_quantum").val()){
     //    var p = (isNaN($("#poc_losses").val()) || $("#poc_losses").val()=='')?0:($("#noc_quantum").val()*($("#poc_losses").val())/100);

     //    if($("#noc_type").val() == 'buy')
     //     {
     //    $('#final_quantum').val(parseFloat($("#noc_quantum").val())+p);
     //     }
     //    if($("#noc_type").val() == 'sell')
     //     {
     //       $('#final_quantum').val(parseFloat($("#noc_quantum").val())-p);
     //     }
     //    var s = (isNaN($("#stu_losess").val()) || $("#stu_losess").val()=='')?0:($('#final_quantum').val()*($("#stu_losess").val())/100);
     //    if($("#noc_type").val() == 'buy')
     //     {
     //    $('#final_quantum').val(parseFloat($('#final_quantum').val())+s);
     //     }
     //    if($("#noc_type").val() == 'sell')
     //     {
     //       $('#final_quantum').val(parseFloat($('#final_quantum').val())-s);
     //     }

     //   var dl = (isNaN($("#discom_lossess").val()) || $("#discom_lossess").val()=='')?0:($("#final_quantum").val()*($("#discom_lossess").val())/100);

     //    if($("#noc_type").val() == 'buy')
     //     {

     //    $('#final_quantum').val((parseFloat($('#final_quantum').val())+dl).toFixed(2));
     //     }
     //    if($("#noc_type").val() == 'sell')
     //     {
     //       $('#final_quantum').val((parseFloat($('#final_quantum').val())-dl).toFixed(2));
     //     }
     //    var spd = parseInt(s) + parseInt(p) + parseInt(dl);

     //   $('#final_quantum').addClass('valid');
     // }else{
     //   $('#final_quantum').val('');
     // }
     //  });

      $('#noc_periphery').change(function(){
         var nocval = $('#noc_periphery').val();

         if(nocval == 'Ex-Bus')
         {
          var client_id=$('#client').val();
          // alert(client_id);
           $("#noc_quantum").val('');
          if(client_id!='')
          {
              $.ajax({
                  url: '{{ url()->to("get-losses-ajax") }}',
                  type: 'GET', //this is your methodtotal_lavel_balance
                  data: { 'id':client_id},
                  dataType: 'JSON',
                  success: function(data){
                    //$('#poc_losses').val(data.noc_type);
                    $('#stu_losses').val(data.stu_l);
                    $('#discom_losses').val(data.discom_l);
                    if(data.poc_apply=='Yes')
                    {
                      document.getElementById("region_entity").disabled = false;
                      document.getElementById("region").disabled = false;
                    }
                  }
              });
          }


            // $('#discom_lossess,#poc_losses,#stu_losess').keyup(function(event) {
            $('#noc_quantum').keyup(function(event) {

                if($("#noc_quantum").val()!='')
                {
                   var p = (isNaN($("#poc_losses").val()) || $("#poc_losses").val()=='')?0:($("#noc_quantum").val()*($("#poc_losses").val())/100);

                   if($("#noc_type").val() == 'buy')
                    {
                   $('#final_quantum').val(parseFloat($("#noc_quantum").val())+p);
                    }
                   if($("#noc_type").val() == 'sell')
                    {
                      $('#final_quantum').val(parseFloat($("#noc_quantum").val())-p);
                    }
                   var s = (isNaN($("#stu_losses").val()) || $("#stu_losses").val()=='')?0:($('#final_quantum').val()*($("#stu_losses").val())/100);

                   if($("#noc_type").val() == 'buy')
                    {
                   $('#final_quantum').val(parseFloat($('#final_quantum').val())+s);
                    }
                   if($("#noc_type").val() == 'sell')
                    {
                      $('#final_quantum').val(parseFloat($('#final_quantum').val())-s);
                    }

                  var dl = (isNaN($("#discom_losses").val()) || $("#discom_losses").val()=='')?0:($("#final_quantum").val()*($("#discom_losses").val())/100);

                   if($("#noc_type").val() == 'buy')
                    {

                   $('#final_quantum').val((parseFloat($('#final_quantum').val())+dl).toFixed(2));
                    }
                   if($("#noc_type").val() == 'sell')
                    {
                      $('#final_quantum').val((parseFloat($('#final_quantum').val())-dl).toFixed(2));
                    }
                   var spd = parseInt(s) + parseInt(p) + parseInt(dl);

                   if($("#noc_type").val() == 'buy')
                   {
                      var total = parseInt(n) + spd;
                   }
                   if($("#noc_type").val() == 'sell')
                   {
                      var total = parseInt(n) - spd;
                   }

                  $("#final_quantum").val(total);
                  $('#final_quantum').addClass('valid');
                }
                else
                {
                  $("#final_quantum").val("");
                }
            });
            $("#final_quantum").val('');
            $("#stu_poc_discom").removeClass('hidden');
         }
         if(nocval == 'Regional')
         {
            $("#final_quantum").val('');
            $("#noc_quantum").val('');
            $("#poc_losses").val('');
            $("#stu_losses").val('');
            $("#discom_losses").val('');
            $("#stu_poc_discom").addClass('hidden');
            document.getElementById("region_entity").disabled = true;
            document.getElementById("region").disabled = true;
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
  <script type="text/javascript">
    $(function() {
        $('#noc_application_no').change(function(){
          var id=$(this).val();
          if(id!='')
          {
              $.ajax({
                  url: '{{ url()->to("get-noc-data") }}',
                  type: 'GET', //this is your methodtotal_lavel_balance
                  data: { 'id':id},
                  dataType: 'JSON',
                  success: function(data){
                    $('#noc_type').val(data.noc_type);
                    $('#exchange').val(data.exchange);
                    $('#validity_from').val(data.start_date);
                    $('#validity_to').val(data.end_date);
                  }
              });
          }
        });
    });

  </script>
  <script type="text/javascript">
    $(function() {
        $('#region').change(function(){
          var name=$(this).val();
          if(name!='')
          {
              $.ajax({
                  url: '{{ url()->to("get-region-entity") }}',
                  type: 'GET', //this is your methodtotal_lavel_balance
                  data: { 'name':name},
                  dataType: 'JSON',
                  success: function(data){
                      //alert(data.region_ajax_req);
                      html='<option value="">Select</option>';
                      $.each(data.region_ajax_req,function(key,val){
                        html+='<option value="'+val.regional_entity+'">'+val.regional_entity+'</option>';
                      });
                    $('#region_entity').html(html);
                  }
              });
          }
        });
    });

  </script>
  <script type="text/javascript">
    $(function() {
        $('#region_entity').change(function(){
          var id=$('#client').val();
          var region_entity=$(this).val();
          var noc_type=$('#noc_type').val();
          var region=$('#region').val();
          if(noc_type=='')
          {
            alert('Please Select NOC Type.');
          }
          if(region_entity!='')
          {
              $.ajax({
                  url: '{{ url()->to("get-region-value") }}',
                  type: 'GET', //this is your methodtotal_lavel_balance
                  data: {'id':id,'region_entity':region_entity,'noc_type':noc_type,'region':region},
                  dataType: 'JSON',
                  success: function(data){
                    $('#poc_losses').val(data.poc_losses);
                    $('#noc_quantum').val('');
                    $("#noc_quantum").css('border-color', 'red');
                    $("#error1").show();
                  }
              });
          }
        });
    });

  </script>
<script>
 function removeDisabled(){
    document.getElementById("noc_type").disabled = false;
    document.getElementById("validity_from").disabled = false;
    document.getElementById("validity_to").disabled = false;
    document.getElementById("poc_losses").disabled = false;
    document.getElementById("stu_losses").disabled = false;
    document.getElementById("discom_losses").disabled = false;
    document.getElementById("final_quantum").disabled = false;
    document.getElementById("region").disabled = false;
    document.getElementById("region_entity").disabled = false;
    document.getElementById("exchange").disabled = false;
}
</script>
    @endsection
