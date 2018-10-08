@extends('theme.layouts.default')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5><label  class="control-label"><u>EMPLOYEE LIST</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="/manageofficials/employeeview">MANAGE EMPLOYEE</a></li>
        <li class="#"><u>EMPLOYEE</u></li>
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
      <input type="text" class="form-control" placeholder="SEARCH" id="search">
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
<div class="box mt3">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th class="srno">SR.NO</th>
        <th>EMPLOYEE NAME</th>
        <th>DESIGNATION</th>
        <th>ROLE NAME</th>
        <th>DEPARTMENT</th>
        <th>CREATED DATE</th>
        <th class="act">ACTION</th>
      </tr>
      </thead>

       <tbody>
                              
                              @forelse ($employeeData as $key => $value)
                              <tr>
                                <td class="text-center">{{ $key+$employeeData->firstItem() }}</td>
                                <td class="text-center">{{ $value->name }} </td>
                                <td class="text-center">{{ $value->designation }}</td>
                                <td class="text-center">{{ @$value->rolename->name  }}</td>
                                <td class="text-center">{{ $value->department['depatment_name'] }}</td>
                                <td class="text-center">{{ @date('d/m/Y',strtotime($value->created_at)) }}</td>
                                <td class="text-center">
                                  <a href="/manageofficials/viewoneoffiicals/{{ $value->id }}"><span class="glyphicon glyphicon-eye-open" officials_detail_id="{{ $value->id }}"></span></a>
                                  &nbsp;&nbsp;&nbsp;&nbsp;
                                  <a href="/manageofficials/editofficials/{{ $value->id }}"> <span class="glyphicon glyphicon-pencil" officials_detail_id="{{ $value->id }}"></span></a>
                                  &nbsp;&nbsp;&nbsp;&nbsp;
                                  <a href="" data-toggle="modal" data-target="#ConvertData{{ $value->id }}" name="" id="convert-disabled">
                                      <span class="glyphicon glyphicon-trash" id="remove-detail" officials_detail_id="{{ $value->id }}"></span></a>
                                </td>
                                <div id="ConvertData{{ $value->id }}" class="modal fade" role="dialog">
           <form method="GET"  action="{{url('/manageofficials/deleteofficialsdetail/'.$value->id)}}">
            {{ csrf_field() }}
           <div class="modal-dialog modal-confirm">
             <div class="modal-content">
               <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                 <h4 class="modal-title text-center"></h4>
               </div> -->
               <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                 <center><p style="font-size: 12px;font-weight:400;color:black!important; text-align:center;">DO YOU REALLY WANT TO DELETE THIS RECORD?</p>
                  </center>
               </div>
               <div class="modal-footer">
                <div class="text-center">
                 <button type="submit" class="btn btn-info btn-xs">YES</button>
                 <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">NO</button>
               </div>
               </div>
             </div>
           </div>
           </form>
         </div>
                              </tr>
                              @empty
                            <tr class="alert-danger" ><th colspan='9'>No Data Found.</th></tr>
                            @endforelse

                              </tbody>
                           </table>
                           <div class=" col-md-12">
                            <div class="col-md-6"><br>
                              Total Records: {{ $employeeData->total() }}
                            </div>
                            <div class="col-md-6">
                            <div class=" pull-right">{{$employeeData->links()}}</div>
                          </div>
                        </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <!-- /.content -->
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


@endsection
