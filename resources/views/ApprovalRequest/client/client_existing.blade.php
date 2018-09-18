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

                           <div class="box">
                              <div class="box-body">
                                 <div class="row">
                                    <div class="col-md-2"><label  class="control-label"> CLIENT DETAILS</label></div>
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
                                          
                                              @isset($clientData)
                                          <?php
                                          $i=1;
                                           $input_lebels = \App\Common\Languages\ManageClientLang::input_labels();
                                          ?>
                                          @foreach ($clientData as $key => $value)
                                          <tr>
                                             
                                             
                                               <td class="text-center">{{ $i }}</td>
                                               <td class="text-center">{{ $input_lebels[$value->attribute_name]}}</td>
                                               <td class="text-center">
                                                @if(in_array($value->old_att_value,$state_data))
                                                  <?php
                                                  $state_list = \App\Common\StateList::get_states();
                                                  ?>
                                                  @foreach($state_list as $state_code=>$state_ar)
                                                    @if($state_code==$value->old_att_value)
                                                      {{$state_ar['name']}}
                                                   @endif
                                                  @endforeach
                                                @else
                                                  {{ $value->old_att_value }}
                                                @endif
                                              </td>
                                               <td class="text-center">
                                                @if(in_array($value->updated_attribute_value,$state_data))
                                                  <?php
                                                  $state_list = \App\Common\StateList::get_states();
                                                  ?>
                                                  @foreach($state_list as $state_code=>$state_ar)
                                                    @if($state_code==$value->updated_attribute_value)
                                                      {{$state_ar['name']}}
                                                   @endif
                                                  @endforeach
                                                @else
                                                  {{ $value->updated_attribute_value }}
                                                @endif

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