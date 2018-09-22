@extends('theme.layouts.default')
@section('content')
<section class="content-header">
               <h5><label  class="control-label"><u>APPROVE BANK DETAILS</u></label></h5>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
                  <li><a href="#">APPROVE REQUEST</a></li>
                  <li><a href="active">CLIENT</a></li>
                  <li><a href="active"><u>EXISTING</u></a></li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               @if (\Session::has('success'))
            <div class="alert alert-success mt10" >
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {!! \Session::get('success') !!}
            </div>
            @endif
               <div class="row">
                  <div class="col-xs-12">
                       <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">NEW</a></li>
                        <li><a data-toggle="tab" href="#menu1">MODIFIED</a></li>
                        <li><a data-toggle="tab" href="#menu2">DELETE</a></li>
                     </ul>
                     <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                           <div class="box">
                              <div class="box-body">
                                 <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right">
                                          <a href="{{url('client/existing')}}"><button type="button" class="btn btn-info btn-xs pull-right mr"><span class="glyphicon glyphicon-forward"></span>BACK TO LIST</button></a>
                                      <button type="button" class="btn  btn-info btn-xs" name="cdv4" id="cdv4">APPROVE ALL</button>
                                       &nbsp&nbsp&nbsp<button type="button" class="btn  btn-danger btn-xs mlt" name="cdn4" id="cdn4">REJECT ALL</button>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th class="chy " style="padding:5px!important;"><input type="checkbox"  class="minimal"></th>
                                             <th class="srno vl">SR.NO</th>
                                             <th class="vl">BANK NAME</th>
                                             <th class="vl">BRANCH NAME</th>
                                             <th class="vl">ACCOUNT NUMBER</th>
                                             <th class="vl">IFSC CODE</th>
                                             <th class="vl">VIRTUAL ACCOUNT NUMBER</th>
                                             <th class="act vl">ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @isset($Addbankdata)
                                          <?php
                                          $i=1;
                                          ?>
                                          @foreach ($Addbankdata as $key => $value)
                                          <tr>

                                               <td class="vl" style="padding:5px!important;"><input type="checkbox"  class="minimal"></td>
                                               <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $value->bank_name }}</td>
                                               <td class="text-center vl">{{ $value->branch_name }}</td>
                                               <td class="text-center vl">{{ $value->account_number }}</td>
                                               <td class="text-center vl">{{ $value->ifsc}}</td>
                                               <td class="text-center vl">{{ $value->virtual_account_number }}</td>
                                             <td class="vl"><a href="/add/{{ $value->id }}/approved/bank_temp"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href="/add/{{ $value->id }}/rejected/bank_temp"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
                                          </tr>
                                        <?php
                                       $i++;
                                       ?>
                                       @endforeach
                                       @endisset
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
                                    <div class="col-md-4 text-right"><button type="button" class="btn  btn-info btn-xs" name="cdq4" id="cdq4">APPROVE ALL</button>
                                       &nbsp&nbsp&nbsp<button type="button" class="btn  btn-danger btn-xs mlt" name="cdw4" id="cdw4">REJECT ALL</button>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th class="chy" style="padding:5px!important;"><input type="checkbox"  class="minimal"></th>
                                             <th class="srno vl">SR.NO</th>
                                             <th class="vl">FIELD NAME</th>
                                             <th class="vl">CURRENT VALUE</th>
                                             <th class="vl">UPDATED VALUE</th>
                                             <th class="act vl">ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>

                                              @isset($bankData)
                                          <?php
                                          $i=1;
                                           $input_lebels = \App\Common\Languages\ManageClientLang::input_labels();
                                          ?>
                                          @foreach ($bankData as $key => $value)
                                          <tr>

                                                <td class="vl" style="padding:5px!important;"><input type="checkbox"  class="minimal"></td>
                                               <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $input_lebels[$value->attribute_name]}}</td>
                                               <td class="text-center vl">{{ $value->old_att_value }}</td>
                                               <td class="text-center vl">{{ $value->updated_attribute_value }}</td>
                                             <td class="vl"><a href="/modified/{{ $value->id }}/approved"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href="/modified/{{ $value->id }}/rejected"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
                                          </tr>
                                        <?php
                                       $i++;
                                       ?>
                                       @endforeach
                                       @endisset


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
                                    <div class="col-md-4 text-right"><button type="button" class="btn  btn-info btn-xs">APPROVE ALL</button>
                                       &nbsp&nbsp&nbsp<button type="button" class="btn  btn-danger btn-xs mlt">REJECT ALL</button>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                              <th class="chy" style="padding:5px!important;"><input type="checkbox"  class="minimal"></th>
                                              <th class="srno vl">SR.NO</th>
                                             <th class="vl">BANK NAME</th>
                                             <th class="vl">BRANCH NAME</th>
                                             <th class="vl">ACCOUNT NUMBER</th>
                                             <th class="vl">IFSC CODE</th>
                                             <th class="vl">VIRTUAL ACCOUNT NUMBER</th>
                                             <th class="act vl">ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>

                                           @isset($deletedbnkData)
                                             <?php
                                             $i=1;
                                             ?>
                                             @foreach ($deletedbnkData as $key => $value)

                                             <tr>
                                               <td class="vl" style="padding:5px!important;"><input type="checkbox"  class="minimal"></td>
                                               <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $value->bank_name }}</td>
                                               <td class="text-center vl">{{ $value->branch_name }}</td>
                                               <td class="text-center vl">{{ $value->account_number }}</td>
                                               <td class="text-center vl">{{ $value->ifsc }}</td>
                                               <td class="text-center vl">{{ $value->virtual_account_number }}</td>
                                               <td class="text-center vl">

                                                        <a href="/deletebank/{{ $value->id }}/approved/bank"><button type="button" class="btn  btn-info btn-xs">Approve</button></a>

                                                        <a href="/deletebank/{{ $value->id }}/rejected/bank"><button type="button" class="btn  btn-danger btn-xs">Reject</button></a>

                                               </td>
                                             </tr>
                                          <?php
                                          $i++;
                                          ?>
                                          @endforeach
                                          @endisset

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
  <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
   <script>
   $(function () {
       $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
         checkboxClass: 'icheckbox_flat-blue',
         radioClass   : 'iradio_flat-blue'
     })
     //Red color scheme for iCheck
     $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
       checkboxClass: 'icheckbox_minimal-red',
       radioClass   : 'iradio_minimal-red'
     })
     //Flat red color scheme for iCheck
     $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
       checkboxClass: 'icheckbox_flat-blue',
       radioClass   : 'iradio_flat-blue'
     })

   });

   </script>
            @endsection
