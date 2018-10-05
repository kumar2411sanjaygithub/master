@extends('theme.layouts.default')
@section('content_head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
   <h5><label  class="control-label">Trading Margin (TM) Name Setting</label></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
    <li><a href="/basicdetails">MANAGE CLIENT</a></li>
    
      <li><a href="">TRADER'S SETTING</a></li>
      
      <li class="#"><u>TM NAME SETTING</u></li>
   </ol>
</section>
  <div class="clearfix"></div>
   <!-- <br> -->
   <!-- success msg -->
   @if(session()->has('addmsg'))
     <div class="alert alert-success mt10" id="success">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
         {{ session()->get('addmsg') }}
     </div>
   @endif
<section class="content">
  <!-- Main content -->
  <form method="post" action="{{route('tmnameupdate')}}">
    {{ csrf_field() }}
  <div class="row">
     <div class="col-xs-12">
        <div class="box">
           <div class="box-body">

              <div class="row">&nbsp;</div>
              <div class="row">
                <div class="box-body table-responsive">
                   <table class="table table-bordered text-center">
                     <thead class="tablehead">
                       <tr>
                         <th class="text-center" style="width:33.33%!important;">Segment</th>
                         <th class="text-center" style="width:33.33%!important;">Trading Margin Name as</th>
                         <th class="text-center" style="width:33.33%!important;">GST Applicable</th>
                       </tr>
                     </thead>
                     <tbody>
                       <form method="post">
                         {{csrf_field()}}
                         @foreach($tmData as  $segment)
                             <tr>
                               <td class="text-center">{{ $segment->segment}}</td>
                               <td class="text-center">
                                 <select class="form-control input-sm select2" id="dam_tm" name="tm_{{$segment->id}}">
                                   <option value="TM" @if($segment->tmname=="TM") selected @endif>TM</option>
                                   <option value="Professional" @if($segment->tmname=="Professional") selected @endif>Professional</option>
                                   <option value="Success" @if($segment->tmname=="Success") selected @endif>Success</option>
                                 </select>
                                 <input type="hidden" name="segment[]" value="{{ $segment->id}}">
                               </td>
                               <td class="text-center">
                                 <select class="form-control input-sm select2" id="dam_gst" name="gst_{{$segment->id}}">
                                   <option value="Yes" @if($segment->gst=="Yes") selected @endif>Yes</option>
                                   <option value="No" @if($segment->gst=="No") selected @endif>No</option>
                                 </select>
                               </td>
                             </tr>
                           @endforeach
                         </form>
                     </tbody>
                   </table>
                </div>

              </div>
              <div class="row">&nbsp;</div>
              <div class="row">
                 <div class="col-md-10"></div>
                 <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs">UPDATE</button></div>
                 <div class="col-md-1"><button type="button" class="btn btn-block btn-danger btn-xs">CANCEL</button></div>
              </div>
              <div class="row">&nbsp;</div>
           </div>
        </div>
     </div>
  </div>
  </form>
</section>
<script type="text/javascript">
 setTimeout(function() {
   $('#success').fadeOut('fast');
   }, 2000); // <-
</script>
<script>
   $(function () {

     //Date picker
     $('#datepicker').datepicker({
       autoclose: true
     })
     $('#datepicker1').datepicker({
       autoclose: true
     })
     $('#datepicker2').datepicker({
       autoclose: true
     })
     $('#datepicker3').datepicker({
       autoclose: true
     });
     $('.timepicker').timepicker({
        showInputs: false
      });
   })
   </script>
   <script>
   $(document).ready(function(){
     $("#client").change(function(){
          var id = $("#client").val();
           $.ajax({    //create an ajax request to display.php
             type: "GET",
             url: "{{url('/ppa/biddata')}}",
             data:{'id':id},
             dataType: "JSON",   //expect html to be returned
             success: function(response){
               $("#bid_cut_off_time").val(response.bid_cut_off_time);
               $("#trader_type").val(response.trader_type);
             }

         });
     });
   });
   </script>
@endsection
