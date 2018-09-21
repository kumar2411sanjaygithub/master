@extends('theme.layouts.default')
@section('content')
<section class="content-header">
    <h5><label  class="control-label"><u>APPROVE NEW EMPLOYEE</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">APPROVE REQUEST</a></li>
        <li><a href="active">EMPLOYEE</a></li>
        <li><a href="active"><u>NEW</u></a></li>
      </ol>
    </section>
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
                <input type="text" class="form-control" placeholder="SEARCH" id="search">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" name="go" id="go"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
              </div></div>
          <div class="col-md-6"></div>
            <div class="col-md-4 text-right"><button type="button" class="btn btn-raised btn-info btn-xs">APPROVE ALL</button>
            &nbsp&nbsp&nbsp<button type="button" class="btn btn-raised btn-danger btn-xs mlt">REJECT ALL</button>
          </div></div>
        <div class="box">
            <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th class="chy"><input type="checkbox"  class="minimal" name="ane1" id="ane1"></th>
        <th class="srno">SR.NO</th>
        <th>EMPLOYEE NAME</th>
        <th>DESIGNATION</th>
        <th>ROLE NAME</th>
        <th>DEPARTMENT</th>
        <th class="act">ACTION</th>
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
                             <input type="checkbox" name="checkbox[]" value="{{ $value->id }}" class="minimal"><span class=""></span>
                             </td>
                             <td><div class="">{{$i}}</div></td>
                              <td class="text-center">{{ $value->name }} </td>
                              <td class="text-center">{{ $value->designation }}</td>
                              <td class="text-center w20">{{ $value->role }}</td>
                              <td class="text-center">{{ $value->department['depatment_name'] }}</td>

                              @if($value->emp_app_status =='0')
                              <td class="text-center w15">

                                  <a href="/approve/{{ $value->id }}"><button type="button" class="btn btn-raised btn-info btn-xs">APPROVE</button></a>

                                  <a href="/reject/{{ $value->id }}"><button type="button" class="btn btn-raised btn-danger btn-xs">REJECT</button></a>

                              </td>
                              @elseif($value->emp_app_status =='1')
                                <td class="text-center">
                                  <span class="text-primary">APPROVED</span>
                                </td>
                              @elseif($value->approve_status =='2')
                              <td class="text-center">
                                <span class="text-danger">REJECTED</span>
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
   $("#search").keyup(function () {
       var value = this.value.toLowerCase().trim();

       $("table tr").each(function (index) {
           if (!index) return;
           $(this).find("td").each(function () {
               var id = $(this).text().toLowerCase().trim();
               var not_found = (id.indexOf(value) == -1);
               $(this).closest('tr').toggle(!not_found);
               return not_found;
           });
       });
   });
 </script>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
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
