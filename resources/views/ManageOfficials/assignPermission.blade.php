@extends('theme.layouts.default')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5><label  class="control-label"> <u>ASSIGN PERMISSION</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
        <li><a href="{{ route('roles.index') }}"><u>ROLE & PERMISSION</u></a></li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
<div class="box">
  <div class="box-header">
    @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
         <ul>
             <li>{!! \Session::get('success') !!}</li>
         </ul>
      </div>
    @endif
  </div>
  <form method="post" action="{{('/assignpermission/store')}}">
    {{csrf_field()}}
    <input type="hidden" name="get_role_id" value="{{$role_id}}">
  <div class="box-body table-responsive">
    <table class="table table-bordered text-center">
  <thead>
    <th class="vl">SR.NO</th>
    <th class="vl">PERMISSION NAME</th>
    <th class="vl">SLUG</th>
    <th>ADD </br><input type="checkbox" id="add-checkbox" class="minimal"></th>
    <th>VIEW </br><input type="checkbox" id="view-checkbox" class="minimal"></th>
    <th>EDIT </br><input type="checkbox" id="edit-checkbox"  class="minimal"></th>
    <th>DELETE </br><input type="checkbox" id="delete-checkbox" class="minimal"></th>
    <th>VERIFIER </br><input type="checkbox" id="verifier-checkbox" class="minimal"></th>
    <th>APPROVER </br><input type="checkbox" id="approver-checkbox" class="minimal"></th>
  </thead>
  <tbody>

  @php $i=1; @endphp
  @if (count($permission_list) > 0)
    @foreach ($permission_list as $k=>$permission)
    <tr>

      <td>{{$i}}</td>
      <td>{{$permission->permission_name}}</td>
      <td>{{$permission->slug}}</td>
      <td><input type="checkbox" class="minimal add-checkbox" name="get[{{$i}}][]" value="{{$permission->permission_name.'_add-'.$permission->id}}" @if(in_array($permission->id,$all_permission_id) && in_array($permission->permission_name.'_add',$permission_name)) checked="checked" @endif ></td>
      <td><input type="checkbox" class="minimal view-checkbox" name="get[{{$i}}][]" value="{{$permission->permission_name.'_view-'.$permission->id}}" @if(in_array($permission->id,$all_permission_id) && in_array($permission->permission_name.'_view',$permission_name)) checked="checked" @endif></td>
      <td><input type="checkbox" class="minimal edit-checkbox" name="get[{{$i}}][]" value="{{$permission->permission_name.'_edit-'.$permission->id}}" @if(in_array($permission->id,$all_permission_id) && in_array($permission->permission_name.'_edit',$permission_name)) checked="checked" @endif></td>
      <td><input type="checkbox" class="minimal delete-checkbox" name="get[{{$i}}][]" value="{{$permission->permission_name.'_delete-'.$permission->id}}" @if(in_array($permission->id,$all_permission_id) && in_array($permission->permission_name.'_delete',$permission_name)) checked="checked" @endif></td>
      <td><input type="checkbox" class="minimal verifier-checkbox" name="get[{{$i}}][]" value="{{$permission->permission_name.'_verifier-'.$permission->id}}" @if(in_array($permission->id,$all_permission_id) && in_array($permission->permission_name.'_verifier',$permission_name)) checked="checked" @endif></td>
      <td><input type="checkbox" class="minimal approver-checkbox" name="get[{{$i}}][]" value="{{$permission->permission_name.'_approver-'.$permission->id}}" @if(in_array($permission->id,$all_permission_id) && in_array($permission->permission_name.'_approver',$permission_name)) checked="checked" @endif></td>
    </tr>
       @php $i++; @endphp
   @endforeach
  @else
   <tr>
       <td colspan="9" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
   </tr>
  @endif
  </tbody>
</table>
  </div>

<div class="row">&nbsp;</div>
 <div class="row">
    <div class="col-md-5"></div>
     <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
     <div class="col-md-1"><a href="{{ route('roles.index') }}" class="btn btn-block btn-danger btn-xs">CANCEL</a></div>
   <div class="col-md-5"></div>
 </div>
 <div class="row">&nbsp;</div>
 </div>
</form>

    </div>
  </div>

    </section>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!-- /.content -->
       <script type="text/javascript">
     setTimeout(function() {
       $('#successMessage').fadeOut('fast');
       }, 2000); // <-
   </script>

   <script type="text/javascript">
     $("#add-checkbox").change(function(){
        $(".add-checkbox").prop("checked", $(this).prop("checked"))
      });
    $(".add-checkbox").change(function(){
        if($(this).prop("checked") == false){
            $("#add-checkbox").prop("checked", false)
        }
        if($(".add-checkbox:checked").length == $(".add-checkbox").length){
            $("#add-checkbox").prop("checked", true)
        }
    });

     $("#edit-checkbox").change(function(){
        $(".edit-checkbox").prop("checked", $(this).prop("checked"))
      });
    $(".edit-checkbox").change(function(){
        if($(this).prop("checked") == false){
            $("#edit-checkbox").prop("checked", false)
        }
        if($(".edit-checkbox:checked").length == $(".edit-checkbox").length){
            $("#edit-checkbox").prop("checked", true)
        }
    });

     $("#delete-checkbox").change(function(){
        $(".delete-checkbox").prop("checked", $(this).prop("checked"))
      });
    $(".delete-checkbox").change(function(){
        if($(this).prop("checked") == false){
            $("#delete-checkbox").prop("checked", false)
        }
        if($(".delete-checkbox:checked").length == $(".delete-checkbox").length){
            $("#delete-checkbox").prop("checked", true)
        }
    });

     $("#view-checkbox").change(function(){
        $(".view-checkbox").prop("checked", $(this).prop("checked"))
      });
    $(".view-checkbox").change(function(){
        if($(this).prop("checked") == false){
            $("#view-checkbox").prop("checked", false)
        }
        if($(".view-checkbox:checked").length == $(".view-checkbox").length){
            $("#view-checkbox").prop("checked", true)
        }
    });

     $("#verifier-checkbox").change(function(){
        $(".verifier-checkbox").prop("checked", $(this).prop("checked"))
      });
    $(".verifier-checkbox").change(function(){
        if($(this).prop("checked") == false){
            $("#verifier-checkbox").prop("checked", false)
        }
        if($(".verifier-checkbox:checked").length == $(".verifier-checkbox").length){
            $("#verifier-checkbox").prop("checked", true)
        }
    });

     $("#approver-checkbox").change(function(){
        $(".approver-checkbox").prop("checked", $(this).prop("checked"))
      });
    $(".approver-checkbox").change(function(){
        if($(this).prop("checked") == false){
            $("#approver-checkbox").prop("checked", false)
        }
        if($(".approver-checkbox:checked").length == $(".approver-checkbox").length){
            $("#approver-checkbox").prop("checked", true)
        }
    });

   </script>
   <script>
   $(function () {
       $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
         checkboxClass: 'icheckbox_flat-green',
         radioClass   : 'iradio_flat-green'
     })
     //Red color scheme for iCheck
     $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
       checkboxClass: 'icheckbox_minimal-red',
       radioClass   : 'iradio_minimal-red'
     })
     //Flat red color scheme for iCheck
     $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
       checkboxClass: 'icheckbox_flat-blue',
       radioClass   : 'iradio_flat-blue'
     })

   })

   $(function () {
   $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
   checkboxClass: 'icheckbox_flat-green',
   radioClass   : 'iradio_flat-green'
   })
   });
   </script>
@endsection
