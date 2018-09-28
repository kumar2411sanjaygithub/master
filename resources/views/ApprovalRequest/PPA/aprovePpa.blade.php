@extends('theme.layouts.default')
@section('content')
<section class="content-header">
   <h5 class="pull-left"><label  class="control-label pull-right mt-1"><u>APPROVE PPA DETAILS</u></h5>
   &nbsp;&nbsp;&nbsp; <span class="hifan">|</span>  <span class="hifan">|</span> <span class="hifan">|</span> </label>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">APPROVE REQUEST</a></li>
      <li><a href="#">PPA</a></li>
   </ol>
</section>
<!-- Main content -->
<section class="content">

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
               <a href="{{url('client/existing')}}"><button type="button" class="btn btn-info btn-xs pull-right mr"><span class="glyphicon glyphicon-forward"></span>BACK TO LIST</button></a>
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
                                 <th class="vl">EXCHANGE TYPE</th>
                                 <th class="vl">VALIDITY FROM</th>
                                 <th class="vl">VALIDITY TO</th>
                                 <th class="vl">FILE NAME</th>
                                 <th class="act vl">ACTION</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td class="text-center vl"><input type="checkbox"   name="select_all" value="" class="minimal1 deletedbutton"></td>
                                 <td class="text-center vl"></td>
                                 <td class="text-center vl"></td>
                                 <td class="text-center vl"></td>
                                 <td class="text-center vl"></td>
                                 <td class="text-center vl"><a href="" >View</a></td>
                                 <td class="vl"  style="padding:5px!important;"><a href=""><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href=""><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
                              </tr>
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
                              <tr>
                                 <td style="padding:5px!important;"><input type="checkbox" class="minimal1 deletedbuttonD" name="select_allD" value=""></td>
                                 <td class="text-center"></td>
                                 <td class="text-center"></td>
                                 <td class="text-center"></td>
                                 <td class="text-center"></td>
                                 <td class="text-center"></td>
                                 <td class="text-center vl">
                                    <a href=""><button type="button" class="btn  btn-info btn-xs">APPROVE</button></a>
                                    <a href=""><button type="button" class="btn  btn-danger btn-xs">REJECT</button></a>
                                 </td>
                              </tr>
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
