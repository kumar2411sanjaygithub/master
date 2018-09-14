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
      <label  class="control-label">Payment Security Mechanism(PSM) Details</label>
   </h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">PSM Details</a></li>
      <li><a href="#" class="active">PSM Add</a></li>
   </ol>
</section>
  <section class="content">
    <div class="clearfix"></div>
      <div class="row">
         <div class="col-xs-12">
            <!--bank details start--->
            <div class="box">
               <div class="box-body">
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
               </div>
            </div>
            <!-- /.row -->
         </div>
      </div>
  </section>

<script>
$(document).ready(function(){
  $("#client").change(function(){
       var id = $("#client").val();
        window.location="{{url('/psm/psmdetails')}}/"+id;
  });
});
</script>
@endsection
