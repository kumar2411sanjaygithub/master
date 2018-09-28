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
<section class="content"><br>
  <div class="box">
   <div class="box-body" >
      <div class="row">
        <div class="col-md-12">
         <select class="" name="client_id" id="select-client" data-live-search="true">
           <option>Search Client</option>
            @foreach ($clientData as $key => $value)
            <option value="{{ $value->id }}" data-tokens="{{ $value->id }}.{{ $value->id }}.{{ $value->id }};?>"  @if(@$id==$value->id) selected  @endif> [{{$value->company_name}}] [{{$value->short_id}}] [{{$value->crn_no}}]</option>
           @endforeach

         </select>
         <script>
         $(document).ready(function() {
              $("#select-client").change(function(e) {
                    var id = this.value;
                    var url = '{{url('approveppadetailsfind')}}/'+id;

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
                        <div class="col-md-4 text-right">
                           <form class="pull-right" action="{{ url()->to('/client/exchange/Approved') }}" method="post" id="approve_data">
                              {{ csrf_field() }}
                              <input type="hidden" name="selected_status" class="selected_status">
                              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted" name="cdw5" id="cdw5">APPROVE ALL</button>
                              <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
                           </form>
                           <form class="pull-right" action="{{ url()->to('/client/exchange/Rejected') }}" method="post" id="approve_data">
                              {{ csrf_field() }}
                              <input type="hidden" name="selected_status" class="selected_status">
                              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rej" name="cdw5" id="cdw5">REJECT ALL</button>
                              <a data-toggle="modal" data-target="#myModalRej" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
                           </form>
                           <div id="myModal" class="modal fade" style="display: none;">
                              <div class="modal-dialog modal-confirm">
                                 <div class="modal-content">
                                    <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                       <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                       </div> -->
                                    <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                       <center>
                                          <p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? </p>
                                       </center>
                                    </div>
                                    <div class="modal-footer">
                                       <div class="text-center">
                                          <button type="button" href="#"   class="btn btn-info">
                                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal">Yes</a>
                                          </button>
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
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
                                       <center>
                                          <p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS? </p>
                                       </center>
                                    </div>
                                    <div class="modal-footer">
                                       <div class="text-center">
                                          <button type="button" href="#"   class="btn btn-info">
                                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal">Yes</a>
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
                                 <th class="chy" style="padding:5px!important;"><input type="checkbox" class="minimal1 deleteallbutton" name="select_all"></th>
                                 <th class="srno vl">SR. NO.</th>
                                 <th class="vl">VALIDITY START DATE</th>
                                 <th class="vl">VALIDITY END DATE</th>
                                 <th class="vl">FILE</th>
                                 <th class="act vl">ACTION</th>
                              </tr>
                           </thead>
                           <tbody>
                             @forelse($ppaData as $key => $value)
                              <tr>
                                 <td class="text-center vl"><input type="checkbox"   name="select_all" value="" class="minimal1 deletedbutton"></td>
                                 <td class="text-center vl">{{$key+1}}</td>
                                 <td class="text-center vl">{{date('d/m/Y',strtotime($value->validity_to))}}</td>
                                 <td class="text-center vl">{{date('d/m/Y',strtotime($value->validity_from))}}</td>
                                 <td class="text-center vl"><a download href="{{url('/documents/ppa/'.$value->file_path)}}" >View</a></td>
                                 <td class="vl" style="padding:5px!important;">
                                   @if($value->status == 0)
                                   <a href="/PPA/aprovePpa/{{$value->id}}/Approved"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>
                                   <a href="/PPA/aprovePpa/{{$value->id}}/Rejected"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a>
                                   @elseif($value->status == 1)
                                   <span class="text-info">Approved</span>
                                   @elseif($value->status == 2)
                                   <span class="text-danger">Rejected</span>
                                   @endif
                                 </td>
                              </tr>
                              @empty
                              <tr><td colspan="6">Record Not Found</td></tr>
                              @endforelse
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
                        <div class="col-md-4 text-right">
                           <form class="pull-right" action="" method="post" id="approve_data">
                              <input type="hidden" name="selected_status" class="selected_statusM">
                              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deletedM" name="cdw5" id="cdw5">APPROVE ALL</button>
                              <a data-toggle="modal" data-target="#myModalM" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
                           </form>
                           <form class="pull-right" action="" method="post" id="approve_data">
                              {{ csrf_field() }}
                              <input type="hidden" name="selected_status" class="selected_statusM">
                              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rejM" name="cdw5" id="cdw5">REJECT ALL</button>
                              <a data-toggle="modal" data-target="#myModalRejM" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
                           </form>
                           <div id="myModalM" class="modal fade" style="display: none;">
                              <div class="modal-dialog modal-confirm">
                                 <div class="modal-content">
                                    <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                                       <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                                       </div> -->
                                    <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                                       <center>
                                          <p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? </p>
                                       </center>
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
                                       <center>
                                          <p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS? </p>
                                       </center>
                                    </div>
                                    <div class="modal-footer">
                                       <div class="text-center">
                                          <button type="button" href="#"   class="btn btn-info">
                                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rejM">Yes</a>
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
                                 <th class="chy"  style="padding:5px!important;"><input type="checkbox" class="minimal1 deleteallbuttonM" name="select_allM"></th>
                                 <th class="srno vl">SR.NO</th>
                                 <th class="vl">FIELD NAME</th>
                                 <th class="vl">CURRENT VALUE</th>
                                 <th class="vl">UPDATED VALUE</th>
                                 <th class="act">ACTION</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td style="padding:5px!important;"><input type="checkbox" class="minimal1 deletedbuttonM" name="select_allM" value=""></td>
                                 <td class="text-center vl"></td>
                                 <td class="text-center vl"></td>
                                 <td class="text-center vl">
                                 </td>
                                 <td class="text-center vl">
                                 </td>
                                 <td  class="vl"><a href=""><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href=""><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div id="menu2" class="tab-pane fade">
               <div class="box">
                  <div class="box-body">
                     <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-hover text-center">
                           <thead>
                              <tr>
                                 <th class="chy" style="padding:5px!important;"><input type="checkbox" class="minimal1 deleteallbuttonD" name="select_allD"></th>
                                 <th class="srno vl">SR.NO</th>
                                 <th class="vl">EXCHANGE TYPE</th>
                                 <th class="vl">VALIDITY FROM</th>
                                 <th class="vl">VALIDITY TO</th>
                                 <th class="vl">FILE NAME</th>
                                 <th class="act vl">ACTION</th>
                              </tr>
                           </thead>
                           <tbody>
                             @forelse($delData as $key -> $value)
                             <tr>
                                <td class="text-center vl"><input type="checkbox" name="select_all" value="" class="minimal1 deletedbutton"></td>
                                <td class="text-center vl">{{$key+1}}</td>
                                <td class="text-center vl">{{date('d/m/Y',strtotime($value->validity_to))}}</td>
                                <td class="text-center vl">{{date('d/m/Y',strtotime($value->validity_from))}}</td>
                                <td class="text-center vl"><a download href="{{url('/documents/ppa/'.$value->file_path)}}" >View</a></td>
                                <td class="vl" style="padding:5px!important;">
                                  @if($value->status == 0)
                                  <a href="/PPA/aprovePpa/{{$value->id}}/Approved"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>
                                  <a href="/PPA/aprovePpa/{{$value->id}}/Rejected"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a>
                                  @elseif($value->status == 1)
                                  <span class="text-info">Approved</span>
                                  @elseif($value->status == 2)
                                  <span class="text-danger">Rejected</span>
                                  @endif
                                </td>
                             </tr>
                              @empty
                              <tr><td colspan="7">Record Not Found</td><tr>
                              @endforelse
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
<script type="text/javascript">
$(document).ready(function() {
    $('#select-client').select2();
});
</script>
<script>
  $(function () {
      $('input[type="checkbox"].minimal1, input[type="radio"].minimal1').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass   : 'iradio_flat-blue'
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
  });

  </script>


@endsection
