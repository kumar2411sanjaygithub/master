@extends('theme.layouts.default')
@section('content')
  <section class="content-header">
    <h5><label  class="control-label">GENERATE RATESHEET GRAPH</label></h5>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">DAM</a></li>
      <li><a href="#">IEX</a></li>
      <li><a href="#">GENERATE</a></li>
      <li><a href="#">RATESHEET GRAPH</a></li>
    </ol>
  </section>
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
              <div class="box-body">
                 <div class="row">
                    <div class="col-md-3">
                       <label  class="control-label">SELECT DELIVERY DATE</label>
                       <div class="input-group date">
                          <div class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right input-sm ddate" id="dd_input" placeholder="DELIVERY  DATE">
                       </div>
                    </div>
                    <div class="col-md-1" style="margin-top:8px;">
                       <label  class="control-label"></label>
                       <button type="button" class="btn btn-block btn-info btn-xs" name="" id="submit_go">GO</button>
                    </div>
                    <div class="col-md-4"></div>
                    {{--<div class="col-md-2">
                       <a href="#">
                          <div><label  class="control-label">GENERATE ALL</label></div>
                          <span class="glyphicon glyphicon-send"></span>
                       </a>
                    </div>
                    <div class="col-md-2">
                       <a href="#">
                          <div><label  class="control-label">SEND EMAIL TO ALL</label></div>
                          <span class="glyphicon glyphicon-send"></span>
                       </a>
                    </div>--}}
                 </div>
              </div>
           </div>
        </div>
      </div>
      <!-- // -->
      <div class="row">
        <div class="col-md-12">
           <div class="box">
              <div class="box-body table-responsive">
                  <div class="table-responsive p2 tbody">
                    <table class="table-datatable table table-striped table-hover " id="datatable1">
                      <thead class="tablehead">
                        <tr>
                          <th class="text-center  w5" rowspan="2" style="padding-bottom:28px!important;">SR.NO.</th>
                          <th class="text-center " rowspan="2" style="padding-bottom:28px!important;">CLIENT NAME</th>
                          <th class="text-center " colspan="2">RATESHEET GRAPH</th>
                        </tr>
                        <tr>
                          <th class="text-center ">DOWNLOAD</th>
                          <th class="text-center ">SEND MAIL</th>
                        </tr>
                      </thead>
                      <tbody>
                        @isset($bidclient)

                        <?php $i=1; ?>
                      @foreach ($bidclient as $key=>$name)  

                        @if($name->place_bid()->where('bid_date',$dt)->count()<=0)
                          @continue
                        @else
                          <?php $id = $name->place_bid()->where('bid_date',$dt)->take(1)->get()[0]->id; ?>
                        @endif
                        <tr>
                          <td class="text-center">{{$i}}</td>
                          <td class="text-center">{{ $name->company_name }}</td>
                          <td style="text-center">
                            <a href="{{url('download-ratesheet-graph/download')}}/{{$name->id}}/IEX/{{ $id }}"><button type="button" class="btn  btn-info btn-xs">GENERATE</button></a>
                          </td>
                           <?php
                            if($name->mail_status== 0){?>
                          <td style="text-center">
                            <a href="{{url('service/mailRatesheet/'.$name->id.'/'.$id) }}" target="_blank"><button type="button" class="btn btn-primary btn-xs" name="" id=""><span class="glyphicon glyphicon-download-alt"></span>&nbsp;SEND</button></a>
                          </td>
                          <?php } else{ ?>
                          <td style="text-center">
                            <a href="{{url('service/mailRatesheet/'.$name->id.'/'.$id) }}" target="_blank"><button type="button" class="btn btn-danger btn-xs" name="" id=""><span class="glyphicon glyphicon-download-alt"></span>&nbsp;Re-Send</button></a>
                          </td>
                          <?php } ?>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                        @endisset
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- pxil code end -->
              </div>
        </div>
      </div>
  </section>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript">
 $(document).ready(function() {
    $('.ddate').datepicker({
        autoclose: true
    });
  });
  </script>
  <!-- eix tab and pxil tab codding -->
  <script>
  $(document).ready(function() {
    $('input.pxil_radio').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'PXIL') {
            $(".pxiltab").removeClass('hidden');
            $(".iextab").addClass("hidden");

        }
    });
    $('input.iex_radio').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'IEX') {
            $(".pxiltab").addClass('hidden');
            $(".iextab").removeClass('hidden');
        }
    });
  });
</script>
<script>
 $('#submit_go').on('click',function(event){
                event.preventDefault();
                $str = $('#dd_input').val();
                if($str==''){
                  alert('please choose date first');
                } else{
                $year = $str.substr($str.lastIndexOf('/')+1);
                $day = $str.substr($str.indexOf('/')+1,2);
                $month = $str.substr(0,2);
                window.location = "{{ route('rate_sheet_graph') }}"+"/IEX/"+$year+"/"+$month+"/"+$day;
                }
            });
</script>
@endsection('content')
