@extends('theme.layouts.default')
@section('content')
<section class="content-header">
      <h5>
    <label  class="control-label">IMPORT RATE SHEET</label>
     </h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">DAM</a></li>
        <li><a href="#">IEX</a></li>
        <li><a href="#">IMPORT</a></li>
        <li><a href="#">RATESHEET</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="clearfix"></div><br>
            @if(session()->has('success'))
              <div class="alert alert-success">
                  {{ session()->get('success') }}
              </div>
            @endif
            <!-- query validater     -->
            @if($errors->any())
             @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                  {{$error}}
                </div>
             @endforeach
            @endif
      <div class="row">
        <div class="col-xs-12">
<div class="box">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th rowspan="2" style="vertical-align:middle;">SR.NO</th>
        <th rowspan="2" style="vertical-align:middle;">DATE</th>
        <th colspan="2">RATESHEET</th>
      </tr>
      <tr>
        <th>UPLOAD</th>
        <th>DOWNLOAD</th>
      </tr>
      </thead>
      <tbody>
       <?php $i=1; ?>
           
            @foreach($date_list as $date=>$fileName)
                <tr date="{{$date}}" type="IEX">
                  <td class="text-center">{{$i}}</td>
                  <td class="text-center">{{@date('d/m/Y',strtotime($date)) }}</td>
                  <td class="text-center">
                      <button type="button" class="btn @if($fileName <> '') btn-success @else btn-warning @endif  btn-xs" data-toggle="modal" data-target="#upload{{$i}}" date="{{$date}}"><span class="glyphicon glyphicon-upload"></span>&nbsp;UPLOAD</button>
                  </td>
                  <td class="text-center">
                      @if($fileName <> '')
                          <a href="{{url('download-ratesheet/'.$fileName)}}" target="_blank"><button type="button" class="btn btn-info btn-xs" file_path="{{$directory_path['IEX'].'/'.$date.'.csv'}}" id="download" date={{$date}}><span class="glyphicon glyphicon-download-alt"></span>&nbsp;DOWNLOAD</button></a>
                      @endif
                  </td>
                  <div class="modal fade" id="upload{{$i}}" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                          <form method="post" action="{{ route('upload-ratesheet') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Upload Rate Sheet(.csv file)</h5>
                          </div>
                          <div class="modal-body text-center">
                            {{ csrf_field() }}
                            <input type="hidden" name="date" id="date_input" value="{{$date}}"/>
                            <input type="hidden" name="exchange" id="exchange_input"/>
                            <input type="file" name="fileToUpload" id="fileToUpload" accept=".csv">
                             {{-- accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" --}}
                          </div>
                          <div class="modal-footer">
                            <div class="text-center">
                              <button type="submit" class="btn btn-raised btn-info btn-sm">Submit</button>
                              <button type="button" class="btn btn-raised btn-danger btn-sm" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </form>
                        </div>

                      </div>

                </tr>
                <?php $i++; ?>
            @endforeach
      </tbody>
      </table>
  </div>
  
</div>
  </div>
   </section>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
 $(document).ready(function() {
    $('.deliverydate').datepicker({
        autoclose: true
    });
  });
  </script>
  <script>
  $('button[data-target="#upload"]').on('click',function(){
        $('#exchange_input').val($('input[name="exchange_radio"]:checked').val());
        $('#date_input').val($(this).attr('date'));
    })
  });
</script>
   @endsection