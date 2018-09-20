@extends('theme.layouts.default')
@section('content')
<section class="content-header">
    <h5><label  class="control-label">APPROVE NEW EMPLOYEE</label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">APPROVE REQUEST</a></li>
        <li><a href="active">EMPLOYEE</a></li>
        <li><a href="active">NEW</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @if(session()->has('updatemsg'))
          <div class="alert alert-success mt10">
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
                      <button type="button" class="btn btn-info btn-flat" name="go" id="go"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
              </div></div>
          <div class="col-md-6"></div>
            <div class="col-md-4 text-right"><input type="checkbox"  class="minimal" name="ap1" id="checkAll">&nbsp&nbsp<label  class="control-label">APPROVE ALL</label>
            &nbsp&nbsp&nbsp<input type="checkbox" class="minimal" name="ra1" id="checkAllr">&nbsp&nbsp<label  class="control-label"  >REJECT ALL</label></div>
          </div>
        <div class="box">
          <div class="box-body">
      <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th><input type="checkbox"  class="minimal" name="ane1" id="ane1"></th>
        <th>EMPLOYEE NAME</th>
        <th>DESIGNATION</th>
        <th>ROLE NAME</th>
        <th>DEPARTMENT</th>
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
            <td>
            <div class="checkbox c-checkbox">
            <label>
               <input type="checkbox" name="checkbox[]" value="{{ $value->id }}" class=""><span class=""></span>
            </label>
            </div>
            <div class="">{{$i}}</div>

             </td>
                              <td class="text-center">{{ $value->name }} </td>
                              <td class="text-center">{{ $value->designation }}</td>
                              <td class="text-center w20">{{ $value->role }}
                              </td>
                              <td class="text-center">{{ $value->department['depatment_name'] }}</td>
                              
                              @if($value->emp_app_status =='0')
                              <td class="text-center w15">
                                
                                  <a href="/approve/{{ $value->id }}"><button type="button" class="btn btn-raised btn-info btn-xs">Approve</button></a>
                                
                                  <a href="/reject/{{ $value->id }}"><button type="button" class="btn btn-raised btn-danger btn-xs">Reject</button></a>
                                
                              </td>
                              @elseif($value->emp_app_status =='1')
                                <td class="text-center">
                                  <span class="text-primary">Approved</span>
                                </td>
                              @elseif($value->approve_status =='2')
                              <td class="text-center">
                                <span class="text-danger">Rejected</span>
                              </td>
                              @endif
                            </tr>
                            <?php
                              $i++;
                            ?>
                              @endforeach
                              @endisset

      
      </tbody>
      </table>

  <!-- /.box-body -->
</div>
</div>
</div>
    </section>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
    </script>
    <script>
    $("#checkAllr").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
    </script>
    <script>
 function myFunction() {
  //alert(1);
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

    @endsection