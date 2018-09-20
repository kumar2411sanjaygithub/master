@extends('theme.layouts.default')
@section('content')
<section class="content-header">
   <h5><label  class="control-label"><u>EDIT DEPARTMENT</u></label></h5>
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
                  <label  class="control-label">DEPARTMENT NAME<span class="text-danger"><strong>*</strong></span></label>
                   <input class="form-control input-sm" type="text" id="depatment_name" name="depatment_name"value="{{ $departmentData->depatment_name }}">
                </div>
                <div class="col-md-3">
                  <label  class="control-label">DESCRIPTION</label>
                  <input class="form-control input-sm" type="text" id="description" name="description" value="{{ $departmentData->description }}">
                </div>
                <div class="col-md-1" style="margin-top:16px;"><button class="btn btn-info btn-xs mt3" id="" name="">UPDATE</button></div>
                <div class="col-md-1" style="margin-top:16px;"><a href="{{ route('departments') }}"><input type="button" class="btn btn-danger btn-xs mt3" value="Cancel"></a>
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
