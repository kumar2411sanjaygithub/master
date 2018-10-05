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
      <label  class="control-label">ADD DISCOM</label>
   </h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">POC & DISCOM LOSSES</a></li>
      <li><a href="#" class="active">DISCOM ADD</a></li>
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
    <form method="post" enctype="multipart/form-data" action="{{ route('adddiscom')}}">
      {{ csrf_field()}}
      <div class="row">
      <div class="col-xs-12">
        <div class="box discom-tab @if($errors->isEmpty())hidden @else  @endif">
           <div class="box-body">
              <div class="row">
                 <div class="col-md-3 {{ $errors->has('date_from') ? 'has-error' : '' }}">
                    <label  class="control-label">APPLICATON FROM DATE</label><span class="text-danger"><strong>*</strong></span>
                    <div class="input-group date">
                       <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                       </div>
                       <input type="text" placeholder="APPLICATON FROM DATE" autocomplete="off" class="form-control pull-right input-sm" value="{{old('date_from')}}" id="datepicker" name="date_from">
                    </div>
                    <span class="text-danger">{{ $errors->first('date_from') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('date_to') ? 'has-error' : '' }}">
                    <label  class="control-label">APPLICATION TO DATE</label><span class="text-danger"><strong>*</strong></span>
                    <div class="input-group date">
                       <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                       </div>
                       <input type="text" placeholder="APPLICATION TO DATE" autocomplete="off" value="{{old('date_to')}}" class="form-control pull-right input-sm" id="datepicker1" name="date_to">
                    </div>
                    <span class="text-danger">{{ $errors->first('date_to') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('region') ? 'has-error' : '' }}">
                    <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
                    <!-- <input class="form-control input-sm" type="text" placeholder="VALUE" value="{{old('region')}}" id="region" name="region"> -->
                    <select class="form-control input-sm" name="region" id="region" value="{{old('region')}}">
                        <option value="">SELECT</option>
                        <?php
                          $state_list = \App\Common\StateList::get_states();
                        ?>
                        @foreach($state_list as $state_code=>$state_ar)
                         <option value="{{$state_code}}" {{ isset($clientData) && $clientData->conn_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                        @endforeach
                      </select>
                    <span class="text-danger">{{ $errors->first('region') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('regional_entity') ? 'has-error' : '' }}">
                    <label  class="control-label">VOLTAGE LEVEL</label><span class="text-danger"><strong>*</strong></span>
                    <!-- <input class="form-control input-sm" type="text" placeholder="VALUE" value="{{old('regional_entity')}}" id="regional_entity" name="regional_entity"> -->
                    <select class="form-control input-sm" name="regional_entity" id="regional_entity" value="{{old('regional_entity')}}">
                        <option value="">SELECT</option>
                        <option>11KV</option>
                        <option>22KV</option>
                        <option>33KV</option>
                        <option>66KV</option>
                        <option>132KV</option>
                        <option>220KV</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('regional_entity') }}</span>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-3 {{ $errors->has('injection_poc_loss') ? 'has-error' : '' }}">
                    <label  class="control-label">STU LOSSES</label><span class="text-danger"><strong>*</strong></span>
                    <input class="form-control input-sm num" type="text" placeholder="STU LOSSES" value="{{old('injection_poc_loss')}}" id="injection_poc_loss" name="injection_poc_loss">
                    <span class="text-danger">{{ $errors->first('injection_poc_loss') }}</span>
                 </div>
                 <div class="col-md-3 {{ $errors->has('withdraw_poc_loss') ? 'has-error' : '' }}">
                    <label  class="control-label">DISCOM LOSSES</label><span class="text-danger"><strong>*</strong></span>
                    <input class="form-control input-sm num" type="text" placeholder="DISCOM LOSSES" value="{{old('withdraw_poc_loss')}}" id="withdraw_poc_loss" name="withdraw_poc_loss">
                    <span class="text-danger">{{ $errors->first('withdraw_poc_loss') }}</span>
                 </div>
                 <div class="col-md-3"></div>
                 <div class="col-md-3 mt23">
                   <div class="col-md-6"><button type="submit" class="btn btn-block btn-info btn-xs pull-right">SAVE</button></div>
                   <div class="col-md-6"><button type="button" class="btn btn-block btn-danger btn-xs discom-cancel pull-right">CANCEL</button></div>
                 </div>
               </div>

           </div>
        </div>
      </div>
    </div>
    </form>
    <div class="row">
      <div class="col-md-2">
         <div class="input-group input-group-sm">
            <input type="text" class="form-control" id="search" placeholder="SEARCH">
            <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
            </span>
         </div>
      </div>
     <div class="col-md-10">
        <a href="#" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#myModal">&nbsp IMPORT(CSV/XLSX)</a>
        <a class="btn btn-info btn-xs discom-btn pull-right mr5" name=" "><span class="glyphicon glyphicon-plus"></span>&nbsp ADD</a>
      </div>
    </div>
  <div class="box mt3">
     <div class="box-body table-responsive">
        <table class="table table-bordered text-center">
          <thead class="tablehead">
            <tr>
              <th class="text-center "><u>Sr.No</u></th>
              <th class="text-center"><u>Application From Date</u></th>
              <th class="text-center"><u>Application To Date</u></th>
              <th class="text-center"><u>State</u></th>
              <th class="text-center"><u>Voltage Level (KV)</u></th>
              <th class="text-center"><u>STU Losses (in %)</u></th>
              <th class="text-center"><u>DISCOM Losses(in %)</u></th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($discomData as $key => $value)
            <tr>
              <td class="text-center">{{$key+1}}</td>
              <td class="text-center">{{ $value->date_from }}</td>
              <td class="text-center">{{ $value->date_to }}</td>
              <td class="text-center">{{ $value->region }}</td>
              <td class="text-center">{{ $value->regional_entity }}</td>
              <td class="text-center">{{ $value->injection_poc_loss }}</td>
              <td class="text-center">{{ $value->withdraw_poc_loss }}</td>
              <td class="text-center">
                <a href="/discom/{{$value->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                &nbsp;&nbsp;&nbsp;
                <a href="/discom/deletediscom/{{$value->id}}"><span class="glyphicon glyphicon-trash"></span></a>
              </td>
            </tr>
            @empty
            <tr><td class="alert-danger" colspan="8">Record not found</td><tr>
            @endforelse
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
</script>
<script>
   $(function () {
   $(".discom-btn").click(function(){
     $(".discom-tab").removeClass('hidden');
     $(".discom-btn").hide();
   });
   $(".discom-cancel").click(function(){
      $(".discom-tab").addClass('hidden');
      $(".discom-btn").show();
   });
 });
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
