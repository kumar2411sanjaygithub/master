@extends('theme.layouts.default')
@section('content')
<section class="content">
  <form method="post" action="{{route('addservices',['id' => $client_id])}}">
     {{ csrf_field() }}
   <div class="row">
      <div class="col-xs-12">
         <div class="row">
            <div class="col-md-8">
               <h5><label class="control-label"><u>SET EMAIL/SMS ALERT</u>&nbsp&nbsp&nbsp&nbsp {{$client->company_name}}</label></h5>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-1" style="margin-left:-30px;"><a href="/contactdetails/{{$client_id}}" class="btn btn-info btn-xs mt7">
               </span><span class="glyphicon glyphicon-forward"></span>&nbsp; BACK TO LIST
               </a>
            </div>
         </div>
         <div class="box mt3">
            <div class="box-header">
              @if(session()->has('message'))
               <div class="alert alert-success alert-dismissible fade in">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-ok"></span> &nbsp;{{ session()->get('message') }}
               </div>
               @endif
            </div>
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
                     @isset($alert_type)
                     <?php
                        $input_lebels = \App\Common\Languages\ManageClientLang::input_labels();
                        ?>
                     @foreach ($alert_type as $key => $value)
                     <tr>
                        <td><input type="hidden" value="{{ $input_lebels[$value->alert_type] }}" name="alert_type">{{ $input_lebels[$value->alert_type] }}</td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="dam_iex_sms"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="dam_iex_email"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="dam_pxil_sms"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="dam_pxil_email"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="tam_iex_sms"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="tam_iex_email"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="tam_pxil_sms"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="tam_pxil_email"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="rec_iex_sms"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="rec_iex_email"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="rec_pxil_sms"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="rec_pxil_email"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="ec_iex_sms"></td>
                        <td><input type="checkbox" class="minimal" value="Yes" name="ec_iex_email"></td>
                     </tr>
                     @endforeach
                     @endisset
                  </tbody>
               </table>
            </div>
            <div class="row">
               <div class="col-md-12">
                <div class="col-md-12">
                 <div class="text-right"><button type="submit" class="btn btn-info btn-xs">SAVE</button></div>
               </div>
               </div>
          </div>
            <div class="row">&nbsp;</div>
      </div>
   </div>
</form>
</section>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
   $(function () {
       $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
       checkboxClass: 'icheckbox_minimal-blue',
       radioClass   : 'iradio_minimal-blue'
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
