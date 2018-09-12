@extends('theme.layouts.default')
@section('content')
<section class="content-header">
      <h5><label  class="control-label"><u>CLIENT  REQUEST LIST</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE CLIENT</a></li>
        <li class="active"><u>CLIENT BASIC DETAILS</u></li>
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
                <input type="text" class="form-control" placeholder="SEARCH">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
              </div></div>
          <div class="col-md-8"></div>
          
          </div>

          <div class="box">
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
                 @isset($clientdata)

                              <?php
                                $i=1;
                              ?>
                              @foreach ($clientdata as $key => $value)
                              <tr>
                                <td class="text-center">{{ $i }}</td>
                                <td class="text-center">{{ $value->company_name }} </td>
                                <td class="text-center">{{ $value->iex_portfolio }}</td>
                                <td class="text-center">{{ $value->pxil_portfolio }}</td>
                                <td class="text-center">{{ $value->crn_no }}</td>
                                <td class="text-center ">
                                  <a href="#" class="text-decoration: underline">basic</a>&nbsp<a href="#">contact</a>&nbsp<a href="/exchangeapproval/{{$value->id}}">exchange file</a>&nbsp<a href="#">noc</a>&nbsp<a href="/bankapproval/{{$value->id}}">bank</a>&nbsp<a href="#">psm</a>
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
            
          </div>
        </section>
 <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
        @endsection