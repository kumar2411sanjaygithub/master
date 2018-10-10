@extends('theme.layouts.default')
@section('content')
  <style>

.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 13px;
  margin-top:-3px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top:8px;
  left: 0;
  right: 0;
  bottom:-8px;
  background-color: #ccc;
  -webkit-transition: .6s;
  transition: .6s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 10px;
  width: 10px;
  left: 1px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

  </style>
<section class="content-header">
  <h5><label  class="control-label">BARRED CLIENT</label></h5>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
   <li><a href="/basicdetails">MANAGE CLIENT</a></li>
    <li class="#"><u>BARRED CLIENT</u></li>
   

  </ol>
</section>

 

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
  @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="glyphicon glyphicon-ok"></span> {!! \Session::get('success') !!}
    </div>
   @endif
  <!------------------------------------bank details start--->
<div class="box">
<div class="box-body  table-responsive">
<table class="table table-bordered table-striped  text-center">
   <thead>
     <tr>
       <th>SR.NO</th>
       <th>CLIENT NAME</th>
       <th>IEX PORTFOLIO ID</th>
       <th>PXIL PORTFOLIO ID</th>
       <th>ACTION</th>
     </tr>
   </thead>
   <tbody>
      @php $i=1; @endphp
      @if (count($client_list) > 0)
         @foreach ($client_list as $k=>$client_data)
          <tr>
            <td>{{$i}}</td>
            <td>{{@$client_data->company_name}}</td>
            <td>{{$client_data->iex_portfolio}}</td>
            <td>{{$client_data->pxil_portfolio}}</td>
            <td>BLOCK &nbsp;&nbsp; <label class="switch" style="position: relative;top: -6px;"><input type="checkbox" {{ $client_data->barred_status===1 ? 'checked data-toggle=modal data-target=#clientDeactivate'.$client_data->id :  'data-toggle=modal data-target=#clientActivate'.$client_data->id }}><span class="slider round"></span></label> &nbsp;&nbsp; ACTIVE</td>

          </tr>
          <div id="{{ $client_data->barred_status===1 ? 'clientDeactivate'.$client_data->id : 'clientActivate'.$client_data->id }}" class="modal fade" role="dialog">
           <div class="modal-dialog">
             <!-- Modal content-->
             <div class="modal-content cat-header">
               <!-- <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center" style="    font-size: 18px;" ><strong></strong></h4>
               </div> -->
               <form id="SignupForm" name="SignupForm"  action="/client-status/{{ $client_data->id }}/status/{{ $client_data->barred_status===1 ? 0 : 1 }}" method="GET"  >

               <div class="modal-body">
                 <p style="text-align:center; font-size:12px;font-weight:500;color:black!important; text-align:center;">ARE YOU SURE TO {{ $client_data->barred_status===1 ? 'BLOCK' : 'ACTIVE' }} THIS CLIENT?</p>
               </div>
               <div class="modal-footer">
                 <button type="submit" class="btn btn-info pull-left yes-btn btn-xs"  style="margin-left: 41%;">YES</button>
                 <button type="button" class="btn btn-danger pull-right yes-btn btn-xs" data-dismiss="modal" style="margin-right: 45%;">NO</button>
               </div>
               </form>
             </div>
           </div>
          </div>

            @php $i++; @endphp
        @endforeach
      @else
        <tr>
            <td colspan="8" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
        </tr>
      @endif
     </tbody>
 </table>
 {{ $client_list->links() }}
   </div>
  </div>
</section>

@endsection
