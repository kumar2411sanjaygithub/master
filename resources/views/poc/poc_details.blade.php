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
      <label  class="control-label">ADD POC LOSSES</label>
   </h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">POC & Discom Losses</a></li>
      <li><a href="#" class="active">POC Add</a></li>
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
    <form method="post" enctype="multipart/form-data" action="{{ route('addpoc')}}">
      {{ csrf_field()}}
      <div class="row poc-tab @if($errors->isEmpty())hidden @else  @endif">
      <div class="col-xs-12">
        <div class="box">
           <div class="box-body">
              <div class="row">
                 <div class="col-md-3 {{ $errors->has('date_from') ? 'has-error' : '' }}">
                    <label  class="control-label">APPLICATON FROM DATE</label>
                    <div class="input-group date">
                       <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                       </div>
                       <input type="text" class="form-control pull-right input-sm" autocomplete="off" id="datepicker" name="date_from">
                       <span class="text-danger">{{ $errors->first('date_from') }}</span>
                    </div>
                 </div>
                 <div class="col-md-3 {{ $errors->has('date_to') ? 'has-error' : '' }}">
                    <label  class="control-label">APPLICATION TO DATE</label>
                    <div class="input-group date">
                       <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                       </div>
                       <input type="text" class="form-control pull-right input-sm" autocomplete="off" id="datepicker1" name="date_to">
                       <span class="text-danger">{{ $errors->first('date_to') }}</span>
                    </div>
                 </div>
                 <div class="col-md-3 {{ $errors->has('region') ? 'has-error' : '' }}">
                    <label  class="control-label">REGION</label>
                    <select class="form-control input-sm " style="width: 100%;" id="region" name="region">
                      <option value="">Select</option>
                      <option value="Northern">Northern</option>
                      <option value="Western">Western</option>
                      <option value="Southern">Southern</option>
                      <option value="Eastern">Eastern</option>
                      <option value="North Eastern">North Eastern</option>
                      </select>

                    <span class="text-danger">{{ $errors->first('region') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('regional_entity') ? 'has-error' : '' }}">
                    <label  class="control-label">REGIONAL ENTITY</label>
                    <input class="form-control input-sm" type="text" placeholder="VALUE" id="regional_entity" name="regional_entity">
                    <span class="text-danger">{{ $errors->first('regional_entity') }}</span>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-3 {{ $errors->has('injection_poc_loss') ? 'has-error' : '' }}">
                    <label  class="control-label">INJECTION POC LOSSES(%)</label>
                    <input class="form-control input-sm num" type="text" placeholder="VALUE" id="injection_poc_loss" name="injection_poc_loss">
                    <span class="text-danger">{{ $errors->first('injection_poc_loss') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('withdraw_poc_loss') ? 'has-error' : '' }}">
                    <label  class="control-label">WITHDRAWAL POC LOSS(%)</label>
                    <input class="form-control input-sm num" type="text" placeholder="VALUE" id="withdraw_poc_loss" name="withdraw_poc_loss">
                    <span class="text-danger">{{ $errors->first('withdraw_poc_loss') }}</span>
                 </div>
               </div>
               <div class="row">&nbsp;</div>
               <div class="row">
                 <div class="col-md-12 text-center">
                   <button type="submit" class="btn btn-info btn-xs">SAVE</button>
                 <button type="button" class="btn btn-danger btn-xs poc-cancel">CANCEL</button>
               </div>
              </div>
              <div class="row">&nbsp;</div>
           </div>
        </div>
      </div>
    </div>
    </form>
    <div class="row">
     <div class="col-md-12">
        <a href="#" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#myModal">&nbsp IMPORT(CSV/XLSX)</a>
        <a class="btn btn-info btn-xs poc-btn pull-right mr5" name=" "><span class="glyphicon glyphicon-plus"></span>&nbsp ADD</a>
      </div>
    </div>
  <div class="box">
     <div class="box-body table-responsive">
        <table class="table table-bordered text-center">
          <thead class="tablehead">
            <tr>
              <th class="text-center"><u>S.No</u></th>
              <th class="text-center"><u>Application From Date</u></th>
              <th class="text-center"><u>Application To Date</u></th>
              <th class="text-center"><u>Region</u></th>
              <th class="text-center"><u>Regional Entity</u></th>
              <th class="text-center"><u>Injection POC loss (in %)</u></th>
              <th class="text-center"><u>Withdrawal POC loss (in %)</u></th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($lossesData as $key => $value)
            <tr>
              <td class="text-center">{{$key+1}}</td>
              <td class="text-center">{{ $value->date_from }}</td>
              <td class="text-center">{{ $value->date_to }}</td>
              <td class="text-center">{{ $value->region }}</td>
              <td class="text-center">{{ $value->regional_entity }}</td>
              <td class="text-center">{{ $value->injection_poc_loss }}</td>
              <td class="text-center">{{ $value->withdraw_poc_loss }}</td>
              <td class="text-center">
                <a href="/poc/{{$value->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                &nbsp;&nbsp;&nbsp;
                <a href="/poc/deleteppa/{{$value->id}}"><span class="glyphicon glyphicon-trash"></span></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
     </div>
  </div>
  </section>
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header text-center">
          <h4 class="modal-title">Import CSV/XLSX</h4>
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <input type="file" name="file">
          <input type="text" class="form-control pull-right input-sm" autocomplete="off" id="datepicker" name="date_from">

          <input type="text" class="form-control pull-right input-sm" autocomplete="off" id="datepicker1" name="date_to">

        </div>

        <!-- Modal footer -->
        <div class="modal-footer text-center">
          <button type="button" class="btn btn-danger text-center" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
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
   $(".poc-btn").click(function(){
     $(".poc-tab").removeClass('hidden');
     $(".poc-btn").hide();
   });
   $(".poc-cancel").click(function(){
      $(".poc-tab").addClass('hidden');
      $(".poc-btn").show();
   });
</script>
@endsection
