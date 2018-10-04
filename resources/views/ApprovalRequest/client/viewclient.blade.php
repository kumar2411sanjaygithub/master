@extends('theme.layouts.default')
@section('content')
<section class="content-header">
      <h5><label  class="control-label"><u>CLIENT  REQUEST LIST</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">APPROVE REQUEST</a></li>
        <li><a href="#">CLIENT</a></li>
        <li class="active"><u>EXISTING</u></li>
      </ol>
    </section>
    <section class="content">
       @if(session()->has('message'))
            <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('message') }}
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

          </div>

          <div class="box mt3">
                    <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover text-center">
                <thead>
                <tr>
                  <th>SR.NO</th>
                  <th>CLIENT NAME</th>
                  <th>IEX PORTFOLIO ID</th>
                  <th>PXIL PORTFOLIO ID</th>
                  <th>CRN</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                
                              @forelse ($clientdata as $key => $value)
                              <tr>
                                <td class="text-center">{{ $key+$clientdata->firstItem() }}</td>
                                <td class="text-center" style="width:40%;">{{ $value->company_name }} </td>
                                <td class="text-center">{{ $value->iex_portfolio }}</td>
                                <td class="text-center">{{ $value->pxil_portfolio }}</td>
                                <td class="text-center">{{ $value->crn_no }}</td>
                                <td class="text-center ">
                                  <a href="/basic/approval/{{$value->id}}" class="text-decoration: underline"><u>BASIC</u></a>&nbsp&nbsp&nbsp&nbsp<a href="/contact/approval/{{$value->id}}"><u>CONTACT</u></a>&nbsp&nbsp&nbsp&nbsp<a href="/exchangeapproval/{{$value->id}}"><u>EXCHANGE FILE</u></a>&nbsp&nbsp&nbsp&nbsp<a href="/nocapproval/{{$value->id}}"><u>NOC</u></a>&nbsp&nbsp&nbsp&nbsp<a href="/bankapproval/{{$value->id}}"><u>BANK</u></a>
                                </td>
                              </tr>
                           
                              @empty
                <tr class="alert-danger" ><th colspan='9'>No Data Found.</th></tr>
                            @endforelse

                              </tbody>
                           </table>

                           <div class=" col-md-12">
                            <div class="col-md-6"><br>
                              Total Records: {{ $clientdata->total() }}
                            </div>
                            <div class="col-md-6">
                            <div class=" pull-right">{{$clientdata->links()}}</div>
                          </div>
                        </div>
            </div>

          </div>
        </section>
 <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
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
        @endsection
