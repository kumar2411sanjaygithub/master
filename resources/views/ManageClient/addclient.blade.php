@extends('theme.layouts.default')
@section('content')
<section class="content-header">
      <h5><label  class="control-label"><u>CLIENT LIST</u></label></h5>
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
          <div class="box">
      <div class="row">
        <div class="col-xs-12">
          <div style="height:10px;">&nbsp;</div>
          <div class="row1">
              <div class="col-md-2" style="padding-left:10px;">
              <div class="input-group input-group-sm">
                <input type="text" id="search" class="form-control" placeholder="SEARCH">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
              </div></div>
          </div>
          <div class="row">
          <div class="col-md-8"></div>
          <div class="col-md-2 pull-right" style="margin-right:10px;">
            <a href="{{ ('clientadd')}}" class="btn btn-info btn-xs pull-right">
            <span class="glyphicon glyphicon-plus"> </span>&nbsp ADD CLIENT</a>
          </div>
          </div>
          <div class="box1">
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



                                  <a href="/basic/{{$value->id}}" class="text-decoration: underline"><u>BASIC</u></a>&nbsp&nbsp<a href="/contactdetails/{{$value->id}}"><u>CONTACT</u></a>&nbsp&nbsp<a href="/exchangedetails/{{$value->id}}"><u>EXCHANGE FILE</u></a>&nbsp&nbsp<a href="/nocdetails/{{$value->id}}"><u>NOC</u></a>&nbsp&nbsp<a href="/bankdetails/{{$value->id}}"><u>BANK</u></a>&nbsp&nbsp<a href="{{url('/psm/psmdetails/'.$value->id)}}"><u>PSM</u></a>

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
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

 <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
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
@endsection
