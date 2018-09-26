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
     <label  class="control-label"><u class="setword">Edit PSM Details</u></label>
     &nbsp; {{@$clientData->company_name}}<span class="hifan">|</span>{{@$clientData->crn_no}}<span class="hifan">|</span>{{@$clientData->iex_portfolio}}<span class="hifan">|</span>{{@$clientData->pxil_portfolio}}
   </h5>

   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="{{ route('psmdetials') }}">PSM Search Client</a></li>
      <li><a href="#" class="active">PSM Edit</a></li>
   </ol>
</section>
<!-- Content Header (Page header) -->
<!-- Main content -->
  <section class="content">
    <div class="clearfix"></div>

     @if(session()->has('updatemsg'))
       <div class="alert alert-success  mt10">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
           {{ session()->get('updatemsg') }}
       </div>
     @endif

    <form method="post" enctype="multipart/form-data" action="{{ url('updatepsm/'.$psmData->id)}}">
      {{ csrf_field()}}
      <div class="row">
        <div class="col-xs-12">
           <div class="box">
              <div class="box-body">
                 <div class="row">
                    <div class="col-md-3 {{ $errors->has('type') ? 'has-error' : '' }}">
                       <label  class="control-label">TYPE</label><span class="text-danger"><strong>*</strong></span>
                       <select class="form-control input-sm select2" name="type" id="bankselect" onchange="select()" style="width: 100%;">
                          <option value="0" @if($psmData->type == 0) selected="selected" @endif>Cash Transfer</option>
                          <option value="1" @if($psmData->type == 1) selected="selected" @endif>Bank Transfer</option>
                          <option value="2" @if($psmData->type == 2) selected="selected" @endif>Letter Of Credit</option>
                          <option value="3" @if($psmData->type == 3) selected="selected" @endif>Bank Guarantee</option>
                       </select>
                       <span class="text-danger">{{ $errors->first('type') }}</span>
                    </div>
                    <div class="col-md-3 {{ $errors->has('received_date') ? 'has-error' : '' }}">
                       <label  class="control-label">RECIVED DATE</label><span class="text-danger"><strong>*</strong></span>
                       <div class="input-group date">
                          <div class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                          </div>
                          <input autocomplete="off" type="text" value="{{date('d/m/Y',strtotime($psmData->received_date))}}" class="form-control pull-right input-sm" name="received_date" id="datepicker">
                       </div>
                          <span class="text-danger">{{ $errors->first('received_date') }}</span>
                    </div>
                    <div class="col-md-3">
                       <label  class="control-label">DOCUMENT NO.</label>
                       <input class="form-control input-sm" value="{{$psmData->document_no}}" type="text" name="document_no" placeholder="ENTER DOCUMENT NO.">
                    </div>
                    <div class="col-md-3 {{ $errors->has('amount') ? 'has-error' : '' }}">
                       <label  class="control-label">AMOUNT</label><span class="text-danger"><strong>*</strong></span>
                       <input class="form-control input-sm" value="{{$psmData->amount}}" type="text" name="amount" placeholder="ENTER AMOUNT">
                       <span class="text-danger">{{ $errors->first('amount') }}</span>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-3 {{ $errors->has('issue_date') ? 'has-error' : '' }}">
                       <label  class="control-label">ISSUE DATE</label><span class="text-danger"><strong>*</strong></span>
                       <div class="input-group date">
                          <div class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                          </div>
                          <input autocomplete="off" type="text" @if(($psmData->type == 0) || ($psmData->type == 1)) disabled="disabled" @endif value="{{date('d/m/Y',strtotime($psmData->issue_date))}}" name="issue_date" class="form-control pull-right input-sm" id="issue_date">
                       </div>
                          <span class="text-danger">{{ $errors->first('issue_date') }}</span>
                    </div>
                    <div class="col-md-3 {{ $errors->has('expiry_date') ? 'has-error' : '' }}">
                       <label  class="control-label">EXPIRY DATE</label><span class="text-danger"><strong>*</strong></span>
                       <div class="input-group date">
                          <div class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                          </div>
                          <input autocomplete="off" type="text" class="form-control pull-right input-sm" value="{{date('d/m/Y',strtotime($psmData->expiry_date))}}" name="expiry_date" id="datepicker2">
                       </div>
                          <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                    </div>
                    <div class="col-md-3">
                       <label  class="control-label">REVOCABLE DATE</label>
                       <div class="input-group date">
                          <div class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                          </div>
                          <input autocomplete="off" type="text" @if(($psmData->type == 0) || ($psmData->type == 1)) disabled="disabled" @endif class="form-control pull-right input-sm" value="{{date('d/m/Y',strtotime($psmData->revocable_date))}}" name="revocable_date" id="revocable_date">
                       </div>
                    </div>
                    <div class="col-md-3 {{ $errors->has('document') ? 'has-error' : '' }}">
                       <label  class="control-label">UPLOAD DOCUMENT</label><span class="text-danger"><strong>*</strong></span>
                       <input class="form-control input-sm" @if(($psmData->type == 0) || ($psmData->type == 1)) disabled="disabled" @endif type="file" value="{{$psmData->document}}" name="document" id="upload" placeholder="ENTER POC LOSSES">
                       <input class="form-control input-sm" type="hidden" value="{{ $psmData->document }}" name="old">

                       <span class="text-danger">{{ $errors->first('document') }}</span>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-3">
                       <label  class="control-label">DESCRIPTION</label>
                       <input class="form-control input-sm" type="text" value="{{$psmData->description}}" name="description" placeholder="ENTER DESCRIPTION">
                    </div>
                 </div>
                 <div class="row">&nbsp;</div>
                 <div class="row">
                    <div class="col-md-5"></div>
                    <input type="hidden" name="client_id" value="{{$psmData->client_id}}">
                    <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
                    <div class="col-md-1"><a href="{{url('/psm/psmdetails/'.$psmData->client_id)}}" class="btn btn-block btn-danger btn-xs">CANCEL</a></div>
                    <div class="col-md-5"></div>
                 </div>
              </div>
           </div>
        </div>

    </div>
    </form>

</section>

<script type="text/javascript">
 setTimeout(function() {
   $('.alert-success').fadeOut('fast');
   }, 2000); // <-
</script>
<script>
  function select(){
    //alert(1);
    var bankselect = $('#bankselect').val();
 if(bankselect == 2 ||bankselect == 3)
  {
    document.getElementById("issue_date").disabled = false;
    document.getElementById("revocable_date").disabled = false;
    document.getElementById("upload").disabled = false;
  }else{
    document.getElementById("issue_date").disabled = true;
    document.getElementById("revocable_date").disabled = true;
    document.getElementById("upload").disabled = true;
  }
}
</script>
<script>
$(function () {

  //Date picker
  $('#datepicker').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
  })
  $('#issue_date').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
  }).on('changeDate', function (selected) {
     var startDate = new Date(selected.date.valueOf());
     $('#datepicker2').datepicker('setStartDate', startDate);
   }).on('clearDate', function (selected) {
       $('#datepicker2').datepicker('setStartDate', null);
   });


  $(".datepicker").datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
  })
  $('#datepicker2').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
  }).on('changeDate', function (selected) {
       var endDate = new Date(selected.date.valueOf());
       $('#issue_date').datepicker('setEndDate', endDate);
   }).on('clearDate', function (selected) {
       $('#issue_date').datepicker('setEndDate', null);
   });
  $('#revocable_date').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
  })

})
</script>
@endsection
