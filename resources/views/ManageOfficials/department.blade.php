@extends('theme.layouts.default')
@section('content_head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection
@section('content')
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <h5><label  class="control-label"><u>DEPARTMENT LIST</u></label></h5>
         <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li><a href="#">MANAGE EMPLOYEE</a></li>
            <li><a href="active"><u>DEPARTMENT</u></a></li>
         </ol>
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="clearfix"></div>
          <!-- <br> -->
          <!-- success msg -->
          @if(session()->has('message'))
            <div class="alert alert-success mt10">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('message') }}
            </div>
          @endif
          <!-- query validater     -->
          <!-- success msg -->
          @if(session()->has('updatemsg'))
            <div class="alert alert-success  mt10">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('updatemsg') }}
            </div>
          @endif
          <!-- query validater     -->
          <!-- success msg -->
          @if(session()->has('delmsg'))
            <div class="alert alert-success  mt10" >
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('delmsg') }}
            </div>
          @endif
            <form method="post" action="{{ route('departments_create') }}">
             {{ csrf_field() }}
             <div class="row">
                <div class="col-xs-12">
                   <div class="adddeportment box @if($errors->isEmpty())hidden @else  @endif">
                      <div class="box-body">
                        <div class="row">
                            <div class="col-md-3  {{ $errors->has('depatment_name') ? 'has-error' : '' }}">
                               <label  class="control-label">DEPARTMENT NAME<span class="text-danger"><strong>*</strong></span></label>
                               <input class="form-control input-sm" type="text" placeholder="ENTER DEPARTMENT NAME" id="depatment_name" name="depatment_name">
                                <span class="text-danger">{{ $errors->first('depatment_name') }}</span>
                            </div>
                            <div class="col-md-3">
                               <label  class="control-label">DESCRIPTION</label>
                               <input class="form-control input-sm" type="text" placeholder="ENTER DESCRIPTION" id="description" name="description">
                            </div>
                            <div class="col-md-3">
                              <div class="col-md-6" style="margin-top:22px;">
                                  <button type="submit" id= "submitdepartment" class="btn btn-block btn-info btn-xs">SAVE</button>
                              </div>
                              <div class="col-md-6" style="margin-top:22px;">
                                  <a href="{{ route('departments') }}"><input type="button"  class="btn btn-danger btn-block  btn-xs pull-right"value="Cancel"></a>
                              </div>
                            </div>
                        </div>

                      </div>
                    </div>
                </div>
             </div>
                       </form>
             <div class="row">
                <div class="col-md-12">
                  <div class="pull-right mt7">
                    <button type="button" class="btn btn-info btn-xs btn-block adddeportmentbtn "> <span class="glyphicon glyphicon-plus"></span>&nbsp; Add Department</button>
                  </div>
                </div>
             </div>
             <div class="box">
                <div class="box-body table-responsive">
                   <table id="example1" class="table table-bordered table-striped table-hover text-center">
                      <thead class="tablehead">
                            <tr>
                              <th class="text-center srno">SR.NO
                              </th>
                              <th class="text-center ">DEPARTMENT NAME
                              </th>
                              <th class="text-center ">DESCRIPTION</th>
                              <th class="text-center ">CREATED BY</th>
                              <th class="text-center">CREATED DATE</th>
                              <th class="text-center act1">ACTION</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1; ?>
                            @foreach ($Department as $key => $value)
                            <tr>
                              <td class="text-center">{{ $i }}</td>
                              <td class="text-center aks-caps">{{$value->depatment_name}}</td>
                              <td class="text-center">{{$value->description}}</td>
                              <td class="text-center">{{$value->creator_name()}}</td>
                              <td class="text-center">{{@date('d/m/Y',strtotime($value->created_at)) }}</td>

                              <td class="text-center">
                                <a href="/manageofficials/editdepartments/{{$value->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="" data-toggle="modal" data-target="#ConvertData{{ $value->id }}" name="" id="convert-disabled"><span class="glyphicon glyphicon-trash"></span></a>
                              </td>
                              <div id="ConvertData{{ $value->id }}" class="modal fade" role="dialog">
           <form method="GET"  action="{{url('/manageofficials/deletedepartments/'.$value->id)}}">
            {{ csrf_field() }}
           <div class="modal-dialog modal-confirm">
             <div class="modal-content">
               <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                 <h4 class="modal-title text-center"></h4>
               </div>
               <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                 <p style="font-size: 18px;font-weight:400;color:black!important; text-align:center;">Are you sure you want to delete this record?</p>
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
                          <?php $i++; ?>
                            @endforeach
                          </tbody>
                   </table>
                </div>
                <!-- /.box-body -->
             </div>


      
       
     </section>


  <script>
    $(document).ready(function(){
      $(".adddeportmentbtn").click(function(){
        $(".adddeportment").removeClass("hidden");
        $(".adddeportmentbtn").hide();
      });
      $(".card").css("margin-bottom","1px");
    });
  </script>
  <script>

         </script>
          <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
  @endsection
