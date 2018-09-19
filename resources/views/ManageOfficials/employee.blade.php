@extends('theme.layouts.default')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5><label  class="control-label"><u>ADD EMPLOYEE</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
        <li><a href="active"><u>ADD EMPLOYEE</u></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
       @if(session()->has('message'))
            <div class="alert alert-success mt10">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('message') }}
            </div>
          @endif
          <!-- query validater     -->
          @if($errors->any())
           @foreach ($errors->all() as $error)
              <div class="alert alert-danger mt10">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{$error}}
              </div>
           @endforeach
          @endif

<form method="post" action="/manageofficials/saveofficialsdata">
  {{ csrf_field() }}
<div class="box">
  <div class="box-body">
  <div class="row">
      <div class="col-md-3">
     <label  class="control-label">EMPLOYEE</label>
       <input class="form-control input-sm valid" type="text" name="name" id="name" value="{{ old('name') }}">
    </div>
  <div class="col-md-3">
    <label  class="control-label">EMPLOYEE ID</label>
  <input class="form-control input-sm" type="text"  name="employee_id" id="employee_id" value="{{ old('employee_id') }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">DESIGNATION</label>
  <input class="form-control input-sm" type="text" name="designation" id="designation" value="{{ old('designation') }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">EMAIL ID</label>
  <input class="form-control input-sm" type="text" name="email" id="email" value="{{ old('email') }}">
  </div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CONTACT NUMBER</label>
     <input class="form-control input-sm" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}">
  </div>
<div class="col-md-3">
  <label  class="control-label">TELEPHONE NUMBER</label>
<input class="form-control input-sm" type="text" name="telephone_number" id="telephone_number" value="{{ old('telephone_number') }}">
</div>
<div class="col-md-3">
  <label  class="control-label">USER NAME</label>
<input class="form-control input-sm" type="text" name="username" id="username" value="{{ old('username') }}">
</div>
<div class="col-md-3">
  <label  class="control-label">NEW PASSWORD</label>
<input class="form-control input-sm" type="text" name="password" id="password" value="">
</div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CONFIRM PASSWORD</label>
     <input class="form-control input-sm" type="text" name="confirmed" id="confirmed" value="">
  </div>
<div class="col-md-3">
  <label  class="control-label">DEPARTMENT NAME</label>
  <select class="form-control input-sm" name="department_id" id="department_id">
         @foreach($department as $departmentuser)
        <option value="{{$departmentuser->id}}">{{$departmentuser->depatment_name}}</option>
          @endForeach
        </select>
        <div class="mda-form-control-line"></div>

   </div>
<div class="col-md-3">
  <label  class="control-label">ROLE</label>
  <select class="form-control input-sm" name="role_id" id="role_id" style="width: 100%;">
     @foreach($role as $roleuser)
        <option value="{{$roleuser->id}}">{{$roleuser->name}}</option>
          @endForeach
        </select>
        <div class="mda-form-control-line"></div>

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
       <input class="form-control input-sm" type="text" name="line1" id="line1" value="{{ old('line1') }}">
    </div>
  <div class="col-md-3">
    <label  class="control-label">LINE2</label>
  <input class="form-control input-sm" type="text" name="line2" id="line2" value="{{ old('line2') }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
    <select class="form-control input-sm select2" name="country" id="country" style="width: 100%;">
        <option selected="selected"> SELECT COUNTRY</option>
        <option>INDIA</option>

    </select>
  </div>
  <div class="col-md-3">
    <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
    <select class="form-control input-sm select2" name="state" id="state" style="width: 100%;">
        <option value="">SELECT STATE</option>
          <?php
          $state_list = \App\Common\StateList::get_states();
          ?>
          @foreach($state_list as $state_code=>$state_ar)
           <option value="{{$state_code}}" {{ isset($clientData) && $clientData->reg_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
          @endforeach

    </select>
  </div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CITY/TOWN</label><span class="text-danger"><strong>*</strong></span>
   <input class="form-control input-sm" type="text" name="city" id="city" value="{{ old('city') }}">
  </div>
<div class="col-md-3">
  <label  class="control-label">PIN CODE</label>
<input class="form-control input-sm" type="text" name="pin_code" id="pin_code" value="{{ old('pin_code') }}">
</div>
<div class="col-md-3">
  <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm" type="text" name="comm_mob" id="comm_mob" value="{{ old('comm_mob') }}">
</div>
<div class="col-md-3">
  <label  class="control-label">TELEPHONE NUMBER</label>
<input class="form-control input-sm" type="text" name="comm_telephone" id="comm_telephone" value="{{ old('comm_telephone') }}">
</div>
</div>
<div class="row">&nbsp;</div>
 <div class="row">
    <div class="col-md-12 text-center">
     <button type="submit" class="btn btn-info btn-xs" id="save_officials">SAVE</button>
     <a href="{{ route('employee') }}"><input type="button" class="btn btn-danger btn-xs" value="Cancel"></a>
   </div>
 </div>
</div>
</div>

</form>
    </section>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    {{ Html::script('js/employee/empvalidate.js') }}
  @endsection
