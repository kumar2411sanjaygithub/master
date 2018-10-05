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
      <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="">NOC </a></li>
      <li class=""><u>NOC</u> <u>APPLICATION</u></li>
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
                  <select class="" name="client_id" id="select-client" data-live-search="true">
                      <option>Search Client</option>
                       @foreach ($clientData as $key => $value)
                       <option value="{{ $value->id }}" data-tokens="{{ $value->id }}.{{ $value->id }}.{{ $value->id }};?>"> {{$value->company_name}} [{{$value->short_id}}] [{{$value->crn_no}}] [{{$value->iex_portfolio}}] [{{$value->pxil_portfolio}}]</option>
                      @endforeach
                    </select>
                  </div>
               </div>
             </form>
            </div>
         </div>
            <h5>
      <label  class="control-label"><u>APPROVED</u> <u>CLIENT LIST</u></label>
   </h5>
          <div class="box">
            <div class="box-body table-responsive">
            <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>SR.NO</th>
                <th>APPLICATON NO.</th>
                <th>SLDC</th>
                <th>NOC TYPE</th>
                <th>EXCHANGE TYPE</th>
                <th>QUANTUM</th>
                <th>VALIDITY START DATE</th>
                <th>VALIDITY END DATE</th>
                <th>NOC REQUEST</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              @php $i=1; @endphp
              @if (count($approved_noc) > 0)
                 @foreach ($approved_noc as $k=>$noc_approved)
                  <tr>
                    <td>{{$i}}</td>

                    <td><a href="{{url('/getclientData/'.$noc_approved->client_id)}}">{{$noc_approved->application_no}}</a></td>
                    <td>{{strtoupper($noc_approved->sldc)}}</td>
                    <td>{{strtoupper($noc_approved->noc_type)}}</td>
                    <td>{{strtoupper($noc_approved->exchange_type)}}</td>
                    <td>{{$noc_approved->quantum}}</td>
                    <td>{{date('d/m/Y',strtotime($noc_approved->start_date))}}</td>
                    <td>{{date('d/m/Y',strtotime($noc_approved->end_date))}}</td>
                    <td>
                      @if($noc_approved->noc_file)
                        <a href="{{url('fileNdownloads/'.$noc_approved->noc_file)}}" target="_blank" aks="tooltip" title="Download"><span class="glyphicon glyphicon-download"></span></a>
                      @endif
                    </td>
                    <td>
                      <a class="btn btn-info btn-xs" disabled>APPROVED</a>
                    </td>
                  </tr>
                    @php $i++; @endphp
                @endforeach
              @else
                <tr>
                    <td colspan="10" style="background-color: #c74343a6;"><b>NO DATA FOUND.</b></td>
                </tr>
              @endif
            </tbody>
          </table>
          {{ $approved_noc->links() }}
            </div>
            <!-- /.box-body -->
          </div>

    </section>
    <!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script>
$(document).ready(function() {
     $("#select-client").change(function(e) {
           var id = this.value;
           var url = "{{url('/getclientData')}}/"+id;

           window.location = url;
     });
 });
</script>
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
<script type="text/javascript">
    $(document).ready(function() {
   $('#select-client').select2();
});
</script>
  @endsection
