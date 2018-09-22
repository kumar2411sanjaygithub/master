@extends('theme.layouts.default')
@section('content')
{!! Html::style('autocomplete/jquery-ui.css') !!}
{{ Html::script('autocomplete/jquery-1.10.2.js') }}
{{ Html::script('autocomplete/jquery-ui.js') }}
<style>
table{
  width:100%;
  table-layout: fixed;
}
.tbl-content table {
  width:100.5%;
  overflow-x:hide;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:260px;
  overflow-x:auto;
}
tr td{padding:3px 0;}
</style>
<style>.f12{font-size: 12px;}.tablehead > tr >th{font-size:11px!important;padding:3px!important;}.table > thead > tr > th{height:25px!important;}</style>
  <section>
    <div class="panel panel-default">
      <div class="panel-heading topheading">Bid Placement Reminder</div>
      <div class="col-md-12"><br />
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
      <div class="clearfix"></div><br />
      <div class="col-md-12 iextab">
        <div class="container container-lg np">
          <div class="panel panel-default nb nbbg np">
            <div class="panel-body np">
              <!-- // -->
              <div class="card mb0">
                <div class="card-body">
                  <form method="POST" action="">
                  <input  type="hidden" class="form-control browsers" list="browsers" name="user_id" id="user_id">
                   <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                  <div class="row">
                   <div class="col-sm-4">
                       <div class="mda-form-group float-label rel-wrapper">
                         <div class="mda-form-control">
                             <div class="mda-form-control-line"></div>
                             <input class="form-control search_text" name="search_text" id="search_text"
                             value="@if($id != ''){{$a[0]['company_name']}}@endif">
                             @if($id != '')
                            <label></label>
                          @else
                            <label>Search Users</label>
                          @endif
                           </div>
                         </div>
                     </div>
                   </form>
                     <div class="col-sm-3">

                       </div>
                       <div class="col-md-2">
                         <a><img class="ml25" src="{{asset('img/icons/mail.svg')}}" height="33px" width="33px"><br>
                         <span class="fs12" id = "remainder_mail">Send Mail To All</span></a>
                       </div>
                       <div class="col-md-2">
                         <a><img class="ml25" src="{{asset('img/icons/sms.svg')}}" height="33px" width="23px"><br>
                         <span class="fs12" id = "remainder_sms">Send SMS To All</span></a>
                       </div>
                     </div>
                   </div>
                 </div>

              <div class="row mt10">
                <div class="col-lg-12">
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
                  <div class="card ">
                    <div class="table-responsive p2">
                     <div class="tbl-header">
                      <table class="table table-striped">
                        <thead class="tablehead">
                          <tr>
                            <th class="text-center fs14 w5" rowspan="2" style="padding-bottom: 28px!important;">Sr. No</th>
                            <th class="text-center fs14 w57" rowspan="2" style="padding-bottom: 28px!important;">User Name</th>
                            <th class="text-center fs14 w13" rowspan="2" style="padding-bottom: 28px!important;">Last Bid Submission</th>
                            <th class="text-center fs14 w28" colspan="2">Action</th>
                          </tr>
                          <tr>
                            <th class="text-center fs14">Send Email</th>
                            <th class="text-center fs14">Send SMS</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                    <div class="tbl-content oxh">
                      <table>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($a as $key => $value)


                        <tr calue="{{$value['client_id']}}">
                        <td class="text-center w5">{{ $i }}</td>
                        <td class="text-center w57">{{$value['company_name']}}</td>
                        @if($value['bid_submission_date']!= '')
                        <td class="text-center w13">{{@date('d/m/Y',strtotime($value['bid_submission_date']))}}</td>
                        @else
                        <td class="text-center w13">NA</td>
                        @endif
                         <td class="text-center w14">
                               @if($value['email_submission_time'][0]<>'')
                                 <a href = "{{ route('bidplacement.bidmail',[$value['client_id']]) }}" style="color: red;">
                                       <img class="" src="{{asset('img/icons/mail.svg')}}" height="33px" width="33px"> &nbsp;
                                       <span class="fs12">Resend Email</span>
                                 </a>
                                <br/>{{$value['email_submission_time'][1]}}
                                <br/>{{date('d/m/Y',strtotime(str_replace('/','-',$value['email_submission_time'][0])))}}


                                @else
                                  <a href = "{{ route('bidplacement.bidmail',[$value['client_id']]) }}">
                                       <img class="" src="{{asset('img/icons/mail.svg')}}" height="33px" width="33px">&nbsp;
                                       <span class="fs12" id ="email">Send Email</span>
                                  </a>
                                @endif
                            </td>
                            <td class="text-center w14">
                              @if($value['sms_submission_time'][0]<>'')
                                   <a href = "{{ route('bidplacement.bidsms',$value['client_id']) }}" style="color: red;">
                                       <img class="" src="{{asset('img/icons/sms.svg')}}" height="23px" width="23px">&nbsp;
                                       <span class="fs12">Re-send Sms</span></a>

                                   <br/>{{$value['sms_submission_time'][1]}}
                                   <br/>{{date('d/m/Y',strtotime(str_replace('/','-',$value['sms_submission_time'][0])))}}
                                @else
                                   <a href = "{{ route('bidplacement.bidsms',$value['client_id']) }}">
                                        <img class="" src="{{asset('img/icons/sms.svg')}}" height="23px" width="23px">&nbsp;
                                        <span class="fs12">Send Sms</span>
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
              </div>
              <!-- // -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 pxiltab hidden">
        <h1 class="text-center">Under Proceed</h1>
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
<!-- method 2 -->
<script>
//  $(document).ready(function(){
//      $("span").click("#remainder_mail"){
//        $('#email').each(){
//           $("span").trigger("click");
//    };

//     };
// });

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
