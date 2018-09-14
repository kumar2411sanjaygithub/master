@extends('theme.layouts.default')
@section('content_head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <h5><label  class="control-label">ADD PPA DETAILS</label></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">PPA Details</a></li>
      <li><a href="active">ADD PPA DETAILS</a></li>
   </ol>
</section>
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

   <div class="box">
     <form method="post" action="{{ route('ppadetails') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="box-body hidden" id="apd-tab">
         <div class="row">
            <div class="col-md-12">
              <select class="form-control input-sm select2" id="client" name="client" style="width: 100%;">
                 <option selected="selected">SELECT CLIENT</option>
                 @foreach ($clientData as $key => $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
              </select>
            </div>
         </div>
         <div class="row">&nbsp;</div>
         <div class="row">
            <div class="col-md-3 {{ $errors->has('validity_from') ? 'has-error' : '' }}">
               <label  class="control-label">VALIDITY START DATE</label><span class="text-danger"><strong>*</strong></span>
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" autocomplete="off" class="form-control pull-right input-sm" id="datepicker" name="validity_from">
                  <span class="text-danger">{{ $errors->first('validity_from') }}</span>
               </div>
            </div>
            <div class="col-md-3 {{ $errors->has('validity_to') ? 'has-error' : '' }}">
               <label  class="control-label">VALIDITY END DATE</label><span class="text-danger"><strong>*</strong></span>
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" autocomplete="off" class="form-control pull-right input-sm" id="datepicker1" name="validity_to">
                  <span class="text-danger">{{ $errors->first('validity_to') }}</span>
               </div>
            </div>
            <div class="col-md-3 {{ $errors->has('file_path') ? 'has-error' : '' }}">
               <label  class="control-label">UPLOAD DOCUMENT</label><span class="text-danger"><strong>*</strong></span>
               <input class="form-control input-sm" type="file" name="file_path" placeholder="ENTER POC LOSSES">
               <span class="text-danger">{{ $errors->first('file_path') }}</span>
            </div>
         </div>
         <div class="row">&nbsp;</div>
         <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
            <div class="col-md-1"><button type="reset" class="btn btn-block btn-danger btn-xs">CANCEL</button></div>
            <div class="col-md-5"></div>
         </div>
         <div class="row">&nbsp;</div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-2">
         <div class="input-group input-group-sm">
            <input type="text" class="form-control" placeholder="SEARCH">
            <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
            </span>
         </div>
      </div>
      <div class="col-md-8"></div>
      <div class="col-md-2">
         <a href="#" id="add-ppa" class="btn btn-info btn-xs pull-right" >
         <span class="glyphicon glyphicon-plus"> </span>&nbsp ADD PPA</a>
      </div>
   </div>
   <div class="box">
      <div class="box-body table-responsive">
         <table id="example1" class="table table-bordered table-striped table-hover text-center">
            <thead>
               <tr>
                  <th>SR.NO</th>
                  <th>VALIDITY START DATE</th>
                  <th>VALIDITY END DATE</th>
                  <th>FILE</th>
                  <!-- <th>STATUS</th> -->
                  <th>ACTION</th>
               </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach ($ppaData as $key => $value)
               <tr>
                  <td>{{ $i }}</td>
                  <td>{{$value->validity_from}}</td>
                  <td>{{$value->validity_to}}</td>
                  <td><a href="{{url('/documents/ppa/'.$value->file_path)}}" download='download'>{{$value->file_path}}</a></td>
                  <td class="text-center">
                    <a href="/ppa/editppa/{{$value->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="/ppa/deleteppa/{{$value->id}}"><span class="glyphicon glyphicon-trash"></span></a>
                  </td>
                 </tr>
               <?php $i++; ?>
                 @endforeach
            </tbody>
         </table>
          {{ $ppaData->links() }}
      </div>
      <!-- /.box-body -->
   </div>
 </form>
</section>
<!-- /.content -->
<script>
   $(document).ready(function(){
       $("#ram").click(function(){
           $("#sharma").hide();
           $("#lakhan").removeClass("hidden");

   });
   });
     $(function () {
       $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
         checkboxClass: 'icheckbox_flat-green',
         radioClass   : 'iradio_flat-green'
       })
     });
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
    $("#add-ppa").click(function(){
        $("#apd-tab").removeClass('hidden');
    });
  });
</script>
<script type="text/javascript">
 setTimeout(function() {
   $('.alert-success').fadeOut('fast');
   }, 2000); // <-
</script>
@endsection
