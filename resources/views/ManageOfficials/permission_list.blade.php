@extends('theme.layouts.default')
@section('content')
      <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5><label  class="control-label"><u>PERMISION LIST</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE OFFICIALS</a></li>
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
        <div class="col-md-12 mb5">
          <a href="{{ route('permissionlist.create') }}" class="btn btn-info btn-xs pull-right">
          <span class="glyphicon glyphicon-plus"> </span>&nbsp CREATE PERMISSION</a>
        </div>
      </div>
      <div class="box">
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped table-hover text-center">
            <thead>
            <tr>
              <th>SR.NO</th>
              <th>PERMISSION NAME</th>
              <th>SLAG</th>
              <th>DESCRIPTION</th>
              <th>CREATED DATE</th>
              <th>ACTION</th>
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
                        <a href="{{ route('permissionlist.edit',[$permission->id]) }}"><span class="glyphicon glyphicon-pencil"></span>
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
<!--modal----------------------------->



<!--new table closed-->

      <!-- /.row -->

    </section>

    <!-- /.content -->
   <script type="text/javascript">
     setTimeout(function() {
       $('#successMessage').fadeOut('fast');
       }, 2000); // <-
   </script>
  @endsection
