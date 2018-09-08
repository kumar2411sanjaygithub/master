@extends('theme.layouts.default')
@section('content')
<section class="content-header">
<div class="">Edit Departments</div>
 </section>
 <section class="content">
  <div class="clearfix"></div>
          <!-- <br> -->
          <!-- success msg -->
          @if(session()->has('updatemsg'))
            <div class="alert alert-success mt10">
                {{ session()->get('updatemsg') }}
            </div>
          @endif
          <!-- query validater     -->
          <form method="post" action="/manageofficials/updatedepartmentdata/{{$departmentData->id}}'">
            {{ csrf_field() }}
<div class="box">
  <div class="box-body">
  <div class="row">
      <div class="col-md-3">
     <label  class="control-label">DEPARTMENT NAME</label>
       <input class="form-control input-sm" type="text" id="depatment_name" name="depatment_name"value="{{ $departmentData->depatment_name }}">
      
    </div>
  <div class="col-md-3">
    <label  class="control-label">DESCRIPTION</label>
  <input class="form-control input-sm" type="text" id="description" name="description" value="{{ $departmentData->description }}">
  </div>
</div>
<div class="row">&nbsp;</div>
<div class="row">
   <div class="col-md-5"></div>
    <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs" id="" name="">UPDATE</button></div>
    <a href="{{ route('departments') }}"><input type="button" class="btn btn-block btn-danger btn-xs" value="Cancel" style="width: 6%;"></a>
  <div class="col-md-5"></div>
</div>

</div>
</div>
</form>
 </section>
@endsection