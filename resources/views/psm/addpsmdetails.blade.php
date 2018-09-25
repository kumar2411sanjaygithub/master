@extends('theme.layouts.default')
@section('content_head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection
@section('content')
<style>
a.disabled {
  pointer-events: none;
  cursor: default;
}
span.hifan{color:#51c0f0;font-size:15px;margin-left:7px;margin-right:7px;}
</style>

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

      <div class="row">
         <div class="col-xs-12">
           <div class="row">
             <div class="col-md-7 pull-left">
               <h5 class="hid">
                  <label  class="control-label"><u class="setword">Payment Security Mechanism(PSM) Details</u></label>
                  &nbsp; {{@$clientData->company_name}}<span class="hifan">|</span>{{@$clientData->crn_no}}<span class="hifan">|</span>{{@$clientData->iex_portfolio}}<span class="hifan">|</span>{{@$clientData->pxil_portfolio}}
               </h5>
             </div>
             <div class="col-md-5 pull-right">
                     <a href="{{ route('basic.details') }}"><button type="button" class="btn btn-info btn-xs pull-right mt7 "><span class="glyphicon glyphicon-forward"></span>BACK TO LIST</button></a>
                      <a class="mt7 mr5 btn btn-info btn-xs pull-right apdbtn hid @if($errors->isEmpty()) @else hidden  @endif">
                        <span class="glyphicon glyphicon-plus"> </span>&nbsp ADD PSM</a>

             </div>
           </div>
           <form method="post" enctype="multipart/form-data" action="{{ url('psm/psmdetails/'.$id) }}" class="apd @if($errors->isEmpty())hidden @else  @endif">
             {{ csrf_field()}}
            <div class="row">
                 <div class="col-xs-12">
                    <div class="box">
                       <div class="box-body">
                          <div class="row">
                             <div class="col-md-3 {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label  class="control-label">TYPE</label><span class="text-danger"><strong>*</strong></span>
                                <select class="form-control input-sm select2" name="type" id="bankselect" onchange="select()" style="width: 100%;">
                                   <option value="0">Cash Transfer</option>
                                   <option value="1">Bank Transfer</option>
                                   <option value="2">Letter Of Credit</option>
                                   <option value="3">Bank Guarantee</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                             </div>
                             <div class="col-md-3 {{ $errors->has('received_date') ? 'has-error' : '' }}">
                                <label  class="control-label">RECIVED DATE</label><span class="text-danger"><strong>*</strong></span>
                                <div class="input-group date">
                                   <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                   </div>
                                   <input type="text" autocomplete="off" value="{{old('received_date')}}" class="form-control pull-right input-sm" name="received_date" id="datepicker">
                                </div>
                                   <span class="text-danger">{{ $errors->first('received_date') }}</span>
                             </div>
                             <div class="col-md-3">
                                <label  class="control-label">DOCUMENT NO.</label>
                                <input class="form-control input-sm" value="{{old('document_no')}}" type="text" name="document_no" placeholder="ENTER DOCUMENT NO.">
                             </div>
                             <div class="col-md-3 {{ $errors->has('amount') ? 'has-error' : '' }}">
                                <label  class="control-label">AMOUNT</label><span class="text-danger"><strong>*</strong></span>
                                <input class="form-control input-sm num" value="{{old('amount')}}" type="text" name="amount" placeholder="ENTER AMOUNT">
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
                                   <input type="text" autocomplete="off" disabled="disabled" value="{{old('issue_date')}}" name="issue_date" class="form-control pull-right input-sm" id="issue_date">
                                </div>
                                <span class="text-danger">{{ $errors->first('issue_date') }}</span>
                             </div>
                             <div class="col-md-3 {{ $errors->has('expiry_date') ? 'has-error' : '' }}">
                                <label  class="control-label">EXPIRY DATE</label><span class="text-danger"><strong>*</strong></span>
                                <div class="input-group date">
                                   <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                   </div>
                                   <input type="text" autocomplete="off" class="form-control pull-right input-sm" value="{{old('expiry_date')}}" name="expiry_date" id="datepicker2">
                                </div>
                                   <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                             </div>
                             <div class="col-md-3">
                                <label  class="control-label">REVOCABLE DATE</label>
                                <div class="input-group date">
                                   <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                   </div>
                                   <input type="text" autocomplete="off" class="form-control pull-right input-sm" value="{{old('revocable_date')}}" name="revocable_date" id="revocable_date" disabled="disabled">
                                </div>
                             </div>
                             <div class="col-md-3 {{ $errors->has('document') ? 'has-error' : '' }}">
                                <label  class="control-label">UPLOAD DOCUMENT</label><span class="text-danger"><strong>*</strong></span>
                                <input class="form-control input-sm" type="file" value="{{old('document')}}" name="document" id="upload" placeholder="ENTER POC LOSSES" disabled="disabled" style="padding:4px 4px;">
                                <span class="text-danger">{{ $errors->first('document') }}</span>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-3">
                                <label  class="control-label">DESCRIPTION</label>
                                <input class="form-control input-sm" type="text" value="{{old('description')}}" name="description" placeholder="ENTER DESCRIPTION">
                             </div>

                          </div>
                          <div class="row">&nbsp;</div>
                          <div class="row">
                             <div class="col-md-5"></div>
                             <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
                             <div class="col-md-1"><button type="button" id="cancel1" class="btn btn-block btn-danger btn-xs cancel">CANCEL</button></div>
                             <div class="col-md-5"></div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
            </form>

            <div class="box">
               <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped table-hover text-center">
                     <thead>
                        <tr>
                           <th class="srno">SR.NO</th>
                           <th>TYPE</th>
                           <th>RECVIED DATE</th>
                           <th>AMOUNT</th>
                           <th>DOCUMENT NO.</th>
                           <th>ISSUE DATE</th>
                           <th>EXPIRY DATE</th>
                           <th>REVOCABLE DATE</th>
                           <th>FILE</th>
                           <th>DESCRIPTION</th>
                           <th class="act1">ACTION</th>
                        </tr>
                     </thead>
                     <tbody>
                       <?php $i=1; ?>
                       @forelse($psmData as $key => $value)
                        <tr>
                           <td>{{ $i}}</td>
                           <td>
                             @if($value->type == 0)
                              Cash Transfer
                             @elseif($value->type == 1)
                              Bank Transfer
                            @elseif($value->type == 2)
                              Letter Of Credit
                            @else
                              Bank Guarantee
                            @endif
                           </td>
                           <td>{{$value->received_date}}</td>
                           <td>{{$value->amount}}</td>
                           <td>{{$value->document_no}}</td>
                           <td>{{$value->issue_date}}</td>
                           <td>{{$value->expiry_date}}</td>
                           <td>{{$value->revocable_date}}</td>
                           <td><a href="{{url('documents/psm/'.$value->document)}}" download="download">{{$value->document}}</a></td>
                           <td>{{$value->description}}</td>
                           <td>
                             <a href="/editpsmdetails/{{$value->id}}/{{$value->client_id}}"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                             <a href="/deletepsmdetails/{{$value->id}}" class="text-danger"><span class="glyphicon glyphicon-trash "></span></a>
                           </td>
                        </tr>
                          <?php $i++; ?>
                        @empty
                        <tr>
                          <td colspan="11" class="alert-danger">Record Not Found</td>
                        </tr>
                        @endforelse
                     </tbody>
                  </table>
                  {{ $psmData->links() }}
               </div>
               <!-- /.box-body -->
            </div>
            @php
            if(isset($last_id->id)&& $last_id->id!='')
            {
              $path=url('addpsmexposure/'.@$last_id->id);
            }

            @endphp
            <div class="row">
              <div class="col-md-6">
            <section class="content-header exposuredetails">
              <span style="margin-left:-12px;"><label class="control-label"><u class="psmexp-test"> PSM EXPOSURE DETAILS</u></label></span>
            </section>
          </div>
          <div class="col-md-6">
            <a class="btn btn-info btn-xs pull-right apedbtn">
            <span class="glyphicon glyphicon-plus"> </span> SET PSM EXPOSURE</a>
          </div>
          </div>
            <form method="post" enctype="multipart/form-data" action="{{ @$path}}" class="aped  @if($errors->isEmpty()) hidden @else   @endif">
              {{ csrf_field()}}

              <div class="row">
               <div class="col-xs-12">
                  <div class="box">
                     <div class="box-body">
                        <div class="row">
                          <div class="col-md-3 {{ $errors->has('psm_amount') ? 'has-error' : '' }}">
                             <label  class="control-label">PSM Amount</label>
                             <input class="form-control input-sm" readonly value="{{@$last_id->amount}}" name="psm_amount" id="psm_amount" type="text">
                             <span class="text-danger">{{ $errors->first('exposure_percent') }}</span>
                          </div>
                           <div class="col-md-3 {{ $errors->has('psm_amount') ? 'has-error' : '' }}">
                              <label  class="control-label">Exposure(%)</label>
                              <input class="form-control input-sm num" value="{{@$last_id->exposure_percent}}" name="exposure_percent" id="exposure_percent" type="text" placeholder="Enter Percent">
                              <span class="text-danger">{{ $errors->first('exposure_percent') }}</span>
                           </div>
                           <div class="col-md-3">
                              <label  class="control-label">PSM Exposure (Auto-Calculate)</label>
                              <input class="form-control input-sm" value="{{@$last_id->exposure}}" name="exposure" id="exposure" type="text" placeholder="Auto Calculate">
                           </div>
                           <div class="col-md-1"><button type="submit" @if(empty($path))disabled @endif class="btn btn-block btn-info btn-xs" style="margin-top:20px;">SAVE</button></div>
                           <div class="col-md-1"><input type="reset" class="btn btn-block btn-danger btn-xs" value="CANCEL" id="cancel"  style="margin-top:20px;"></div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
            </form>

            <div class="box">
               <div class="box-body table-responsive">
                  <table id="example2" class="table table-bordered table-striped table-hover text-center">
                     <thead>
                        <tr>
                           <th class="srno">SR.NO</th>
                           <th>PSM AMOUNT</th>
                           <th>EXPOSURE(%)</th>
                           <th>PSM EXPOSURE</th>
                           <th>ADDED DATE</th>
                           <th class="act1">ACTION</th>
                        </tr>
                     </thead>
                     <tbody>
                       @if(!empty($last_id->exposure_percent)&&!empty($last_id->exposure))
                        <tr>
                           <td>1</td>
                           <td>{{isset($last_id->psm_amount)?@$last_id->psm_amount:'-'}}</td>
                           <td>{{isset($last_id->exposure_percent)?@$last_id->exposure_percent:'-'}}</td>
                           <td>{{isset($last_id->exposure)?@$last_id->exposure:'-'}}</td>
                           <td>{{(isset($last_id->psm_added_date))?@$last_id->psm_added_date:'-'}}</td>
                           <td><a href="javascript::void()" target="/editexposure/{{@$last_id->id}}/{{$clientData->id}}" class="{{ isset($last_id->exposure)? '':' disabled'}}" id="btn-edit-psm"><span class="glyphicon glyphicon-pencil"></span></a></td>
                        </tr>
                        @else
                        <tr class="alert-danger"><td colspan="6">Record Not Found</td></tr>
                        @endif
                     </tbody>
                  </table>
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.row -->
         </div>
      </div>

    </form>


  </section>
  <!-- The Modal -->
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
     })
     $(".datepicker").datepicker({
       autoclose: true,
       format: 'dd/mm/yyyy',
     })
     $('#datepicker2').datepicker({
       autoclose: true,
       format: 'dd/mm/yyyy',
     })
     $('#revocable_date').datepicker({
       autoclose: true,
       format: 'dd/mm/yyyy',
     })

   })
</script>
<script>
$(document).ready(function(){
    $(".apdbtn").click(function(){
        $(".apd").removeClass("hidden");
        $(".apdbtn").addClass("hidden");
        $(".setword").text("Add PSM Details");
    });
    $(".apedbtn, #btn-edit-psm").click(function(){
        $(".aped").removeClass("hidden");
        $(".psmexp-test").text("Add PSM Exposure Details");
        $(".apedbtn").hide();
    });
    $("#cancel").click(function(){
      $(".aped").addClass("hidden");
      $(".psmexp-test").text("PSM Exposure Details");
      $(".apedbtn").show();
    });
    $(".cancel").click(function(){
      $(".apdbtn").removeClass("hidden");
      $(".setword").text("Payment Security Mechanism(PSM) Details");
    });
    $("#cancel1").click(function(){
      $(".apd").addClass("hidden")
    });
});
</script>
<script>
$(document).ready(function(){
    $("#exposure_percent").keyup(function(){
      var amount = $("#psm_amount").val();
       var per = $("#exposure_percent").val();
       var calcPrice  = (amount - ( amount * per / 100 )).toFixed(2);
       var calcPrice = amount - calcPrice;
       $("#exposure").val(calcPrice);
    });
});
</script>

@endsection
