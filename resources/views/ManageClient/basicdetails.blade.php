@extends('theme.layouts.default')
@section('content')
   <section class="content-header">
      <h5><label  class="control-label"><u>ADD CLIENT</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE CLIENT</a></li>
        <li class="#">CLIENT BASIC DETAILS</li>
        <li class="active"><u>ADD CLIENT</u></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2 text-right"><a href="" class="btn btn-info btn-xs">
           <span class="glyphicon glyphicon-plus"></span>&nbspBACK TO LIST
         </a></div></div>

         @if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
@endif

         <form method="post" action="/client/saveclient">
          {{ csrf_field() }}
            <div class="box" >

            <div class="box-body">
            <h5><label  class="control-label"><u>CLIENT DETAILS</u></label></h5>
            <div class="row">
              <div class="col-md-3 {{ $errors->has('company_name') ? 'has-error' : '' }}">
              <label  class="control-label">COMPANY NAME</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER COMPANY NAME" name="company_name" id="company_name">
               <span class="text-danger">{{ $errors->first('company_name') }}</span>
              </div>
              <div class="col-md-3">
              <label  class="control-label">GSTIN</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER GSTIN" name="gstin" id="gstin">
              </div>
              <div class="col-md-3">
            <label  class="control-label">PAN</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER PAN NUMBER" name="pan" id="pan">
              </div>
              <div class="col-md-3">
            <label  class="control-label">CIN</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER CIN NUMBER" name="cin" id="cin">
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
            <label  class="control-label">PRIMARY CONTACT NUMBER</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER PRIMARY CONTACT NUMBER" name="pri_contact_no" id="pri_contact_no">
              </div>
              <div class="col-md-3">
            <label  class="control-label">PRIMARY EMAIL ID</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER PRIMARY MAIL ID"name="email" id="email">
              </div>
              <div class="col-md-3">
              <label  class="control-label">SHORT ID</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER SHORT ID" name="short_id" id="short_id">
              </div>
              <div class="col-md-3">
              <label  class="control-label">OLD SAP CODE</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER OLD SAP CODE" name="old_sap" id="old_sap" >
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
            <label  class="control-label">SAP CODE</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER SAP CODE" name="new_sap" id="new_sap">
              </div>
              <div class="col-md-3">
            <label  class="control-label">CRN</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER CRN NUMBER" name="crn_no" id="crn_no">
              </div>
            </div>
          <hr>
          <h5><label  class="control-label"><u>REGISTERED OFFICE ADDRESS</u></label></h5>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">LINE-1</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder=".ENTER ADDRESS1" name="reg_line1" id="reg_line1">
              </div>
              <div class="col-md-3">
              <label  class="control-label">LINE-2</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS2"  name="reg_line2" id="reg_line2">
              </div>
              <div class="col-md-3">
              <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
              <select class="form-control input-sm" style="width: 100%;" id="reg_country" name="reg_country">
                  <option selected="selected"> SELECT COUNTRY</option>
                 <option>INDIA</option>

                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
              <select class="form-control input-sm" style="width: 100%;"id="reg_state" name="reg_state">

                  <option value="">SELECT STATE</option>
          <?php
          $state_list = \App\Common\StateList::get_states();
          ?>
          @foreach($state_list as $state_code=>$state_ar)
           <option value="{{$state_code}}" {{ isset($clientData) && $clientData->reg_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
          @endforeach


                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">CITY</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" name="reg_city" id="reg_city" value="">
              </div>
              <div class="col-md-3">
            <label  class="control-label">PIN CODE</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER PIN CODE" id="reg_pin" name="reg_pin">
              </div>
              <div class="col-md-3">
            <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
                <input class="form-control input-sm" type="text" placeholder="ENTER MOBILE NUMBER"  id="reg_mob" name="reg_mob">
              </div>
              <div class="col-md-3">
            <label  class="control-label">TELEPHONE</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER TELEPHONE NUMBER" id="reg_telephone" name="reg_telephone">
              </div>
            </div>
          <div class="row">
            <div class="col-md-2">
          <h5><label  class="control-label"><u>BILLING ADDRESS</u></label></h5>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-5 text-right" style="margin-top:10px;">
          <input type="checkbox" class="minimal">&nbsp<span>SAME AS REGISTERED OFFICE ADDRESS</span>
        </div>
      </div>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">LINE-1</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder=".ENTER ADDRESS1" id="bill_line1" name="bill_line1">
              </div>
              <div class="col-md-3">
              <label  class="control-label">LINE-2</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS2" id="bill_line2" name="bill_line2">
              </div>
              <div class="col-md-3">
              <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
              <select class="form-control input-sm" style="width: 100%;" id="bill_country" name="bill_country">
                  <option selected="selected">India</option>


                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
              <select class="form-control input-sm" style="width: 100%;" id="bill_state" name="bill_state">
                  <option selected="selected">PLEASE SELECT</option>
                  <?php
          $state_list = \App\Common\StateList::get_states();
          ?>
          @foreach($state_list as $state_code=>$state_ar)
           <option value="{{$state_code}}" {{ isset($clientData) && $clientData->reg_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
          @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">CITY</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" style="width: 100%;" id="bill_city" name="bill_city">


              </div>
              <div class="col-md-3">
            <label  class="control-label">PIN CODE</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER PIN CODE" id="bill_pin" name="bill_pin">
              </div>
              <div class="col-md-3">
            <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
                <input class="form-control input-sm" type="text" placeholder="ENTER MOBILE NUMBER" id="bill_mob" name="bill_mob">
              </div>
              <div class="col-md-3">
            <label  class="control-label">TELEPHONE</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER TELEPHONE NUMBER"id="bill_telephone" name="bill_telephone">
              </div>
            </div>

        <hr>
          <div class="row">
            <div class="col-md-2">
        <h5><label  class="control-label"><u>DELIVERY ADDRESS</u></label></h5>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-5 text-right">
      <input type="checkbox" class="minimal">&nbsp<span>SAME AS BILLING ADDRESS</span>
        </div>
      </div>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">LINE-1</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder=".ENTER ADDRESS1" id="del_lin1" name="del_lin1">
              </div>
              <div class="col-md-3">
              <label  class="control-label">LINE-2</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS2" id="del_lin2" name="del_lin2">
              </div>
              <div class="col-md-3">
              <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
              <select class="form-control input-sm" style="width: 100%;" id="del_country" name="del_country">
                  <option selected="selected">India</option>


                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
              <select class="form-control input-sm" style="width: 100%;" id="del_state" name="del_state">
                  <option selected="selected">PLEASE SELECT</option>

                  <?php
          $state_list = \App\Common\StateList::get_states();
          ?>
          @foreach($state_list as $state_code=>$state_ar)
           <option value="{{$state_code}}" {{ isset($clientData) && $clientData->reg_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
          @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">CITY</label>
              <input class="form-control input-sm" style="width: 100%;" id="del_city" name="del_city">

              </div>
              <div class="col-md-3">
            <label  class="control-label">PIN CODE</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER PIN CODE" id="del_pin" name="del_pin">
              </div>
              <div class="col-md-3">
            <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
                <input class="form-control input-sm" type="text" placeholder="ENTER MOBILE NUMBER" id="del_mob" name="del_mob">
              </div>
              <div class="col-md-3">
            <label  class="control-label">TELEPHONE</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER TELEPHONE NUMBER" id="del_telephone" name="del_telephone">
              </div>
            </div>
            <hr>
            <h5><label  class="control-label"><u>EXCHANGE DETAILS</u></label></h5>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">IEX CLIENT NAME</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER CLIENT NAME" id="iex_client_name" name="iex_client_name">
              </div>
              <div class="col-md-3">
              <label  class="control-label">IEX PORTFOLIO CODE</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER PORTFOLIO CODE"  id="iex_portfolio" name="iex_portfolio">
              </div>
              <div class="col-md-3">
              <label  class="control-label">IEX STATUS</label>
              <select class="form-control input-sm " style="width: 100%;"  id="iex_status" name="iex_status">
                  <option selected="selected">PLEASE SELECT</option>

                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">PXIL CLIENT NAME</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER CLIENT NAME"  id="pxil_client_name" name="pxil_client_name">
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">PXIL PORTFOLIO CODE</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER PORTDOLIO CODE" id="pxil_portfolio" name="pxil_portfolio">
              </div>
              <div class="col-md-3">
            <label  class="control-label">PXIL STATUS</label>
            <select class="form-control input-sm" style="width: 100%;" id="pxil_status" name="pxil_status">
                <option selected="selected">PLEASE SELECT</option>

              </select>
              </div>
              <div class="col-md-3">
            <label  class="control-label">IEX REGION</label>
            <select class="form-control input-sm" style="width: 100%;"id="iex_region" name="iex_region">
                <option selected="selected">PLEASE SELECT</option>
                <option>ALASKA</option>
                <option>CALIFONIA</option>
              </select>
              </div>
              <div class="col-md-3">
            <label  class="control-label">PXIL REGION</label>
            <select class="form-control input-sm" style="width: 100%;" id="pxil_region" name="pxil_region">
                <option selected="selected">PLEASE SELECT</option>

              </select>
              </div>
            </div>
           <hr>
          <h5><label  class="control-label"><u>CONNECTION DETAILS</u></label></h5>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">STATE TYPE</label>
              <select class="form-control input-sm" style="width: 100%;" id="state_type" name="state_type">
                  <option selected="selected">PLEASE SELECT</option>
                  <option>intra state </option>
                  <option>inter state</option>

                </select>
              </div>
               <div class="col-md-3">
            <label  class="control-label">STATE(For NOC)</label>
            <select class="form-control input-sm" style="width: 100%;" name="conn_state" id="conn_state">
                <option selected="selected">PLEASE SELECT</option>
                <?php
          $state_list = \App\Common\StateList::get_states();
          ?>
          @foreach($state_list as $state_code=>$state_ar)
           <option value="{{$state_code}}" {{ isset($clientData) && $clientData->reg_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
          @endforeach
              </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">DISCOM</label>
              <select class="form-control input-sm" style="width: 100%;" id="discom" name="discom">
                  <option value=''>PLEASE SELECT</option>
                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">VOLTAGE LEVEL</label>
              <select class="form-control input-sm" style="width: 100%;" id="voltage" name="voltage">
                  <option value=''>PLEASE SELECT</option>
                </select>
              </div>


            </div>
            <div class="row">
              <div class="col-md-12"></div>
            </div>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">PART OF INTERCONNECTION</label>
              <div class="form-group">
                <div class="col-md-4 pull-left">
                    <input type="checkbox" class="flat-red pull-left" id="inter_discom" name="inter_discom"><span class="pull-left" >DISCOM</span>
                  </div>
                <div class="col-md-3 pull-left">
                    <input type="checkbox" class="flat-red" id="inter_stu" name="inter_stu"><span  class="pull-left">STU</span>
                </div>
               <div class="col-md-4 pull-Left">
                     <input type="checkbox" class="flat-red" id="inter_poc" name="inter_poc"><span  class="pull-left">POC/CTU</span>
                </div>
              </div>
              </div>
              <div class="col-md-3">
            <label  class="control-label">DOES BELONG TO COMMON FEEDER</label>
            <div class="form-group">
              <div class="col-md-6 pull-left">
                  <input type="radio" class="flat-red" name="rt" id="rt"><span  class="pull-left">YES</span>
              </div>
             <div class="col-md-6 pull-Left">
                   <input type="radio" class="flat-red" name="rt" id="rt1"><span  class="pull-left">NO</span>
              </div>
            </div>
              </div>
              <div class="col-md-3">
            <label  class="control-label">FEEDER NAME</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER FEEDER NAME" name="feeder_name" id="feeder_name">
              </div>
              <div class="col-md-3">
            <label  class="control-label">FEEDER CODE</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER FEEDER CODE" name="feeder_code" id="feeder_code">
              </div>
            </div>
            <div class="row">

              <div class="col-md-3">
              <label  class="control-label"> NAME OF SUBSTATION</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER SUBSTATION NAME" id="name_of_substation" name="name_of_substation">
              </div>
              <div class="col-md-3">
            <label  class="control-label">MAXIMUM INJECTION QUANTUM</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER INJECTION QUANTUM" name="maxm_injection" id="maxm_injection">
              </div>
              <div class="col-md-3">
            <label  class="control-label">MAXIMUM WITHDRAWAL QUANTUM</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER WITHDRAWAL QUANTUM" name="maxm_withdrawal" id="maxm_withdrawal">
              </div>
            </div>
              <hr>
        <h5><label  class="control-label"><u>FINANCIAL ARRANGEMENT</u></label></h5>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">LATER PAYMENT PENALTY(%)</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER DISCOM" name="payment" id="payment">
              </div>
              <div class="col-md-3">
              <label  class="control-label">PAYMENT OBLIGATION</label>
              <select class="form-control input-sm" style="width: 100%;" name="obligation" id="obligation">
                  <option selected="selected">PLEASE SELECT</option>

                </select>
              </div>
            </div>

           <hr>
              <div class="row">
                 <div class="col-md-5"></div>
                  <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs" id="saveclient">SAVE</button></div>
                  <div class="col-md-1"><a href="{{route('basic.details')}}"><input type="button" class="btn btn-block btn-danger btn-xs"value="Cancel"></a></div>
                <div class="col-md-5"></div>
              </div>
              <div class="row">&nbsp;</div>
              </div>
                </div>
            </div>
    </div>
    </section>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 {{ Html::script('js/client/clientdetails.js') }}
 <script>
 $(document).ready(function(){
   $('#conn_state').on('change', function() {

     var state=this.value;
     if(state!='')
     {
       $.ajax({
           url: '{{ url()->to("noc_discom_s") }}',
           type: 'GET',
           data: {'state':state},
           dataType: 'JSON',
           success: function(data)
           {
             html1='';
             html1+='<option value="">CHOOSE</option>';
             $.each(data.voltage, function(key1, value1){
               html1+='<option value="'+value1+'">'+value1+'</option>';
             });
             $('#voltage').html(html1);

             html='';
             html+='<option value="">CHOOSE</option>';
             $.each(data.discom, function(key, value){
               html+='<option value="'+value+'">'+value+'</option>';
             });
             $('#discom').html(html);
           }
       });
     }
   });

 });
</script>
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
