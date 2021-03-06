@extends('theme.layouts.default')
@section('content')

<section class="content-header">
    <h5><label  class="control-label"><u>VIEW EMPLOYEE</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
        <li><a href="#"><u>VIEW EMPLOYEE</u></a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href="{{ route('employee') }}" class="btn btn-info btn-xs pull-right mt7"  id="ram" name="">
           <span class="glyphicon glyphicon-forward"></span>&nbsp BACK TO LIST</a>
          </div>
          </div>

<form method="post" name="" id="">
<div class="box mt3">
  <div class="box-body">
  <div class="row">
      <div class="col-md-3">
     <label  class="control-label">EMPLOYEE</label><span class="text-danger"><strong>*</strong></span>
       <input class="form-control input-sm" type="text" name="name" id="name"  disabled="disabled" name="name" value="{{ $officialstData->name }}">
    </div>
  <div class="col-md-3">
    <label  class="control-label">EMPLOYEE ID</label><span class="text-danger"><strong>*</strong></span>
  <input class="form-control input-sm" type="text"  name="employee_id" id="employee_id"  disabled="disabled" name="employee_idemployee_id" value="{{ $officialstData->employee_id }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">DESIGNATION</label><span class="text-danger"><strong>*</strong></span>
  <input class="form-control input-sm" type="text" name="designation" id="designation"  disabled="disabled" name="designation" value="{{ $officialstData->designation }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">EMAIL ID</label><span class="text-danger"><strong>*</strong></span>
  <input class="form-control input-sm" type="text" name="email" id="email"  disabled="disabled" name="email" value="{{ $officialstData->email }}">
  </div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CONTACT NUMBER</label><span class="text-danger"><strong>*</strong></span>
     <input class="form-control input-sm" type="text" name="contact_number" id="contact_number"  disabled="disabled" name="contact_number" value="{{ $officialstData->contact_number }}">
  </div>
<div class="col-md-3">
  <label  class="control-label">TELEPHONE NUMBER</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm" type="text" name="telephone_number" id="telephone_number"  disabled="disabled" name="telephone_number" value="{{ $officialstData->telephone_number }}">
</div>
<div class="col-md-3">
  <label  class="control-label">USER NAME</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm" type="text" name="username" id="username"  disabled="disabled" name="username" value="{{ $officialstData->username }}">
</div>

<div class="col-md-3">
  <label  class="control-label">DEPARTMENT NAME</label><span class="text-danger"><strong>*</strong></span>
   <select class="form-control valid" disabled="disabled" name="department_id" id="department_id" value="">
              <option value='0'>Please Select Department</option>
              @foreach($department as $departmentuser)
                <option value="{{$departmentuser->id}}" {{isset($officialstData) && $officialstData->department_id == $departmentuser->id ? 'selected="selected"' : ''}}>{{$departmentuser->depatment_name}}</option>
              @endForeach
                </select>
</div>
<!-- <div class="col-md-3">
  <label  class="control-label">NEW PASSWORD</label>
<input class="form-control input-sm" typpassworde="text" name="password" id="password" readonly name="password" value="{{ $officialstData->password }}">
</div> -->
</div>
<div class="row">
   <!--  <div class="col-md-3">
   <label  class="control-label">CONFIRM PASSWORD</label>
     <input class="form-control input-sm" type="text" name="confirmed" id="confirmed" readonly name="confirmed" value="{{ $officialstData->confirmed }}">
  </div> -->

<div class="col-md-3">
  <label  class="control-label">ROLE</label><span class="text-danger"><strong>*</strong></span>
   <input class="form-control input-sm" type="text" name="role_idrole_id" id="role_id"  disabled="disabled" name="role_id" value="{{ @$officialstData->rolename->name }}">
</div>
</div>
</div>
</div>
<h5><label  class="control-label"><u>COMMUNICATION ADDRESS<u></label></h5>
<div class="box">
  <div class="box-body">
  <div class="row">
      <div class="col-md-3">
     <label  class="control-label">LINE1</label><span class="text-danger"><strong>*</strong></span>
       <input class="form-control input-sm" type="text" name="line1 " id=" line1"  disabled="disabled" name="line1" value="{{ $officialstData->line1 }}">
    </div>
  <div class="col-md-3">
    <label  class="control-label">LINE2</label><span class="text-danger"><strong>*</strong></span>
  <input class="form-control input-sm" type="text" name="line2" id="line2"  disabled="disabled" name="line2" value="{{ $officialstData->line2 }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
    <input class="form-control input-sm" type="text" name="country" id="country"  disabled="disabled" name="country" value="{{ $officialstData->country }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
     <select class="form-control valid" disabled="disabled" name="state" id="state" value="">                     
         <?php
       $state_list = \App\Common\StateList::get_states();
         ?>
        @foreach($state_list as $state_code=>$state_ar)
                <option value="{{$state_code}}" {{ isset($officialstData) && $officialstData->state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>                                
               @endforeach
            </select>
  </div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CITY/TOWN</label><span class="text-danger"><strong>*</strong></span>
   <input class="form-control input-sm" type="text" name="line2" id="line2"  disabled="disabled" name="line2" value="{{ $officialstData->line2 }}">
  </div>
<div class="col-md-3">
  <label  class="control-label">PIN CODE</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm" type="text" name="pin_code" id="pin_code"  disabled="disabled" name="pin_code" value="{{ $officialstData->pin_code }}">
</div>
<div class="col-md-3">
  <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm" type="text" name="comm_mob" id="comm_mob"  disabled="disabled" name="comm_mob" value="{{ $officialstData->comm_mob }}">
</div>
<div class="col-md-3">
  <label  class="control-label">TELEPHONE NUMBER</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm" type="text" name="comm_telephone" id="comm_telephone"  disabled="disabled" name="comm_telephone" value="{{ $officialstData->comm_telephone }}">
</div>
</div>
</div>
</div>

</form>
    </section>
    @endsection