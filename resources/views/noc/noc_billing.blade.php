@extends('theme.layouts.default')
@section('content')
    <section class="content-header">
      <h5>
    <label  class="control-label">NOC BILLING SETTING</label>
     </h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="{{route('billsetting.nocbilllist')}}">NOC APPLICATION</a></li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

   @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
         <ul>
             <li>{!! \Session::get('success') !!}</li>
         </ul>
      </div>
   @endif
  <div class="box">
    <form method="post" action="{{ isset($edit_nocBilling)?url('/noc-billing-update/'.$edit_nocBilling->id):route('noc_billing.nocbillingcreate')}}" id="Noc_billing_ID">
      {{csrf_field()}}
    <div class="box-body">
<div class="row">
  <div class="col-md-6 {{ $errors->has('state') ? 'has-error' : '' }}">
    <label  class="control-label">STATE <span class="text-danger">*</span></label>
    <select class="form-control input-sm" style="width: 100%;" id="state" name="state" {{isset($edit_nocBilling)?"disabled='disabled'":''}}>
        <option value="">PLEASE SELECT STATE</option>
         <?php
          $state_list = \App\Common\StateList::get_states();
              ?>
        @foreach($state_list as $state_code=>$state_ar)
          @if(isset($inset_state)&&!in_array($state_code,@$inset_state)|| isset($edit_nocBilling->id))
            <option value="{{$state_code}}" {{ isset($edit_nocBilling) && $edit_nocBilling->state == $state_code || old('state')==  $state_code? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>

          @endif
        @endforeach
    </select>
    <span class="text-danger">{{ $errors->first('state') }}</span>
  </div>
  <div class="col-md-6 {{ $errors->has('noc_application_for') ? 'has-error' : '' }}">
    <label  class="control-label">NOC APPLICATION SENT TO <span class="text-danger">*</span></label>
    <select class="form-control input-sm" style="width: 100%;" name="noc_application_for" id="noc_application_for">
       <option value="">SELECT</option>
       <option value="sldc" {{ isset($edit_nocBilling) && $edit_nocBilling->noc_application_for == 'sldc' || old('noc_application_for')==  'sldc'? 'selected="selected"' : '' }}>SLDC</option>
       <option value="discom" {{ isset($edit_nocBilling) && $edit_nocBilling->noc_application_for == 'discom' || old('noc_application_for')==  'discom'? 'selected="selected"' : '' }}>DISCOM</option>
       <option value="both" {{ isset($edit_nocBilling) && $edit_nocBilling->noc_application_for == 'both' || old('noc_application_for')==  'both'? 'selected="selected"' : '' }}>BOTH</option>
  </select>
    <span class="text-danger">{{ $errors->first('noc_application_for') }}</span>
  </div>
  </div>
    <div class="row">&nbsp;</div>
<div class="row"><hr>
  <div class="col-md-3">
    <label  class="control-label">DISCOM</label>
    <select class="form-control input-sm" style="width: 100%;" name="discom" id="discom">
       <option value="">SELECT DISCOM</option>
       @if(isset($edit_nocBilling->discom))
      <option value="{{$edit_nocBilling->discom}}" selected="selected">{{$edit_nocBilling->discom}}</option>
      @endif
  </select>
  </div>
  <div class="col-md-3">
    <label  class="control-label">AMOUNT</label>
    <input class="form-control input-sm num" type="text" placeholder="VALUE" id="discom_amt" name="discom_amt" value="{{ isset($edit_nocBilling->discom_amt) ? $edit_nocBilling->discom_amt : old('discom_amt') }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">GST APPLICABLE</label>
    <select class="form-control input-sm" style="width: 100%;"  id="discom_gst_applicabale" name="discom_gst_applicabale">
       <option value="YES" {{ isset($edit_nocBilling) && $edit_nocBilling->discom_gst_applicabale == 'YES' || old('discom_gst_applicabale')==  'YES'? 'selected="selected"' : '' }}>YES</option>
       <option value="NO" {{ isset($edit_nocBilling) && $edit_nocBilling->discom_gst_applicabale == 'NO' || old('discom_gst_applicabale')==  'NO'? 'selected="selected"' : '' }}>NO</option>
  </select>
  </div>

  <div class="col-md-3">
    <label  class="control-label">CGST AMOUNT</label>
    <input class="form-control input-sm num" type="text" placeholder="VALUE" id="discom_cgst_value" name="discom_cgst_value" value="{{ isset($edit_nocBilling->discom_cgst_value) ? $edit_nocBilling->discom_cgst_value : old('discom_cgst_value') }}">
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <label  class="control-label">SGST AMOUNT</label>
    <input class="form-control input-sm num" type="text" placeholder="VALUE" id="discom_sgst_value" name="discom_sgst_value" value="{{ isset($edit_nocBilling->discom_sgst_value) ? $edit_nocBilling->discom_sgst_value : old('discom_sgst_value') }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">UTGST AMOUNT</label>
    <input class="form-control input-sm num" type="text" placeholder="VALUE" id="discom_utgst_value" name="discom_utgst_value" value="{{ isset($edit_nocBilling->discom_utgst_value) ? $edit_nocBilling->discom_utgst_value : old('discom_utgst_value') }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">IGST AMOUNT</label>

    <input class="form-control input-sm num" type="text" placeholder="VALUE" id="discom_igst_value" name="discom_igst_value" value="{{ isset($edit_nocBilling->discom_igst_value) ? $edit_nocBilling->discom_igst_value : old('discom_igst_value') }}">
  </div>
  </div>
<hr>
  <div class="row">
    <div class="col-md-3">
      <label  class="control-label">SLDC</label>
      <select class="form-control input-sm" style="width: 100%;"  name="sldc" id="sldc">
         <option value="">SELECT SLDC</option>
         @if(isset($edit_nocBilling->sldc))
        <option value="{{$edit_nocBilling->sldc}}" selected="selected">{{$edit_nocBilling->sldc}}</option>
        @endif

    </select>
    </div>
    <div class="col-md-3">
      <label  class="control-label">AMOUNT</label>
      <input class="form-control input-sm num" type="text" placeholder="VALUE" id="sldc_amt" name="sldc_amt"  value="{{ isset($edit_nocBilling->sldc_amt) ? $edit_nocBilling->sldc_amt : old('sldc_amt') }}">
    </div>
    <div class="col-md-3">
      <label  class="control-label">GST APPLICABLE</label>
      <select class="form-control input-sm" style="width: 100%;" name="sldc_gst_applicable" id="sldc_gst_applicable">
         <option value="YES" {{ isset($edit_nocBilling) && $edit_nocBilling->sldc_gst_applicable == 'YES' || old('sldc_gst_applicable')==  'YES'? 'selected="selected"' : '' }}>YES</option>
         <option value="NO" {{ isset($edit_nocBilling) && $edit_nocBilling->sldc_gst_applicable == 'NO' || old('sldc_gst_applicable')==  'NO'? 'selected="selected"' : '' }}>NO</option>
    </select>
    </div>

    <div class="col-md-3">
      <label  class="control-label">CGST AMOUNT</label>
      <input class="form-control input-sm num" type="text" placeholder="VALUE" id="sldc_cgst_amt" name="sldc_cgst_amt"  value="{{ isset($edit_nocBilling->sldc_cgst_amt) ?$edit_nocBilling->sldc_cgst_amt  : old('sldc_cgst_amt') }}">
    </div>
  </div>
<div class="row">
  <div class="col-md-3">
    <label  class="control-label">SGST AMOUNT</label>
    <input class="form-control input-sm num" type="text" placeholder="VALUE" id="sldc_sgst_amt" name="sldc_sgst_amt" value="{{ isset($edit_nocBilling->sldc_sgst_amt) ? $edit_nocBilling->sldc_sgst_amt : old('sldc_sgst_amt') }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">UTGST AMOUNT</label>
    <input class="form-control input-sm num" type="text" placeholder="VALUE" id="sldc_utgst_amt" name="sldc_utgst_amt" value="{{ isset($edit_nocBilling->sldc_utgst_amt) ? $edit_nocBilling->sldc_utgst_amt : old('sldc_utgst_amt') }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">IGST AMOUNT</label>
    <input class="form-control input-sm num" type="text" placeholder="VALUE" id="sldc_igst_amt" name="sldc_igst_amt" value="{{ isset($edit_nocBilling->sldc_igst_amt) ? $edit_nocBilling->sldc_igst_amt : old('sldc_igst_amt') }}">
  </div>

  </div>

    <div class="row">&nbsp;</div>
     <div class="row">
        <div class="col-md-5"></div>
        @if(isset($edit_nocBilling))
         <div class="col-md-1"><button type="submit" id="checkValidation" class="btn btn-block btn-info btn-xs">UPDATE</button></div>
         @else
          <div class="col-md-1"><button type="submit" id="checkValidation" class="btn btn-block btn-success btn-xs">SAVE</button></div>
         @endif
        <div class="col-md-5"></div>
     </div>
</div>
</form>
</div>

<div class="box">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th rowspan="2" class="srno vl" >SR.NO</th>
        <th rowspan="2"  class="vl">STATE1</th>
        <th colspan="7">DISCOM</th>
        <th colspan="7">SDLC</th>
        <th rowspan="2" class="act1 vl">ACTION</th>
      </tr>
      <tr>
        <th>NAME</th>
        <th>AMOUNT</th>
        <th>GST APPLIED</th>
        <th>CGST AMOUNT</th>
        <th>SGST AMOUNT</th>
        <th>UTGST AMOUNT</th>
        <th>IGST AMOUNT</th>
        <th>NAME</th>
        <th>AMOUNT</th>
        <th>GST APPLIED</th>
        <th>CGST AMOUNT</th>
        <th>SGST AMOUNT</th>
        <th>UTGST AMOUNT</th>
        <th>IGST AMOUNT</th>
      </tr>
      </thead>
      <tbody>
      @php $i=1; @endphp
      @if (count($nocBillingList) > 0)
         @foreach ($nocBillingList as $k=>$nocBilling)
          <tr>
            <td>{{$i}}</td>
            <td>
              @php
                $state_list = \App\Common\StateList::get_states();
              @endphp
              @foreach($state_list as $state_code=>$state_ar)
                @if($state_code==$nocBilling->state)
                  {{$state_ar['name']}}
                @endif
              @endforeach
            </td>
            <td>{{($nocBilling->discom)?$nocBilling->discom:'-'}}</td>
            <td>{{($nocBilling->discom_amt)?$nocBilling->discom_amt:'-'}}</td>
            <td>{{($nocBilling->discom_gst_applicabale)?$nocBilling->discom_gst_applicabale:'-'}}</td>
            <td>{{($nocBilling->discom_cgst_value)?$nocBilling->discom_cgst_value:'-'}}</td>
            <td>{{($nocBilling->discom_sgst_value)?$nocBilling->discom_sgst_value:'-'}}</td>
            <td>{{($nocBilling->discom_utgst_value)?$nocBilling->discom_utgst_value:'-'}}</td>  <td>{{($nocBilling->discom_igst_value)?$nocBilling->discom_igst_value:'-'}}</td>
            <td>{{($nocBilling->sldc)?$nocBilling->sldc:'-'}}</td>
            <td>{{($nocBilling->sldc_amt)?$nocBilling->sldc_amt:'-'}}</td>
            <td>{{($nocBilling->sldc_gst_applicable)?$nocBilling->sldc_gst_applicable:'-'}}</td>
            <td>{{($nocBilling->sldc_cgst_amt)?$nocBilling->sldc_cgst_amt:'-'}}</td>
            <td>{{($nocBilling->sldc_sgst_amt)?$nocBilling->sldc_sgst_amt:'-'}}</td>
            <td>{{($nocBilling->sldc_utgst_amt)?$nocBilling->sldc_utgst_amt:'-'}}</td>
            <td>{{($nocBilling->sldc_igst_amt)?$nocBilling->sldc_igst_amt:'-'}}</td>
            <td>
              <a href="{{ route('noc_billing.nocbillingedit',[$nocBilling->id]) }}"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="" data-toggle="modal" data-target="#deleteData{{ $nocBilling->id }}"><span class="glyphicon glyphicon-trash text-danger" ></span></a>
            </td>
            <div id="deleteData{{ $nocBilling
           ->id }}" class="modal fade" role="dialog">
               <form method="POST"  action="{{url('noc-billing-setting/'.$nocBilling->id)}}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
               <div class="modal-dialog modal-confirm">
                 <div class="modal-content">
                   <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                     <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                   </div>
                   <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                     <p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO DELETE THESE RECORDS? IF CHOOSE YES, THEN THIS PROCESS CANNOT BE UNDONE.</p>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-danger">Yes</button>
                     <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                   </div>
                 </div>
               </div>
               </form>
             </div>

          </tr>
            @php $i++; @endphp
        @endforeach
      @else
        <tr>
            <td colspan="12" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
        </tr>
      @endif
    </tbody>
    </table>
     {{ $nocBillingList->links() }}
      </tbody>
      </table>
  </div>

</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $('#noc_application_for').on('click', function() {
      var noc_application_for=this.value;
      var state=$('#state').val();
      if(state!='')
      {
        $.ajax({
            url: '{{ url()->to("noc_discom_search") }}',
            type: 'GET',
            data: {'noc_application_for':noc_application_for,'state':state},
            dataType: 'JSON',
            success: function(data)
            {
              html1='';
              html1+='<option value="">CHOOSE</option>';
              $.each(data.sldc, function(key1, value1){
                html1+='<option value="'+value1+'">'+value1+'</option>';
              });
              $('#sldc').html(html1);

              html='';
              html+='<option value="">CHOOSE</option>';
              $.each(data.discom, function(key, value){
                html+='<option value="'+value+'">'+value+'</option>';
              });
              $('#discom').html(html);
            }
        });
      }
      else
      {
        $('#noc_application_for').val('');
        $("#state").css('border-color', 'red');
      }

    });

  });
</script>
<script type="text/javascript">
 setTimeout(function() {
   $('#successMessage').fadeOut('fast');
   }, 2000); // <-
</script>
  @endsection
