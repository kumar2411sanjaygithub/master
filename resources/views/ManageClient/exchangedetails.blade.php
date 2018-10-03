@extends('theme.layouts.default')
@section('content')
     <section class="content">
                    <div class="row">
                      <div class="col-xs-12">
                                <div class="row">
                                  <div class="col-md-6 pull-left">
                                      <h5 class="pull-left"><label class="control-label pull-right mt-1"><u>Upload Exchange File</u></h5> &nbsp;&nbsp;&nbsp; {{$client_details[0]['company_name']}}<span class="hifan">|</span> {{$client_details[0]['crn_no']}} <span class="hifan">|</span> {{$client_details[0]['iex_portfolio']}}<span class="hifan">|</span> {{$client_details[0]['pxil_portfolio']}}</label>
                                  </div>
                                  <div class="col-md-6 pull-right">
                                          <a href="{{ route('basic.details') }}"><button type="button" class="btn btn-info btn-xs pull-right mt7"><span class="glyphicon glyphicon-forward"></span>BACK TO LIST</button></a>
                                          <button class="btn btn-info btn-xs pull-right mr5 mt7 {{(isset($get_exchange_details)||!$errors->isEmpty())?'hidden':''}}" id="add"><span class="glyphicon glyphicon-plus"></span>&nbsp ADD</button>
                                  </div>
                                </div>
                                      @if(session()->has('message'))
                                        <div class="alert alert-success alert-dismissible fade in">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                         <span class="glyphicon glyphicon-ok"></span> &nbsp; {{ session()->get('message') }}
                                        </div>
                                      @endif
                                  <form method ="post" action="{{isset($get_exchange_details)?url('exchange_edit/'.$get_exchange_details->id):route('exchange_create')}}" enctype="multipart/form-data">
                                   {{ csrf_field() }}
                                   <div class="{{isset($get_exchange_details)?'':'divhide'}}" id="exchangebox">

                                  <div class="box {{(isset($get_exchange_details)||!$errors->isEmpty())?'':'hidden'}} addtab">
                                  <div class="box-body">
                                  <div class="row">
                                      <div class="col-md-3 {{ $errors->has('ex_type') ? 'has-error' : '' }}">
                                        <input type="hidden"  name="client_id" value="{{@$client_id}}" id="client">
                                      <label  class="control-label">EXCHANGE TYPE<span class="text-danger"><strong>*</strong></span></label>

                                      <select class="form-control input-sm " style="width: 100%;" id="ex_type" name="ex_type" >
                                          <option value="">SELECT EXCHANGE</option>
                                          <option value="IEX" {{(isset($get_exchange_details)&& $get_exchange_details->ex_type=='IEX')||old('ex_type')=='IEX'?'selected':''}}>IEX</option>
                                          <option value="PXIL" {{(isset($get_exchange_details)&& $get_exchange_details->ex_type=='PXIL')||old('ex_type')=='PXIL'?'selected':''}}>PXIL</option>
                                          </select>
                                          <span class="text-danger">{{ $errors->first('ex_type') }}</span>
                                          </div>
                                          <div class="col-md-3 {{ $errors->has('validity_from') ? 'has-error' : '' }}">
                                           <label  class="control-label">VALIDITY START DATE<span class="text-danger"><strong>*</strong></span></label>
                                           <div class="input-group date" id="datepicker" >
                                             <div class="input-group-addon">
                                               <i class="fa fa-calendar"></i>
                                             </div>
                                             <input type="text" class="form-control pull-right input-sm"  id="validity_from" name="validity_from" value="{{isset($get_exchange_details)?date('d/m/Y',strtotime($get_exchange_details->validity_from)):old('validity_from')}}" autocomplete="off">

                                           </div>
                                           <span class="text-danger">{{ $errors->first('validity_to') }}</span>
                                          </div>
                                          <div class="col-md-3 {{ $errors->has('validity_to') ? 'has-error' : '' }}">
                                            <label  class="control-label">VALIDITY END START<span class="text-danger"><strong>*</strong><span></label>
                                            <div class="input-group date" id="datepicker1">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" class="form-control pull-right input-sm"  id="validity_to" name="validity_to" value="{{isset($get_exchange_details)?date('d/m/Y',strtotime($get_exchange_details->validity_to)):old('validity_to')}}"  autocomplete="off">

                                            </div>
                                            <span class="text-danger">{{ $errors->first('validity_to') }}</span>
                                          </div>
                                          <div class="col-md-3 {{ $errors->has('file_upload') ? 'has-error' : '' }}">
                                            <label  class="control-label">REGISTRATION CERTIFICATE</label><span class="text-danger"><strong>*</strong></span>
                                            <input class="form-control input-sm" type="file" placeholder="" id="file_upload" name="file_upload" style="padding:4px 4px;">
                                             <span class="text-danger">{{ $errors->first('file_upload') }}</span>
                                          </div>
                                        </div>
                                         <div class="col-md-12">&nbsp;</div>
                                           <div class="col-md-12">
                                             <div class="col-md-5"></div>
                                             @if(isset($get_exchange_details))
                                              <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs" id="save" name="save">UPDATE</button></div>
                                              @else
                                              <div class="col-md-1"><button type="submit" class="btn btn-block btn-success btn-xs" id="save" name="save">SAVE</button></div>
                                              @endif
                                              <div class="col-md-1"><a href="{{ URL('/exchangedetails/'.$client_id) }}" ><input type="button" class="btn btn-block btn-danger btn-xs cancel" id="bn7" name="bn7" value="CANCEL"></a></div>

                                            <div class="col-md-5"></div>
                                          </div>

                                        </div>
                                        </div>
                                      </div>
                                    
                                    </form>
                                <div class="box">


                                <div class="box-body table-responsive">
                                  <table class="table table-bordered text-center">
                                <thead>
                                  <tr>
                                    <th class="srno">SR.NO</th>
                                    <th>TYPE</th>
                                    <th>VALIDITY START DATE</th>
                                    <th>VALIDITY END DATE</th>
                                    <th>FILE</th>
                                    <th>STATUS</th>
                                    <th class="act1">ACTION</th>
                                  </tr>
                                </thead>
                                <tbody>
                                
                              @forelse ($exchangedetails as $key => $value)
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
                                  <td class="text-center">{{$key+$exchangedetails->firstItem()}}</td>
                                  <td class="text-center">{{ $value->ex_type }}</td>
                                  <td class="text-center">{{ date('d/m/Y',strtotime($value->validity_from)) }}</td>
                                  <td class="text-center">{{ date('d/m/Y',strtotime($value->validity_to)) }}</td>
                                  <td class="text-center"><a href="{{url('downloads/'.$value->file_upload)}}" >View</a></td>
                                  <td>{{ $valid }}</td>
                                  <td class="text-center">
                                    <a href="{{url('/editexchangedetail/'.$client_id.'/eid/'.$value->id)}}"><span class="glyphicon glyphicon-pencil" id="edit-bank-detail" bank_detail_id="{{ $value->id }}"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="/delete/exchange/{{$value->id}}"><span class="glyphicon glyphicon-trash text-danger" id="remove-bank-detail" bank_detail_id="{{ $value->id }}"></span></a>
                                  </td>
                              </tr>
                              
                           
                             @empty
                             <tr class="alert-danger" ><th colspan='7'>No Data Found.</th></tr>
                              @endforelse
                                </tbody>
                                </table>
                                 <div class=" col-md-12">
                            <div class="col-md-6"><br>
                              Total Records: {{ $exchangedetails->total() }}
                            </div>
                            <div class="col-md-6">
                            <div class=" pull-right">{{$exchangedetails->links()}}</div>
                          </div>
                        </div>
                                </div>
                                </div>
                          </div>
                    </div>
              </section>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script>

     $(document).ready(function(){
      $('#add').on('click', function(){
          $(".addtab").removeClass("hidden");
          $("#add").hide();
        });
        $(".cancel").click(function(){
          $(".addtab").addClass("hidden");
        });
      });
     </script>
     <script>
  function myFunction(){
    //alert(1);
    $('#exchangebox').addClass('divhide').removeClass('divshow');
    $("#add").show();
  }
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
        autoclose: true
      })
      $('#datepicker3').datepicker({
        autoclose: true
      })
   $('.timepicker').timepicker({
        showInputs: false
      })
    })

 </script>
   <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
@endsection
