@extends('theme.layouts.default')
@section('content')
<section class="content-header">
               <h5><label  class="control-label">APPROVE EXISTING CLIENT REQUEST</label></h5>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
                  <li><a href="#">APPROVE REQUEST</a></li>
                  <li><a href="active">CLIENT</a></li>
                  <li><a href="active">EXISTING</a></li>
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
                        <div class="col-md-12">
                           <div class="input-group input-group-sm">
                              <input type="text" class="form-control" placeholder="SEARCH CLIENT......................." id="input" onkeyup="myFunction()">
                              <span class="input-group-btn">
                              <button type="button" class="btn btn-info btn-flat"><span class="glyphicon glyphicon-search"></span></button>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="row">&nbsp;</div>
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
                                    <div class="col-md-2"><label  class="control-label">NOC DETAILS</label></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right"><input type="checkbox"  class="minimal">&nbsp&nbsp<label  class="control-label">APPROVE ALL</label>
                                       &nbsp&nbsp&nbsp<input type="checkbox" class="minimal">&nbsp&nbsp<label  class="control-label"  >REJECT ALL</label>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th><input type="checkbox"  class="minimal"></th>
                                             <th>NOC TYPE</th>
                                             <th>NOC QUANTUM</th>
                                             <th>VALIDITY FROM</th>
                                             <th>VALIDITY TO</th>
                                             <th>NOC PERIPHERY</th>
                                             <th>FINAL NOC QUANTUM</th>
                                             <th>POC LOSSES</th>
                                             <th>STU LOSSES</th>
                                             <th>DISCOM LOSSES</th>
                                             <th>FILE NAME</th>
                                             <th>ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @isset($Addnocdata)
                                          <?php
                                          $i=1;
                                          ?>
                                          @foreach ($Addnocdata as $key => $value)
                                          <tr>


                                               <td class="text-center">{{ $i }}</td>
                                               <td class="text-center">{{ $value->noc_type}}</td>
                                               <td class="text-center">{{ $value->noc_quantum }}</td>
                                               <td class="text-center">{{ $value->validity_from }}</td>
                                               <td class="text-center">{{ $value->validity_to }}</td>
                                               <td class="text-center">{{ $value->noc_periphery }}</td>
                                               <td class="text-center">{{ $value->final_quantum }}</td>
                                               <td class="text-center">{{ $value->poc_losses }}</td>
                                               <td class="text-center">{{ $value->stu_losses }}</td>
                                               <td class="text-center">{{ $value->discom_losses }}</td>
                                               <td class="text-center">{{ $value->upload_noc }}</td>
                                             <td><a href="/addnoc/{{ $value->id }}/approved/noc_temp"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href="/addnoc/{{ $value->id }}/rejected/noc_temp"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
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
                                    <div class="col-md-2"><label  class="control-label"> NOC DETAILS</label></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right"><input type="checkbox"  class="minimal">&nbsp&nbsp<label  class="control-label">APPROVE ALL</label>
                                       &nbsp&nbsp&nbsp<input type="checkbox" class="minimal">&nbsp&nbsp<label  class="control-label"  >REJECT ALL</label>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th><input type="checkbox"  class="minimal">Sr.no</th>

                                             <th>FIELD NAME</th>
                                             <th>CURRENT VALUE</th>
                                             <th>UPDATED VALUE</th>
                                             <th>ACTION</th>
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


                                               <td class="text-center">{{ $i }}</td>
                                               <td class="text-center">{{ $input_lebels[$value->attribute_name]}}</td>
                                               <td class="text-center">{{ $value->old_att_value }}</td>
                                               <td class="text-center">{{ $value->updated_attribute_value }}</td>
                                             <td><a href="/noc/modified/{{ $value->id }}/approved"><button type="button" class="btn  btn-info btn-xs" name="cd4" id="cd4">APPROVE</button></a>&nbsp<a href="/noc/modified/{{ $value->id }}/rejected"><button type="button" class="btn  btn-danger btn-xs" name="re1" id="re1">REJECT</button></a></td>
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
                                    <div class="col-md-2"><label  class="control-label"> NOC DETAILS</label></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right"><input type="checkbox"  class="minimal">&nbsp&nbsp<label  class="control-label">APPROVE ALL</label>
                                       &nbsp&nbsp&nbsp<input type="checkbox" class="minimal">&nbsp&nbsp<label  class="control-label"  >REJECT ALL</label>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th><input type="checkbox"  class="minimal"></th>
                                             <th>NOC TYPE</th>
                                             <th>NOC QUANTUM</th>
                                             <th>VALIDITY FROM</th>
                                             <th>VALIDITY TO</th>
                                             <th>NOC PERIPHERY</th>
                                             <th>FINAL NOC QUANTUM</th>
                                             <th>POC LOSSES</th>
                                             <th>STU LOSSES</th>
                                             <th>DISCOM LOSSES</th>
                                             <th>FILE NAME</th>
                                             <th>ACTION</th>
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
                                                    <td class="text-center">{{ $i }}</td>
                                               <td class="text-center">{{ $value->noc_type}}</td>
                                               <td class="text-center">{{ $value->noc_quantum }}</td>
                                               <td class="text-center">{{ $value->validity_from }}</td>
                                               <td class="text-center">{{ $value->validity_to }}</td>
                                               <td class="text-center">{{ $value->noc_periphery }}</td>
                                               <td class="text-center">{{ $value->final_quantum }}</td>
                                               <td class="text-center">{{ $value->poc_losses }}</td>
                                               <td class="text-center">{{ $value->stu_losses }}</td>
                                               <td class="text-center">{{ $value->discom_losses }}</td>
                                               <td class="text-center">{{ $value->upload_noc }}</td>
                                                    <td class="text-center">

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
