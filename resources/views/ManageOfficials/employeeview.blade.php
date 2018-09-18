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
      @if(session()->has('message'))
            <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('message') }}
            </div>
          @endif
          <!-- success msg -->
          <!-- success msg -->
          @if(session()->has('delmsg'))
            <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('delmsg') }}
            </div>
          @endif
          <!-- success msg -->
          @if(session()->has('updatemsg'))
            <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('updatemsg') }}
            </div>
          @endif
      <div class="row">
        <div class="col-xs-12">
<div class="row">
    <div class="col-md-2">
    <div class="input-group input-group-sm">
      <input type="text" class="form-control" placeholder="SEARCH" id="input" onkeyup="myFunction()">
          <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
          </span>
    </div></div>
<div class="col-md-8"></div>
<div class="col-md-2">
  <a href="{{ ('officialsadd')}}" class="btn btn-info btn-xs pull-right"  id="ram">
    <span type="button" class="glyphicon glyphicon-plus adddeportmentbtn"></span> ADD EMPLOYEE</a>
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
                                <td class="text-center">{{ $value->name }} </td>
                                <td class="text-center">{{ $value->designation }}</td>
                                <td class="text-center">{{ $value->role }}</td>
                                <td class="text-center">{{ $value->department['depatment_name'] }}</td>
                                <td class="text-center">{{ @date('d/m/Y',strtotime($value->created_at)) }}</td>
                                <td class="text-center">
                                  <a href="/manageofficials/viewoneoffiicals/{{ $value->id }}"><span class="glyphicon glyphicon-eye-open" officials_detail_id="{{ $value->id }}"></span></a>
                                  &nbsp;&nbsp;&nbsp;
                                  <a href="/manageofficials/editofficials/{{ $value->id }}"> <span class="glyphicon glyphicon-pencil" officials_detail_id="{{ $value->id }}"></span></a>
                                  &nbsp;&nbsp;&nbsp;
                                  <a href="/manageofficials/deleteofficialsdetail/{{ $value->id }}">
                                      <span class="glyphicon glyphicon-trash" id="remove-detail" officials_detail_id="{{ $value->id }}"></span></a>
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
    <script>
 function myFunction() {
 var input, filter, table, tr, td, i;
 input = document.getElementById("input");
 filter = input.value.toUpperCase();
 table = document.getElementById("example1");
 tr = table.getElementsByTagName("tr");
 console.log(tr);
 for (i = 0; i < tr.length; i++) {
   td = tr[i].getElementsByTagName("td")[1];
   if (td) {
     if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
       tr[i].style.display = "";
     } else {
       tr[i].style.display = "none";
     }
   }
 }
}
</script>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
  <script>
      $('.remove-detail').on('click', function(e) {
        alert(1);
        e.preventDefault();
        var href_to_hit = $(this).closest('a').prop('href');
        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false
          },
          function() {
              // console.log(href_to_hit);
              $.get(href_to_hit).done(function(){
                swal('Deleted!', 'Your Data has been deleted.', 'success');
                $(e.currentTarget).closest('tr').remove();
              }).fail(function(){
                swal('Failed!', 'Opps! Your Data has not been deleted at this instance of time.', 'warning');
              });
          });
      });
  </script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  {{ Html::script('js/employee/empvalidate.js') }}
@endsection
