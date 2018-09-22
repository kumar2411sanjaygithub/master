@extends('theme.layouts.default')
@section('content_head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection
@section('content')
<style>
a.disabled {
  pointer-events: none;
  cursor: default;
}
</style>
<section class="content-header">
  <h5><label  class="control-label"><u>Insufficient PSM Client Details</u></label></h5>

   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">APPROVE REQUEST</a></li>
      <li><a href="{{ route('psmdetials') }}" class="active">INSUFFICIENT PSM</a></li>
    
   </ol>
</section>
<!-- Content Header (Page header) -->
<!-- Main content -->
  <section class="content">
    <div class="clearfix"></div>
     <!-- <br> -->
     <!-- success msg -->
     @if(session()->has('message'))
       <div class="alert alert-success mt10">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
           {{ session()->get('message') }}
       </div>
     @endif
     <!-- query validater     -->
     <!-- success msg -->
     @if(session()->has('updatemsg'))
       <div class="alert alert-success  mt10">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
           {{ session()->get('updatemsg') }}
       </div>
     @endif
     <!-- query validater     -->
     <!-- success msg -->
     @if(session()->has('delmsg'))
       <div class="alert alert-success  mt10" >
       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
           {{ session()->get('delmsg') }}
       </div>
     @endif

      <div class="row">
         <div class="col-xs-12">

            <!-- <section class="content-header">
              <h5><label  class="control-label"><u>Insufficient PSM Client Details</u></label></h5>
            </section> -->
            <form method="post" enctype="multipart/form-data" action="">
              {{ csrf_field()}}
              <div class="row">
                 <div class="col-xs-12">
                    <div class="box">
                       <div class="box-body">
                          <div class="row">
                             <div class="col-md-3">
                                <label  class="control-label">Select Delivery Date</label>
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                     <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right input-sm" autocomplete="off" id="datepicker" name="validity_from">
                                  <span class="text-danger"></span>
                               </div>
                              </div>
                             <div class="col-md-1" style="margin-top:20px!important;"><button type="button" class="btn btn-block btn-info btn-xs">Go</button></div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
            </form>
            <div class="row">
               <div class="col-md-2">
                  <div class="input-group input-group-sm">
                     <input type="text" class="form-control" placeholder="SEARCH">
                     <span class="input-group-btn">
                     <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                     </span>
                  </div>
               </div>
               <div class="col-md-8"></div>

            </div>
            <div class="box">
               <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped table-hover text-center">
                     <thead>
                        <tr>
                           <th>SR.NO</th>
                           <th>Client Name</th>
                           <th>Portfolio Id</th>
                           <th>Outstanding Balance (1)</th>
                           <th>Unbilled Energy (2)</th>
                           <th>Averate 15 Day Bill Amount (3)</th>
                           <th>Required Exposure (1+2+3)</th>
                           <th>PSM Exposure</th>
                           <th>Reason</th>
                           <th>ACTION</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td>ABC Solutions Pvt. Ltd.</td>
                           <td>S2GJI102To5</td>
                           <td>625345346</td>
                           <td>534534</td>
                           <td>456546</td>
                           <td>345345</td>
                           <td>546546546</td>
                           <td><a>Insufficient Balance</td>
                           <td>
                             <button type="button" class="btn  btn-info btn-xs" value="Approve">Approve</button>
                           </td>
                        <tr>

                     </tbody>
                  </table>
               </div>
               <!-- /.box-body -->
            </div>
         </div>
      </div>

    </form>


  </section>
  <!-- The Modal -->
<script type="text/javascript">
 setTimeout(function() {
   $('.alert-success').fadeOut('fast');
   }, 2000); // <-

</script>

<script>
   $(function () {

     //Date picker
     $('#datepicker').datepicker({
       autoclose: true
     })
     $('#issue_date').datepicker({
       autoclose: true
     })
     $('#datepicker2').datepicker({
       autoclose: true
     })
     $('#revocable_date').datepicker({
       autoclose: true
     })

   })
</script>
@endsection
