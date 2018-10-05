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
      <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="">DAM</a></li>
      <li><a href="">IEX</a></li>
      <li><a href="/bidplacement/bidplacement">BID CONFIRMATION</a></li>
      <li class="#"><u>NO BID</u></li>
    </ol>
  </section>
  <section class="content">
<div class="row">
<div class="col-xs-12">
  @if(session()->has('success'))

    <div class="alert alert-success mt10">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{ session()->get('success') }}
    </div>
  @endif
  @if($errors->any())
   @foreach ($errors->all() as $error)
      <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{$error}}
      </div>
   @endforeach
  @endif
<div class="box" style="margin-bottom:0px;">
<div class="box-body">
  <div class="col-md-12 hidden"><br />
    <div class="col-md-6 col-md-offset-4">
      <div class="form-group">
        <div class="col-sm-6">
          <label class="radio-inline c-radio">
            <input id="inlineradioIEX" class="iex_radio checkbox_check1" type="radio" name="i-radio" value="IEX" checked><span class="ion-record"></span> IEX
          </label>
        </div>
        <div class="col-sm-6">
          <label class="radio-inline c-radio">
            <input disabled id="inlineradioPXIL" class="pxil_radio checkbox_check2" type="radio" name="i-radio" value="PXIL"><span class="ion-record"></span> PXIL
          </label>
        </div>
      </div>
    </div>
  </div>
<!-- <div class="row">
  <div class="col-md-12">
    <div class="col-md-1 pl0 pr0">
      <label  class="control-label">SELECT DATE</label>
    </div>
    <div class="col-md-3">
       <div class="input-group date">
         <div class="input-group-addon">
           <i class="fa fa-calendar"></i>
         </div>
         <input type="text" class="form-control pull-right input-sm" id="deliverydate" placeholder="SELECT DATE"  name="" id="">
       </div>
     </div>
    <div class="col-md-1">
        <button type="button" class="btn btn-block btn-info btn-xs mt3"  name="" id="">GO</button>
    </div>
    <div class="col-md-6"></div>
  </div>
</div>
</div>
</div> -->

<div class="row">&nbsp;</div>
<div class="row">
    <div class="col-md-2">
      <div class="mda-form-group float-label rel-wrapper">
        <div class="mda-form-control">
            <div class="mda-form-control-line"></div>
            <input  type="hidden" class="form-control browsers" list="browsers" name="user_id" id="user_id">
                   <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            <div class="input-group input-group-sm">
            <input class="form-control search_text" style="border-radius:2px 0 0 2px;width:200px;" name="search_text" placeholder="SEARCH" id="search_text"
            value="@if($id != ''){{$a[0]['company_name']}}@endif">
            <span class="input-group-btn" style="margin-bottom:3px;">
            <button style="margin-bottom:4px;border-radius:0 2px 2px 0;" type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
          </span>
            @if($id != '')
           <label></label>
         @else
           <!-- <label>Search Users</label> -->
         @endif
       </div>
          </div>
        </div>
  </div>
<div class="col-md-3"></div>
<div class="col-md-3"></div>
  <!-- <div class="col-md-3"><label class="control-label" style="margin-top:5px;">CLIENTS WHO HAVE OPTED NO BID</label></div> -->
<!-- <div class="col-md-4">
  <a href="#" id="remainder_mail" class="btn btn-info btn-xs pull-right" name="" id="">
  <span class="glyphicon glyphicon-send"> </span>&nbsp SEND E-MAIL TO ALL</a>
  <a href="#" id="remainder_sms" class="btn btn-info btn-xs pull-right mr5" name="" id="">
    <span class="glyphicon glyphicon-send"> </span>&nbsp SEND SMS TO ALL</a>
</div> -->


</div>
<div class="box">
<div class="box-body table-responsive">
  <table id="example1" class="table table-bordered table-striped table-hover text-center">
    <thead>
    <tr>
      <th class="w5">SR.NO</th>
      <th>CLIENT NAME</th>
      <th class="w10">PORTFOLIO ID</th>
      <th class="w10">BID SUBMISSION DATE</th>
      <th class="w10">EMAIL</th>
      <th class="w10">SMS</th>
  </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>
      @foreach($a as $key => $value)


      <tr calue="{{$value['client_id']}}">
      <td class="text-center w5">{{ $i }}</td>
      <td class="text-center w57">{{$value['company_name']}}</td>
      <td class="text-center w57">{{$value['iex_portfolio']}}</td>
      @if($value['bid_submission_date']!= '')
      <td class="text-center w13">{{@date('d/m/Y',strtotime($value['bid_submission_date']))}}</td>
      @else
      <td class="text-center w13">NA</td>
      @endif
       <td class="text-center w14">
             @if($value['email_submission_time'][0]<>'')
               <a href = "{{ route('bidplacement.bidmail',[$value['client_id']]) }}" style="color: red;">
                     <span class=" text-danger glyphicon glyphicon-retweet"></span>&nbsp;
               </a>
              <br/>{{$value['email_submission_time'][1]}}
              <br/>{{date('d/m/Y',strtotime(str_replace('/','-',$value['email_submission_time'][0])))}}


              @else
                <a href = "{{ route('bidplacement.bidmail',[$value['client_id']]) }}">
                     <span class="text-success glyphicon glyphicon-send"></span>&nbsp;<br><span class="text-danger"> DD/MM/YY (HH:MM:SS)<span>
                </a>
              @endif
          </td>
          <td class="text-center w14">
            @if($value['sms_submission_time'][0]<>'')
                 <a href = "{{ route('bidplacement.bidsms',$value['client_id']) }}" style="color: red;">
                    <span class=" text-danger glyphicon glyphicon-repeat"></span>&nbsp;

                 <br/>{{$value['sms_submission_time'][1]}}
                 <br/>{{date('d/m/Y',strtotime(str_replace('/','-',$value['sms_submission_time'][0])))}}
              @else
                 <a href = "{{ route('bidplacement.bidsms',$value['client_id']) }}">
                     <span class=" text-success glyphicon glyphicon-envelope"></span>&nbsp; <br> <span class="text-danger">DD/MM/YY (HH:MM:SS)</span>
                 </a>
              @endif
          </td>
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
