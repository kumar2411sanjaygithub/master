@extends('theme.layouts.default')
@section('content')
      <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5><label  class="control-label"><u>ROLE LIST</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE OFFICIALS</a></li>
        <li><a href="#">ROLE & PERMISION</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
<div class="row">
   @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
         <ul>
             <li>{!! \Session::get('success') !!}</li>
         </ul>
      </div>
   @endif
<div class="col-md-10"></div>
<div class="col-md-2">
  <a href="{{ route('roles.create') }}" class="btn btn-info btn-xs pull-right">
  <span class="glyphicon glyphicon-plus"> </span>&nbsp ADD ROLE</a>
</div>
</div>
<div class="box">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th>SR.NO</th>
        <th>DEPARTMENT NAME</th>
        <th>ROLE NAME</th>
        <th>ACCES PERMISIONS</th>
        <th>CREATED BY</th>
        <th>CREATED DATE</th>
        <th>ACTION</th>
      </tr>
      </thead>
      <tbody>
         @php $i=1; @endphp
         @if (count($roles) > 0)
            @foreach ($roles as $k=>$role)
               <tr>
                 <td>{{$i}}</td>
                 <td>{{@$role->getDepartment->depatment_name}}</td>
                 <td>{{$role->name}}</td>
                 <td><a href="{{ url('assignpermission/'.$role->id) }}">Assign Permissions</a></td>
                 <td>{{@$role->getuser->name}}</td>
                 <td>{{ date('d/m/Y',strtotime($role->created_at))}}</td>
                 <td>
                  <a href="{{ route('roles.edit',[$role->id]) }}"><span class="glyphicon glyphicon-pencil"></span>
                  <a href="" data-toggle="modal" data-target="#deleteData{{ $role->id }}"><span class="glyphicon glyphicon-trash" style="color: red;"></span></a>

                 </td>
                <div id="deleteData{{ $role
               ->id }}" class="modal fade" role="dialog">
                   <form method="POST"  action="{{url('roles/'.$role->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
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
  </div>
  <!-- /.box-body -->
</div>

    </section>
    <!-- /.content -->
   <script type="text/javascript">
     setTimeout(function() {
       $('#successMessage').fadeOut('fast');
       }, 2000); // <-
   </script>
  @endsection