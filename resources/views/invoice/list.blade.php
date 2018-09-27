@extends('theme.layouts.default')
@section('content')
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
<div class="col-md-3">
    <label  class="control-label">SELECT CLIENT</label>
    <select class="form-control input-sm disabled-class" @php if(isset($url_segment)){}else{echo "disabled";}@endphp name="" id="select_client" style="width: 100%;">  
        <option value="">CLIENT NAME</option>
       
        @foreach($client_list as $clients)
        
        <option value="{{$clients->id}}">{{@$clients->client_details->company_name}}</option>
        @endforeach
    </select>
  </div>
</div>
  </div>
</div>

<div class="box">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th>SR.NO</th>
        <th>CLIENT LIST</th>
        <th>ACTION</th>
      </tr>
      </thead>
      <tbody>
         <?php $i=1; ?>
         @foreach ($clients as $key=> $invoice)

      <tr>
        <td>{{$i}}</td>
        <td></td>
        <td><a  class= "btn btn-primary  btn-xs"  href="" id ="foo"><span class="glyphicon glyphicon-send"></span>&nbsp;GENERATE</a></td>
      </tr>
       <?php $i++; ?>
     @endforeach
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
   if($str!=''){
    $('.disabled-class').removeAttr("disabled");   
    }
   
    // window.setTimeout(function() {
    //     $(".alert").fadeTo(500, 0).slideUp(500, function(){
    //         $(this).remove();
    //     });
    // }, 5000);
  </script>
    @endsection