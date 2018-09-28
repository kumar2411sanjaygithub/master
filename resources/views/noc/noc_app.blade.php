@extends('theme.layouts.default')
@section('content')
<style type="text/css">
  .hidediv{
    display:none;
  }
.showdiv{
    display:block;
  }
  .btn .badge
  {
    top: 0px !important;
  }

  .aks_danger
  {
    background:#FE3C3D !important;
    border: 1px solid #FE3C3D !important;
  }
  .aks_warning
  {
    background:#f18d00  !important;
    border: 1px solid #f18d00  !important;
  }
  .aks_success
  {
    background:#5cb85c  !important;
    border: 1px solid #5cb85c  !important;
  }
  .aks_rej
  {
    background:#d9534f !important;
    border: 1px solid #d9534f  !important;
  }
a.disabled {
   pointer-events: none;
   cursor: default;
}
.label {
    color: white;
    font-size: 9px;
}


.success {background-color: #4CAF50;} /* Green */
.edited {background-color: #2196F3;} /* Green */
.danger {background-color: #f44336;} /* Green */
.warning {background-color: #ff9800;} /* Green */

</style>
<style>
.scroll-table-container {
height:auto;
overflow: scroll;
}
.scroll-table1
{
border-collapse:collapse;
min-width:260px;
}
.scroll-table4
{
border-collapse:collapse;
min-width:130px;
}
.scroll-table5
{
border-collapse:collapse;
min-width:160px;
}
.scroll-table2
{
border-collapse:collapse;
min-width:50px;
}
.scroll-table3
{
border-collapse:collapse;
min-width:100px;
}
.fnt
{
  font-size:11px!important;
  padding-left:10px!important;
  padding-right: 10px!important;
  padding-bottom:0px!important;
  padding-top:0px!important;
  font-weight:600!important;

}
</style>
<section class="content-header">
   <h5>
      <label  class="control-label"><u>NOC</u> <u>APPLICATON</u></label>
   </h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">NOC </a></li>
      <li><a href="{{route('noc-applications.index')}}"><u>NOC</u> <u>APPLICATION</u></a></li>
   </ol>
</section>
   @if (\Session::has('error'))
      <div class="alert alert-danger" id="successMessage">
         <ul>
             <li>{!! \Session::get('error') !!}</li>
         </ul>
      </div>
   @endif
   @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
         <ul>
             <li>{!! \Session::get('success') !!}</li>
         </ul>
      </div>
   @endif

<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-body">
               <div class="row">
                  <div class="col-md-12">
                  <select class="" name="client_id" id="select-client" data-live-search="true">
                      <option>Search Client</option>
                       @foreach ($clientData as $key => $value)
                       <option value="{{ $value->id }}" data-tokens="{{ $value->id }}.{{ $value->id }}.{{ $value->id }};?>" @if($client_id==$value->id) selected  @endif> [{{$value->company_name}}] [{{$value->short_id}}] [{{$value->crn_no}}]</option>
                      @endforeach

                    </select>
                  </div>
               </div>
            </div>
         </div>

         <div class="box @if($errors->isEmpty())hidediv @else  @endif"  id="divStatus">
            <div class="box-body">
               <div class="row">&nbsp;</div>
               <div class="" >
                <form method="post" action="{{route('noc-applicationn.nocstore')}}" enctype="multipart/form-data">
                  {{csrf_field()}}

                  <input type="hidden" value="{{isset($client_id)?$client_id:''}}" name="client_id">
                  <input type="hidden" value="{{isset($str)?$str:''}}" name="client_name">

               <div class="row">
                  <div class="col-md-3 {{ $errors->has('sldc') ? 'has-error' : '' }}">
                     <label  class="control-label">SLDC</label>
                    <select class="form-control input-sm" style="width: 100%;" id="sldc" name="sldc">
                        <option value="">PLEASE SELECT SLDC</option>
                        @if (count($sldc_array) > 0)
                          @foreach($sldc_array as $sldc)
                              <option value="{{$sldc}}" {{ isset($get_state_discom) && $get_state_discom->state == $state_code ? 'selected="selected"' : '' }}>{{$sldc}}</option>
                          @endforeach
                        @else
                          <option value="">No data.</option>
                        @endif
                    </select>
                    <span class="text-danger">{{ $errors->first('sldc') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('noc_type') ? 'has-error' : '' }}">
                     <label  class="control-label">NOC TYPE</label>
                     <select class="form-control input-sm" style="width: 100%;" id="noc_type" name="noc_type">
                        <option value="">SELECT NOC TYPE</option>
                        <option value="buy">BUY</option>
                        <option value="sell">SELL</option>
                     </select>
                    <span class="text-danger">{{ $errors->first('noc_type') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('exchange_type') ? 'has-error' : '' }}">
                     <label  class="control-label">EXCHANGE TYPE</label>
                     <select class="form-control input-sm" style="width: 100%;" id="exchange_type" name="exchange_type">
                        <option value="">SELECT</option>
                        <option value="iex">IEX</option>
                        <option value="pxil">PXIL</option>
                     </select>
                    <span class="text-danger">{{ $errors->first('exchange_type') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('quantum') ? 'has-error' : '' }}">
                     <label  class="control-label">QUANTUM</label>
                     <input class="form-control input-sm num" type="text" placeholder="VALUE" id="quantum" name="quantum">
                    <span class="text-danger">{{ $errors->first('quantum') }}</span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2 {{ $errors->has('start_date') ? 'has-error' : '' }}">
                     <label  class="control-label">VALIDITY START DATE</label>
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right input-sm" id="datepicker"  name="start_date" autocomplete="off" placeholder="DD/MM/YYYY">
                     </div>
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                  </div>
                  <div class="col-md-1 {{ $errors->has('start_time') ? 'has-error' : '' }}">
                     <label  class="control-label">TIME</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker" name="start_time">
                     </div>
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                  </div>
                  <div class="col-md-2 {{ $errors->has('end_date') ? 'has-error' : '' }}">
                     <label  class="control-label">VALIDITY END DATE</label>
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right input-sm" id="datepicker1"  name="end_date" autocomplete="off" placeholder="DD/MM/YYYY">
                     </div>
                      <span class="text-danger">{{ $errors->first('end_date') }}</span>
                  </div>
                  <div class="col-md-1 {{ $errors->has('end_time') ? 'has-error' : '' }}">
                     <label  class="control-label">TIME</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker" name="end_time">
                     </div>
                      <span class="text-danger">{{ $errors->first('end_time') }}</span>
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">ATTACH NOC REQUEST</label>
                     <input class="form-control input-sm" type="file" placeholder="" id="noc_file" name="noc_file" style="padding:4px 4px;">
                  </div>
               </div>
               <div class="row">&nbsp;</div>
               <div class="row">
                  <div class="col-md-5"></div>
                  <div class="col-md-1"><button type="submit" class="btn btn-block btn-success btn-xs">INITIATE</button></div>
                  <div class="col-md-5"></div>
               </div>
             </form>
             </div>
            </div>
         </div>
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href="#" class="btn btn-info btn-xs pull-right"  id="punch_app" name=" ">
            <span class="glyphicon glyphicon-plus"> </span>&nbsp;PUNCH APPLICATION</a>
          </div>
          </div>

         <div class="box" >
            <div class="box-body table-responsive  scroll-table-container">
               <table id="example1" class="table table-bordered table-striped table-hover text-center ">
                  <thead>
                     <tr>
                        <th rowspan="2" class="vl scroll-table2" >SR.NO</th>
                        <th rowspan="2" class="vl scroll-table4" >APPLICATON NO.</th>
                        <th rowspan="2" class="vl scroll-table2" >SLDC</th>
                        <th rowspan="2" class="vl scroll-table3" >NOC TYPE</th>
                        <th rowspan="2" class="vl scroll-table3" >EXCHANGE TYPE</th>
                        <th rowspan="2" class="vl scroll-table3" >QUANTUM</th>
                        <th rowspan="2" class="vl scroll-table4" >VALIDITY START DATE</th>
                        <th rowspan="2" class="vl scroll-table4" >VALIDITY END DATE</th>
                        <th rowspan="2" class="vl scroll-table3" >NOC REQUEST</th>
                        <th rowspan="2" class="vl scroll-table3">STATUS</th>
                        <th rowspan="2" class="vl scroll-table3" >PAYMENT ENTRY</th>
                        <th rowspan="2" class="vl scroll-table5" >NOC APPLICATON</th>
                        <th rowspan="2" class="vl scroll-table5" >ACTION</th>
                        <th colspan="3" class="vl scroll-table4">DEBIT NOTE</th>
                        <th rowspan="2" class="vl scroll-table5" >SDLC &nbsp;ACTION&nbsp; STATUS</th>
                     </tr>
                     <tr>
                        <th class="vl scroll-table3">SDLC</th>
                        <th class="vl scroll-table3">DISCOM</th>
                        <th class="vl scroll-table3">EMAIL</th>
                     </tr>
                  </thead>
                  <tbody>
                  @php $i=1; @endphp
                  @if (count($noc_data) > 0)
                     @foreach ($noc_data as $k=>$noc_list)
                     <tr>
                        <td class="vl">{{$i}}</td>
                        <td class="vl">{{$noc_list->application_no}}</td>
                        <td class="vl">{{strtoupper($noc_list->sldc)}}</td>
                        <td class="vl">{{strtoupper($noc_list->noc_type)}}</td>
                        <td class="vl">{{strtoupper($noc_list->exchange_type)}}</td>
                        <td class="vl">{{$noc_list->quantum}}</td>
                        <td class="vl">{{date('d/m/Y',strtotime($noc_list->start_date))}}</td>
                        <td class="vl">{{date('d/m/Y',strtotime($noc_list->end_date))}}</td>
                        <td class="vl">
                          @if($noc_list->noc_file)
                            <a href="{{url('fileNdownloads/'.$noc_list->noc_file)}}">View</a>
                          @endif
                        </td>


                        <td class="vl">
                          @if($noc_list->status==1)
                            <span class="text-default"><b>INITIATED</b></span>
                          @elseif($noc_list->status==2)
                            <span class="text-info"><b>APPROVED</b></span>
                          @elseif($noc_list->status==3)
                            <span class="text-primary"><b>SUBMITTED</b></span>
                          @elseif($noc_list->status==4)
                            <span class="text-success"><b>NOC RECEIVED</b></span>
                          @elseif($noc_list->status==5)
                            <span class="text-danger"><b>REJECTED</b></span>
                          @endif
                        </td>
                        <td class="vl">
                          @if(($noc_list->payment_challan_number!='' && $noc_list->bank_name!='' && $noc_list->transcation_date!='' && $noc_list->amount!=''))
                            @if($noc_list->status==4 ||$noc_list->status==5 ||$noc_list->status==1)
                              <a disabled><span class="label edited fnt " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
                              @else
                              <a href="" data-toggle="modal" data-target="#deleteData{{ $noc_list->id }}" ><span class="label edited fnt " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a>

                              @endif

                          @else
                            <a href="" data-toggle="modal" data-target="#deleteData{{ $noc_list->id }}" class="btn  btn-default btn-xs @if(($noc_list->status==2 ||$noc_list->status==3)) @else disabled @endif">ADD</a>
                          @endif
                        </td>
                        <td class="vl">

                          <a href="/generateNocPDF/{{$noc_list->id}}" @if($noc_list->status==1 ||$noc_list->status==2||(($noc_list->status==4 ||$noc_list->status==5)&&$noc_list->generate_noc_application=='')) class="disabled" @else @if(($noc_list->status==2 ||$noc_list->status==3) && $noc_list->generate_noc_application=='') @else class="disabled hidediv" @endif @endif><span class="label edited fnt">GENERATE</span></a>

                           <a href="{{url('/downloadGenPdfn/'.$noc_list->generate_noc_application)}}" @if($noc_list->status==3 && $noc_list->generate_noc_application!='') @else @if(($noc_list->status==4 ||$noc_list->status==5)&&$noc_list->generate_noc_application!=''))  class="disabled" @else class="disabled hidediv" @endif @endif><span class="label success fnt">DOWNLOAD</span></a>
                            <a href="#" data-toggle="modal" data-target="#deletegererateBill{{ $noc_list->id }}" @if($noc_list->status==3 && $noc_list->generate_noc_application!='') @else @if(($noc_list->status==4 ||$noc_list->status==5)&&$noc_list->generate_noc_application!=''))  class="disabled hidediv" @else class="disabled hidediv" @endif @endif><span class="label danger fnt">DELETE</span></a>
                        </td>
                        <td class="vl">
                         <!--  <a href="/noc/edit/{{$noc_list->id}}" @if($noc_list->status==1 ||$noc_list->status==4 ||$noc_list->status==5) class="disabled" @else @if($noc_list->status==3 && $noc_list->generate_noc_application=='')  @else class="disabled"  @endif @endif><span class="label edited fnt" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a> -->
                           @if($noc_list->status==1 ||$noc_list->status==4 ||$noc_list->status==5) 
                             <a ><span class="label edited fnt" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
                           
                           @else 
                            @if($noc_list->status==3 && $noc_list->generate_noc_application=='')  
                             <a href="/noc/edit/{{$noc_list->id}}"><span class="label edited fnt" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
                            @else 
                             <a  data-toggle="modal" data-target="#alertMessage{{ $noc_list->id }}"><span class="label edited fnt" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
                            @endif 
                           @endif


                          <a href="/noc/email/{{$noc_list->id}}/client/{{$client_id}}" @if($noc_list->status==1 ||$noc_list->status==4 ||$noc_list->status==5) class="disabled" @else @if($noc_list->status==3)  @else class="disabled" @endif @endif><span class="label success fnt">SEND EMAIL</span></a>
                        </td>
                        <td class="vl">
                          @if(@$noc_list['client']['nocbilling']['noc_application_for']=='both' || @$noc_list['client']['nocbilling']['noc_application_for']=='sldc')
                            <a href="/generatesldcPDF/{{$noc_list->id}}/client/{{@$client_id}}" @if($noc_list->status==1 ||$noc_list->status==2||(($noc_list->status==4 ||$noc_list->status==5)&&$noc_list->generate_sldc_debit=='')) class="disabled" @else @if(($noc_list->status==2 ||$noc_list->status==3) && $noc_list->generate_sldc_debit=='') @else class="disabled hidediv" @endif @endif><span class="label edited fnt">GENERATE</span></a>
                            
                            <a href="{{url('/downlNewFile/'.$noc_list->generate_sldc_debit)}}"  @if($noc_list->status==3 && $noc_list->generate_sldc_debit!='') @else @if(($noc_list->status==4 ||$noc_list->status==5)&&$noc_list->generate_sldc_debit!=''))  class="disabled" @else class="disabled hidediv" @endif @endif><span class="label success fnt">DOWNLOAD</span></a>

                            <a href="#" data-toggle="modal" data-target="#deletesldcDebit{{ $noc_list->id }}" @if($noc_list->status==3 && $noc_list->generate_sldc_debit!='') @else @if(($noc_list->status==4 ||$noc_list->status==5)&&$noc_list->generate_sldc_debit!=''))  class="disabled hidediv" @else class="disabled hidediv" @endif @endif><span class="label danger fnt">DELETE</span></a>

                          @endif
                        </td>
                        <td class="vl" >
                          @if(@$noc_list['client']['nocbilling']['noc_application_for']=='both' || @$noc_list['client']['nocbilling']['noc_application_for']=='discom')
                            <a href="/generatediscomPDF/{{$noc_list->id}}/client/{{@$client_id}}" @if($noc_list->status==1 ||$noc_list->status==2||(($noc_list->status==4 ||$noc_list->status==5)&&$noc_list->generate_discom_debit=='')) class="disabled" @else @if(($noc_list->status==2 ||$noc_list->status==3) && $noc_list->generate_discom_debit=='') @else class="disabled hidediv" @endif @endif><span class="label edited fnt">GENERATE</span></a>
                            <a href="{{url('/downlNewFile/'.$noc_list->generate_discom_debit)}}" @if($noc_list->status==3 && $noc_list->generate_discom_debit!='') @else @if(($noc_list->status==4 ||$noc_list->status==5)&&$noc_list->generate_discom_debit!=''))  class="disabled" @else class="disabled hidediv" @endif @endif><span class="label success fnt">DOWNLOAD</span></a>

                            <a href="#" data-toggle="modal" data-target="#deletediscomDebit{{ $noc_list->id }}" @if($noc_list->status==3 && $noc_list->generate_discom_debit!='') @else @if(($noc_list->status==4 ||$noc_list->status==5)&&$noc_list->generate_discom_debit!=''))  class="disabled hidediv" @else class="disabled hidediv" @endif @endif><span class="label danger fnt">DELETE</span></a>

                          @endif
                        </td>
                        <td class="vl">
                           <a href="/noc/email-debit/{{$noc_list->id}}/client/{{$client_id}}" @if($noc_list->status==1 ||$noc_list->status==4 ||$noc_list->status==5) class="disabled" @else @if($noc_list->status==3 )  @else class="disabled" @endif @endif><span class="label success fnt">SEND EMAIL</span></a>
                        </td>
                        <td class="vertical-align">
                          @if($noc_list->status==1 || $noc_list->status==2 || $noc_list->status==3)
                            <a @if($noc_list->status==1) class="disabled" @else @if($noc_list->status==3 && $noc_list->generate_noc_application!='')  @else class="disabled" @endif @endif href="" data-toggle="modal" data-target="#approveData{{ $noc_list->id }}" ><span class="label edited fnt">ACCEPT</span></a>

                            <a  @if($noc_list->status==1) class="disabled" @else @if($noc_list->status==3 && $noc_list->generate_noc_application!='')  @else class="disabled" @endif @endif href="" data-toggle="modal" data-target="#rejectedData{{ $noc_list->id }}" ><span class="label danger fnt">REJECT</span></a>
                            @elseif($noc_list->status==4)
                            <a disabled><span class="label edited fnt">ACCEPTED</span></a>
                            @elseif($noc_list->status==5)
                            <a  disabled><span class="label danger fnt">REJECTED</span></a>
                            @endif

                        </td>
                        <div id="deleteData{{ $noc_list->id }}" class="modal fade" role="dialog">
                           <form method="POST"  action="/add-payment">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                           <div class="modal-dialog modal-confirm">
                             <div class="modal-content">
                               <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                @if($noc_list->payment_challan_number!='' && $noc_list->bank_name!='' && $noc_list->transcation_date!='' && $noc_list->amount!='')
                                 <h4 class="modal-title text-center">EDIT PAYMENT</h4>
                                 @else
                                 <h4 class="modal-title text-center">ADD PAYMENT</h4>
                                 @endif
                               </div>
                               <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                               <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6">
                                     <label  class="control-label">PAYMENT CHALLAN NUMBER</label>
                                     <input class="form-control input-sm" type="text" placeholder="PAYMENT CHALLAN NUMBER" id="payment_challan_number" name="payment_challan_number" value="{{isset($noc_list->payment_challan_number)?$noc_list->payment_challan_number:''}}" required="">
                                     <input class="form-control input-sm" type="hidden" id="noc_id" name="noc_id" value="{{$noc_list->id}}">
                                    <input type="hidden" value="{{isset($str)?$str:''}}" name="client_name">

                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6">
                                     <label  class="control-label">BANK NAME</label>
                                     <input class="form-control input-sm" type="text" placeholder="BANK NAME" id="bank_name" name="bank_name"  value="{{isset($noc_list->bank_name)?$noc_list->bank_name:''}}" required>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6">
                                     <label  class="control-label">TRANSACTION DATE</label>
                                     <div class="input-group date">
                                        <div class="input-group-addon">
                                           <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right input-sm" id="datepicker3"  name="transcation_date"  value="{{isset($noc_list->transcation_date)?$noc_list->transcation_date:''}}" required placeholder="DD/MM/YYYY">
                                     </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6">
                                     <label  class="control-label">AMOUNT</label>
                                     <input class="form-control input-sm" type="text" placeholder="AMOUNT" id="amount" name="amount" onkeypress="return IsNumeric1(event);"  value="{{isset($noc_list->amount)?$noc_list->amount:''}}" required>
                                      <span id="error_areaa1" style="color: Red; display: none">* Input digits (0 - 9)</span>
                                  </div>
                               </div>

                               </div>
                               <div class="modal-footer">
                                @if($noc_list->payment_challan_number!='' && $noc_list->bank_name!='' && $noc_list->transcation_date!='' && $noc_list->amount!='')
                                  <button type="submit" class="btn btn-info btn-xs save_button">UPDATE</button>
                                @else
                                  <button type="submit" class="btn btn-info btn-xs save_button">SAVE</button>
                                @endif
                                 <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">CANCEL</button>
                               </div>
                             </div>
                           </div>
                           </form>
                         </div>
                        <div id="alertMessage{{ $noc_list
                       ->id }}" class="modal fade" role="dialog">
                           <form method="POST">
                           <div class="modal-dialog modal-confirm">
                            <input type="hidden" value="{{isset($str)?$str:''}}" name="client_name">
                            <input type="hidden" value="{{isset($noc_list->generate_noc_application)?$noc_list->generate_noc_application:''}}" name="noc_file_pdf">
                             <div class="modal-content">
                               <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                 <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                               </div> -->
                               <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                 <center><p style="font-size: 12px;font-weight: 500;color:black!important;">PLEASE DELETE NOC APPLICATION AFTER THAT CAN BE EDIT INFORMATION.</p></center>
                               </div>
                               <div class="modal-footer">
                                <div class="text-center">
                                 <!-- <button type="submit" class="btn btn-info btn-xs">YES</button> -->
                                 <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">CLOSE</button>
                               </div>
                               </div>
                             </div>
                           </div>
                           </form>
                         </div>


                        <div id="deletegererateBill{{ $noc_list
                       ->id }}" class="modal fade" role="dialog">
                           <form method="POST"  action="{{url('noc-pdf-delete/'.$noc_list->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                           <div class="modal-dialog modal-confirm">
                            <input type="hidden" value="{{isset($str)?$str:''}}" name="client_name">
                            <input type="hidden" value="{{isset($noc_list->generate_noc_application)?$noc_list->generate_noc_application:''}}" name="noc_file_pdf">
                             <div class="modal-content">
                               <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                 <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                               </div> -->
                               <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                 <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO DELETE THESE RECORDS</p></center>
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
                        <div id="deletesldcDebit{{ $noc_list
                       ->id }}" class="modal fade" role="dialog">
                           <form method="POST"  action="{{url('noc-pdf-delete/'.$noc_list->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                           <div class="modal-dialog modal-confirm">
                            <input type="hidden" value="{{isset($str)?$str:''}}" name="client_name">
                            <input type="hidden" value="{{isset($noc_list->generate_sldc_debit)?$noc_list->generate_sldc_debit:''}}" name="noc_sldc_pdf">
                             <div class="modal-content">
                               <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                 <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                               </div> -->
                               <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                 <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO DELETE THESE RECORDS?</p></center>
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
                        <div id="deletediscomDebit{{ $noc_list
                       ->id }}" class="modal fade" role="dialog">
                           <form method="POST"  action="{{url('noc-pdf-delete/'.$noc_list->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                           <div class="modal-dialog modal-confirm">
                            <input type="hidden" value="{{isset($str)?$str:''}}" name="client_name">
                            <input type="hidden" value="{{isset($noc_list->generate_discom_debit)?$noc_list->generate_discom_debit:''}}" name="noc_discom_pdf">
                             <div class="modal-content">
                               <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                 <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                               </div> -->
                               <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO DELETE THESE RECORDS?</p></center>
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
                          <div id="rejectedData{{ $noc_list->id }}" class="modal fade" role="dialog">
                             <form method="POST"  action="{{url('noc-request/'.$noc_list->id.'/status/5')}}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                             <div class="modal-dialog modal-confirm">
                               <div class="modal-content">
                                <!--  <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                   <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                 </div> -->
                                 <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                    <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED THIS NOC APPLICAITON.</p></center>
                                 </div>
                                 <div class="modal-footer">
                                  <div class="text-center">
                                   <button type="submit" class="btn btn-info">YES</button>
                                   <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                                 </div>
                                 </div>
                               </div>
                             </div>
                             </form>
                           </div>
                          <div id="approveData{{ $noc_list->id }}" class="modal fade" role="dialog">
                             <form method="POST"  action="{{url('noc-request/'.$noc_list->id.'/status/4')}}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                             <div class="modal-dialog modal-confirm">
                               <div class="modal-content">
                                 <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                   <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                 </div> -->
                                 <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                   <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO ACCEPTED THIS NOC APPLICAITON.</p></center>
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
                            @php $i++; @endphp
                        @endforeach
                      @else
                        <tr>
                            <td colspan="20" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
                        </tr>
                      @endif
                  </tbody>
               </table>
               {{ $noc_data->links() }}
            </div>
           </div>
         </div>
       </div>
    </section>
    <!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script>
$(document).ready(function() {
     $("#select-client").change(function(e) {
           var id = this.value;
           var url = "{{url('/getclientData')}}/"+id;

           window.location = url;
     });
 });
</script>
<script type="text/javascript">
 setTimeout(function() {
   $('#successMessage').fadeOut('fast');
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
           $('#datepicker2').datepicker({
             autoclose: true,
              format: 'dd/mm/yyyy'
           });
           $('#datepicker3').datepicker({
             autoclose: true,
              format: 'dd/mm/yyyy'
           });
        $('.timepicker').timepicker({
             showInputs: false
           });
         });
      </script>
      <script type="text/javascript">
        $('#punch_app').on('click', function(e){
            e.preventDefault();
            $('#divStatus').removeClass('hidediv');
            $(this).addClass('showdiv');
        });

      </script>
<script type="text/javascript">
  //   $(".save_button").click(function(){

  // var transcation_date = $("#transcation_date").val();
  // var payment_number = $("#payment_challan_number").val();
  // var bank_name = $("#bank_name").val();
  // var amount = $("#amount").val();
  // if(payment_number=='')
  // {
  //   $("#payment_challan_number").css('border-color', 'red');
  //   $("#old_pwd_error").css("color", "red");
  //   $("#old_pwd_error").show();
  //   $("#old_pwd_error").html("<small><b>Fill this field.</b></small> ");
  //   return false;
  // }
  // if(bank_name=='')
  // {
  //   $("#bank_name").css('border-color', 'red');
  //   $("#old_pwd_error1").css("color", "red");
  //   $("#old_pwd_error1").show();
  //   $("#old_pwd_error1").html("<small><b>Fill this field.</b></small> ");
  //   return false;
  // }
  // if(transcation_date=='')
  // {
  //   $(".date").css('border-color', 'red');
  //   $("#old_pwd_error2").css("color", "red");
  //   $("#old_pwd_error2").show();
  //   $("#old_pwd_error2").html("<small><b>Fill this field.</b></small> ");
  //   return false;
  // }
  // if(amount=='')
  // {
  //   $("#amount").css('border-color', 'red');
  //   $("#old_pwd_error3").css("color", "red");
  //   $("#old_pwd_error3").show();
  //   $("#old_pwd_error3").html("<small><b>Fill this field.</b></small> ");
  //   return false;
  // }

  // });

  var specialKeys = new Array();
  specialKeys.push(8); //Backspace
  function IsNumeric1(e) {
      var keyCode = e.which ? e.which : e.keyCode
      var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
      document.getElementById("error_areaa1").style.display = ret ? "none" : "inline";
      return ret;
  }
</script>


<script type="text/javascript">
    $(document).ready(function() {
   $('#select-client').select2();
});
</script>

  @endsection
