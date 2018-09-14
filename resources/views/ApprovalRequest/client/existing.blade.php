@extends('theme.layouts.default')
@section('content')
<section class="content-header">
               <h5><label  class="control-label">APPROVE EXISTING CLIENT REQUEST</label></h5>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
                  <li><a href="#">APPROVE REQUEST</a></li>
                  <li><a href="active">CLIENT</a></li>
                  <li><a href="active">EXISTING</a></li>
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
                     <div class="row">
                        <div class="col-md-12">
                           <div class="input-group input-group-sm">
                              <input type="text" class="form-control" placeholder="SEARCH CLIENT.......................">
                              <span class="input-group-btn">
                              <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="row">&nbsp;</div>
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
                                    <div class="col-md-2"><label  class="control-label">BANK DETAILS</label></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right"><input type="checkbox"  class="minimal">&nbsp&nbsp<label  class="control-label">APPROVE ALL</label>
                                       &nbsp&nbsp&nbsp<input type="checkbox" class="minimal">&nbsp&nbsp<label  class="control-label"  >REJECT ALL</label>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th><input type="checkbox"  class="minimal"></th>
                                             <th>BANK NAME</th>
                                             <th>BRANCH NAME</th>
                                             <th>ACCOUNT NUMBER</th>
                                             <th>IFSC CODE</th>
                                             <th>VIRTUAL ACCOUNT NUMBER</th>
                                             <th>ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @isset($Addbankdata)
                                          <?php
                                          $i=1;
                                          ?>
                                          @foreach ($Addbankdata as $key => $value)
                                          <tr>
                                             
                                             
                                               <td class="text-center">{{ $i }}</td>
                                               <td class="text-center">{{ $value->bank_name }}</td>
                                               <td class="text-center">{{ $value->branch_name }}</td>
                                               <td class="text-center">{{ $value->account_number }}</td>
                                               <td class="text-center">{{ $value->ifsc}}</td>
                                               <td class="text-center">{{ $value->virtual_account_number }}</td>
                                             <td><a href="/add/{{ $value->id }}/approved/bank_temp"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href="/add/{{ $value->id }}/rejected/bank_temp"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
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
                                    <div class="col-md-2"><label  class="control-label"> BANK DETAILS</label></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right"><input type="checkbox"  class="minimal">&nbsp&nbsp<label  class="control-label">APPROVE ALL</label>
                                       &nbsp&nbsp&nbsp<input type="checkbox" class="minimal">&nbsp&nbsp<label  class="control-label"  >REJECT ALL</label>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th><input type="checkbox"  class="minimal">Sr.no</th>
                                             
                                             <th>FIELD NAME</th>
                                             <th>CURRENT VALUE</th>
                                             <th>UPDATED VALUE</th>
                                             <th>ACTION</th>
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
                                             
                                             
                                               <td class="text-center">{{ $i }}</td>
                                               <td class="text-center">{{ $input_lebels[$value->attribute_name]}}</td>
                                               <td class="text-center">{{ $value->old_att_value }}</td>
                                               <td class="text-center">{{ $value->updated_attribute_value }}</td>
                                             <td><a href="/modified/{{ $value->id }}/approved"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href="/modified/{{ $value->id }}/rejected"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
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
                                    <div class="col-md-2"><label  class="control-label"> BANK DETAILS</label></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right"><input type="checkbox"  class="minimal">&nbsp&nbsp<label  class="control-label">APPROVE ALL</label>
                                       &nbsp&nbsp&nbsp<input type="checkbox" class="minimal">&nbsp&nbsp<label  class="control-label"  >REJECT ALL</label>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                              <th><input type="checkbox"  class="minimal"></th>
                                             <th>BANK NAME</th>
                                             <th>BRANCH NAME</th>
                                             <th>ACCOUNT NUMBER</th>
                                             <th>IFSC CODE</th>
                                             <th>VIRTUAL ACCOUNT NUMBER</th>
                                             <th>ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                         
                                           @isset($deletedbnkData)
                                             <?php
                                             $i=1;
                                             ?>
                                             @foreach ($deletedbnkData as $key => $value)

                                             <tr>
                                               <td class="text-center">{{ $i }}</td>

                                               <td class="text-center">{{ $value->bank_name }}</td>
                                               <td class="text-center">{{ $value->branch_name }}</td>
                                               <td class="text-center">{{ $value->account_number }}</td>
                                               <td class="text-center">{{ $value->ifsc }}</td>
                                               <td class="text-center">{{ $value->virtual_account_number }}</td>
                                               <td class="text-center">
                                                   
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
            @endsection