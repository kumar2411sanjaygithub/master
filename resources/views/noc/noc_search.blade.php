@extends('theme.layouts.default')
@section('content')
<style type="text/css">
  .hidediv{
    display:none;
  }
.showdiv{
    display:block;
  }
</style>
<section class="content-header">
   <h5>
      <label  class="control-label"><u>NOC</u> <u>APPLICATON</u></label>
   </h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">NOC </a></li>
      <li><a href="{{route('noc-applications.index')}}"><u>NOC</u> <u>APPLICATION</u></a></li>
   </ol>
</section>
   @if (\Session::has('error'))
      <div class="alert alert-danger" id="successMessage">
         <ul>
             <li>{!! \Session::get('error') !!}</li>
         </ul>
      </div>
   @endif

<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-body">
              <form method="post" action="{{route('getclientData',['id'=>'clientdata'])}}">
                {{csrf_field()}}
                {{method_field('GET')}}
               <div class="row">
                  <div class="col-md-12">
                     <div class="input-group input-group-sm">
                        <input type="text" class="form-control candidate_auto_search" placeholder="SEARCH" name="client_name">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                     </div>
                  </div>
               </div>
             </form>
            </div>
         </div>
    </section>
    <!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script type="text/javascript">
// Jquery Conflict Code here
  (function($) {
      //autocomplete
      $(".candidate_auto_search").autocomplete({
          source: "{{url('/client/search')}}",
          minLength: 2,
          select: function(event, ui) {
        $('.candidate_auto_search').val(ui.item.value);
        $(event.target.form).submit();
      }
      });                
  }(jQuery));


        //   var url = "{{url('/client/search')}}";

        // $('.candidate_auto_search').typeahead({

        //     source:  function (query, process) {

        //     return $.get(url, { query: query }, function (data) {

        //             return process(data);

        //         });

        //     }

        // });
</script>
<script type="text/javascript">
 setTimeout(function() {
   $('#successMessage').fadeOut('fast');
   }, 2000); // <-
</script>

  @endsection