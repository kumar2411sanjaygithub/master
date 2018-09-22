@extends('theme.layouts.default')
@section('content')
<section class="content-header">
               <h5><label  class="control-label"><u>APPROVE NOC DETAILS</u></label></h5>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
                  <li><a href="#">APPROVE REQUEST</a></li>
                  <li><a href="active">CLIENT</a></li>
                  <li><a href="active"><u>EXISTING</u></a></li>
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
                                     <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">NEW</a></li>
                        <li><a data-toggle="tab" href="#menu1">MODIFIED</a></li>
                        <li><a data-toggle="tab" href="#menu2">DELETE</a></li>
                     </ul>
                     <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                           <div class="box">
                              <div class="box-body">
                                 <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right">
                                    <a href="{{url('client/existing')}}"><button type="button" class="btn btn-info btn-xs pull-right mr"><span class="glyphicon glyphicon-forward"></span>BACK TO LIST</button></a>
                                      <button type="button" class="btn  btn-info btn-xs" name="cdw4" id="cdw4">APPROVE ALL</button>
                                       &nbsp&nbsp&nbsp&nbsp&nbsp<button type="button" class="btn  btn-danger btn-xs mlt" name="cde4" id="cde4">REJECT ALL</button>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th class="chy" style="padding:5px!important;"><input type="checkbox"  class="minimal"></th>
                                             <th class="srno vl">SR.NO</th>
                                             <th class="vl">NOC TYPE</th>
                                             <th class="vl">NOC QUANTUM</th>
                                             <th class="vl">VALIDITY FROM</th>
                                             <th class="vl">VALIDITY TO</th>
                                             <th class="vl">NOC PERIPHERY</th>
                                             <th class="vl">FINAL NOC QUANTUM</th>
                                             <th class="vl">POC LOSSES</th>
                                             <th class="vl">STU LOSSES</th>
                                             <th class="vl">DISCOM LOSSES</th>
                                             <th class="vl">FILE NAME</th>
                                             <th class="act vl">ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @isset($Addnocdata)
                                          <?php
                                          $i=1;
                                          ?>
                                          @foreach ($Addnocdata as $key => $value)
                                          <tr>

                                              <td class="vl" style="padding:5px!important;"><input type="checkbox"  class="minimal"></td>
                                               <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $value->noc_type}}</td>
                                               <td class="text-center vl">{{ $value->noc_quantum }}</td>
                                               <td class="text-center vl">{{ $value->validity_from }}</td>
                                               <td class="text-center vl">{{ $value->validity_to }}</td>
                                               <td class="text-center vl">{{ $value->noc_periphery }}</td>
                                               <td class="text-center vl">{{ $value->final_quantum }}</td>
                                               <td class="text-center vl">{{ $value->poc_losses }}</td>
                                               <td class="text-center vl">{{ $value->stu_losses }}</td>
                                               <td class="text-center vl">{{ $value->discom_losses }}</td>
                                               <td class="text-center vl">{{ $value->upload_noc }}</td>
                                             <td class="vl"><a href="/addnoc/{{ $value->id }}/approved/noc_temp"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href="/addnoc/{{ $value->id }}/rejected/noc_temp"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
                                          </tr>
                                        <?php
                                       $i++;
                                       ?>
                                       @endforeach
                                       @endisset
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                           <div class="box">
                              <div class="box-body">
                                 <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right"><button type="button" class="btn  btn-info btn-xs" name="cdr4" id="cdr4">APPROVE ALL</button>
                                       &nbsp&nbsp&nbsp&nbsp&nbsp<button type="button" class="btn  btn-danger btn-xs mlt" name="cdq4" id="cdq4">REJECT ALL</button>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th class="chy" style="padding:5px!important;"><input type="checkbox"  class="minimal"></th>
                                             <th class="srno vl">SR.NO</th>
                                             <th class="vl">FIELD NAME</th>
                                             <th class="vl">CURRENT VALUE</th>
                                             <th class="vl">UPDATED VALUE</th>
                                             <th class="act vl">ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>

                                              @isset($nocData)
                                          <?php
                                          $i=1;
                                           $input_lebels = \App\Common\Languages\ManageClientLang::input_labels();
                                          ?>
                                          @foreach ($nocData as $key => $value)
                                          <tr>

                                                <td class="vl" style="padding:5px!important;"><input type="checkbox"  class="minimal"> </td>
                                               <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $input_lebels[$value->attribute_name]}}</td>
                                               <td class="text-center vl">{{ $value->old_att_value }}</td>
                                               <td class="text-center vl">{{ $value->updated_attribute_value }}</td>
                                             <td class="vl"><a href="/noc/modified/{{ $value->id }}/approved"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href="/noc/modified/{{ $value->id }}/rejected"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
                                          </tr>
                                        <?php
                                       $i++;
                                       ?>
                                       @endforeach
                                       @endisset


                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                           <div class="box">
                              <div class="box-body">
                                <div class="row">
                                   <div class="col-md-2"></div>
                                   <div class="col-md-6"></div>
                                   <div class="col-md-4 text-right"><button type="button" class="btn  btn-info btn-xs" name="cdr4" id="cdr4">APPROVE ALL</button>
                                      &nbsp&nbsp&nbsp&nbsp&nbsp<button type="button" class="btn  btn-danger btn-xs mlt" name="cdq4" id="cdq4">REJECT ALL</button>
                                   </div>
                                </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th class="chy" style="padding:5px!important;"><input type="checkbox"  class="minimal"></th>
                                             <th class="srno">SR.NO</th>
                                             <th class="vl" >NOC TYPE</th>
                                             <th class="vl">NOC QUANTUM</th>
                                             <th class="vl">VALIDITY FROM</th>
                                             <th class="vl">VALIDITY TO</th>
                                             <th class="vl">NOC PERIPHERY</th>
                                             <th class="vl">FINAL NOC QUANTUM</th>
                                             <th class="vl">POC LOSSES</th>
                                             <th class="vl">STU LOSSES</th>
                                             <th class="vl">DISCOM LOSSES</th>
                                             <th class="vl">FILE NAME</th>
                                             <th class="act vl">ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                                @isset($delnocData)
                                                  <?php
                                                  $i=1;
                                                  ?>
                                                  @foreach ($delnocData as $key => $value)


                                                <tr>
                                                  <td class="vl" style="padding:5px!important;"><input type="checkbox"  class="minimal"></td>
                                                  <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $value->noc_type}}</td>
                                               <td class="text-center vl">{{ $value->noc_quantum }}</td>
                                               <td class="text-center vl">{{ $value->validity_from }}</td>
                                               <td class="text-center vl">{{ $value->validity_to }}</td>
                                               <td class="text-center vl">{{ $value->noc_periphery }}</td>
                                               <td class="text-center vl">{{ $value->final_quantum }}</td>
                                               <td class="text-center vl">{{ $value->poc_losses }}</td>
                                               <td class="text-center vl">{{ $value->stu_losses }}</td>
                                               <td class="text-center vl">{{ $value->discom_losses }}</td>
                                               <td class="text-center vl">{{ $value->upload_noc }}</td>
                                                    <td class="text-center vl">

                                                          <a href="/delete_noc/{{ $value->id }}/approved/noc"><button type="button" class="btn  btn-info btn-xs">Approve</button></a>

                                                          <a href="/delete_noc/{{ $value->id }}/rejected/noc"><button type="button" class="btn  btn-danger btn-xs">Reject</button></a>

                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                                ?>

                                            @endforeach
                                          @endisset
                                          </tr>

                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
             <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
             <script>
             $(function () {
                 $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                   checkboxClass: 'icheckbox_flat-blue',
                   radioClass   : 'iradio_flat-blue'
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
 function myFunction() {
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
            @endsection
