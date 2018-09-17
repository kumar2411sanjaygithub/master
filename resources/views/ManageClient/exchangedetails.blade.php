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
 <section class="content-header">
      <h5><label  class="control-label"><u>Upload Exchange File</u>&nbsp <small>lakhan pvt. ltd</small></label></h5>
    </section>
    <section class="content">
       @if(session()->has('message'))
            <div class="alert alert-success mt10">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('message') }}
            </div>
          @endif



          <form method ="post" action="{{isset($get_exchange_details)?url('exchange_edit/'.$get_exchange_details->id):route('exchange_create')}}" enctype="multipart/form-data">
           {{ csrf_field() }}
           <div class="row{{isset($get_bank_details)?'':'divhide'}}" id="exchangebox">

          <div class="box">
          <div class="box-body">
          <div class="row">
              <div class="col-md-3 {{ $errors->has('ex_type') ? 'has-error' : '' }}">
                <input type="hidden"  name="client_id" value="{{@$client_id}}" id="client">
              <label  class="control-label">EXCHANGE TYPE*</label>
              <select class="form-control input-sm " style="width: 100%;" id="ex_type" name="ex_type" >
                  <option value="">SELECT EXCHANGE</option>
                  <option value="iex" {{(isset($get_exchange_details)&& $get_exchange_details->ex_type=='iex')||old('ex_type')=='iex'?'selected':''}}>IEX</option>
                  <option value="pxil" {{(isset($get_exchange_details)&& $get_exchange_details->ex_type=='pxil')||old('ex_type')=='pxil'?'selected':''}}>PXIL</option>
      </select>
      <span class="text-danger">{{ $errors->first('ex_type') }}</span>
      </div>
      <div class="col-md-3 {{ $errors->has('validity_from') ? 'has-error' : '' }}">
       <label  class="control-label">VALIDITY START DATE*</label>
       <div class="input-group date" id="datepicker" >
         <div class="input-group-addon">
           <i class="fa fa-calendar"></i>
         </div>
         <input type="text" class="form-control pull-right input-sm"  id="validity_from" name="validity_from" value="{{isset($get_exchange_details)?$get_exchange_details->validity_from:old('validity_from')}}">

       </div>
       <span class="text-danger">{{ $errors->first('validity_from') }}</span>
      </div>
      <div class="col-md-3 ">
        <label  class="control-label">VALIDITY END START*</label>
        <div class="input-group date" id="datepicker1">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control pull-right input-sm"  id="validity_to" name="validity_to" value="{{isset($get_exchange_details)?$get_exchange_details->validity_to:old('validity_to')}}">

        </div>
        <span class="text-danger">{{ $errors->first('validity_to') }}</span>
      </div>
      <div class="col-md-3 {{ $errors->has('file_upload') ? 'has-error' : '' }}">
        <label  class="control-label">REGISTRATION CERTIFICATE*</label><span class="text-danger"><strong>*</strong></span>
        <input class="form-control input-sm" type="file" placeholder="" id="file_upload" name="file_upload">
         <span class="text-danger">{{ $errors->first('file_upload') }}</span>
      </div>
    </div>
     <div class="row">&nbsp;</div>
       <div class="row">
         <div class="col-md-5"></div>
         @if(isset($get_exchange_details))
          <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs" id="save" name="save">UPDATE</button></div>
          @else
          <div class="col-md-1"><button type="submit" class="btn btn-block btn-success btn-xs" id="save" name="save">SAVE</button></div>
          @endif
          <div class="col-md-1"><input type="button" class="btn btn-block btn-danger btn-xs" id="bn7" name="bn7" value="Cancel"  onclick="myFunction()"></div>

        <div class="col-md-5"></div>
      </div>

    </div>
    </div>
  </div>
</form>
                    <div class="row">
                         <div class="col-xs-12">
                                <div class="row">
                                   <div class="col-md-9"></div>
                                   <div class="col-md-3 text-right"><button class="btn btn-info btn-xs" id="add">
                                    <span class="glyphicon glyphicon-plus"></span>&nbsp ADD</button>
                                    <a href="{{ route('basic.details') }}"><input type="button"  class="btn btn-info btn-xs" value=" BACK TO LIST"></a>
                                  </div></div>
                                <div class="box">
                                <div class="box-body table-responsive">
                                  <table class="table table-bordered text-center">
                                <thead>
                                  <tr>
                                    <th>SR.NO</th>
                                    <th>TYPE</th>
                                    <th>VALIDITY START DATE</th>
                                    <th>VALIDITY END DATE</th>
                                    <th>FILE</th>

                                    <th>ACTION</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @isset($exchangedetails)
                              <?php
                              $i=1;
                              ?>
                              @foreach ($exchangedetails as $key => $value)
                               <tr>
                                  <td class="text-center">{{ $i }}</td>
                                  <td class="text-center">{{ $value->ex_type }}</td>
                                  <td class="text-center">{{ $value->validity_from }}</td>
                                  <td class="text-center">{{ $value->validity_to }}</td>
                                  <td class="text-center">{{ $value->file_upload }}</td>

                                  <td class="text-center">
                                    <a href="{{url('/editexchangedetail/'.$client_id.'/eid/'.$value->id)}}"><span class="glyphicon glyphicon-pencil" id="edit-bank-detail" bank_detail_id="{{ $value->id }}"></span></a>
                                    <a href="/delete/exchange/{{$value->id}}"><span class="glyphicon glyphicon-trash text-danger" id="remove-bank-detail" bank_detail_id="{{ $value->id }}"></span></a>
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

      $('#exchangebox').removeClass('divhide').addClass('divshow');
      });
      });
     </script>
     <script>
  function myFunction(){
    //alert(1);
    $('#exchangebox').addClass('divhide').removeClass('divshow');
  }
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
   <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
     @endsection
