@extends('theme.layouts.default')
@section('content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5><label  class="control-label">EMPLOYEE LIST</label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
        <li><a href="active">EMPLOYEE</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
<div class="row">
    <div class="col-md-2">
    <div class="input-group input-group-sm">
      <input type="text" class="form-control" placeholder="SEARCH">
          <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
          </span>
    </div></div>
<div class="col-md-8"></div>
<div class="col-md-2">
  <a href="{{ ('officialsadd')}}" class="btn btn-info btn-xs pull-right"  id="ram">
    <button type="button" class="glyphicon glyphicon-plus adddeportmentbtn">ADD EMPLOYEE</button></a>
</div>
</div>
<div class="box">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th>SR.NO</th>
        <th>EMPLOYEE NAME</th>
        <th>DESIGNATION</th>
        <th>ROLE NAME</th>
        <th>DEPARTMENT</th>
        <th>CREATED DATE</th>
        <th>ACTION</th>
      </tr>
      </thead>
      
       <tbody>
                              @isset($employeeData)
                              <?php
                                $i=1;
                              ?>
                              @foreach ($employeeData as $key => $value)
                              <tr>
                                <td class="text-center">{{ $i }}</td>
                                <td class="text-center">{{ $value->employee }} {{ $value->middle_name }} {{ $value->last_name }}</td>
                                <td class="text-center">{{ $value->designation }}</td>
                                <td class="text-center"></td>
                                <td class="text-center">{{ $value->department['depatment_name'] }}</td>
                                <td class="text-center">{{ @date('d/m/Y',strtotime($value->created_at)) }}</td>
                                <td class="text-center">
                                  <a href="/manageofficials/viewoneoffiicals/{{ $value->id }}"><span class="glyphicon glyphicon-eye-open" officials_detail_id="{{ $value->id }}"></span></a>
                                  &nbsp;&nbsp;&nbsp;
                                  <a href="/manageofficials/editofficials/{{ $value->id }}"> <span class="glyphicon glyphicon-pencil" officials_detail_id="{{ $value->id }}"></span></a>
                                  &nbsp;&nbsp;&nbsp;
                                  <a href="/manageofficials/deleteofficialsdetail/{{ $value->id }}">
                                      <span class="glyphicon glyphicon-trash" officials_detail_id="{{ $value->id }}"></span></a>
                                </td>
                              </tr>
                            <?php
                              $i++;
                            ?>
                              @endforeach
                              @endisset
                            </tbody>
      </table>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
 
@endsection