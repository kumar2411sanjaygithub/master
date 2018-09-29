@extends('theme.layouts.default')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="content-header">
      <h5>
    <label  class="control-label"><u>ENERGY BILL</u></label>
     </h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">DAM</a></li>
        <li><a href="#">IEX</a></li>
        <li><a href="#">RTC</a></li>
        <li><a href="#"><u>ENERGY BILL</u></a></li>

      </ol>
    </section>

@php
 $url_segment = \Request::segment(3);
@endphp
    <!-- Main content -->
    <section class="content">
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
  

  <div class="col-md-1" style="margin-top:10px;">
        <label  class="control-label"></label>
    <button type="button" class="btn btn-block btn-info btn-xs" name="" id="submit_go">GO</button>
   </div>
  <div class="col-md-8"></div>
  </div>
</div>
</div>
<div class="box">
<div class="box-body">
<div class="row">
@if(isset($clients) && count($clients) > 0)
<div class="col-md-3">

    <label  class="control-label">SELECT CLIENT</label>
    <select class="form-control input-sm disabled-class" name="" id="select_client" style="width: 100%;" onchange="Datalist()">
        <!-- <option value="">Select Clients</option> -->
        <option value="{{$all_bill_string}}">Select All</option>
        @foreach($clients as $key => $client)
            <option value="{{$client['bill_string']}}">{{$client['company_name']}}[{{$client['iex_portfolio']}}]</option>
        @endforeach
    </select>
  </div>
@endif
</div>
  </div>
</div>

<div class="box">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th rowspan="2" class="vertical-align">SR.NO</th>
        <th rowspan="2" class="vertical-align">CLIENT NAME</th>
        <th colspan="2">ENERGY BILL</th>
        <th colspan="2">OA CHARGES BILL</th>
        <th colspan="2">ENERGY & CHANGES BILL</th>
        <th colspan="2">TRADING MARGIN BILL</th>
        <th colspan="2">OBLIGATION & TRADING MARGIN BILL</th>
      </tr>
       <tr>
        <th><u><a href="#">GENERATE ALL</a></u><br><u><a href="#">DOWNLOAD ALL</a></u></th>
            <th><u><a href="#">EMAIL ALL</a></u></th>
        <th><u><a href="#">GENERATE ALL</a></u><br><u><a href="#">DOWNLOAD ALL</a></u></th>
            <th><u><a href="#">EMAIL ALL</a></u></th>
        <th><u><a href="#">GENERATE ALL</a></u><br><u><a href="#">DOWNLOAD ALL</a></u></th>
            <th><u><a href="#">EMAIL ALL</a></u></th>
        <th><u><a href="#">GENERATE ALL</a></u><br><u><a href="#">DOWNLOAD ALL</a></u></th>
            <th><u><a href="#">EMAIL ALL</a></u></th>
        <th><u><a href="#">GENERATE ALL</a></u><br><u><a href="#">DOWNLOAD ALL</a></u></th>
            <th><u><a href="#">EMAIL ALL</a></u></th>

      </tr>
      </thead>
      <tbody>
           
      </tbody>
      </table>
  </div>
</div>
    </div>
    </div>
    </section>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
  $(document).ready(function() {
        $('.ddate').datepicker({
           autoclose: true,
           dateFormat: 'dd/mm/yyyy'
        });

        $('#submit_go').on('click',function(event){
            event.preventDefault();
            //$('.disabled-class').removeAttr("disabled");
            $str = $('#dd_input').val();

            if($str==''){
              alert('please choose date first');
            } else{

            $year = $str.substr($str.lastIndexOf('/')+1);
            $day = $str.substr($str.indexOf('/')+1,2);
            $month = $str.substr(0,2);
            window.location = "{{ route('billing') }}"+"/IEX/"+$year+"/"+$month+"/"+$day;
            }
        });
    });
</script>

  <script>
 function Datalist(){
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });   
      var client_value = $('#select_client').val();
      alert(client_value);
      $.ajax({
        type:'POST',
        url:'{{url("/client_bill_list")}}',
        data:{
          'client_value':client_value
        },
        dataType:'JSON',
        success:function(data){
          console.log(data.data);
          if(data.data!=''){
          $('#example1 tbody').append('<tr><td>1</td><td>LAKHAN SHARMA</td><td><a href="#"><span class="glyphicon glyphicon-repeat "></span></a>&nbsp;&nbsp;&nbsp;<a href="#"><span class="glyphicon glyphicon-download-alt"></span></a></td> <td><a href="#"><span class="glyphicon glyphicon-send"></span></a></td><td><a href="#"><span class="glyphicon glyphicon-repeat"></span></a>&nbsp;&nbsp;&nbsp;<a href="#"><span class="glyphicon glyphicon-download-alt"></span></a></td><td><a href="#"><span class="glyphicon glyphicon-send"></span></a></td><td><a href="#"><span class="glyphicon glyphicon-repeat"></span></a>&nbsp;&nbsp;&nbsp;<a href="#"><span class="glyphicon glyphicon-download-alt"></span></a></td><td><a href="#"><span class="glyphicon glyphicon-send"></span></a></td><td><a href="#"><span class="glyphicon glyphicon-repeat"></span></a>&nbsp;&nbsp;&nbsp;<a href="#"><span class="glyphicon glyphicon-download-alt"></span></a></td><td><a href="#"><span class="glyphicon glyphicon-send"></span></a></td><td><a href="#"><span class="glyphicon glyphicon-repeat"></span></a>&nbsp;&nbsp;&nbsp;<a href="#"><span class="glyphicon glyphicon-download-alt"></span></a></td><td><a href="#"><span class="glyphicon glyphicon-send"></span></a></td></tr>');
          }
        }
      });

 }
  </script>
    @endsection