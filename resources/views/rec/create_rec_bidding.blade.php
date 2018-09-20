@extends('theme.layouts.default')
@section('content')

<section class="content-header">
   <h5><label  class="control-label"><u>BIDDING</u>  <u>SETTING</u></label></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">MANAGE CLIENT</a></li>
      <li><a href="#">REC</a></li>
      <li><a href="{{route('rec-bidding.biddingSearchindex')}}"><u>BIDDING</u>  <u>SETTING</u></a></li>
      <li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-body">
               <div class="row">&nbsp;</div>
               <div class="row">
                  <div class="col-md-3">
                     <label  class="control-label">BIDDING CUFF OFF TIME</label><span class="text-danger"><strong>*</strong></span>
                     <input class="form-control input-sm" type="text" placeholder="ENTER BIDDING CUTT OFF TIME" id="jhq1" name="jhq1">
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">IEX CA CLIENT ID</label>
                     <input class="form-control input-sm" type="text" placeholder="ENTER IEX CA CLIENT ID" id="jhq2" name="jhq2">
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">PXIL CA CLIENT ID</label>
                     <input class="form-control input-sm" type="text" placeholder="ENTER PXIL CA CLIENT ID" id="jhq3" name="jhq3">
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">REC EXCHANGE TYPE</label>
                     <select class="form-control input-sm" style="width: 100%;" id="jhq4" name="jhq4">
                        <option selected="selected">PLEASE SELECT</option>
                        <option value="ala">ALASKA</option>
                        <option value="cali">CALIFONIA</option>
                     </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3">
                     <label  class="control-label">REC ENERGY TYPE</label>
                     <select class="form-control input-sm " style="width: 100%;" id="jhq5" name="jhq5">
                        <option selected="selected">PLEASE SELECT</option>
                        <option value="awa">ALASKA</option>
                        <option value="cali">CALIFONIA</option>
                     </select>
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">REC BID TYPE</label>
                     <select class="form-control input-sm " style="width: 100%;" id="jhq6" name="jhq6">
                        <option selected="selected">PLEASE SELECT</option>
                        <option value="alas" >ALASKA</option>
                        <option value="cali">CALIFONIA</option>
                     </select>
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">REC BUY CATEGORY</label>
                     <select class="form-control input-sm " style="width: 100%;" id="jhq7" name="jhq7">
                        <option selected="selected">PLEASE SELECT</option>
                        <option value="alas">ALASKA</option>
                        <option value="calis">CALIFONIA</option>
                     </select>
                  </div>
                  <div class="col-md-3">
                     <label  class="control-label">REC IEX STATUS</label>
                     <select class="form-control input-sm" style="width: 100%;" id="jhq8" name="jhq8">
                        <option selected="selected">PLEASE SELECT</option>
                        <option value="alas1">ALASKA</option>
                        <option value="calis">CALIFONIA</option>
                     </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3">
                     <label  class="control-label">REC PXIL STATUS</label>
                     <select class="form-control input-sm select2" style="width: 100%;">
                        <option selected="selected">PLEASE SELECT</option>
                        <option>ALASKA</option>
                        <option>CALIFONIA</option>
                     </select>
                  </div>
               </div>
               <div class="row">&nbsp;</div>
               <div class="row">
                  <div class="col-md-5"></div>
                  <div class="col-md-1"><button type="button" class="btn btn-block btn-info btn-xs" id="jui" name="jui">SAVE</button></div>
                  <div class="col-md-1"><button type="button" class="btn btn-block btn-danger btn-xs" id="can" name="can">CANCEL</button></div>
                  <div class="col-md-5"></div>
               </div>
               <div class="row">&nbsp;</div>
            </div>
         </div>
      </div>
   </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script type="text/javascript">
 setTimeout(function() {
   $('#successMessage').fadeOut('fast');
   }, 2000); // <-
</script>
<script>
   $(function () {

     //Date picker
     $('#datepicker').datepicker({
       autoclose: true,
       format: 'dd/mm/yyyy',
       startDate: "+0d"
     });
   });
</script>
  @endsection