@extends('theme.layouts.default')
@section('content')

<section class="content-header">
   <h5><label  class="control-label"><u>LEAD INFORMATION</u></label></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">CRM</a></li>
      <li class="active"><u>LEAD</u></li>
   </ol>
</section>
<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="row">
            <div class="col-md-2">
               <!-- <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="SEARCH" id="" name="">
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-info btn-flat" id="" name=""><span class="glyphicon glyphicon-search"></span></button>
                  </span>
               </div> -->
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-2">
               <a href="{{ route('lead.index') }}" class="btn btn-info btn-xs pull-right"  id="ram" name="">
               <span class="glyphicon glyphicon-forward"></span>&nbsp BACK TO LIST</a>
            </div>
         </div>
  @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
          <ul>
              <li>{!! \Session::get('success') !!}</li>
          </ul>
      </div>
  @endif

          <form method="post" action="{{ url('/lead/'.$leads->id) }}">
            {{csrf_field()}}
            {{method_field('PATCH')}}
         <div class="box">
            <div class="box-body">
               <div class="row">
                  <div class="col-md-3 {{ $errors->has('company_name') ? 'has-error' : '' }}">
                     <label  class="control-label">COMPANY NAME</label><span class="text-danger"><strong>*</strong></span>
                     <input class="form-control input-sm disabled-class"  disabled='disabled' type="text" placeholder="ENTER COMPANY NAME" id="company_name" name="company_name" value="{{
        (isset($leads->company_name)) ? $leads->company_name : old('company_name') }}">
              <span class="text-danger">{{ $errors->first('company_name') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('product') ? 'has-error' : '' }}">
                     <label  class="control-label">PRODUCT</label><span class="text-danger"><strong>*</strong></span>
                      <select class="form-control disabled-class" disabled='disabled' id="product"  name="product">
                        <option value="">CHOOSE PRODUCT</option>
                        @if(count($product)>0)
                          @foreach($product as $product_data)
                            @if (isset($leads->product) && $product_data->id == $leads->product )
                              <option value="{{ $product_data->id }}" selected>{{ $product_data->product_name }}</option>
                            @else
                              <option value="{{ $product_data->id }}" @if(old('product') == $product_data->id) {{ 'selected' }} @endif>{{ $product_data->product_name }}</option>
                            @endif
                          @endforeach
                        @else
                          <option value="">No Data Found.</option>
                        @endif
                      </select>
              <span class="text-danger">{{ $errors->first('product') }}</span>
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">CONTACT PERSON</label><span class="text-danger"><strong>*</strong></span>
                     <input class="form-control input-sm disabled-class"  disabled='disabled' type="text" placeholder="ENTER CONTACT PERSON" id="contact_person" name="contact_person" value="{{
        (isset($leads->contact_person)) ? $leads->contact_person : old('contact_person') }}">
                  </div>
                  <div class="col-md-3 {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                     <label  class="control-label">CONTACT NUMBER</label><span class="text-danger"><strong>*</strong></span>
                     <input class="form-control input-sm disabled-class" disabled='disabled' type="text" placeholder="ENTER CONTACT NUMBER" id="contact_number" name="contact_number" value="{{
        (isset($leads->contact_number)) ? $leads->contact_number : old('contact_number') }}">
              <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12"></div>
               </div>
               <div class="row">
                  <div class="col-md-3">
                     <label  class="control-label">EMAIL ID</label><span class="text-danger"><strong>*</strong></span>
                     <input class="form-control input-sm disabled-class" disabled='disabled' type="text" placeholder="ENTER EMAIL ID" id="email_id" name="email_id" value="{{
        (isset($leads->email_id)) ? $leads->email_id : old('email_id') }}">
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">INDUSTRY</label>
                      <select class="form-control disabled-class" disabled='disabled' id="industry"  name="industry">
                        <option value="">CHOOSE INDUSTRY</option>
                        @if(count($industry)>0)
                          @foreach($industry as $industry_data)
                            @if (isset($leads->industry) && $industry_data->id == $leads->industry )
                              <option value="{{ $industry_data->id }}" selected>{{ $industry_data->industry_name }}</option>
                            @else
                              <option value="{{ $industry_data->id }}" @if(old('industry') == $industry_data->id) {{ 'selected' }} @endif>{{ $industry_data->industry_name }}</option>
                            @endif
                          @endforeach
                        @else
                          <option value="">No Data.</option>
                        @endif
                      </select>
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">LEAD OWNER</label>
                      <select class="form-control disabled-class" disabled='disabled' id="lead_owner"  name="lead_owner">
                        <option value="">CHOOSE LEAD OWNER</option>
                        @if(count($user)>0)
                          @foreach($user as $user_data)
                            @if (isset($leads->lead_owner) && $user_data->id == $leads->lead_owner )
                              <option value="{{ $user_data->id }}" selected>{{ $user_data->name }}</option>
                            @else
                              <option value="{{ $user_data->id }}" @if(old('lead_owner') == $user_data->id) {{ 'selected' }} @endif>{{ $user_data->name }}</option>
                            @endif
                          @endforeach
                        @else
                          <option value="">No Data.</option>
                        @endif
                      </select>
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">LEAD SOURCE</label>
                      <select class="form-control disabled-class" disabled='disabled' id="lead_source"  name="lead_source">
                        <option value="">CHOOSE LEAD SOURCE</option>
                        @if(count($leadsource)>0)
                          @foreach($leadsource as $leadsource_data)
                            @if (isset($leads->lead_source) && $leadsource_data->id == $leads->lead_source )
                              <option value="{{ $leadsource_data->id }}" selected>{{ $leadsource_data->name }}</option>
                            @else
                              <option value="{{ $leadsource_data->id }}" @if(old('lead_source') == $leadsource_data->id) {{ 'selected' }} @endif>{{ $leadsource_data->name }}</option>
                            @endif
                          @endforeach
                        @else
                          <option value="">No Data.</option>
                        @endif
                      </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 {{ $errors->has('quantum') ? 'has-error' : '' }}">
                <label  class="control-label">QUANTUM</label>
                  <input class="form-control input-sm disabled-class" disabled='disabled' type="text" placeholder="ENTER QUANTUM" id="quantum" name="quantum" value="{{
        (isset($leads->quantum)) ? $leads->quantum : old('quantum') }}">
              <span class="text-danger">{{ $errors->first('quantum') }}</span>

                  </div>
                  <div class="col-md-3">
                <label  class="control-label">STATE</label>
                  <select class="form-control input-sm disabled-class" disabled='disabled' style="width: 100%;" id="state" name="state">
                      <option value="">PLEASE SELECT STATE</option>
                       <?php
                        $state_list = \App\Common\StateList::get_states();
                            ?>
                      @foreach($state_list as $state_code=>$state_ar)
                        <option value="{{$state_code}}" {{ isset($leads->state) && $leads->state == $state_code || old('state')==  $state_code? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                      @endforeach
                  </select>
                  </div>
                  <div class="col-md-3">
                    <label  class="control-label">DISCOM</label>
                  <input class="form-control input-sm disabled-class" type="text" disabled='disabled' placeholder="ENTER DISCOM" id="discom" name="discom" value="{{
        (isset($leads->discom)) ? $leads->discom : old('discom') }}">
                  </div>
                  <div class="col-md-3">
                  <label  class="control-label">VOLTAGE</label>
                  <select class="form-control input-sm disabled-class" disabled='disabled' style="width: 100%;" id="voltage" name="voltage">
                      <option value="">PLEASE SELECT</option>
                      <option value="11K" {{ isset($leads->voltage) && $leads->voltage == '11K' ||old('voltage')=='11K'? 'selected="selected"' : '' }}>11K</option>
                      <option value="22K" {{ isset($leads->voltage) && $leads->voltage == '22K' ||old('voltage')=='22K'? 'selected="selected"' : '' }}>22K</option>
                      <option value="33k" {{ isset($leads->voltage) && $leads->voltage == '33k' ||old('voltage')=='33k'? 'selected="selected"' : '' }}>33K</option>
                      <option value="66k" {{ isset($leads->voltage) && $leads->voltage == '66k' ||old('voltage')=='66k'? 'selected="selected"' : '' }}>66K</option>
                      <option value="132K" {{ isset($leads->voltage) && $leads->voltage == '132K' ||old('voltage')=='132K'? 'selected="selected"' : '' }}>132K</option>
                      <option value="220K" {{ isset($leads->voltage) && $leads->voltage == '220K' ||old('voltage')=='220K'? 'selected="selected"' : '' }}>220K</option>
                  </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                <label  class="control-label">REMARKS</label>
                  <input class="form-control input-sm disabled-class" disabled='disabled' type="text" placeholder="ENTER REMARKS" id="remarks" name="remarks" value="{{
        (isset($leads->remarks)) ? $leads->remarks : old('remarks') }}">
                  </div>
                </div>


               <div class="row">
                  <div class="col-md-2">
                     <label  class="control-label"><u>ADDRESS INFORMATION</u></label>
                  </div>
                  <div class="col-md-9"></div>
                  <div class="col-md-1 " style="margin-left:-14px;"><button type="button" class="btn  btn-info btn-xs">LOCATE MAP</button></div>
               </div>
               <hr>
               <div class="row">
                  <div class="col-md-3 {{ $errors->has('add_line1') ? 'has-error' : '' }}">
                     <label  class="control-label">LINE-1</label><span class="text-danger"><strong>*</strong></span>
                     <input class="form-control input-sm disabled-class" disabled='disabled' type="text" placeholder="ADDRESS1" id="add_line1" name="add_line1" value="{{
        (isset($leads->add_line1)) ? $leads->add_line1 : old('add_line1') }}">
               <span class="text-danger">{{ $errors->first('add_line1') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('add_lin2') ? 'has-error' : '' }}">
                     <label  class="control-label">LINE-2</label>
                     <input class="form-control input-sm disabled-class" disabled='disabled' type="text" placeholder="ADDRESS2" id="add_lin2" name="add_lin2" value="{{
        (isset($leads->add_lin2)) ? $leads->add_lin2 : old('add_lin2') }}">
               <span class="text-danger">{{ $errors->first('add_lin2') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('add_country') ? 'has-error' : '' }}">
                     <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
                     <select class="form-control input-sm disabled-class" disabled='disabled' style="width: 100%;" id="add_country" name="add_country">
                        <option value="INDIA" {{ isset($leads->add_country) &&  $leads->add_country == "INDIA" ||old('add_country')=="INDIA"? 'selected="selected"' : '' }}>INDIA</option>
                   </select>
               <span class="text-danger">{{ $errors->first('add_country') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('add_state') ? 'has-error' : '' }}">
                     <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
                      <select class="form-control input-sm disabled-class" disabled='disabled' style="width: 100%;" id="add_state" name="add_state">
                          <option value="">PLEASE SELECT STATE</option>
                           <?php
                            $state_list = \App\Common\StateList::get_states();
                                ?>
                          @foreach($state_list as $state_code=>$state_ar)
                            <option value="{{$state_code}}" {{ isset($leads->add_state) &&  $leads->add_state == $state_code ||old('add_state')==$state_code? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                          @endforeach
                      </select>
               <span class="text-danger">{{ $errors->first('add_state') }}</span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12"></div>
               </div>
               <div class="row">
                  <div class="col-md-3 {{ $errors->has('add_city') ? 'has-error' : '' }}">
                     <label  class="control-label">CITY</label><span class="text-danger"><strong>*</strong></span>
                      <input class="form-control input-sm disabled-class" disabled='disabled' type="text" placeholder="ENTER CITY" id="add_city" name="add_city" value="{{
        (isset($leads->add_city)) ? $leads->add_city : old('add_city') }}">
               <span class="text-danger">{{ $errors->first('add_city') }}</span>
                  </div>
                  <div class="col-md-3 {{ $errors->has('add_pincode') ? 'has-error' : '' }}">
                     <label  class="control-label">PIN CODE</label><span class="text-danger"><strong>*</strong></span>
                     <input class="form-control input-sm disabled-class" onkeypress="return IsNumeric1(event);" disabled='disabled' type="text" placeholder="ENTER PIN CODE" id="add_pincode" name="add_pincode" value="{{
        (isset($leads->add_pincode)) ? $leads->add_pincode : old('add_pincode') }}">
                <span id="error_areaa1" style="color: Red; display: none">* Input digits (0 - 9)</span>
                <span class="text-danger">{{ $errors->first('add_pincode') }}</span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-5"></div>
                <div class="col-md-1"  id="enable_edit"><a href="#" class="btn btn-block btn-info btn-xs enable_edit" name="">EDIT</a></div>
               <div class="col-md-1 saveButton" style="display: none;"><button type="submit" class="btn btn-block btn-success btn-xs">UPDATE</button></div>
               @if(!isset($getcrn_info))
               <div class="col-md-1"><a href="" data-toggle="modal" data-target="#ConvertData{{ $leads->id }}" class="btn btn-block btn-default btn-xs" name="" id="convert-disabled">CONVERT</a></div>
               @else
               <div class="col-md-2"><a disabled class="btn btn-default btn-xs" name="">CONVERTED</a></div>
               @endif
               <div class="col-md-3"></div>
            </div>
            <div class="row">&nbsp;</div>
         </div>
       </form>
       <!--*************** Converted Model Start ***************-->
        <div id="ConvertData{{ $leads
       ->id }}" class="modal fade" role="dialog">
           <form method="GET"  action="{{url('lead/genearet/'.$leads->id.'/crn/'.$leads->product)}}">
            {{ csrf_field() }}
           <div class="modal-dialog modal-confirm">
             <div class="modal-content">
               <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                 <h4 class="modal-title text-center">ARE YOU SURE?</h4>
               </div>
               <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                 <p style="font-size: 18px;font-weight: 400;color:black!important; text-align:center;">Are you sure you want to convert lead?</p>
               </div>
               <div class="modal-footer">
                 <button type="submit" class="btn btn-danger">Yes</button>
                 <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
               </div>
             </div>
           </div>
           </form>
         </div>
         <!--*************** Converted Model End***************-->
         <div class="row">
            <div class="col-md-1"><label  class="control-label"><u>ACTIVITIES</u></label></div>
            <div class="col-md-10"></div>
            <div class="col-md-1" style="margin-left:-13px;">
               <button type="button" class="btn  btn-info btn-xs" data-toggle="modal" data-target="#myModal">   <span class="glyphicon glyphicon-plus"> </span>&nbspNEW TASK</button>
            </div>
         </div>
         <div class="box " >
            <!---------------------------->
            <div class="box-body table-responsive">
               <table class="table table-bordered text-center">
                  <thead>
                     <tr>
                        <th>SR.NO.</th>
                        <th>SUBJECT</th>
                        <th>STATUS</th>
                        <th>DUE DATE</th>
                        <th>ACTIVITY OWNER</th>
                        <th>MODIFIED TIME</th>
                        <th>ACTION</th>
                     </tr>
                  </thead>
                  <tbody>
                  @php $i=1; @endphp
                  @if (count($tasks) > 0)
                     @foreach ($tasks as $k=>$task)
                       <tr>
                        <td>{{$i}}</td>
                          <td>{{$task->subject}}</td>
                          <td>{{$task->status}}</td>
                          <td>{{date('d/m/Y',strtotime($task->due_date))}}</td>
                          <td>{{@$task->user->name}}</td>
                          <td>{{date('d/m/Y',strtotime($task->created_at))}}</td>
                          <td>
                            <a href="" data-toggle="modal" data-target="#myModal{{ $task->id }}"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="" data-toggle="modal" data-target="#deleteData{{ $task->id }}"><span class="glyphicon glyphicon-trash" style="color: red;"></span></a>
                          </td>
                          <div id="deleteData{{ $task
                         ->id }}" class="modal fade" role="dialog">
                             <form method="POST"  action="{{url('task-delete/'.$task->id)}}">
                              {{ csrf_field() }}
                              {{ method_field('GET') }}
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

                           <!-- for Update Task  -->
                           <div class="modal fade" id="myModal{{ $task
                         ->id }}" role="dialog">
                           <div class="modal-dialog">
                           <!-- Modal content-->
                           <form method="post" action="{{url('task-update/'.$task
                         ->id)}}">
                            {{csrf_field()}}
                           <div class="modal-content">
                           <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">EDIT TASK</h4>
                           </div>
                           <div class="modal-body">
                           <div class="row">
                           <div class="col-md-6">
                           <label  class="control-label">SUBJECT</label>
                           <input class="form-control input-sm" type="text" placeholder="ENTER SUBJECT" id="subject" name="subject" value="{{$task->subject}}" required="required">
                           </div>
                           <div class="col-md-6">
                           <label  class="control-label">STATUS</label>
                           <select class="form-control input-sm" style="width: 100%;" id="status" name="status" required="required">
                           <option value="">SELECT STATUS</option>
                           <option value="COMPLETED" @if($task->status == 'COMPLETED') {{ 'selected' }} @endif>COMPLETED</option>
                           <option value="WORKING"  @if($task->status == 'WORKING') {{ 'selected' }} @endif>WORKING</option>
                           <option value="NON-WORKING"  @if($task->status == 'NON-WORKING') {{ 'selected' }} @endif>NON-WORKING</option>
                           </select>
                           </div>
                           </div>
                           <div class="row">
                           <div class="col-md-6">
                           <label  class="control-label">DUE DATE</label>
                           <div class="input-group date">
                           <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" class="form-control pull-right input-sm" id="datepicker" name="due_date" value="{{date('d/m/Y',strtotime($task->due_date))}}" placeholder="DD/MM/YYYY" required="required">
                           </div>
                           </div>
                           <div class="col-md-6">
                           <label  class="control-label">OWNER</label>
                              <select class="form-control"  id="owner"  name="owner" required="required">
                                <option value="">CHOOSE OWNER</option>
                                @if(count($user)>0)
                                  @foreach($user as $user_data)
                                      <option value="{{ $user_data->id }}" @if($task->owner == $user_data->id) {{ 'selected' }} @endif>{{ $user_data->name }}</option>
                                  @endforeach
                                @else
                                  <option value="">No Data.</option>
                                @endif
                              </select>
                           </div>
                           </div>
                           </div>
                           <div class="modal-footer">
                           <div class="row">
                           <div class="col-md-4"></div>
                           <div class="col-md-2"><button type="submit" class="btn btn-block btn-success btn-xs" id="" name="">UPDATE</button></div>
                           <div class="col-md-2"><button type="button" data-dismiss="modal" class="btn btn-block btn-danger btn-xs" id="" name="">CANCEL</button></div>
                           <div class="col-md-4"></div>
                           </div>
                           </div>
                           </div>
                          </form>
                           </div>
                           </div>

                       </tr>

                        @php $i++; @endphp
                    @endforeach
                  @else
                    <tr>
                        <td colspan="7" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
                    </tr>
                  @endif
                  </tbody>
               </table>
                {{ $tasks->links() }}
            </div>
         </div>

        <div class="row">
            <div class="col-md-1"><label  class="control-label"><u>PRODUCT</u></label></div>
            <div class="col-md-9"></div>
            <div class="col-md-2 pull-right" style="margin-right:-54px;" >
               <button type="button" class="btn  btn-info btn-xs" data-toggle="modal" data-target="#myModalProduct"> <span class="glyphicon glyphicon-plus"> </span>&nbsp NEW PRODUCT</button>
            </div>
         </div>
         <div class="box">
            <div class="box-body table-responsive">
               <table class="table table-bordered text-center">
                  <thead>
                     <tr>
                        <th>SR.NO.</th>
                        <th>PRODUCT</th>
                        <th>ACTION</th>
                     </tr>
                  </thead>
                  <tbody>
                  @php $i=1; @endphp
                  @if (count($leadProduct) > 0)
                     @foreach ($leadProduct as $k=>$leadProduct)
                       <tr>
                        <td>{{$i}}</td>
                          <td>{{@$leadProduct->product_name->product_name}}</td>
                          <td>
                            @if($leadProduct->product_converted!=1)
                            <a href="{{url('lead/genearet/'.$leads->id.'/crn/'.$leadProduct->product_id)}}" class="btn  btn-default btn-xs" name="">CONVERT</a>&nbsp;&nbsp;

                            <a href="" data-toggle="modal" data-target="#deleteData{{ $leadProduct->id }}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" style="color: red;"></span>DELETE</a>
                            @else
                              <a  class="btn  btn-default btn-xs" disabled name="">CONVERTED</a>
                            @endif
                          </td>
                          <div id="deleteData{{ $leadProduct
                         ->id }}" class="modal fade" role="dialog">
                             <form method="POST"  action="{{url('leadproduct-delete/'.$leadProduct->id)}}">
                              {{ csrf_field() }}
                              {{ method_field('GET') }}
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
                        <td colspan="7" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
                    </tr>
                  @endif
                  </tbody>
               </table>
                {{ $tasks->links() }}
            </div>
         </div>
         <div class="row">
            <div class="col-md-1"><label  class="control-label"><u>EMAILS</u></label></div>
            <div class="col-md-10"></div>
            <div class="col-md-1" style="margin-left:-10px;">
               <button type="button" class="btn  btn-info btn-xs" data-toggle="modal" data-target="#myModal1">SEND EMAIL</button>
            </div>
         </div>
         <div class="box ">
              <div class="box-body table-responsive">
               <table class="table table-bordered text-center">
                  <thead>
                     <tr>
                        <th>SR.NO.</th>
                        <th>RECIVED BY</th>
                        <th>SUBJECT</th>
                        <th>DATE</th>
                        <th>SENT BY</th>
                        <th>ACTION</th>
                     </tr>
                  </thead>
                  <tbody>
                  @php $i=1; @endphp
                  @if (count($leadEmail) > 0)
                     @foreach ($leadEmail as $k=>$leadEmails)
                       <tr>
                        <td>{{$i}}</td>
                        <td>{{$leadEmails->recieved_by}}</td>
                        <td>{{$leadEmails->subject}}</td>
                        <td>{{date('d/m/Y',strtotime($leadEmails->created_at))}}</td>
                        <td>{{$leadEmails->send_by}}</td>
                          <td>
                            <a href="" data-toggle="modal" data-target="#deleteData{{ $leadEmails->id }}"><span class="glyphicon glyphicon-trash" style="color: red;"></span></a>
                          </td>
                          <div id="deleteData{{ $leadEmails
                         ->id }}" class="modal fade" role="dialog">
                             <form method="POST"  action="{{url('lead-email-delete/'.$leadEmails->id)}}">
                              {{ csrf_field() }}
                              {{ method_field('GET') }}
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
                        <td colspan="6" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
                    </tr>
                  @endif
                  </tbody>
               </table>
                {{ $leadEmail->links() }}
            </div>
         </div>
         <!---modal----------------------------->
         <div class="modal fade" id="myModalProduct" role="dialog">
         <div class="modal-dialog">
         <!-- Modal content-->
         <form method="post" action="{{url('product-lead')}}">
          {{csrf_field()}}
         <div class="modal-content">
         <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">ADD PRODUCT</h4>
         </div>
        <input class="form-control input-sm" type="hidden" placeholder="ENTER" id="lead_id" name="lead_id" value="{{
        (isset($leads->id)) ? $leads->id : '' }}">

         <div class="modal-body">
         <div class="row">
         <div class="col-md-6">
         <label  class="control-label">PRODUCT</label>
            <select class="form-control"  id="product_id"  name="product_id" required="required">
              <option value="">CHOOSE PRODUCT</option>
                  @if(count($product)>0)
                    @foreach($product as $product_data)
                    @if(!in_array($product_data->id,$lead_keys) && $product_data->id!=$leads->product)
                      <option value="{{ $product_data->id }}" @if(old('product_id') == $product_data->id) {{ 'selected' }} @endif>{{ $product_data->product_name }}</option>
                    @endif
                    @endforeach
                  @else
                    <option value="">No Data.</option>
                  @endif
            </select>
         </div>
         </div>
         </div>
         <div class="modal-footer">
         <div class="row">
         <div class="col-md-4"></div>
         <div class="col-md-2"><button type="submit" class="btn btn-block btn-info btn-xs" id="" name="">SAVE</button></div>
         <div class="col-md-2"><button type="button" data-dismiss="modal" class="btn btn-block btn-danger btn-xs" id="" name="">CANCEL</button></div>
         <div class="col-md-4"></div>
         </div>
         </div>
         </div>
        </form>
         </div>
         </div>

         <div class="container">
         <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
         <!-- Modal content-->
         <form method="post" action="{{url('task-lead')}}">
          {{csrf_field()}}
         <div class="modal-content">
         <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">CREATE TASK</h4>
         <input class="form-control input-sm" type="hidden" placeholder="ENTER" id="lead_id" name="lead_id" value="{{
        (isset($leads->id)) ? $leads->id : '' }}">
         </div>
         <div class="modal-body">
         <div class="row">
         <div class="col-md-6">
         <label  class="control-label">SUBJECT</label>
         <input class="form-control input-sm" type="text" placeholder="ENTER SUBJECT" id="subject" name="subject" required="required">
         </div>
         <div class="col-md-6">
         <label  class="control-label">STATUS</label>
         <select class="form-control input-sm" style="width: 100%;" id="status" name="status" required="required">
         <option value="">SELECT STATUS</option>
         <option value="COMPLETED">COMPLETED</option>
         <option value="WORKING">WORKING</option>
         <option value="NON-WORKING">NON-WORKING</option>
         </select>
         </div>
         </div>
         <div class="row">
         <div class="col-md-6">
         <label  class="control-label">DUE DATE</label>
         <div class="input-group date">
         <div class="input-group-addon">
         <i class="fa fa-calendar"></i>
         </div>
         <input type="text" class="form-control pull-right input-sm" id="datetimepicker1" name="due_date" placeholder="DD/MM/YYYY" required="required">
         </div>
         </div>
         <div class="col-md-6">
         <label  class="control-label">OWNER</label>
            <select class="form-control"  id="owner"  name="owner" required="required">
              <option value="">CHOOSE OWNER</option>
              @if(count($user)>0)
                @foreach($user as $user_data)
                    <option value="{{ $user_data->id }}" @if(old('lead_owner') == $user_data->id) {{ 'selected' }} @endif>{{ $user_data->name }}</option>
                @endforeach
              @else
                <option value="">No Data.</option>
              @endif
            </select>
         </div>
         </div>
         </div>
         <div class="modal-footer">
         <div class="row">
         <div class="col-md-4"></div>
         <div class="col-md-2"><button type="submit" class="btn btn-block btn-info btn-xs" id="" name="">SAVE</button></div>
         <div class="col-md-2"><button type="button" data-dismiss="modal" class="btn btn-block btn-danger btn-xs" id="" name="">CANCEL</button></div>
         <div class="col-md-4"></div>
         </div>
         </div>
         </div>
        </form>
         </div>
         </div>

         <!---------------new table closed-->
         <div class="container">
          <form method="post" action="{{url('lead-email-add')}}" enctype="multipart/form-data">
         <div class="modal fade" id="myModal1" role="dialog">
          {{csrf_field()}}
         <div class="modal-dialog modal-lg">
         <div class="modal-content">
         <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">EMAILS</h4>
         </div>
         <div class="modal-body">
         <!-- /.col -->
         <div class="col-md-12">
         <div class="box box-primary">
         <div class="box-header with-border">
         <h3 class="box-title">Compose New EMAIL</h3>
         </div>
          <input class="form-control input-sm" type="hidden" placeholder="ENTER" id="lead_id" name="lead_id" value="{{
        (isset($leads->id)) ? $leads->id : '' }}">
         <!-- /.box-header -->
         <div class="box-body">
         <div class="form-group">
         <input type="email" class="form-control" placeholder="To:" name="recieved_by">
         </div>
         <div class="form-group">
         <input class="form-control" placeholder="Subject:" name="subject">
         </div>
         <div class="form-group">
         <textarea name="editor1" ></textarea>
         </div>
         <div class="form-group">
         <div class="btn btn-default btn-file">
         <i class="fa fa-paperclip"></i> Attachment
         <input type="file" name="attached">
         </div>
         <p class="help-block">Max. 32MB</p>
         </div>
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
         <div class="pull-right">
         <!-- <button type="button" class="btn btn-default" id="" name=""><i class="fa fa-pencil"></i> Draft</button> -->
         <button type="submit" class="btn btn-primary" id="" name=""><i class="fa fa-envelope-o"></i> Send</button>
         </div>
         <!-- <button type="reset" class="btn btn-default" id="" name=""><i class="fa fa-times"></i> Discard</button> -->
         </div>
         <!-- /.box-footer -->
         </div>
         <!-- /. box -->
         </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </div>
         </div>
         </div>
       </form>
         </div>
         <!-- /.row -->
      </div>
   </div>
</section>
<!-- /.content -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

      <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
      <script>
         CKEDITOR.replace( 'editor1' );
      </script>

      <script type="text/javascript">
                   //Date picker
           $('#datepicker').datepicker({
             autoclose: true
           })
      </script>
      <script type="text/javascript">
        $('.enable_edit').click(function(){
             $('#enable_edit').hide();
             $('.disabled-class').removeAttr("disabled");
             $('.saveButton').show();
              $("#convert-disabled").addClass('disabled').removeAttr("href"); 
             return false;
           });
      </script>
      <script>
      var specialKeys = new Array();
      specialKeys.push(8); //Backspace
      function IsNumeric1(e) {
         var keyCode = e.which ? e.which : e.keyCode
         var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
         document.getElementById("error_areaa1").style.display = ret ? "none" : "inline";
         return ret;
      }
      </script>
      <script>
      $(function() {
  $('#datetimepicker1').datepicker({
    language: 'pt-BR'
  });
});

      </script>
@endsection
