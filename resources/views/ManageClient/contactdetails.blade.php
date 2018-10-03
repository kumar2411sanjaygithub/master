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


    <!-- Main content -->
    <section class="content">
          @if (count($errors) > 0 && $errors->has('pending'))
            <div class="alert alert-danger">
                <ul>
                   <li>{{ $errors->first('pending') }}</li>
                </ul>
            </div>
         @endif


          <div class="row">
            <div class="col-md-6 pull-left">
                <h5 class="pull-left"><label class="control-label pull-right mt-1"><u>CONTACT DETAILS</u></h5> &nbsp;&nbsp;&nbsp; {{$client_details[0]['company_name']}}<span class="hifan">|</span> {{$client_details[0]['crn_no']}} <span class="hifan">|</span> {{$client_details[0]['iex_portfolio']}}<span class="hifan">|</span> {{$client_details[0]['pxil_portfolio']}}</label>
            </div>
            <div class="col-md-6 pull-right">
                <a href="{{ route('basic.details') }}"><button  class="btn btn-info btn-xs mt7 pull-right" value=" BACK TO LIST"><span class="glyphicon glyphicon-forward"></span>&nbsp;BACK TO LIST</button></a>
                <button class="btn btn-info btn-xs mt7 pull-right mr5 {{(isset($get_contact_details)||!$errors->isEmpty())?'divhide':''}}" id="add"><span class="glyphicon glyphicon-plus"></span>&nbspADD</button>

            </div>
          </div>

       @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <span class="glyphicon glyphicon-ok"></span> &nbsp;{{ session()->get('message') }}
        </div>
        @endif
      <form method ="post" action="{{isset($get_contact_details)?url('contact_edit/'.$get_contact_details->id):route('contact_create')}}">
      {{ csrf_field() }}
      <div class="row {{(isset($get_contact_details)||!$errors->isEmpty())?'':'divhide'}}" id="contactbox">
        <div class="col-xs-12">
        <div class="box mt3" id="cbox">
           <div class="box-body">
      <div class="row ">
      <div class="col-md-3 {{ $errors->has('name') ? 'has-error' : '' }}">
      <label  class="control-label">FULL NAME</label><span class="text-danger"><strong>*</strong></span>
      <input type="hidden" valid name="client_id" value="{{@$client_id}}" id="client">
    <input class="form-control input-sm" type="text" placeholder="ENTER FULL NAME" id="name" name="name" value="{{isset($get_contact_details)?$get_contact_details->name:old('name')}}">
    <span class="text-danger">{{ $errors->first('name') }}</span>
      </div>
      <div class="col-md-3 {{ $errors->has('designation') ? 'has-error' : '' }}">
       <label  class="control-label">DESIGNATION<span class="text-danger"><strong>*</strong></span></label>
      <input class="form-control input-sm" type="text" placeholder="ENTER DESIGNATION" id="designation" name="designation" value="{{isset($get_contact_details)?$get_contact_details->designation:old('designation')}}">
      <span class="text-danger">{{ $errors->first('designation') }}</span>
      </div>
      <div class="col-md-3 {{ $errors->has('email') ? 'has-error' : '' }}">
        <label  class="control-label">EMAIL ID</label><span class="text-danger"><strong>*</strong></span>
        <input class="form-control input-sm" type="text" placeholder="ENTER EMAIL ID" id="email" name="email" value="{{isset($get_contact_details)?$get_contact_details->email:old('email')}}">
        <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>
      <div class="col-md-3  {{ $errors->has('mob_num') ? 'has-error' : '' }}">
        <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
        <input class="form-control input-sm num" maxlength="10" type="text" placeholder="ENTER MOBILE NUMBER" id="mob_num" name="mob_num" value="{{isset($get_contact_details)?$get_contact_details->mob_num:old('mob_num')}}">
        <span class="text-danger">{{ $errors->first('mob_num') }}</span>
    </div>
  </div>
     <div class="row">&nbsp;</div>
      <div class="row">
         <div class="col-md-10"></div>
         @if(isset($get_contact_details))
          <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs" id="save" name="save">UPDATE</button></div>
          @else
          <div class="col-md-1"><button type="submit" class="btn btn-block btn-success btn-xs" id="save" name="save">SAVE</button></div>
          @endif
          <div class="col-md-1"><a href="{{ URL('/contactdetails/'.$client_id) }}" ><input type="button" class="btn btn-block btn-danger btn-xs" id="bn7" name="bn7" value="CANCEL"></a></div>
       
      </div>
      </div>
    </div></div></div>
    </form>





               <div class="row">
                  <div class="col-xs-12">
                     <div class="box mt3">
                        <div class="box-body table-responsive">
                           <table class="table table-bordered text-center table-striped table-hover table-condensed">
                              <thead>
                                 <tr>
                                    <th class="srno">SR.NO</th>
                                    <th>FULL NAME</th>
                                    <th>DESIGNATION</th>
                                    <th>EMAIL ID</th>
                                    <th>MOBILE NUMBER</th>
                                    <th>EMAIL/SMS ALERT</th>
                                    <th class="act1">ACTION</th>
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
                                 
                  @forelse ($contactdetails as $key => $value)
                      <tr>
                        <td class="text-center">{{$key+$contactdetails->firstItem()}}</td>
                        <td class="text-center">{{ $value->name }}</td>
                        <td class="text-center">{{ $value->designation }}</td>
                        <td class="text-center">{{ $value->email }}</td>
                        <td class="text-center">{{ $value->mob_num }}</td>
                        <td class="text-center" style="width:9%;" ><a href="/service/contact/{{$value->client_id}}" ><u>SET</u></a></td>
                        <td class="text-center">
                          <a href="{{url('/editcontactdetail/'.$client_id.'/eid/'.$value->id)}}"><span class="glyphicon glyphicon-pencil" id="edit-bank-detail" contact_detail_id="{{ $value->id }}"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="/delete/contact/{{$value->id}}"><span class="glyphicon glyphicon-trash text-danger" id="remove-bank-detail" contact_detail_id="{{ $value->id }}"></span></a>
                        </td>
                      </tr>
                       @empty
                            <tr class="alert-danger" ><th colspan='9'>No Data Found.</th></tr>
                            @endforelse

                              </tbody>
                           </table>

                           <div class=" col-md-12">
                            <div class="col-md-6"><br>
                              Total Records: {{ $contactdetails->total() }}
                            </div>
                            <div class="col-md-6">
                            <div class=" pull-right">{{$contactdetails->links()}}</div>
                          </div>
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
      $("#add").hide();
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
  function myFunction(){
    //alert(1);
    $('#contactbox').addClass('divhide').removeClass('divshow');
     $("#add").show();
  }
  </script>
  <script>
  // function closed(){
  //   alert(1);
  //   $('#modal').('hide');
  // }
  </script>

@endsection
