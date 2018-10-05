@extends('theme.layouts.default')
@section('content')
   <section class="content-header">
   <h5>
      <label  class="control-label">IMPORT SCHEDULING</label>
   </h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">DAM</a></li>
      <li><a href="#">IEX</a></li>
      <li><a href="#">IMPORT</a></li>
      <li><a href="#">OBLIGATION</a></li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   @if (session('status'))
               <div class="alert alert-success">
              {{ session('status') }}
             </div>
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
            <div class="col-md-2"></div>
            {{--<div class="col-md-2">
               <a href="#">
                  <div><label  class="control-label">IMPORT ALL</label></div>
                  <span class="glyphicon glyphicon-send"></span>
               </a>
            </div>
            <div class="col-md-2">
               <a href="#">
                  <div><label  class="control-label">DOWNLOAD ALL</label></div>
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
   <div class="box">
      <div class="box-body table-responsive">
         <table id="example1" class="table table-bordered table-striped table-hover text-center">
            <thead>
               <tr>
                  <th rowspan="2" style="vertical-align:middle;">SR.NO</th>
                  <th rowspan="2" style="vertical-align:middle;">CLIENT NAME</th>
                  <th colspan="4">SCHEDULING</th>
               </tr>
               <tr>
                  <th>IMPORT</th>
                  <th>ACTUAL</th>
                  <th>AMENDED</th>
                  <th>EMAIL</th>
               </tr>
            </thead>
            <tbody>
               <?php $i=1; ?>
                              @foreach ($schedule as $key=>$scheduling)
                                  <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td class="text-center">{{ $scheduling->userclient() }}</td>
                                    

                                    <?php if(count($scheduling->ScheduleDetails) > 0){
                                    ?>
                                     <td class="text-center">
                                      <a  class= "btn btn-success  btn-xs" href="{{ URL('/scheduling/import/'.$scheduling->id) }}"><span class="glyphicon glyphicon-upload"></span>&nbsp;Revise</a>
                                    </td>

                                    <?php } else{ ?>
                                    <td class="text-center">
                                      <a class= "btn btn-warning  btn-xs" href="{{ URL('/scheduling/import/'.$scheduling->id) }}"><span class="glyphicon glyphicon-upload"></span>&nbsp;Import</a>
                                    </td>
                                    <?php } ?>
                                  
                                     <td class="text-center">
                                      <a class= "btn btn-info  btn-xs" href = "{{URL('/scheduling/download/'.$scheduling->id)}}"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;Download Actual</a>
                                    </td>
                                   <?php if(count($scheduling->ScheduleDetails) > 0){
                                    ?>
                                       <td class="text-center">
                                        <a class= "btn btn-primary  btn-xs" href = "{{URL('/scheduling/downloadA/'.$scheduling->id)}}"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;Download Amended</a>
                                    </td>
                                  <?php }else{ ?>
                                  <td class="text-center"></td>
                                    <?php } ?>
                                    <?php
                                    if($scheduling->mail_status== 0){?>
                                    <td class="text-center">

                                      <a href="{{ URL('service/mailscheduling/'.$scheduling->client_id.'/'.$scheduling->id) }}" id ="foo"><button class= "btn btn-success btn-xs"><span class="glyphicon glyphicon-send"></span>&nbsp;Send</button></a>
                                    </td>
                                     <?php } else{ ?>
                                     <td class="text-center">

                                      <a href="{{ URL('service/mailscheduling/'.$scheduling->client_id.'/'.$scheduling->id) }}" id ="foo"><button class= "btn btn-success btn-xs"><span class="glyphicon glyphicon-send"></span>&nbsp;Re-Send</a>
                                    </td>
                                     <?php } ?>
                                  </tr>
                                  <?php $i++; ?>
                              @endforeach
                          </tbody>
                       </table>
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

                $str = $('#dd_input').val();
                if($str==''){
                  alert('please choose date first');
                } else{
                $year = $str.substr($str.lastIndexOf('/')+1);
                $day = $str.substr($str.indexOf('/')+1,2);
                $month = $str.substr(0,2);
                window.location = "{{ route('scheduling') }}"+"/IEX/"+$year+"/"+$month+"/"+$day;
                }
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
@endsection