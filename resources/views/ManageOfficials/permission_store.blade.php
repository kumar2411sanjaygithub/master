@extends('theme.layouts.default')
@section('content')
      <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5><label  class="control-label"><u>{{ (@$permissions->id!='')?'EDIT PERMISSION':'ADD PERMISSION'}}</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
        <li><a href="{{ route('permissionlist.index') }}"><u>EDIT PERMISSION</u></a></li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
  <div class="row">
  <div class="col-xs-12">
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href="{{ route('permissionlist.index') }}" class="btn btn-info btn-xs pull-right mt7"  id="ram" name="">
           <span class="glyphicon glyphicon-forward"></span>&nbsp BACK TO LIST</a>
          </div>
          </div>

<div class="box mt3">
  <div class="box-body">
  <form method="post" action="{{ (@$permissions->id!='')?url('/permissionlist/'.$permissions->id):route('permissionlist.store')}}">
            {{ csrf_field() }}
            {{ (@$permissions->id!='')?method_field('PATCH'):method_field('POST')}}

  <div class="row">
      <div class="col-md-3 {{ $errors->has('permission_name') ? 'has-error' : '' }}">
         <label  class="control-label">PERMISSION NAME<span class="text-danger"><strong>*</strong></span></label>
         <input class="form-control input-sm" type="text" placeholder="ENTER PERMISSION NAME" name="permission_name" value="{{(isset($permissions->id)&& $permissions->permission_name)?$permissions->permission_name:old('permission_name')}}">
          <span class="text-danger">{{ $errors->first('permission_name') }}</span>
    </div>
  <div class="col-md-3 {{ $errors->has('slug') ? 'has-error' : '' }}">
     <label  class="control-label">SLUG</label>
     <input class="form-control input-sm" type="text" placeholder="ENTER SLAG" name="slug" value="{{(isset($permissions->id)&& $permissions->slug)?$permissions->slug:old('slug')}}">
      <span class="text-danger">{{ $errors->first('slug') }}</span>
  </div>
  <div class="col-md-3">
     <label  class="control-label">DESCRIPTION</label>
     <input class="form-control input-sm" type="text" placeholder="ENTER DESCRIPTION" name="description" value="{{(isset($permissions->id)&& $permissions->description)?$permissions->description:old('description')}}">
  </div>
   <div class="col-md-1">
   </div>
<div class="col-md-1"  style="margin-top:21px;">
   <button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button>
 </div>
  <div class="col-md-1" style="margin-top:21px;">
    <a href="{{ route('permissionlist.index') }}"><input type="button"  class="btn btn-danger btn-block  btn-xs pull-right"value="Cancel"></a>
</div> 
</div>
</form>
</div>
</div>


    </section>

      <!-- /.content -->
  @endsection
