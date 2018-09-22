@extends('theme.layouts.default')
@section('content')
{!! Html::style('autocomplete/jquery-ui.css') !!}
{{ Html::script('autocomplete/jquery-1.10.2.js') }}
{{ Html::script('autocomplete/jquery-ui.js') }}

  <section class="content-header">
    <h5>
  <label  class="control-label"><u>BID PLACEMENT REMINDER</u></label>
   </h5>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">DAM</a></li>
      <li><a href="#">IEX</a></li>
      <li><a href="#">BID CONFIRMATION</a></li>
      <li><a href="#"><u>NO BID</u></a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
<div class="box">
<div class="box-body">
<div class="row">
  <div class="col-md-3">
  <label  class="control-label">SELECT DATE</label>
 <div class="input-group date">
   <div class="input-group-addon">
     <i class="fa fa-calendar"></i>
   </div>
   <input type="text" class="form-control pull-right input-sm" id="datepicker" placeholder="DELIVERY  DATE"  name="" id="">
 </div>
</div>
<div class="col-md-1">
      <label  class="control-label"></label>
    <button type="button" class="btn btn-block btn-info btn-xs"  name="" id="" style="margin-top:6px;">GO</button>
</div>
<div class="col-md-8"></div>
</div>
</div>
</div>

<div class="row">&nbsp;</div>
<div class="row">
    <div class="col-md-2">
    <div class="input-group input-group-sm">
      <input type="text" class="form-control" placeholder="SEARCH" name="" id="">
          <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat" name="" id=""><span class="glyphicon glyphicon-search"></span></button>
          </span>
    </div></div>
<div class="col-md-3"></div>
  <div class="col-md-3"><label  class="control-label">CLIENTS WHO HAVE OPTED NO BID</label></div>
  <div class="col-md-2"></div>
<div class="col-md-2">
  <a href="#" class="btn btn-info btn-xs pull-right" name="" id="">
  <span class="glyphicon glyphicon-plus"> </span>&nbsp SEND ALL</a>
</div>
</div>
<div class="box">
<div class="box-body table-responsive">
  <table id="example1" class="table table-bordered table-striped table-hover text-center">
    <thead>
    <tr>
      <th>SR.NO</th>
      <th>CLIENT NAME</th>
      <th>PORTFOLIO ID</th>
      <th>EMAIL</th>
      <th>SMS</th>
  </tr>
    </thead>
    <tbody>
      <tr>
        <td>2</td>
        <td>LAKHAN SHARMA</a>
        <td>ABCDER1234</td>
        <td><a href="#"><button type="button" class="btn btn-primary btn-xs" name="" id=""><span class="glyphicon glyphicon-send"></span>&nbsp; SEND</button></a></td>
        <td><a href="#"><button type="button" class="btn btn-primary btn-xs" name="" id=""><span class="glyphicon glyphicon-send"></span>&nbsp; SEND</button></a></td>
      </tr>

      <tr>
        <td>2</td>
        <td>LAKHAN SHARMA</a>
        <td>ABCDER1234</td>
        <td><a href="#"><button type="button" class="btn btn-primary btn-xs" name="" id=""><span class="glyphicon glyphicon-send"></span>&nbsp; SEND</button></a></td>
        <td><a href="#"><button type="button" class="btn btn-primary btn-xs" name="" id=""><span class="glyphicon glyphicon-send"></span>&nbsp; SEND</button></a></td>
      </tr>
      <tr>
        <td>2</td>
        <td>LAKHAN SHARMA</a>
        <td>ABCDER1234</td>
        <td><a href="#"><button type="button" class="btn btn-primary btn-xs" name="" id=""><span class="glyphicon glyphicon-send"></span>&nbsp; SEND</button></a></td>
        <td><a href="#"><button type="button" class="btn btn-primary btn-xs" name="" id=""><span class="glyphicon glyphicon-send"></span>&nbsp; SEND</button></a></td>
      </tr>
      <tr>
        <td>2</td>
        <td>LAKHAN SHARMA</a>
        <td>ABCDER1234</td>
        <td><a href="#"><button type="button" class="btn btn-primary btn-xs" name="" id=""><span class="glyphicon glyphicon-send"></span>&nbsp; SEND</button></a></td>
        <td><a href="#"><button type="button" class="btn btn-primary btn-xs" name="" id=""><span class="glyphicon glyphicon-send"></span>&nbsp; SEND</button></a></td>
      </tr>
    </tbody>
    </table>
</div>
</div>
</div>
</div>
  </section>

  <script type="text/javascript">
 $(document).ready(function() {
    $('.deliverydate').datepicker({
        autoclose: true
    });
  });
  </script>

<script>
$(document).ready(function() {
    // date function
    $('.deliverydate').datepicker({
        autoclose: true
    });
    // hide the pagination
    $('li[role="tab"]').removeClass("disabled");
    $('ul[aria-label="Pagination"]').hide();
});
// <!-- tooltip for function start -->
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});


$(document).ready(function() {
    $('input.pxil_radio').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'PXIL') {
            $(".pxiltab").removeClass("hidden");
            $(".iextab").addClass("hidden");
        }
    });
    $('input.iex_radio').change(function() {
        if ($(this).is(':checked') && $(this).val() == 'IEX') {
            $(".pxiltab").addClass("hidden");
            $(".iextab").removeClass("hidden");
        }
    });
});
</script>
<script>
 $(document).ready(function(){
     $("email").click(function(){
         alert('hi');
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

    <script>
        src = "{{ route('searchajax') }}";
         $(".search_text").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: src,
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function(data) {
                       response(data);
                    }
                });
            },
            select: function (event, ui) {
              //alert(ui.item.id);
              // console.log(ui.item.id);
              var aa = $("#user_id").val(ui.item.id);
               $("#user_id").submit();
               window.location.href = "{{url('bidplacement/bidplacement')}}/"+ui.item.id;
               //alert('fgdfgd'+ aa);
                //form.submit();// display the selected text
            },
            minLength: 1,
        });
    </script>
@endsection('content')
