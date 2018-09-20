@extends('theme.layouts.default')
@section('content')

<section class="content-header">
   <h5><label  class="control-label"><u>BIDDING</u>  <u>SETTING</u></label></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">MANAGE CLIENT</a></li>
      <li><a href="#">REC</a></li>
      <li><a href="#"><u>BIDDING</u>  <u>SETTING</u></a></li>
      <li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-body">
              <form method="post" action="{{url('/rec/bidding-setting')}}">
                {{csrf_field()}}
               <div class="row">
                  <div class="col-md-12">
                     <div class="input-group input-group-sm">
                        <input type="text" class="form-control client_search" placeholder="SEARCH CLIENT" name='client_name'>
                        <input type="hidden" class="form-control" id="client_id" name="client_id">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                     </div>
                  </div>
               </div>
             </form>
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
// Jquery Conflict Code here
  (function($) {
      //autocomplete
      $(".client_search").autocomplete({
          source: "{{url('/client/search')}}",
          minLength: 1,
          select: function(event, ui) {
            $('#client_id').val(ui.item.id);
            $('.client_search').val(ui.item.value);
            $(event.target.form).submit();
      }
      });                
  }(jQuery));
</script>
  @endsection