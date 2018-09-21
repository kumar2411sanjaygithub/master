@extends('theme.layouts.default')
@section('content')
<section class="content-header">
    <h5><label  class="control-label"><u>APPROVE</u> <u>NEW</u> <u>CLIENT</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">APPROVE REQUEST</a></li>
        <li><a href="active">CLIENT</a></li>
        <li><a href="active"><u>NEW</u></a></li>
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
                <input type="text" class="form-control" placeholder="SEARCH" id="input" onkeyup="myFunction()">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
              </div></div>
        </div>
<div class="box">
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover text-center">
      <thead>
      <tr>
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
                                <?php $i=1; ?>
                                @foreach ($approveclient as $key => $value)
                                <?php $val = @json_encode($value,true); ?>

                                  <tr>
                                    <td>

                                      <div class="text-center">{{$i}}</div>
                                      </td>
                                    <td class="text-center"><a href="javascript:void(0)" onclick="generate_model({{ $value }})" id="pop">{{$value->company_name}}</a></td>
                                    <td class="text-center">{{$value->gstin}}</td>
                                    <td class="text-center">{{$value->pan}}</td>
                                    <td class="text-center">{{$value->cin}}</td>

                                     @if($value->client_app_status =='0')

                                      <td class="text-center">
                                        <a href="/status/{{$value->id}}/approve" class="btn  btn-info btn-xs">APPROVE</a>
                                        <a href="/status/{{$value->id}}/reject" class="btn  btn-danger btn-xs">REJECT</a>
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
                                <?php $i++; ?>
                                @endforeach
                    </tbody>
                 </table>
              </div>
          </div>
    </section>
    <div class="model_contaier"></div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
function myFunction() {
  //alert(1);
 var input, filter, table, tr, td, i;
 input = document.getElementById("input");
 filter = input.value.toUpperCase();
 table = document.getElementById("example1");
 tr = table.getElementsByTagName("tr");
 console.log(tr);
 for (i = 0; i < tr.length; i++) {
   td = tr[i].getElementsByTagName("td")[1];
   if (td) {
     if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
       tr[i].style.display = "";
     } else {
       tr[i].style.display = "none";
     }
   }
 }
}
</script>
 <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
  <script>
  $(function () {
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    })

  })

  $(function () {
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
  })
  });
  </script>
    @endsection
