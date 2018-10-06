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
   <h5><label  class="control-label"><u class="add">PPA DETAILS</u></label></h5>
   <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="/basicdetails">MANAGE CLIENT</a></li>
      <li><a href="">DAM</a></li>
      <li><a href="">IEX</a></li>
      <li class="#"><u> PPA DETAILS </u></li>
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

   <div class="row">
      <div class="col-md-12">
       <select class="" name="client_id" id="select-client" data-live-search="true">
         <option>Search Client</option>
          @foreach ($clientData as $key => $value)
          <option value="{{ $value->id }}" data-tokens="{{ $value->id }}.{{ $value->id }}.{{ $value->id }};?>"  @if($id==$value->id) selected  @endif> {{$value->company_name}} [{{$value->short_id}}] [{{$value->crn_no}}] [{{$value->iex_portfolio}}] [{{$value->pxil_portfolio}}]</option>
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
   <hr>
     <form method="post" action="{{ route('ppadetails') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
     <div class="box @if($errors->isEmpty())hidden @else  @endif" id="apd-tab">
      <div class="box-body" >

         <div class="row">
            <div class="col-md-3 {{ $errors->has('validity_from') ? 'has-error' : '' }}">
               <label  class="control-label">VALIDITY START DATE</label><span class="text-danger"><strong>*</strong></span>
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" autocomplete="off" class="form-control pull-right input-sm" id="datepicker" value="{{old('validity_from')}}" name="validity_from">
               </div>
               <span class="text-danger">{{ $errors->first('validity_from') }}</span>
            </div>
            <div class="col-md-3 {{ $errors->has('validity_to') ? 'has-error' : '' }}">
               <label  class="control-label">VALIDITY END DATE</label><span class="text-danger"><strong>*</strong></span>
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" autocomplete="off" value="{{old('validity_to')}}" class="form-control pull-right input-sm" id="datepicker1" name="validity_to">
               </div>
               <span class="text-danger">{{ $errors->first('validity_to') }}</span>
            </div>
            <div class="col-md-3 {{ $errors->has('file_path') ? 'has-error' : '' }}">
               <label  class="control-label">UPLOAD DOCUMENT</label><span class="text-danger"><strong>*</strong></span>
               <input class="form-control input-sm" type="file" name="file_path" placeholder="ENTER POC LOSSES" style="padding:2px 2px;">
               <span class="text-danger">{{ $errors->first('file_path') }}</span>
            </div>
            <div class="col-md-1" style="margin-top:22px;"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
            <input type="hidden" name="client" value="{{$id}}">
            <div class="col-md-1" style="margin-top:22px;"><button type="reset" id="cancel" class="btn btn-block btn-danger btn-xs">CANCEL</button></div>
         </div>
        </div>
   </div>
   <div class="row">
      <div class="col-md-2">
         <div class="input-group input-group-sm">
            <input type="text" class="form-control" id="search" placeholder="SEARCH">
            <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
            </span>
         </div>
      </div>
       </form>
      <div class="col-md-10 pull-right">
        <!-- <a href="/basicdetails" class="btn btn-info btn-xs pull-right" title="BACK TO LIST"><span class="glyphicon glyphicon-forward"></span>&nbsp BACK TO LIST</a> -->
        <a href="#" id="add-ppa" class="btn btn-info btn-xs pull-right mr5"><span class="glyphicon glyphicon-plus"> </span>&nbsp ADD PPA</a>
      </div>
   </div>
   <div class="box mt3">
      <div class="box-body table-responsive">
         <table id="example1" class="table table-bordered table-striped table-hover text-center">
            <thead>
               <tr>
                  <th>SR.NO</th>
                  <th>VALIDITY START DATE</th>
                  <th>VALIDITY END DATE</th>
                  <th>FILE</th>
                  <th>STATUS</th>
                  <th>ACTION</th>
               </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @forelse ($ppaData as $key => $value)
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
                  <td>{{ $i }}</td>
                  <td>{{date('d/m/Y', strtotime($value->validity_from))}}</td>
                  <td>{{date('d/m/Y',strtotime($value->validity_to))}}</td>
                  <td><a href="{{url('/documents/ppa/'.$value->file_path)}}" download='download'>View</a></td>
                  <td>{{$valid}}</td>
                  <td class="text-center">
                    <a href="/ppa/editppa/{{$value->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="" data-toggle="modal" data-target="#ConvertData{{ $value->id }}" name="" id="convert-disabled"><span class="glyphicon glyphicon-trash text-danger"></span></a>
                  </td>
                   </td>
              <div id="ConvertData{{ $value->id }}" class="modal fade" role="dialog">
           <form method="GET"  action="{{url('/ppa/deleteppa/'.$value->id)}}">
            {{ csrf_field() }}
           <div class="modal-dialog modal-confirm">
             <div class="modal-content">
               <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                 <h4 class="modal-title text-center"></h4>
               </div> -->
               <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                <center><p style="font-size: 12px;font-weight:500;color:black!important; text-align:center;">DO YOU REALLY WANT TO DELETE THIS RECORD?</p></center> 
               </div>
               <div class="modal-footer">

                 
                <div class="text-center">
                 <button type="submit" class="btn btn-info btn-xs">YES</button>
                 <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">NO</button>
               </div>
               </div>
             </div>
           </div>
           </form>
         </div>
                 </tr>
               <?php $i++; ?>
                 @empty
                 <tr><td class="alert-danger" colspan="6">Record Nont Found</td></tr>
                 @endforelse
            </tbody>
         </table>
            <div class="col-md-6"><br>
              Total Records: {{ $ppaData->total() }}
            </div>
            <div class="col-md-6">
              <div class="pull-right">{{$ppaData->links()}}</div>
            </div>
      </div>
      <!-- /.box-body -->
   </div>

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
         format: 'dd/mm/yyyy',
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
        $("#add-ppa").addClass('hidden');
    });
    $("#cancel").click(function(){
        $("#apd-tab").addClass('hidden');
        $("#add-ppa").removeClass('hidden');
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
$(document).ready(function(){
    $("#add-ppa").click(function(){
      $(".add").text("ADD PPA DETAILS");
    })
    $("#cancel").click(function(){
      $(".add").text("PPA DETAILS");
    });
});
</script>
<script>
  $("#search").keyup(function () {
      var value = this.value.toLowerCase().trim();

      $("table tr").each(function (index) {
          if (!index) return;
          $(this).find("td").each(function () {
              var id = $(this).text().toLowerCase().trim();
              var not_found = (id.indexOf(value) == -1);
              $(this).closest('tr').toggle(!not_found);
              return not_found;
          });
      });
  });
</script>
@endsection
