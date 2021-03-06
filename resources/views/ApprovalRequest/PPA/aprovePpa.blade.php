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
span.hifan{margin-right:10px!important;}
</style>
<!-- success msg -->
@if(session()->has('success'))
  <div class="alert alert-success mt10">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      {{ session()->get('success') }}
  </div>
@endif
<!-- query validater     -->
<section class="content-header">
   <h5 class="pull-left"><label  class="control-label pull-right mt-1"><u>APPROVE PPA DETAILS</u></h5>
     @if(isset($headData->company_name))
   &nbsp;&nbsp;&nbsp; <span class="hifan">{{$headData->company_name}}</span> | <span class="hifan">{{$headData->crn_no}}</span> | <span class="hifan">{{$headData->iex_portfolio}}</span> | <span class="hifan">{{$headData->pxil_portfolio}}</span></label>
   @endif
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">APPROVE REQUEST</a></li>
      <li><a href="#">PPA</a></li>
   </ol>
</section>
<!-- Main content -->
<br>
<section class="content mt15">
  <div class="box">
   <div class="box-body" >
      <div class="row">
        <div class="col-md-12">
         <select class="" name="client_id" id="select-client" data-live-search="true">
           <option>Search Client</option>
            @foreach ($clientData as $key => $value)
            <option value="{{ $value->id }}" data-tokens="{{ $value->id }}.{{ $value->id }}.{{ $value->id }};?>"  @if(@$client_id==$value->id) selected  @endif>{{$value->company_name}} [{{$value->short_id}}] [{{$value->crn_no}}] [{{$value->iex_portfolio}}] [{{$value->pxil_portfolio}}]</option>
           @endforeach
         </select>
         <script>
         $(document).ready(function() {
              $("#select-client").change(function(e) {
                    var id = this.value;
                    var url = "{{url('approveppadetailsfind')}}/"+id;

                    window.location = url;
              });
          });
         </script>
        </div>
      </div>
     </div>
</div>
   <div class="row">
      <div class="col-xs-12">
         <div class="row">
            <div class="col-md-10">
               <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#home">NEW</a></li>
                  <li><a data-toggle="tab" href="#menu1">MODIFIED</a></li>
                  <li><a data-toggle="tab" href="#menu2">DELETED</a></li>
               </ul>
            </div>
            <div class="col-md-2 mt8">
               <!-- <a href=""><button type="button" class="btn btn-info btn-xs pull-right mr"><span class="glyphicon glyphicon-forward"></span>BACK TO LIST</button></a> -->
            </div>
         </div>
         <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
               <div class="box">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6"></div>
                        <div class="col-md-4">
                              <div class="pull-right">
                              @if (isset($Addexchangedata) && count($Addexchangedata) > 0)
                              <form class="pull-left" action="{{ url()->to('ppa-details/Approved') }}" method="post" id="approve_data">
                                {{ csrf_field() }}
                                <input type="hidden" name="selected_status" class="selected_status">
                                <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted" name="cdw5" id="cdw5">APPROVE ALL</button>

                                <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
                              </form>
                              @endif
                              &nbsp;
                              @if (isset($Addexchangedata) && count($Addexchangedata) > 0)
                              <form class="pull-right" action="{{ url()->to('ppa-details/Rejected') }}" method="post" id="approve_data">
                                {{ csrf_field() }}
                                <input type="hidden" name="selected_status" class="selected_status">
                                <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rej" name="cdw5" id="cdw5">REJECT ALL</button>

                                <a data-toggle="modal" data-target="#myModalRej" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
                              </form>
                              @endif
                              </div>
                              <div id="myModal" class="modal fade" style="display: none;">
                                <div class="modal-dialog modal-confirm">
                                  <div class="modal-content">
                                    <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                      <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                    </div> -->
                                    <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                      <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? </p></center>
                                    </div>
                                    <div class="modal-footer">
                                       <div class="text-center">
                                      <button type="button" href="#" class="btn btn-xs btn-info">
                                        <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal">Yes</a>
                                      </button>
                                      <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">No</button>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div id="myModalRej" class="modal fade" style="display: none;">
                                <div class="modal-dialog modal-confirm">
                                  <div class="modal-content">
                                    <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                      <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                    </div> -->
                                    <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                      <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS? </p></center>
                                    </div>
                                    <div class="modal-footer">
                                       <div class="text-center">
                                      <button type="button" href="#"   class="btn btn-info btn-xs">
                                        <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rej">Yes</a>
                                      </button>
                                      <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">No</button>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                     </div>
                     <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-hover text-center">
                           <thead>
                              <tr>
                                 <th class="chy" style="padding:5px!important;"><input type="checkbox" class="minimal1 deleteallbutton" name="select_all"></th>
                                 <th class="srno vl">SR. NO.</th>
                                 <th class="vl">VALIDITY START DATE</th>
                                 <th class="vl">VALIDITY END DATE</th>
                                 <th class="vl">STATUS</th>
                                 <th class="vl">FILE</th>
                                 <th class="act vl">ACTION</th>
                              </tr>
                           </thead>
                           <tbody>
                                          @if(isset($Addexchangedata) && count($Addexchangedata)>0)
                                          <?php
                                          $i=1;
                                          ?>
                                          @foreach ($Addexchangedata as $key => $value)
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
                                               <td class="text-center vl"><input type="checkbox"   name="select_all" value="{{ $value->id }}" class="minimal1 deletedbutton"></td>
                                               <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ date('d/m/Y',strtotime($value->validity_from)) }}</td>
                                               <td class="text-center vl">{{ date('d/m/Y',strtotime($value->validity_to)) }}</td>
                                               <td class="text-center vl">{{$valid}}</td>
                                               <td class="text-center vl"><a href="{{url('/documents/ppa/'.$value->file_path)}}" download='download'>View</a></td>
                                             <td class="vl"  style="padding:5px!important;"><a href="/PPA/aprovePpa/{{ $value->id }}/Approved"><span class="text-success glyphicon glyphicon-ok"></span></a>&nbsp;&nbsp;<a href="/PPA/aprovePpa/{{ $value->id }}/Rejected"><span class=" text-danger glyphicon glyphicon-remove"></span></a></td>
                                          </tr>
                                        <?php
                                       $i++;
                                       ?>
                                       @endforeach
                                       @else
                                       <tr class="alert-danger" ><th colspan='7'>No Data Found.</th></tr>
                                       @endif
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div id="menu1" class="tab-pane fade">
               <div class="box">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6"></div>
                        <div class="col-md-4">
                            <div class="pull-right">
                                @if (isset($ppaData) && count($ppaData) > 0)
                                    <form class="pull-left" action="{{ url()->to('ppadetails/allModified/Approved') }}" method="post" id="approve_data">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="selected_status" class="selected_statusM">
                                      <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deletedM" name="cdw5" id="cdw5">APPROVE ALL</button>

                                      <a data-toggle="modal" data-target="#myModalM" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
                                    </form>
                                    @endif
                                    &nbsp;&nbsp;
                                    @if (isset($ppaData) && count($ppaData) > 0)
                                    <form class="pull-right" action="{{ url()->to('ppadetails/allModified/Rejected') }}" method="post" id="approve_data">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="selected_status" class="selected_statusM">
                                      <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rejM" name="cdw5" id="cdw5">REJECT ALL</button>

                                      <a data-toggle="modal" data-target="#myModalRejM" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
                                    </form>
                                    @endif
                                  </div>

                                  <div id="myModalM" class="modal fade" style="display: none;">
                                    <div class="modal-dialog modal-confirm">
                                      <div class="modal-content">
                                        <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                          <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                        </div> -->
                                        <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                          <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? </p></center>
                                        </div>
                                        <div class="modal-footer">
                                           <div class="text-center">
                                          <button type="button" href="#"   class="btn btn-info">
                                            <a href="" style="color:#fff;text-decoration:none" id="delete-button-modalM">Yes</a>
                                          </button>
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                        </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="myModalRejM" class="modal fade" style="display: none;">
                                    <div class="modal-dialog modal-confirm">
                                      <div class="modal-content">
                                        <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                          <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                        </div> -->
                                        <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                          <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS? </p></center>
                                        </div>
                                        <div class="modal-footer">
                                           <div class="text-center">
                                          <button type="button" href="#"   class="btn btn-info btn-xs">
                                            <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rejM">Yes</a>
                                          </button>
                                          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">No</button>
                                        </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                        </div>
                     </div>
                     <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-hover text-center">
                           <thead>
                              <tr>
                                 <th class="chy"  style="padding:5px!important;"><input type="checkbox" class="minimal1 deleteallbuttonM" name="select_allM"></th>
                                 <th class="srno vl">SR.NO</th>
                                 <th class="vl">FIELD NAME</th>
                                 <th class="vl">CURRENT VALUE</th>
                                 <th class="vl">UPDATED VALUE</th>
                                 <th class="act">ACTION</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                          $i=1;
                                           $input_lebels = \App\Common\Languages\ManageClientLang::input_labels();
                                          ?>
                             @forelse($ppaData as $key => $value)
                              <tr>
                                               <td style="padding:5px!important;"><input type="checkbox" class="minimal1 deletedbuttonM" name="select_allM" value="{{ $value->id }}"></td>
                                               <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $input_lebels[$value->attribute_name]}}</td>
                                               <td class="text-center vl">
                                                @if(strstr($input_lebels[$value->attribute_name], 'Date') !== false)
                                                {{ date('d/m/Y',strtotime($value->old_att_value)) }}
                                                @else
                                                  {{$value->old_att_value}}
                                                @endif

                                              </td>
                                               <td class="text-center vl">
                                                @if(strstr($input_lebels[$value->attribute_name], 'Date') !== false)
                                                {{ date('d/m/Y',strtotime($value->updated_attribute_value)) }}
                                                @else
                                                  {{$value->updated_attribute_value}}
                                                @endif
                                               </td>
                                 <td class="vl" style="padding:5px!important;">
                                   @if($value->status == 0)
                                   <a href="/modifiedPpa/{{$value->id}}/Approved"><span class="text-success glyphicon glyphicon-ok"></span></a>&nbsp;&nbsp;
                                   <a href="/modifiedPpa/{{$value->id}}/Rejected"><span class=" text-danger glyphicon glyphicon-remove"></span></a>
                                   @elseif($value->status == 1)
                                   <span class="text-info">Approved</span>
                                   @elseif($value->status == 2)
                                   <span class="text-danger">Rejected</span>
                                   @endif
                                 </td>
                              </tr>
                              @empty
                              <tr><th class="alert-danger" colspan="6">No Data Found.</th></tr>
                              @endforelse
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div id="menu2" class="tab-pane fade">
               <div class="box">
                  <div class="box-body">
                                 <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4">
                                      <div class="pull-right">
                                          @if (isset($delexcgData) && count($delexcgData) > 0)
                                              <form class="pull-left" action="{{ url()->to('ppa/deletedd/request/Approved') }}" method="post" id="approve_data">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="selected_status" class="selected_statusD">
                                                <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deletedD" name="cdw5" id="cdw5">APPROVE ALL</button>

                                                <a data-toggle="modal" data-target="#myModalD" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
                                              </form>
                                              @endif
                                              &nbsp;&nbsp;
                                              @if (isset($delexcgData) && count($delexcgData) > 0)
                                              <form class="pull-right" action="{{ url()->to('ppa/deletedd/request/Rejected') }}" method="post" id="approve_data">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="selected_status" class="selected_statusD">
                                                <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rejD" name="cdw5" id="cdw5">REJECT ALL</button>

                                                <a data-toggle="modal" data-target="#myModalRejD" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
                                              </form>
                                              @endif
                                      </div>
                                        <div id="myModalD" class="modal fade" style="display: none;">
                                          <div class="modal-dialog modal-confirm">
                                            <div class="modal-content">
                                              <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                                <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                              </div> -->
                                              <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                                <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? </p></center>
                                              </div>
                                              <div class="modal-footer">
                                                 <div class="text-center">
                                                <button type="button" href="#"   class="btn btn-info btn-xs">
                                                  <a href="" style="color:#fff;text-decoration:none" id="delete-button-modalD">Yes</a>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">No</button>
                                              </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div id="myModalRejD" class="modal fade" style="display: none;">
                                          <div class="modal-dialog modal-confirm">
                                            <div class="modal-content">
                                              <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                                <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                              </div> -->
                                              <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                                <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS? </p></center>
                                              </div>
                                              <div class="modal-footer">
                                                 <div class="text-center">
                                                <button type="button" href="#"   class="btn btn-info">
                                                  <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rejD">Yes</a>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                              </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                 </div>

                     <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-hover text-center">
                           <thead>
                              <tr>
                                 <th class="chy" style="padding:5px!important;"><input type="checkbox" class="minimal1 deleteallbuttonD" name="select_allD"></th>
                                 <th class="srno vl">SR.NO</th>
                                 <th class="vl">VALIDITY FROM</th>
                                 <th class="vl">VALIDITY TO</th>
                                 <th class="vl">FILE NAME</th>
                                 <th class="act vl">ACTION</th>
                              </tr>
                           </thead>
                           <tbody>
 @if(isset($delexcgData) && count($delexcgData)>0)
                                                  <?php
                                                  $i=1;
                                                  ?>
                                                  @foreach ($delexcgData as $key => $value)


                                                <tr>
                                                    <td style="padding:5px!important;"><input type="checkbox" class="minimal1 deletedbuttonD" name="select_allD" value="{{ $value->id }}"></td>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td class="text-center">{{ date('d/m/Y',strtotime($value->validity_from)) }}</td>
                                                    <td class="text-center">{{ date('d/m/Y',strtotime($value->validity_to)) }}</td>
                                                    <td class="text-center"><a href="{{url('/documents/ppa/'.$value->file_path)}}" download='download'>View</a></td>
                                                    <td class="text-center vl">

                                                          <a href="/deletedPPA/{{ $value->id }}/Approved"><span class="text-success glyphicon glyphicon-ok"></span></a>
                                                          &nbsp;&nbsp;
                                                          <a href="/deletedPPA/{{ $value->id }}/Rejected"><span class=" text-danger glyphicon glyphicon-remove"></span></a>

                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                                ?>

                                            @endforeach
                                       @else
                                       <tr class="alert-danger" ><th colspan='7'>No Data Found.</th></tr>
                                       @endif
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection
@section('content_foot')

  <script>
    $(function () {
        $('input[type="checkbox"].minimal1, input[type="radio"].minimal1').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass   : 'iradio_flat-blue'
      });

    });

    </script>
     <script type="text/javascript">
            $('.deletedbutton').on('ifChecked', function(event) {
              var array = [];
              $('.deletedbutton').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
              $('.selected_status').val(array);
            });
            $('.deletedbutton').on('ifUnchecked', function(event){
              var array = [];
              $('.deletedbutton').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
                $('.selected_status').val(array);
            });
      $(document).delegate('#delete-button-modal','click',function(){
        if(!$(".selected_status").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted").trigger('click');
         return false;
      }
      });
      $(document).delegate('#delete-button-modal-rej','click',function(){
        if(!$(".selected_status").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted-rej").trigger('click');
         return false;
      }
      });


            $(".deleteallbutton").on('ifChecked', function(event) {
                  if($(this).iCheck('check')){
                    $(".deletedbutton").iCheck('check');
                    var array = [];
                    $('.deletedbutton').each(function(){
                      if($(this).iCheck('check')){
                        array.push($(this).val());
                    }
                    });
                    $('.selected_status').val(array);
                  }else{
                      $('.selected_status').val('');
                    $(".deletedbutton").iCheck('uncheck');
                  }
            });
            $('.deleteallbutton').on('ifUnchecked', function(event) {
                $('.selected_status').val('');
                $(".deletedbutton").iCheck('uncheck');
            });

    </script>
    <script type="text/javascript">
            $('.deletedbuttonM').on('ifChecked', function(event) {
              var array = [];
              $('.deletedbuttonM').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
              $('.selected_statusM').val(array);
            });
            $('.deletedbuttonM').on('ifUnchecked', function(event){
              var array = [];
              $('.deletedbuttonM').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
                $('.selected_statusM').val(array);
            });


      $(document).delegate('#delete-button-modalM','click',function(){
        if(!$(".selected_statusM").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deletedM").trigger('click');
         return false;
      }
      });
      $(document).delegate('#delete-button-modal-rejM','click',function(){
        if(!$(".selected_statusM").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted-rejM").trigger('click');
         return false;
      }
      });

            $(".deleteallbuttonM").on('ifChecked', function(event) {
                  if($(this).iCheck('check')){
                    $(".deletedbuttonM").iCheck('check');
                    var array = [];
                    $('.deletedbuttonM').each(function(){
                      if($(this).iCheck('check')){
                        array.push($(this).val());
                    }
                    });
                    $('.selected_statusM').val(array);
                  }else{
                      $('.selected_statusM').val('');
                    $(".deletedbuttonM").iCheck('uncheck');
                  }
            });
            $('.deleteallbuttonM').on('ifUnchecked', function(event) {
                $('.selected_statusM').val('');
                $(".deletedbuttonM").iCheck('uncheck');
            });


    </script>
    <script type="text/javascript">
            $('.deletedbuttonD').on('ifChecked', function(event) {
              var array = [];
              $('.deletedbuttonD').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
              $('.selected_statusD').val(array);
            });
            $('.deletedbuttonD').on('ifUnchecked', function(event){
              var array = [];
              $('.deletedbuttonD').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
                $('.selected_statusD').val(array);
            });


      $(document).delegate('#delete-button-modalD','click',function(){
        if(!$(".selected_statusD").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deletedD").trigger('click');
         return false;
      }
      });
      $(document).delegate('#delete-button-modal-rejD','click',function(){
        if(!$(".selected_statusD").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted-rejD").trigger('click');
         return false;
      }
      });

            $(".deleteallbuttonD").on('ifChecked', function(event) {
                  if($(this).iCheck('check')){
                    $(".deletedbuttonD").iCheck('check');
                    var array = [];
                    $('.deletedbuttonD').each(function(){
                      if($(this).iCheck('check')){
                        array.push($(this).val());
                    }
                    });
                    $('.selected_statusD').val(array);
                  }else{
                      $('.selected_statusD').val('');
                    $(".deletedbuttonD").iCheck('uncheck');
                  }
            });
            $('.deleteallbuttonD').on('ifUnchecked', function(event) {
                $('.selected_statusD').val('');
                $(".deletedbuttonD").iCheck('uncheck');
            });

    </script>
<script type="text/javascript">
$(document).ready(function() {
    $('#select-client').select2();
});
  setTimeout(function() {
    $('.alert-success').fadeOut('fast');
    }, 2000);
  </script>
@endsection
