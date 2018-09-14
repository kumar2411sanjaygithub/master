@extends('theme.layouts.default')
@section('content')
<style type="text/css">
.divhide{
  display: none;
}
.divshow{
  display: block;
}
</style>
     <section class="content-header">
          <h5><label  class="control-label"><u>CONTACT DETAILS</u>&nbsp <small>lakhan pvt. ltd</small></label></h5>
    </section>

    <!-- Main content -->
    <section class="content">
       @if(session()->has('message'))
            <div class="alert alert-success mt10">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('message') }}
            </div>
          @endif
        <!--   @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

          <div class="row">
           <div class="col-xs-12">
            <div class="row">
               <div class="col-md-10"></div>
                <a href="{{ route('basic.details') }}"><input type="button"  class="btn btn-info btn-xs" value=" BACK TO LIST"></a>
              </div>
            </div>
      <form method ="post" action="{{isset($get_contact_details)?url('contact_edit/'.$get_contact_details->id):route('contact_create')}}">
      {{ csrf_field() }}
      <div class="row {{isset($get_contact_details)?'':'divhide'}}" id="contactbox">
        <div class="col-xs-12">
          <div class="box" id="cbox">
           <div class="box-body">
               <div class="row">
                  
      <div class="col-md-3">
      <label  class="control-label">FULL NAME</label><span class="text-danger"><strong>*</strong></span>
      <input type="hidden"  name="client_id" value="{{@$client_id}}" id="client">
    <input class="form-control input-sm" type="text" placeholder="ENTER FULL NAME" id="name" name="name" value="{{isset($get_contact_details)?$get_contact_details->name:old('name')}}">
      </div>
      <div class="col-md-3">
       <label  class="control-label">DESIGNATION</label>
      <input class="form-control input-sm" type="text" placeholder="ENTER DESIGNATION" id="designation" name="designation" value="{{isset($get_contact_details)?$get_contact_details->designation:old('designation')}}">
      </div>
      <div class="col-md-3">
        <label  class="control-label">EMAIL ID</label><span class="text-danger"><strong>*</strong></span>
        <input class="form-control input-sm" type="text" placeholder="ENTER EMAIL ID" id="email" name="email" value="{{isset($get_contact_details)?$get_contact_details->email:old('email')}}">
      </div>
      <div class="col-md-3">
        <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
        <input class="form-control input-sm" type="text" placeholder="ENTER MOBILE NUMBER" id="mob_num" name="mob_num" value="{{isset($get_contact_details)?$get_contact_details->mob_num:old('mob_num')}}">
    </div>
  </div>
     <div class="row">&nbsp;</div>
      <div class="row">
         <div class="col-md-5"></div>
         @if(isset($get_contact_details))
          <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs" id="save" name="save">UPDATE</button></div>
          @else
          <div class="col-md-1"><button type="submit" class="btn btn-block btn-success btn-xs" id="save" name="save">SAVE</button></div>
          @endif
          <div class="col-md-1"><input type="button" class="btn btn-block btn-danger btn-xs" id="bn7" name="bn7" value="Cancel" onclick="myFunction()"></div>
        <div class="col-md-5"></div>
      </div>
      </div>
    </div>
    </div>
  </div>
  </form>

   
               <div class="row">
                  <div class="col-xs-12">
                     
                     <div class="row">
                        <div class="col-md-11"></div>
                        <div class="col-md-1 text-right"><button class="btn btn-info btn-xs"  id="add">
      <span class="glyphicon glyphicon-plus"></span>&nbspADD
    </button></div>
                     </div>
                     <div class="box">
                        <div class="box-body table-responsive">
                           <table class="table table-bordered text-center">
                              <thead>
                                 <tr>
                                    <th>SR.NO</th>
                                    <th>FULL NAME</th>
                                    <th>DESIGNATION</th>
                                    <th>EMAIL ID</th>
                                    <th>MOBILE NUMBER</th>
                                    <th>EMAIL/SMS ALERT</th>
                                    <th>ACTION</th>
                                 </tr>
                              </thead>
                              <tbody>
                                <!--  <tr>
                                    <td>1</td>
                                    <td>AXIX BANK</td>
                                    <td>john</td>
                                    <td>121111111111111</td>
                                    <td>1DFG</td>
                                    <td><a href="#" data-toggle="modal" data-target="#myModal"><u>SET</u></a></td>
                                    <td><a href="edit_contact_details.html"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp<a href="#" class="text-danger"><span class="glyphicon glyphicon-trash "></span></a></td>
                                 </tr> -->
                                 @isset($contactdetails)
                    <?php
                    $i=1;
                    ?>
                    @foreach ($contactdetails as $key => $value)
                      <tr>
                        <td class="text-center">{{ $i }}</td>
                        <td class="text-center">{{ $value->name }}</td>
                        <td class="text-center">{{ $value->designation }}</td>
                        <td class="text-center">{{ $value->email }}</td>
                        <td class="text-center">{{ $value->mob_num }}</td>
                        <td class="text-center" ><button type="button" class="btn" data-toggle="modal" data-target="#btn" value="{{$client_id}}">Set</button></td>
                        <td class="text-center">
                          <a href="{{url('/editcontactdetail/'.$client_id.'/eid/'.$value->id)}}"><span class="glyphicon glyphicon-pencil" id="edit-bank-detail" contact_detail_id="{{ $value->id }}"></span></a>
                          <a href="/delete/contact/{{$value->id}}"><span class="glyphicon glyphicon-trash" id="remove-bank-detail" contact_detail_id="{{ $value->id }}"></span></a>
                        </td>
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
            </div>
          <div class="container" id="btnbtn">
            <div class="modal fade" id="btn" role="dialog">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="mdl">
                     <div class="modal-header">
                        <h5><label  class="control-label"><u>SET EMAIL/SMS ALERT</u>&nbsp <small>lakhan pvt. ltd</small></label><button type="button" class="close pull-right" data-dismiss="modal">&times;</button></h5>

                     </div>
                     <div class="modal-body">
                        <div class="box-body table-responsive">
                           <table class="table table-bordered text-center">
                              <thead>
                                 <tr>
                                    <th></th>
                                    <th colspan="4">DAM</th>
                                    <th colspan="4">TAM</th>
                                    <th colspan="4">REC</th>
                                    <th colspan="4">ESCERTS</th>
                                 </tr>
                                 <tr>
                                    <th rowspan="2" class="text-center">TYPE</th>
                                    <th colspan="2">IEX</th>
                                    <th colspan="2">PXIL</th>
                                    <th colspan="2">IEX</th>
                                    <th colspan="2">PXIL</th>
                                    <th colspan="2">IEX</th>
                                    <th colspan="2">PXIL</th>
                                    <th rowspan="2" class="text-center">EMAIL</th>
                                    <th rowspan="2" class="text-center">SMS</th>
                                 </tr>
                                 <tr>
                                    <th>EMAIL</th>
                                    <th>SMS</th>
                                    <th>EMAIL</th>
                                    <th>SMS</th>
                                    <th>EMAIL</th>
                                    <th>SMS</th>
                                    <th>EMAIL</th>
                                    <th>SMS</th>
                                    <th>EMAIL</th>
                                    <th>SMS</th>
                                    <th>EMAIL</th>
                                    <th>SMS</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>

                                  @isset($alert_type)
                                  <?php
                                  $input_lebels = \App\Common\Languages\ManageClientLang::input_labels();
                                  ?>
                                  @foreach ($alert_type as $key => $value)
                                 
                                    @if($value->segment = 'DAM')
                                    <td>{{ $input_lebels[$value->alert_type] }}</td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                 </tr>
                                @elseif($value->segment = 'obligation')
                                <td>{{ $input_lebels[$value->alert_type] }}</td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    <td><input type="checkbox" class="minimal"></td>
                                    @endif
                                 @endforeach
                              @endisset
                              </tbody>
                           </table>
                        </div>
                        
                     </div>
                     <div class="modal-footer">
                        <div class="row">&nbsp;</div>
                        <div class="row">
                           <div class="col-md-4"></div>
                           <div class="col-md-2"><button type="button" class="btn btn-block btn-info btn-xs">SAVE</button></div>
                           <!-- <div class="col-md-2"><button type="button" class="btn btn-block btn-danger btn-xs" onclick="closed()">CANCEL</button></div> -->
                           <div class="col-md-4"></div>
                        </div>
                        <div class="row">&nbsp;</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
          </section>
          <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script>
    
     $(document).ready(function(){
      $('#add').on('click', function(){
      $('#contactbox').removeClass('divhide').addClass('divshow');
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
  // function myFunction(){
  //   alert(1);
  //   $('#contactbox').addClass('divhide');
  // }
  </script>
  

  
            @endsection