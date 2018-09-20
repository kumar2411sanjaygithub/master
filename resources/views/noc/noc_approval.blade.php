@extends('theme.layouts.default')
@section('content')
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <h5>
            <label  class="control-label"><u>NOC</u> <u>APPLICATON</u> <u>APPROVAL</u></label>
         </h5>
         <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li><a href="#">NOC </a></li>
            <li><a href="{{route('nocapplicationapproval')}}"><u>NOC</u> <u>APPLICATION</u>  <u>APPROVAL</u></a></li>
         </ol>
      </section>
   @if (\Session::has('success'))
      <div class="alert alert-success" id="successMessage">
         <ul>
             <li>{!! \Session::get('success') !!}</li>
         </ul>
      </div>
   @endif      
      <section class="content">
         <div class="row">
            <div class="col-xs-12">
             <ul class="nav nav-tabs">
                 <li class="active" style="height:5px!important;"><a data-toggle="tab" href="#tab1" >INITIATED</a></li>
                 <li><a data-toggle="tab" href="#tab2">APPROVAL</a></li>
                 <li><a data-toggle="tab" href="#tab3">REJECTED</a></li>
             </ul>
              <div class="box">
                <div class="box-body">

  <div class="tab-content">
    <div id="tab1" class="tab-pane fade in active">
      <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th>SR.NO</th>
        <th>CLIENT NAME</th>
        <th>PORTFOLIO ID</th>
        <th>APPLICATON NO.</th>
        <th>VALIDITY START DATE</th>
        <th>VALIDITY END DATE</th>
        <th>NOC REQUEST</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      @php $i=1; @endphp
      @if (count($noc_for_approval) > 0)
         @foreach ($noc_for_approval as $k=>$noc_initiated)                  
          <tr>
            <td>{{$i}}</td>
            <td>{{@$noc_initiated->client->name}}</td>
            <td></td>
            <td>{{$noc_initiated->application_no}}</td>
            <td>{{date('d/m/Y',strtotime($noc_initiated->start_date))}}</td>
            <td>{{date('d/m/Y',strtotime($noc_initiated->end_date))}}</td>
            <td>{{isset($noc_initiated->noc_file)?'YES':'NO' }}</td>
            <td>
              <a href="" data-toggle="modal" data-target="#approveData{{ $noc_initiated->id }}" class="btn  btn-info btn-xs">APPROVE</a>
              <a href="" data-toggle="modal" data-target="#deleteData{{ $noc_initiated->id }}" class="btn  btn-danger btn-xs">REJECT</a>              
            </td>
            <div id="deleteData{{ $noc_initiated->id }}" class="modal fade" role="dialog">
               <form method="POST"  action="{{url('noc-approval-request/'.$noc_initiated->id.'/status/5')}}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
               <div class="modal-dialog modal-confirm">
                 <div class="modal-content">
                   <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                     <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                   </div>
                   <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                     <p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECT THIS NOC APPLICAITON.</p>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-danger">Yes</button>
                     <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                   </div>
                 </div>
               </div>
               </form>
             </div>  
            <div id="approveData{{ $noc_initiated->id }}" class="modal fade" role="dialog">
               <form method="POST"  action="{{url('noc-approval-request/'.$noc_initiated->id.'/status/2')}}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
               <div class="modal-dialog modal-confirm">
                 <div class="modal-content">
                   <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                     <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                   </div>
                   <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                     <p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVE THIS NOC APPLICAITON.</p>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-danger">Yes</button>
                     <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                   </div>
                 </div>
               </div>
               </form>
             </div> 
          </tr>
            @php $i++; @endphp                                   
        @endforeach
      @else
        <tr>
            <td colspan="8" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
        </tr>
      @endif
    </tbody>
  </table>
  {{ $noc_for_approval->links() }}
    </div>
    <div id="tab2" class="tab-pane fade">
      <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th>SR.NO</th>
        <th>CLIENT NAME</th>
        <th>PORTFOLIO ID</th>
        <th>APPLICATON NO.</th>
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
            <td>{{@$noc_approved->client->name}}</td>
            <td></td>
            <td>{{$noc_approved->application_no}}</td>
            <td>{{date('d/m/Y',strtotime($noc_approved->start_date))}}</td>
            <td>{{date('d/m/Y',strtotime($noc_approved->end_date))}}</td>
            <td>{{isset($noc_approved->noc_file)?'YES':'NO' }}</td>
            <td>
              <a href="#" class="btn  btn-info btn-xs">APPROVE</a>
            </td>
          </tr>
            @php $i++; @endphp                                   
        @endforeach
      @else
        <tr>
            <td colspan="8" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
        </tr>
      @endif
    </tbody>
  </table>
  {{ $approved_noc->links() }}
    </div>
    <div id="tab3" class="tab-pane fade">
      <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th>SR.NO</th>
        <th>CLIENT NAME</th>
        <th>PORTFOLIO ID</th>
        <th>APPLICATON NO.</th>
        <th>VALIDITY START DATE</th>
        <th>VALIDITY END DATE</th>
        <th>NOC REQUEST</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      @php $i=1; @endphp
      @if (count($rejected_noc) > 0)
         @foreach ($rejected_noc as $k=>$noc_rejected)                  
          <tr>
            <td>{{$i}}</td>
            <td>{{@$noc_rejected->client->name}}</td>
            <td></td>
            <td>{{$noc_rejected->application_no}}</td>
            <td>{{date('d/m/Y',strtotime($noc_rejected->start_date))}}</td>
            <td>{{date('d/m/Y',strtotime($noc_rejected->end_date))}}</td>
            <td>{{isset($noc_rejected->noc_file)?'YES':'NO' }}</td>
            <td>
              <a href="#" data-toggle="modal" data-target="#deleteData" class="btn  btn-danger btn-xs">REJECT</a>              
            </td>
          </tr>
            @php $i++; @endphp                                   
        @endforeach
      @else
        <tr>
            <td colspan="8" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
        </tr>
      @endif
    </tbody>
  </table>
  {{ $rejected_noc->links() }}
    </tbody>
  </table>
    </div>

  </div>
                </div>
              </div>
            </div>
            </div>
          </section>

    <!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script type="text/javascript">
 setTimeout(function() {
   $('#successMessage').fadeOut('fast');
   }, 2000); // <-
</script>

  @endsection