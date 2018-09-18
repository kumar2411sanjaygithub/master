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
            <div class="box-body box">
              <div class="row">
                <div class="col-md-3">
                  <label  class="control-label">DEPARTMENT NAME</label>
                   <input class="form-control input-sm" type="text" id="depatment_name" name="depatment_name"value="{{ $departmentData->depatment_name }}">
                </div>
                <div class="col-md-3">
                  <label  class="control-label">DESCRIPTION</label>
                  <input class="form-control input-sm" type="text" id="description" name="description" value="{{ $departmentData->description }}">
                </div>
                <div class="col-md-3">
                  <br>
                  <button type="submit" class="btn btn-info btn-xs mt3" id="" name="">UPDATE</button>
                  <a href="{{ route('departments') }}"><input type="button" class="btn btn-danger btn-xs mt3" value="Cancel"></a>
                </div>
              </div>
            </div>
          </form>
      </section>
  <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
@endsection
