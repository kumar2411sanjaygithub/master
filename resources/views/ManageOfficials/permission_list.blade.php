@extends('theme.layouts.default')
@section('content')
      <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5><label  class="control-label"><u>PERMISION LIST</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
        <li><a href="#">PERMISSION</a></li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
    @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
         <ul>
             <li>{!! \Session::get('success') !!}</li>
         </ul>
      </div>
    @endif
  <div class="row">
  <div class="col-xs-12">
<div class="box adddeportment box @if($errors->isEmpty())hidden @else  @endif">
  <div class="box-body">
  <form method="post" action="{{route('permissionlist.store')}}">
            {{ csrf_field() }}

  <div class="row">
      <div class="col-md-3 {{ $errors->has('permission_name') ? 'has-error' : '' }}">
         <label  class="control-label">PERMISSION NAME<span class="text-danger"><strong>*</strong></span></label>
         <input class="form-control input-sm" type="text" placeholder="ENTER PERMISSION NAME" name="permission_name" value="{{(isset($permissions->id)&& $permissions->permission_name)?$permissions->permission_name:old('permission_name')}}">
          <span class="text-danger">{{ $errors->first('permission_name') }}</span>
    </div>
  <div class="col-md-3 {{ $errors->has('slug') ? 'has-error' : '' }}">
     <label  class="control-label">SLAG</label>
     <input class="form-control input-sm" type="text" placeholder="ENTER SLAG" name="slug" value="{{(isset($permissions->id)&& $permissions->slug)?$permissions->slug:old('slug')}}">
      <span class="text-danger">{{ $errors->first('slug') }}</span>
  </div>
  <div class="col-md-3">
     <label  class="control-label">DESCRIPTION</label>
     <input class="form-control input-sm" type="text" placeholder="ENTER DESCRIPTION" name="description" value="{{(isset($permissions->id)&& $permissions->description)?$permissions->description:old('description')}}">
  </div>
<div class="col-md-1 mt3">
   <label  class="control-label"></label>
   <button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
 <div class="col-md-1" style="margin-top:21px;">
    <a href="{{ route('permissionlist.index') }}"><input type="button"  class="btn btn-danger btn-block  btn-xs pull-right"value="Cancel"></a>
</div>   
</div>
</form>
</div>
</div>
</div>
</div>

      <div class="row">
        <div class="col-md-12 mt7">
          <a href="#" class="btn btn-info btn-xs pull-right adddeportmentbtn @if($errors->isEmpty()) @else hidden @endif">
          <span class="glyphicon glyphicon-plus"> </span>&nbsp ADD PERMISSION</a>
        </div>
      </div>
      <div class="box">
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped table-hover text-center">
            <thead>
            <tr>
              <th class="srno">SR.NO</th>
              <th>PERMISSION NAME</th>
              <th>SLAG</th>
              <th>DESCRIPTION</th>
              <th>CREATED DATE</th>
              <th class="act1">ACTION</th>
            </tr>
            </thead>
            <tbody>
               @php $i=1; @endphp
               @if (count($permissions) > 0)
                  @foreach ($permissions as $k=>$permission)
                     <tr>
                       <td>{{$i}}</td>
                       <td>{{$permission->permission_name}}</td>
                       <td>{{$permission->slug}}</td>
                       <td>{{$permission->description}}</td>
                       <td>{{ date('d/m/Y',strtotime($permission->created_at))}}</td>
                       <td>
                        <a href="{{ route('permissionlist.edit',[$permission->id]) }}"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="" data-toggle="modal" data-target="#deleteData{{ $permission->id }}"><span class="glyphicon glyphicon-trash" style="color: red;"></span></a>

                       </td>
                      <div id="deleteData{{ $permission
                     ->id }}" class="modal fade" role="dialog">
                         <form method="POST"  action="{{url('permissionlist/'.$permission->id)}}">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                         <div class="modal-dialog modal-confirm">
                           <div class="modal-content">
                             <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                               <h4 class="modal-title text-center"></h4>
                             </div>
                             <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                               <p style="font-size: 18px;font-weight: 500;color:black!important;text-align:center;">Are you sure you want to delete this record?</p>
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
        </div>
        <!-- /.box-body -->
      </div>
<!--modal----------------------------->



<!--new table closed-->

      <!-- /.row -->

    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <!-- /.content -->
   <script type="text/javascript">
     setTimeout(function() {
       $('#successMessage').fadeOut('fast');
       }, 2000); // <-
   </script>
  <script>
    $(document).ready(function(){
      $(".adddeportmentbtn").click(function(){
        $(".adddeportment").removeClass("hidden");
        $(".adddeportmentbtn").hide();
      });
      $(".card").css("margin-bottom","1px");
    });
  </script>

  @endsection
