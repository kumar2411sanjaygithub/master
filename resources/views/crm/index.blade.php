@extends('theme.layouts.default')
@section('content')
    <section class="content-header">
      <h5><label  class="control-label"><u>ALL LEAD</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">CRM</a></li>
        <li class="active"><u>LEAD</u></li>
      </ol>
    </section>
    <section class="content">
  @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
          <ul>
              <li>{!! \Session::get('success') !!}</li>
          </ul>
      </div>
  @endif


      <div class="row">
        <div class="col-xs-12">
          <div class="row">
              <div class="col-md-2">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="SEARCH" id=" " name=" ">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" id=" " name=" "><span class="glyphicon glyphicon-search"></span></button>
                    </span>
              </div></div>
          <div class="col-md-8"></div>
          <div class="col-md-2">
            <a href="{{ route('lead.create') }}" class="btn btn-info btn-xs pull-right"  id="ram" name=" ">
            <span class="glyphicon glyphicon-plus"> </span>&nbspCREATE LEAD</a>
          </div>
          </div>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover text-center">
                <thead>
                <tr>
                  <th>SR.NO</th>
                  <th>LEAD NO</th>
                  <th>COMPANY NAME</th>
                  <th>EMAIL ID</th>
                  <th>CONTACT NUMBER</th>
                  <th>LEAD SOURCE</th>
                  <th>LEAD OWNER</th>
                </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @if (count($leads) > 0)
                     @foreach ($leads as $k=>$lead)                  
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$lead->leadID}}</td>
                        <td><a href="{{ route('lead.edit',[$lead->id]) }}">{{$lead->company_name}}</a></td>
                        <td>{{$lead->email_id}}</td>
                        <td>{{$lead->contact_number}}</td>
                        <td>{{@$lead->leadsource->name}}</td>
                        <td>{{@$lead->leadowner->name}}</td>
                      </tr>
                        @php $i++; @endphp                                   
                    @endforeach
                  @else
                    <tr>
                        <td colspan="8" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
                    </tr>
                  @endif
                </tbody>
                </table>
                 {{ $leads->links() }}
            </div>
          </div>
    </div>
  </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
     setTimeout(function() {
       $('#successMessage').fadeOut('fast');
       }, 2000); // <-
   </script>
  @endsection