@extends('theme.layouts.default')
@section('content')
 <section class="content-header">
          <h5><label  class="control-label"><u>SET EMAIL/SMS ALERT</u>&nbsp <small>lakhan pvt. ltd</small></label></h5>
    </section>

                       <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="row">
               <div class="col-md-1"></div>
               <div class="col-md-9"></div>
               <div class="col-md-2 text-right"><a href="clientbasicdetails.html" class="btn btn-info btn-xs">
            </span>&nbsp BACK TO LIST
              </a></div>
          </div>
      



<div class="box">
  <div class="box-header">

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
                                 @endforeach
                              @endisset
    
   
  </tbody>
</table>
  </div>

<div class="row">&nbsp;</div>
 <div class="row">
    <div class="col-md-5"></div>
     <div class="col-md-1"><button type="button" class="btn btn-block btn-info btn-xs">SAVE</button></div>
     <div class="col-md-1"><button type="button" class="btn btn-block btn-danger btn-xs">CANCEL</button></div>
   <div class="col-md-5"></div>
 </div>
 <div class="row">&nbsp;</div>
 </div>

    </div>
  </div>
    </section>            
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
         <script>


</script>
         @endsection