@extends('theme.layouts.default')
@section('content')

<section class="content-header">
    <h5><label  class="control-label"><u>VIEW EMPLOYEE</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
        <li><a href="active"><u>VIEW EMPLOYEE</u></a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
<form method="post" name="" id="">
<div class="box">
  <div class="box-body">
  <div class="row">
      <div class="col-md-3">
     <label  class="control-label">EMPLOYEE</label>
       <input class="form-control input-sm" type="text" name="employee" id="employee" readonly name="employee" value="{{ $officialstData->employee }}">
    </div>
  <div class="col-md-3">
    <label  class="control-label">EMPLOYEE ID</label>
  <input class="form-control input-sm" type="text"  name="employee_id" id="employee_id" readonly name="employee_idemployee_id" value="{{ $officialstData->employee_id }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">DESIGNATION</label>
  <input class="form-control input-sm" type="text" name="designation" id="designation" readonly name="designation" value="{{ $officialstData->designation }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">EMAIL ID</label>
  <input class="form-control input-sm" type="text" name="email" id="email" readonly name="email" value="{{ $officialstData->email }}">
  </div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CONTACT NUMBER</label>
     <input class="form-control input-sm" type="text" name="contact_number" id="contact_number" readonly name="contact_number" value="{{ $officialstData->contact_number }}">
  </div>
<div class="col-md-3">
  <label  class="control-label">TELEPHONE NUMBER</label>
<input class="form-control input-sm" type="text" name="telephone_number" id="telephone_number" readonly name="telephone_number" value="{{ $officialstData->telephone_number }}">
</div>
<div class="col-md-3">
  <label  class="control-label">USER NAME</label>
<input class="form-control input-sm" type="text" name="user_name" id="user_name" readonly name="user_name" value="{{ $officialstData->user_name }}">
</div>
<div class="col-md-3">
  <label  class="control-label">NEW PASSWORD</label>
<input class="form-control input-sm" typpassworde="text" name="password" id="password" readonly name="password" value="{{ $officialstData->password }}">
</div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CONFIRM PASSWORD</label>
     <input class="form-control input-sm" type="text" name="confirmed" id="confirmed" readonly name="confirmed" value="{{ $officialstData->confirmed }}">
  </div>
<div class="col-md-3">
  <label  class="control-label">DEPARTMENT NAME</label>
   <input class="form-control input-sm" type="text" name="department_id" id="department_id" readonly name="department_id" value="{{ $officialstData->department_id }}">
</div>
<div class="col-md-3">
  <label  class="control-label">ROLE</label>
   <input class="form-control input-sm" type="text" name="role_idrole_id" id="role_id" readonly name="role_id" value="{{ $officialstData->role_id }}">
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
       <input class="form-control input-sm" type="text" name="line1 " id=" line1" readonly name="line1" value="{{ $officialstData->line1 }}">
    </div>
  <div class="col-md-3">
    <label  class="control-label">LINE2</label>
  <input class="form-control input-sm" type="text" name="line2" id="line2" readonly name="line2" value="{{ $officialstData->line2 }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
    <input class="form-control input-sm" type="text" name="country" id="country" readonly name="country" value="{{ $officialstData->country }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
    <input class="form-control input-sm" type="text" name="state" id="state" readonly name="state" value="{{ $officialstData->state }}">
  </div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CITY/TOWN</label><span class="text-danger"><strong>*</strong></span>
   <input class="form-control input-sm" type="text" name="line2" id="line2" readonly name="line2" value="{{ $officialstData->line2 }}">
  </div>
<div class="col-md-3">
  <label  class="control-label">PIN CODE</label>
<input class="form-control input-sm" type="text" name="pin_code" id="pin_code" readonly name="pin_code" value="{{ $officialstData->pin_code }}">
</div>
<div class="col-md-3">
  <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm" type="text" name="comm_mob" id="comm_mob" readonly name="comm_mob" value="{{ $officialstData->comm_mob }}">
</div>
<div class="col-md-3">
  <label  class="control-label">TELEPHONE NUMBER</label>
<input class="form-control input-sm" type="text" name="comm_telephone" id="comm_telephone" readonly name="comm_telephone" value="{{ $officialstData->comm_telephone }}">
</div>
</div>
<div class="row">&nbsp;</div>
 <div class="row">
    <div class="col-md-5"></div>
     
     <div class="col-md-1"><a href="{{ route('employee') }}"><input type="button" class="btn btn-block btn-danger btn-xs" value="Back To Multiple View"></a></div>
   <div class="col-md-5"></div>
 </div>



</div>
</div>

</form>
    </section>
    @endsection