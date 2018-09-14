@extends('theme.layouts.default')
@section('content')
<section class="content-header">
    <h5><label  class="control-label"><u>APPROVE</u> <u>NEW</u> <u>CLIENT</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">APPROVE REQUEST</a></li>
        <li><a href="active">CLIENT</a></li>
        <li><a href="active"><u>NEW</u></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @if (\Session::has('success'))
              <div class="alert alert-success mt10" >
               <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                   {!! \Session::get('success') !!}
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
        </div>
<div class="box">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
         <th>SR.NO</th>
         <th>CLIENT NAME</th>
         <th>GSTIN</th>
         <th>PAN</th>
         <th>CIN</th>
         <th>ACTION</th>
      </tr>
      </thead>
      <tbody>
      <!-- <tr>
        <td>4</td>
        <td><span class="text-info" data-toggle="modal" data-target="#myModal">cybuzzc sharma cybuzzsc lakhan pvt ltd.</span></td>
        <td>Win9554665755656645</td>
        <td>Win9536567457545664</td>
        <td>r79879879789ahu</td>

         <td><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button>&nbsp<button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></td>

      </tr> -->
                                <?php $i=1; ?>
                                @foreach ($approveclient as $key => $value)

                                  <tr>
                                    <td>

                                      <div class="text-center">{{$i}}</div>
                                      </td>
                                    <td class="text-center tr_1">{{$value->company_name}}</td>
                                    <td class="text-center">{{$value->gstin}}</td>
                                    <td class="text-center">{{$value->pan}}</td>
                                    <td class="text-center">{{$value->cin}}</td>

                                     @if($value->client_app_status =='0')

                                      <td class="text-center">
                                        <a href="/status/{{$value->id}}/approve" class="btn  btn-info btn-xs">Approve</a>
                                        <a href="/status/{{$value->id}}/reject" class="btn  btn-danger btn-xs">Reject</a>
                                      </td>
                                    @elseif($value->client_app_status =='1')

                                      <td class="text-center">
                                        <span class="text-primary">Approved</span>
                                      </td>
                                    @elseif($value->client_app_status =='2')

                                      <td class="text-center">
                                        <span class="text-danger">Rejected</span>
                                      </td>
                                    @endif

                                  </tr>
                                <?php $i++; ?>
                                @endforeach
    </tbody>
      </table>
  </div>

</div>
    </section>
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
