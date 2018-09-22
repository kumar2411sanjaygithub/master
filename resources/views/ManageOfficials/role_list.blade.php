@extends('theme.layouts.default')
@section('content')
      <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5><label  class="control-label"><u>ROLE LIST</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
        <li><a href="#"><u>ROLE & PERMISION</u></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-xs-12">
<div class="row">
  <div class="col-xs-12">
   @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
         <ul>
             <li>{!! \Session::get('success') !!}</li>
         </ul>
      </div>
   @endif
<div class="box adddeportment box @if($errors->isEmpty())hidden @else  @endif">
  <div class="box-body">

  <form method="post" action="{{ (@$role->id!='')?url('/roles/'.$role->id):route('roles.store')}}">
            {{ csrf_field() }}
            {{ (@$role->id!='')?method_field('PATCH'):method_field('POST')}}
  <div class="row">
      <div class="col-md-3 {{ $errors->has('department') ? 'has-error' : '' }}">
     <label  class="control-label">DEPARTMENT NAME<span class="text-danger"><strong>*</strong></span></label>
       <select class="form-control input-sm" name="department">
         <option value="">SELECT DEPARTMENT</option>
         @if(count($department) > 0)
          @foreach($department as $department_data)
            <option value="{{ $department_data->id }}" @if((isset($role->id)&& $role->department_id==$department_data->id)||old('department')==$department_data->id)selected='selected' @endif>{{ $department_data->depatment_name }}</option>
          @endforeach
          @else
           <option value="">NO DATA FOUND.</option>
         @endif

       </select>
        <span class="text-danger">{{ $errors->first('department') }}</span>
    </div>
  <div class="col-md-3 {{ $errors->has('name') ? 'has-error' : '' }}">
    <label  class="control-label">ROLE<span class="text-danger"><strong>*</strong></span></label>
  <input class="form-control input-sm" type="text" placeholder="ENTER ROLE" name="name" value="{{(isset($role->id)&& $role->name)?$role->name:old('name')}}">
    <span class="text-danger">{{ $errors->first('name') }}</span>
  </div>
<div class="col-md-1 mt3">
  <label  class="control-label"></label>
  <button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
  <div class="col-md-1" style="margin-top:21px;">
    <a href="{{ route('roles.index') }}"><input type="button"  class="btn btn-danger btn-block  btn-xs pull-right"value="Cancel"></a>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="col-md-10"></div>
<div class="col-md-2 ">
 <button class="btn btn-info btn-xs pull-right mt7 adddeportmentbtn @if($errors->isEmpty()) @else hidden @endif" >
  <span class="glyphicon glyphicon-plus"> </span>&nbsp ADD ROLE</button>
</div>
</div>
<div class="box">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th class="srno">SR.NO</th>
        <th>DEPARTMENT NAME</th>
        <th>ROLE NAME</th>
        <th>ACCES PERMISIONS</th>
        <th>CREATED BY</th>
        <th>CREATED DATE</th>
        <th class="act1">ACTION</th>
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
                 <td><a href="{{ url('assignpermission/'.$role->id) }}"><u>ASSIGN PERMISIONS</u></a></td>
                 <td>{{@$role->getuser->name}}</td>
                 <td>{{ date('d/m/Y',strtotime($role->created_at))}}</td>
                 <td>
                  <a href="{{ route('roles.edit',[$role->id]) }}"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="" data-toggle="modal" data-target="#deleteData{{ $role->id }}"><span class="glyphicon glyphicon-trash text-danger" ></span></a>

                 </td>
                <div id="deleteData{{ $role
               ->id }}" class="modal fade" role="dialog">
                   <form method="POST"  action="{{url('roles/'.$role->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                   <div class="modal-dialog modal-confirm">
                     <div class="modal-content">
                       <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                         <h4 class="modal-title text-center"></h4>
                       </div>
                       <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                         <p style="font-size: 18px;font-weight: 500;color:black!important;text-align:center">Are you sure you want to delete this record?</p>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
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
