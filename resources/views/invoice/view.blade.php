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

      <div class="row" >
        <div class="col-xs-12">
          <div class="row">
              <div class="col-md-2" >
              <div class="input-group input-group-sm">
                <input type="text" id="search" class="form-control" placeholder="SEARCH">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
              </div></div>


          <div class="col-md-8"></div>
          <div class="col-md-2 pull-right" >
            <a href="{{ ('clientadd')}}" class="btn btn-info btn-xs pull-right">
            <span class="glyphicon glyphicon-plus"> </span>&nbsp ADD CLIENT</a>
          </div>
          </div>
          <div class="box">
                <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover text-center">
                <thead>
                <tr>
                  <th class="srno">fy</th>
                  <th>invoice type</th>
                  <th>billnumber</th>
                  <th>action</th>

                </tr>
                </thead>
                <tbody>
                 @isset($invoice)
                              <?php
                                $i=1;
                              ?>
                              @foreach ($invoice as $invoices)

                              <tr>
                                <td>{{ $invoices->fy }}</td>
            <td>{{ $invoices->invoice_type }}</td>
            <td>{{ $invoices->billnumber }}</td>
            <td><a href="/user/invoice/{{ $invoices->invoice_id }}">Download</a></td>
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
