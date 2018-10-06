@extends('theme.layouts.default')
@section('content')
<section class="content-header">
    <h5><label  class="control-label"><u>APPROVE</u> <u>NEW</u> <u>CLIENT</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="/client/new">APPROVE REQUEST</a></li>
        <li><a href="/client/new">CLIENT</a></li>
        <li class=""><u>NEW</u></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @if (\Session::has('success'))
              <div class="alert alert-success mt10" >
               <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                   {!! \Session::get('success') !!}
               </div>
          @endif

      <div class="row">
        <div class="col-xs-12">
          <div class="row">
              <div class="col-md-2">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="SEARCH" id="search" onkeyup="myFunction()">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
              </div></div>
          <div class="col-md-6"></div>
            <div class="col-md-4" style="margin-right:0px;padding-right:0px;">


            @if (count($approveclient) > 0)
            <form class="pull-right" action="{{ url()->to('new-client-approve/Rejected') }}" method="post" id="approve_data">
              {{ csrf_field() }}
              <input type="hidden" name="selected_status" class="selected_status">
              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rej" name="cdw5" id="cdw5">REJECT ALL</button>

              <a data-toggle="modal" data-target="#myModalRej" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
            </form>
            @endif
        @if (count($approveclient) > 0)
            <form class="pull-right mr5" action="{{ url()->to('new-client-approve/Approved') }}" method="post" id="approve_data">
              {{ csrf_field() }}
              <input type="hidden" name="selected_status" class="selected_status">
              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted" name="cdw5" id="cdw5">APPROVE ALL</button>

              <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
            </form>
            @endif

                <div id="myModal" class="modal fade" style="display: none;">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                        <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                      </div> -->
                      <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? </p></center>
                      </div>
                      <div class="modal-footer">
                         <div class="text-center">
                        <button type="button" href="#"   class="btn btn-xs btn-info">
                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal">Yes</a>
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">No</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="myModalRej" class="modal fade" style="display: none;">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                        <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                      </div> -->
                      <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS? </p></center>
                      </div>
                      <div class="modal-footer">
                         <div class="text-center">
                        <button type="button" href="#"   class="btn btn-info">
                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rej">Yes</a>
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div>


        </div>
<div class="box mt3">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
        <th class="chy" style="padding:5px!important;"><input type="checkbox" class="minimal1 deleteallbutton" name="select_all"></th>
         <th class="srno">SR.NO</th>
         <th>CLIENT NAME</th>
         <th>GSTIN</th>
         <th>PAN</th>
         <th>CIN</th>
         <th class="act">ACTION</th>
      </tr>
      </thead>
      <tbody>
      <!-- <tr>
        <td>4</td>
        <td><span class="text-info" data-toggle="modal" data-target="#myModal">cybuzzc sharma cybuzzsc lakhan pvt ltd.</span></td>
        <td>Win9554665755656645</td>
        <td>Win9536567457545664</td>
        <td>r79879879789ahu</td>

         <td><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button>&nbsp<button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></td>

      </tr> -->
                               
                                @forelse ($approveclient as $key => $value)
                                <?php $val = @json_encode($value,true); ?>

                                  <tr>
                                    <td>
                                     <input type="checkbox" name="select_all" value="{{ $value->id }}" class="minimal1 @if($value->client_app_status =='1' ||$value->client_app_status =='2') @else deletedbutton @endif" @if($value->client_app_status =='1' ||$value->client_app_status =='2') disabled @endif><span class=""></span>
                                     </td>

                                    <td>

                                      <div class="text-center">{{$key+$approveclient->firstItem()}}</div>
                                      </td>
                                    <td class="text-center"><a href="/basic/{{$value->id}}/view" id="pop">{{$value->company_name}}</a></td>
                                    <td class="text-center">{{$value->gstin}}</td>
                                    <td class="text-center">{{$value->pan}}</td>
                                    <td class="text-center">{{$value->cin}}</td>

                                     @if($value->client_app_status =='0')

                                      <td class="text-center">
                                        <a href="/status/{{$value->id}}/approve" ><span class="text-success glyphicon glyphicon-ok"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="/status/{{$value->id}}/reject" ><span class=" text-danger glyphicon glyphicon-remove"></span></a>
                                      </td>
                                    @elseif($value->client_app_status =='1')

                                      <td class="text-center">
                                        <span class="text-primary">APPROVED</span>
                                      </td>
                                    @elseif($value->client_app_status =='2')

                                      <td class="text-center">
                                        <span class="text-danger">REJECTED</span>
                                      </td>
                                    @endif

                                  </tr>
                                
                                @empty 
                                <tr class="alert-danger" ><th colspan='9'>No Data Found.</th></tr>
                            @endforelse

                              </tbody>
                           </table>
                           <div class=" col-md-12">
                            <div class="col-md-6"><br>
                              Total Records: {{ $approveclient->total() }}
                            </div>
                            <div class="col-md-6">
                            <div class=" pull-right">{{$approveclient->links()}}</div>
                          </div>
                        </div>
              </div>
          </div>
    </section>
    <div class="model_contaier"></div>

    @endsection
@section('content_foot')
<script>

function generate_model(approveclient)
{

  $template = `<div class="modal fade " id="modaldetail" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header np m5">
          <button type="button" class="mt5 mr5 close" data-dismiss="modal" style="margin-top:5px;margin-right:5px; color:red;">&times;</button>
          <h4 class="modal-title topheading">View Details</h4>
        </div>
        <div class="modal-body np ml5 mr5 mb5">
            <table class="table table-responsive">
              <tr>
                <td style="padding-left:5px!important;border:1px solid #ddd;width:25%;font-size:13px;" class="text-left">Company Name</td>
                <td class="text-left" style="padding-left:5px!important;font-size:13px;border:1px solid #ddd;">`+ approveclient.company_name +`</td>
              </tr>
              <tr>
                <td style="padding-left:5px!important;font-size:13px;" class="text-left">GSTIN</td>`;
                if(approveclient.gstin!=null){
            $template += `<td class="text-left" style="padding-left:5px!important;font-size:13px;">`+ approveclient.gstin +`</td>`;
              }else
              {
                $template += `<td class="text-left" style="padding-left:5px!important;font-size:13px;">-</td>`;
              }
            $template+= ` </tr>
              <tr>
                <td style="padding-left:5px!important;font-size:13px;" class="text-left">PAN</td>`;
                 if(approveclient.pan!=null){
                $template+= `<td class="text-left" style="padding-left:5px!important;font-size:13px;">`+ approveclient.pan +`</td>`;
                }else
              {
                $template += `<td class="text-left" style="padding-left:5px!important;font-size:13px;">-</td>`;
              }
              $template+= `</tr>
              <tr>
                <td style="padding-left:5px!important;font-size:13px;" class="text-left">CIN</td>`;
              if(approveclient.cin!=null){
                $template+= `<td class="text-left" style="padding-left:5px!important;font-size:13px;">`+ approveclient.cin +`</td>`;
              }
              else
              {
                $template+= `<td class="text-left" style="padding-left:5px!important;font-size:13px;">-</td>`;
              }

              $template+= `</tr>
              <tr>
              <tr>
                <td style="padding-left:5px!important;font-size:13px;" class="text-left"> Primary Email Id</td>
                <td class="text-left" style="padding-left:5px!important;font-size:13px;">`+ approveclient.email +`</td>
              </tr>
                <td style="padding-left:5px!important;font-size:13px;" class="text-left">Primary Contact No.</td>`;
                if(approveclient.pri_contact_no!=null){
                 $template+= `<td class="text-left" style="padding-left:5px!important;font-size:13px;">`+ approveclient.pri_contact_no +`</td>`;
                  }
                  else
                  {
                    $template+= `<td class="text-left" style="padding-left:5px!important;font-size:13px;">-</td>`;
                  }

               $template+= `</tr>

              <tr>
                <td style="padding-left:5px!important;font-size:13px;" class="text-left">Short Id</td>`;
                if(approveclient.short_id!=null){
                $template+= `<td class="text-left" style="padding-left:5px!important;font-size:13px;">`+ approveclient.short_id +`</td>`;
                  }
                  else
                  {
                    $template+= `<td class="text-left" style="padding-left:5px!important;font-size:13px;">-</td>`;
                  }

              $template+= `</tr>
              <tr>
                <td style="padding-left:5px!important;font-size:13px;" class="text-left">Old Sap Code</td>`;
                 if(approveclient.old_sap!=null){
                $template+= `<td class="text-left" style="padding-left:5px!important;font-size:13px;">`+ approveclient.old_sap +`</td>`;
                }
                  else
                  {
                    $template+= `<td class="text-left" style="padding-left:5px!important;font-size:13px;">-</td>`;
                  }
              $template+= `</tr>

              <tr>
                <td style="padding-left:5px!important;font-size:13px;" class="text-left">Sap Code</td>
                <td class="text-left" style="padding-left:5px!important;font-size:13px;">`+ '-' +`</td>
              </tr>

            </table>`;
        if(approveclient.client_app_status==0){
          $template += `<div class="text-center">
                <a href="/status/`+approveclient.id+`/approve" class="btn  btn-info btn-xs">Approve</a>
                <a href="/status/`+approveclient.id+`/reject" class="btn  btn-danger btn-xs">Reject</a>

            </div>`;
        }
        $template += `</div>
      </div>
    </div>
  </div>
  `;
          $('.model_contaier').html($template);
          $('#modaldetail').modal('show')
}

    </script>
    <script>
  $(document).ready(function () {
  $("tr").on('click','#pop',function () {
    $('#modaldetail').modal('show');
  });
});
</script>
  <script>
    $(function () {
        $('input[type="checkbox"].minimal1, input[type="radio"].minimal1').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass   : 'iradio_flat-blue'
      });

    });

    </script>
    <script type="text/javascript">
            $('.deletedbutton').on('ifChecked', function(event) {
              var array = [];
              $('.deletedbutton').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
              $('.selected_status').val(array);
            });
            $('.deletedbutton').on('ifUnchecked', function(event){
              var array = [];
              $('.deletedbutton').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
              $('.selected_status').val(array);
            });
      $(document).delegate('#delete-button-modal','click',function(){
        if(!$(".selected_status").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted").trigger('click');
         return false;
      }
      });
      $(document).delegate('#delete-button-modal-rej','click',function(){
        if(!$(".selected_status").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted-rej").trigger('click');
         return false;
      }
      });

            $(".deleteallbutton").on('ifChecked', function(event) {
                  if($(this).iCheck('check')){
                    $(".deletedbutton").iCheck('check');
                    var array = [];
                    $('.deletedbutton').each(function(){
                      if($(this).iCheck('check')){
                        array.push($(this).val());
                    }
                    });
                    $('.selected_status').val(array);
                  }else{
                      $('.selected_status').val('');
                    $(".deletedbutton").iCheck('uncheck');
                  }
            });
            $('.deleteallbutton').on('ifUnchecked', function(event) {
                $('.selected_status').val('');
                $(".deletedbutton").iCheck('uncheck');
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
    $("#search").keyup(function () {
        var value = this.value.toLowerCase().trim();

        $("table tr").each(function (index) {
            if (!index) return;
            $(this).find("td").each(function () {
                var id = $(this).text().toLowerCase().trim();
                var not_found = (id.indexOf(value) == -1);
                $(this).closest('tr').toggle(!not_found);
                return not_found;
            });
        });
    });
  </script>
@endsection