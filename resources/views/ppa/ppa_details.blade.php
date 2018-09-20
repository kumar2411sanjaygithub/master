@extends('theme.layouts.default')
@section('content_head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection
@section('content')
<style>
.select2{width:100%!important;}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h5><label  class="control-label"><u>ADD PPA DETAILS</u></label></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">PPA Details</a></li>
      <li><a href="#"><u>ADD PPA DETAILS</u></a></li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
  <form method="post">
    {{ csrf_field() }}
     <div class="box">
      <div class="box-body" >
         <div class="row">
            <div class="col-md-12">
             <select class="" name="client_id" id="select-client" data-live-search="true">
               <option>Search User</option>
                @foreach ($clientData as $key => $value)
                <option value="{{ $value->id }} {{(old('client')==$value->id)?'selected':''}}"  data-tokens="{{ $value->id }}.{{ $value->id }}.{{ $value->id }};?>" @if(isset($value->id)) @if($value->id==$value->id) selected @endif @endif> [{{$value->company_name}}] [{{$value->short_id}}] [{{$value->crn_no}}]</option>
               @endforeach

             </select>
             <script>
             $(document).ready(function() {
                  $("#select-client").change(function(e) {
                        var id = this.value;
                        var url = '{{url('addppadetailsfind')}}/'+id;

                        window.location = url;
                  });
              });
             </script>
            </div>
         </div>
        </div>
   </div>
 </form>
</section>
<!-- /.content -->

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
    $("#cancel").click(function(){
        $("#apd-tab").addClass('hidden');
    });
  });
</script>
<script type="text/javascript">
 setTimeout(function() {
   $('.alert-success').fadeOut('fast');
   }, 2000); // <-

   // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#select-client').select2();
});
</script>

@endsection
