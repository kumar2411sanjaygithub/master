@extends('theme.layouts.default')
@section('content')
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <h5>
            <label  class="control-label"><u>NOC</u> <u>APPLICATON</u> <u>APPROVAL</u></label>
         </h5>
         <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
            <li><a href="">NOC </a></li>
            <li class="{{route('nocapplicationapproval')}}"><u>NOC</u> <u>APPLICATION</u>  <u>APPROVAL</u></li>
         </ol>
      </section>
   @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="glyphicon glyphicon-ok"></span> {!! \Session::get('success') !!}
    </div>
   @endif
      <section class="content">
         <div class="row">
            <div class="col-xs-12">
             <ul class="nav nav-tabs">
                 <li class="active" style="height:5px!important;"><a data-toggle="tab" href="#tab1" >INITIATED</a></li>
                 <li><a data-toggle="tab" href="#tab2">APPROVED</a></li>
                 <li><a data-toggle="tab" href="#tab3">REJECTED</a></li>
             </ul>
              <div class="box">
                <div class="box-body">

  <div class="tab-content">
    <div id="tab1" class="tab-pane fade in active table-responsive">
      <div class="table-responsive">
        <table class="table table-bordered text-center">
        <thead>
          <tr>
            <th class="srno">SR.NO</th>
            <th>CLIENT NAME</th>
            <th>PORTFOLIO ID</th>
            <th>APPLICATON NO.</th>
            <th>SLDC</th>
            <th>NOC TYPE</th>
            <th>EXCHANGE TYPE</th>
            <th>QUANTUM</th>        
            <th>VALIDITY START DATE</th>
            <th>VALIDITY END DATE</th>
            <th>NOC REQUEST</th>
            <th class="act">ACTION</th>
          </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @if (count($noc_for_approval) > 0)
             @foreach ($noc_for_approval as $k=>$noc_initiated)
              <tr>
                <td>{{$i}}</td>
                <td>{{@$noc_initiated->client->company_name}}</td>
                <td>
                    @if($noc_initiated->exchange_type=='pxil')
                    {{@$noc_initiated->client->pxil_portfolio}}
                    @elseif($noc_initiated->exchange_type=='iex')
                    {{@$noc_initiated->client->iex_portfolio}}
                    @endif
                </td>
                <td>{{$noc_initiated->application_no}}</td>
                <td>{{strtoupper($noc_initiated->sldc)}}</td>
                <td>{{strtoupper($noc_initiated->noc_type)}}</td>
                <td>{{strtoupper($noc_initiated->exchange_type)}}</td>
                <td>{{$noc_initiated->quantum}}</td>
                <td>{{date('d/m/Y',strtotime($noc_initiated->start_date))}}</td>
                <td>{{date('d/m/Y',strtotime($noc_initiated->end_date))}}</td>
                <td>                
                    @if($noc_initiated->noc_file)
                      <a href="{{url('fileNdownloads/'.$noc_initiated->noc_file)}}" target="_blank" aks="tooltip" title="Download"><span class="glyphicon glyphicon-download"></span></a>
                    @endif
                </td>
                <td>
                  <a href="" data-toggle="modal" data-target="#approveData{{ $noc_initiated->id }}" class="text-success"><span class="glyphicon glyphicon-ok"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="" data-toggle="modal" data-target="#deleteData{{ $noc_initiated->id }}" class="text-danger"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
                <div id="deleteData{{ $noc_initiated->id }}" class="modal fade" role="dialog">
                   <form method="POST"  action="{{url('noc-approval-request/'.$noc_initiated->id.'/status/5')}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                   <div class="modal-dialog modal-confirm">
                     <div class="modal-content">
                        <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                          <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                        </div> -->
                       <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECT THIS NOC APPLICAITON?</p></center>
                       </div>
                       <div class="modal-footer">
                        <div class="text-center">
                         <button type="submit" class="btn btn-info btn-xs">YES</button>
                         <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">NO</button>
                       </div>
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
                        <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                          <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                        </div> -->
                       <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                         <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVE THIS NOC APPLICAITON?</p></center>
                       </div>
                       <div class="modal-footer">
                        <div class="text-center">
                         <button type="submit" class="btn btn-info btn-xs">YES</button>
                         <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">NO</button>
                       </div>
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
                <td colspan="12" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
            </tr>
          @endif
        </tbody>
        </table>
        {{ $noc_for_approval->links() }}
      </div>
    </div>
    <div id="tab2" class="tab-pane fade">
      <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th class="srno">SR.NO</th>
        <th>CLIENT NAME</th>
        <th>PORTFOLIO ID</th>
        <th>APPLICATON NO.</th>
        <th>SLDC</th>
        <th>NOC TYPE</th>
        <th>EXCHANGE TYPE</th>
        <th>QUANTUM</th>          
        <th>VALIDITY START DATE</th>
        <th>VALIDITY END DATE</th>
        <th>NOC REQUEST</th>
      </tr>
    </thead>
    <tbody>
      @php $i=1; @endphp
      @if (count($approved_noc) > 0)
         @foreach ($approved_noc as $k=>$noc_approved)
          <tr>
            <td>{{$i}}</td>
            <td>{{@$noc_approved->client->company_name}}</td>
            <td>
              @if($noc_approved->exchange_type=='pxil')
                {{@$noc_approved->client->pxil_portfolio}}
                @elseif($noc_approved->exchange_type=='iex')
                {{@$noc_approved->client->iex_portfolio}}
                @endif
            </td>
            <td>{{$noc_approved->application_no}}</td>
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
          </tr>
            @php $i++; @endphp
        @endforeach
      @else
        <tr>
            <td colspan="12" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
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
        <th class="srno">SR.NO</th>
        <th>CLIENT NAME</th>
        <th>PORTFOLIO ID</th>
        <th>APPLICATON NO.</th>
        <th>SLDC</th>
        <th>NOC TYPE</th>
        <th>EXCHANGE TYPE</th>
        <th>QUANTUM</th>           
        <th>VALIDITY START DATE</th>
        <th>VALIDITY END DATE</th>
        <th>NOC REQUEST</th>
      </tr>
    </thead>
    <tbody>
      @php $i=1; @endphp
      @if (count($rejected_noc) > 0)
         @foreach ($rejected_noc as $k=>$noc_rejected)
          <tr>
            <td>{{$i}}</td>
            <td>{{@$noc_rejected->client->company_name}}</td>
            <td>
                @if($noc_rejected->exchange_type=='pxil')
                {{@$noc_rejected->client->pxil_portfolio}}
                @elseif($noc_rejected->exchange_type=='iex')
                {{@$noc_rejected->client->iex_portfolio}}
                @endif
            </td>
            <td>{{$noc_rejected->application_no}}</td>
            <td>{{strtoupper($noc_rejected->sldc)}}</td>
            <td>{{strtoupper($noc_rejected->noc_type)}}</td>
            <td>{{strtoupper($noc_rejected->exchange_type)}}</td>
            <td>{{$noc_rejected->quantum}}</td>             
            <td>{{date('d/m/Y',strtotime($noc_rejected->start_date))}}</td>
            <td>{{date('d/m/Y',strtotime($noc_rejected->end_date))}}</td>
            <td>
                @if($noc_rejected->noc_file)
                  <a href="{{url('fileNdownloads/'.$noc_rejected->noc_file)}}" target="_blank" aks="tooltip" title="Download"><span class="glyphicon glyphicon-download"></span></a>
                @endif
          </tr>
            @php $i++; @endphp
        @endforeach
      @else
        <tr>
            <td colspan="12" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
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

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 -->

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script type="text/javascript">
 setTimeout(function() {
   $('#successMessage').fadeOut('fast');
   }, 2000); // <-
</script>

  @endsection
