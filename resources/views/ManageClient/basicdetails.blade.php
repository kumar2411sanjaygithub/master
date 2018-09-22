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
               <div class="col-md-11"></div>
               <div class="col-md-1 " style="margin-left:-29px!important;"><a href="{{ route('basic.details') }}"><button  class="btn btn-info btn-xs" value=" BACK TO LIST"><span class="glyphicon glyphicon-forward"></span>&nbsp;BACK TO LIST</button></a></div>
          </div>


         <form method="post" action="/client/saveclient">
          {{ csrf_field() }}
            <div class="box" >

            <div class="box-body">
            <h5><label  class="control-label"><u>CLIENT DETAILS</u></label></h5><hr>
            <div class="row">
              <div class="col-md-3 {{ $errors->has('company_name') ? 'has-error' : '' }}">
              <label  class="control-label">COMPANY NAME</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER COMPANY NAME" name="company_name" id="company_name" value="{{old('company_name')}}">
               <span class="text-danger">{{ $errors->first('company_name') }}</span>
              </div>
              <div class="col-md-3  {{ $errors->has('gstin') ? 'has-error' : '' }}">
              <label  class="control-label">GSTIN</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER GSTIN" name="gstin" id="gstin" value="{{old('gstin')}}">
               <span class="text-danger">{{ $errors->first('gstin') }}</span>
              </div>
              <div class="col-md-3  {{ $errors->has('pan') ? 'has-error' : '' }}">
            <label  class="control-label">PAN</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER PAN NUMBER" name="pan" id="pan" value="{{old('pan')}}">
               <span class="text-danger">{{ $errors->first('pan') }}</span>
              </div>
              <div class="col-md-3 {{ $errors->has('cin') ? 'has-error' : '' }}">
            <label  class="control-label">CIN</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER CIN NUMBER" name="cin" id="cin" value="{{old('cin')}}">
               <span class="text-danger">{{ $errors->first('cin') }}</span>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3  {{ $errors->has('pri_contact_no') ? 'has-error' : '' }}">
            <label  class="control-label">PRIMARY CONTACT NUMBER</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm num" type="text" placeholder="ENTER PRIMARY CONTACT NUMBER" name="pri_contact_no" id="pri_contact_no" value="{{old('pri_contact_no')}}">
               <span class="text-danger">{{ $errors->first('pri_contact_no') }}</span>
              </div>
              <div class="col-md-3 {{ $errors->has('email') ? 'has-error' : '' }}">
            <label  class="control-label">PRIMARY EMAIL ID</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER PRIMARY MAIL ID"name="email" id="email" value="{{old('email')}}">
               <span class="text-danger">{{ $errors->first('email') }}</span>
              </div>
              <div class="col-md-3">
              <label  class="control-label">SHORT ID</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER SHORT ID" name="short_id" id="short_id" value="{{old('short_id')}}">
              </div>
              <div class="col-md-3">
              <label  class="control-label">OLD SAP CODE</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER OLD SAP CODE" name="old_sap" id="old_sap" value="{{old('short_id')}}" >
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
            <label  class="control-label">SAP CODE</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER SAP CODE" name="new_sap" id="new_sap" value="{{old('new_sap')}}">
              </div>
              <!-- <div class="col-md-3">
                <label  class="control-label">CRN</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER CRN NUMBER" name="crn_no" id="crn_no" value="{{old('crn_no')}}">
              </div> -->
            </div>

          <h5><label  class="control-label"><u>REGISTERED OFFICE ADDRESS</u></label></h5>  <hr>
            <div class="row">
              <div class="col-md-3 {{ $errors->has('reg_line1') ? 'has-error' : '' }}">
              <label  class="control-label">LINE-1</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS LINE-1" name="reg_line1" id="reg_line1" value="{{old('reg_line1')}}">
              <span class="text-danger">{{ $errors->first('reg_line1') }}</span>
              </div>
              <div class="col-md-3">
              <label  class="control-label">LINE-2</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS LINE-2"  name="reg_line2" id="reg_line2" value="{{old('reg_line2')}}">
              </div>
              <div class="col-md-3 {{ $errors->has('reg_country') ? 'has-error' : '' }}">
              <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
              <select class="form-control input-sm" style="width: 100%;" id="reg_country" name="reg_country" value="{{old('reg_country')}}">
                 <option value="">SELECT</option>
                 <option value="India">India</option>

                </select>
              </div>
              <div class="col-md-3 {{ $errors->has('reg_state') ? 'has-error' : '' }}">
              <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
              <select class="form-control input-sm" style="width: 100%;"id="reg_state" name="reg_state" value="{{old('reg_state')}}">
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
              <div class="col-md-3 {{ $errors->has('reg_city') ? 'has-error' : '' }}">
              <label  class="control-label">CITY</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" name="reg_city" id="reg_city" value="{{old('reg_city')}}">
              <span class="text-danger">{{ $errors->first('reg_city') }}</span>
              </div>
              <div class="col-md-3 {{ $errors->has('reg_pin') ? 'has-error' : '' }}">
            <label  class="control-label">PIN CODE</label><span class="text-danger"><strong>*</strong></span>
                <input class="form-control input-sm num" maxlength="6" type="text" placeholder="ENTER PIN CODE" id="reg_pin" name="reg_pin" value="{{old('reg_pin')}}">
                <span class="text-danger">{{ $errors->first('reg_pin') }}</span>
              </div>
              <div class="col-md-3 {{ $errors->has('reg_mob') ? 'has-error' : '' }}">
            <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
                <input class="form-control input-sm num" maxlength="10" type="text" placeholder="ENTER MOBILE NUMBER"  id="reg_mob" name="reg_mob" value="{{old('reg_mob')}}">
                <span class="text-danger">{{ $errors->first('reg_mob') }}</span>
              </div>
              <div class="col-md-3">
            <label  class="control-label">TELEPHONE</label>
                <input class="form-control input-sm num" maxlength="15" type="text" placeholder="ENTER TELEPHONE NUMBER" id="reg_telephone" name="reg_telephone" value="{{old('reg_telephone')}}">
              </div>
            </div>
            <div class="row">
        <div class="col-md-2">
    <h5><label  class="control-label mt5" ><u>BILLING ADDRESS</u></label></h5>
    </div>

    <div class="col-md-5" style="margin-top:7px;" >
  <input type="checkbox" id="saroa"  class="minimal " style="width:30px!important;height:30px!important;">&nbsp<span><label for="saroa" >SAME AS REGISTERED OFFICE ADDRESS</label></span>
    </div>   <div class="col-md-5"></div>
  </div><hr>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">LINE-1</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS LINE-1" id="bill_line1" name="bill_line1" value="{{old('bill_line1')}}">
              </div>
              <div class="col-md-3">
              <label  class="control-label">LINE-2</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS LINE-2" id="bill_line2" name="bill_line2">
              </div>
              <div class="col-md-3">
              <label  class="control-label">COUNTRY</label>
              <select class="form-control input-sm" style="width: 100%;" id="bill_country" name="bill_country"value="{{old('bill_country')}}">
                  <option value="">SELECT</option>
                  <option value="India">India</option>


                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">STATE</label>
              <select class="form-control input-sm" style="width: 100%;" id="bill_state" name="bill_state" value="{{old('bill_state')}}">
                  <option value="">SELECT</option>
                  <?php
          $state_list = \App\Common\StateList::get_states();
          ?>
          @foreach($state_list as $state_code=>$state_ar)
           <option value="{{$state_code}}" {{ isset($clientData) && $clientData->bill_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
          @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">CITY</label>
              <input class="form-control input-sm" style="width: 100%;" id="bill_city" name="bill_city" value="{{old('bill_city')}}">


              </div>
              <div class="col-md-3">
            <label  class="control-label">PIN CODE</label>
                <input class="form-control input-sm num" maxlength="6" type="text" placeholder="ENTER PIN CODE" id="bill_pin" name="bill_pin"value="{{old('bill_pin')}}">
              </div>
              <div class="col-md-3">
            <label  class="control-label">MOBILE NUMBER</label>
                <input class="form-control input-sm num" maxlength="10" type="text" placeholder="ENTER MOBILE NUMBER" id="bill_mob" name="bill_mob"value="{{old('bill_mob')}}">
              </div>
              <div class="col-md-3">
            <label  class="control-label">TELEPHONE</label>
                <input class="form-control input-sm num" maxlength="15" type="text" placeholder="ENTER TELEPHONE NUMBER"id="bill_telephone" name="bill_telephone" value="{{old('bill_telephone')}}">
              </div>
            </div>


          <div class="row">
            <div class="col-md-2">
        <h5><label  class="control-label mt5" ><u>DELIVERY ADDRESS</u></label></h5>
        </div>
        <div class="col-md-5" style="margin-top:7px;">
      <input type="checkbox" id="saba" class="minimal">&nbsp<span><label for="saba">SAME AS BILLING ADDRESS</label></span>
        </div>   <div class="col-md-5"></div>
      </div><hr>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">LINE-1</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS LINE-1" id="del_lin1" name="del_lin1" value="{{old('del_lin1')}}">
              </div>
              <div class="col-md-3">
              <label  class="control-label">LINE-2</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS LINE-2" id="del_lin2" name="del_lin2" value="{{old('del_lin2')}}">
              </div>
              <div class="col-md-3">
              <label  class="control-label">COUNTRY</label>
              <select class="form-control input-sm" style="width: 100%;" id="del_country" name="del_country" value="{{old('del_country')}}">
                  <option value="">SELECT</option>
                  <option value="India">India</option>
                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">STATE</label>
              <select class="form-control input-sm" style="width: 100%;" id="del_state" name="del_state" value="{{old('del_state')}}">
                  <option value=''>SELECT</option>

                  <?php
          $state_list = \App\Common\StateList::get_states();
          ?>
          @foreach($state_list as $state_code=>$state_ar)
           <option value="{{$state_code}}" {{ isset($clientData) && $clientData->del_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
          @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">CITY</label>
              <input class="form-control input-sm" style="width: 100%;" id="del_city" name="del_city" value="{{old('del_city')}}">

              </div>
              <div class="col-md-3">
            <label  class="control-label">PIN CODE</label>
                <input class="form-control input-sm num" maxlength="6" type="text" placeholder="ENTER PIN CODE" id="del_pin" name="del_pin" value="{{old('del_pin')}}">
              </div>
              <div class="col-md-3">
            <label  class="control-label">MOBILE NUMBER</label>
                <input class="form-control input-sm num" maxlength="10" type="text" placeholder="ENTER MOBILE NUMBER" id="del_mob" name="del_mob" value="{{old('del_mob')}}">
              </div>
              <div class="col-md-3">
            <label  class="control-label">TELEPHONE</label>
                <input class="form-control input-sm num" maxlength="15" type="text" placeholder="ENTER TELEPHONE NUMBER" id="del_telephone" name="del_telephone" value="{{old('del_telephone')}}">
              </div>
            </div>

            <h5><label  class="control-label"><u>EXCHANGE DETAILS</u></label></h5><hr>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">IEX CLIENT NAME</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER CLIENT NAME" id="iex_client_name" name="iex_client_name" value="{{old('iex_client_name')}}">
              </div>
              <div class="col-md-3">
              <label  class="control-label">IEX PORTFOLIO CODE</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER PORTFOLIO CODE"  id="iex_portfolio" name="iex_portfolio" value="{{old('iex_portfolio')}}">
              </div>
              <div class="col-md-3">
              <label  class="control-label">IEX STATUS</label>
              <select class="form-control input-sm " style="width: 100%;"  id="iex_status" name="iex_status" value="{{old('iex_status')}}">
                  <option value="">Select</option>
                              <option value="Active" {{ isset($clientData) && $clientData->iex_status == 'Active' ? 'selected="selected"' : '' }}>Active</option>
                              <option value="Inactive" {{ isset($clientData) && $clientData->iex_status == 'Inactive' ? 'selected="selected"' : '' }}>Inactive</option>
                              <option value="Suspended" {{ isset($clientData) && $clientData->iex_status == 'Suspended' ? 'selected="selected"' : '' }}>Suspended</option>

                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">PXIL CLIENT NAME</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER CLIENT NAME"  id="pxil_client_name" name="pxil_client_name" value="{{old('pxil_client_name')}}">
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">PXIL PORTFOLIO CODE</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER PORTDOLIO CODE" id="pxil_portfolio" name="pxil_portfolio" value="{{old('pxil_portfolio')}}">
              </div>
              <div class="col-md-3">
            <label  class="control-label">PXIL STATUS</label>
            <select class="form-control input-sm" style="width: 100%;" id="pxil_status" name="pxil_status" value="{{old('pxil_status')}}">
                <option value="">Select</option>
                              <option value="Active" {{ isset($clientData) && $clientData->iex_status == 'Active' ? 'selected="selected"' : '' }}>Active</option>
                              <option value="Inactive" {{ isset($clientData) && $clientData->iex_status == 'Inactive' ? 'selected="selected"' : '' }}>Inactive</option>
                              <option value="Suspended" {{ isset($clientData) && $clientData->iex_status == 'Suspended' ? 'selected="selected"' : '' }}>Suspended</option>

              </select>
              </div>
              <div class="col-md-3">
            <label  class="control-label">IEX REGION</label>
            <select class="form-control input-sm" style="width: 100%;"id="iex_region" name="iex_region" value="{{old('iex_region')}}">

                <option value="">Select Region</option>
                    <option value="A1" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="A1") ? 'selected' : '' }}>A1(Tripura, Mainpur, Mizoram, Nagaland)</option>
                    <option value="A2" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="A2") ? 'selected' : '' }}>A2(Assam, Arunachal Pradesh, Meghalaya)</option>
                    <option value="E1" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="E1") ? 'selected' : '' }}>E1(West Bengal, Sikkim, Bihar, Jharkhand)</option>
                    <option value="E2" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="E2") ? 'selected' : '' }}>E2(Odisha)</option>
                    <option value="N1" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="N1") ? 'selected' : '' }}>N1(J&K, HP, Chandigarh, Haryana)</option>
                    <option value="N2" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="N2") ? 'selected' : '' }}>N2(UP, Uttaranchal, Rajasthan, Delhi)</option>
                    <option value="N3" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="N3") ? 'selected' : '' }}>N3(Punjab)</option>
                    <option value="S1" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="S1") ? 'selected' : '' }}>S1(AP,Telangana, Karnataka, Pondicherry, SG)</option>
                    <option value="S2" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="S2") ? 'selected' : '' }}>S2(Tamilnadu, Punducherry, Karaikal, Mahe)</option>
                    <option value="S3" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="S3") ? 'selected' : '' }}>S3(Kerla)</option>
                    <option value="W1" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="W1") ? 'selected' : '' }}>W1(Madhya Pradesh)</option>
                    <option value="W2" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="W2") ? 'selected' : '' }}>W2(Maharashtra, Gujarat, DD, DNH, North Goa)</option>
                    <option value="W3" {{ (isset($clientData[0]) && $clientData[0]->iex_region=="W3") ? 'selected' : '' }}>W3(Chhattisharh)</option>
              </select>
              </div>
              <div class="col-md-3">
            <label  class="control-label">PXIL REGION</label>
            <select class="form-control input-sm" style="width: 100%;" id="pxil_region" name="pxil_region" value="{{old('pxil_region')}}">
                 <option value="">Select Region</option>
                    <option value="A1" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="A1") ? 'selected' : '' }}>A1(Tripura, Mainpur, Mizoram, Nagaland)</option>
                    <option value="A2" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="A2") ? 'selected' : '' }}>A2(Assam, Arunachal Pradesh, Meghalaya)</option>
                    <option value="E1" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="E1") ? 'selected' : '' }}>E1(West Bengal, Sikkim, Bihar, Jharkhand)</option>
                    <option value="E2" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="E2") ? 'selected' : '' }}>E2(Odisha)</option>
                    <option value="N1" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="N1") ? 'selected' : '' }}>N1(J&K, HP, Chandigarh, Haryana)</option>
                    <option value="N2" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="N2") ? 'selected' : '' }}>N2(UP, Uttaranchal, Rajasthan, Delhi)</option>
                    <option value="N3" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="N3") ? 'selected' : '' }}>N3(Punjab)</option>
                    <option value="S1" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="S1") ? 'selected' : '' }}>S1(AP,Telangana, Karnataka, Pondicherry, SG)</option>
                    <option value="S2" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="S2") ? 'selected' : '' }}>S2(Tamilnadu, Punducherry, Karaikal, Mahe)</option>
                    <option value="S3" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="S3") ? 'selected' : '' }}>S3(Kerla)</option>
                    <option value="W1" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="W1") ? 'selected' : '' }}>W1(Madhya Pradesh)</option>
                    <option value="W2" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="W2") ? 'selected' : '' }}>W2(Maharashtra, Gujarat, DD, DNH, North Goa)</option>
                    <option value="W3" {{ (isset($clientData[0]) && $clientData[0]->pxil_region=="W3") ? 'selected' : '' }}>W3(Chhattisharh)</option>
              </select>
              </div>
            </div>

          <h5><label  class="control-label"><u>CONNECTION DETAILS</u></label></h5><hr>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">STATE TYPE</label>
              <select class="form-control input-sm" style="width: 100%;" id="state_type" name="state_type" value="{{old('state_type')}}">
                  <option selected="selected">PLEASE SELECT</option>
                  <option>intra state </option>
                  <option>inter state</option>

                </select>
              </div>
               <div class="col-md-3">
            <label  class="control-label">STATE(For NOC)</label>
            <select class="form-control input-sm" style="width: 100%;" name="conn_state" id="conn_state" value="{{old('conn_state')}}">
                <option value="">PLEASE SELECT</option>
                <?php
          $state_list = \App\Common\StateList::get_states();
          ?>
          @foreach($state_list as $state_code=>$state_ar)
           <option value="{{$state_code}}" {{ isset($clientData) && $clientData->conn_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
          @endforeach
              </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">DISCOM</label>
              <select class="form-control input-sm" style="width: 100%;" id="discom" name="discom" value="{{old('discom')}}">
                  <option value=''>PLEASE SELECT</option>
                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">VOLTAGE LEVEL</label>
              <select class="form-control input-sm" style="width: 100%;" id="voltage" name="voltage" value="{{old('voltage')}}">
                  <option value=''>PLEASE SELECT</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12"></div>
            </div>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">POINT OF INTERCONNECTION</label>

              <div class="form-group mt5">
                <div class="col-md-1" >
                    <input type="checkbox"  id="inter_discom" name="inter_discom" value="{{old('inter_discom')}}" class=" minimal "></div>
                      <div class="col-md-3 " ><label for="inter_discom">DISCOM</label>
                  </div>
                <div class="col-md-1 "  >
                    <input type="checkbox"  id="inter_stu" name="inter_stu" value="{{old('inter_stu')}}" class=" minimal"></div>
                    <div class="col-md-1 " ><label for="inter_stu">STU</label>
                </div>
               <div class="col-md-1 ">
                     <input type="checkbox"  id="inter_poc" name="inter_poc" value="{{old('inter_poc')}}" class=" minimal ">
                </div>
                   <div class="col-md-5 " style="width:20%;margin-left:-3px;"><label for="inter_poc">POC/CTU</label></div>
                </div>
              </div>
              <div class="col-md-3">
            <label  class="control-label">DOES BELONG TO COMMON FEEDER?</label>
            <div class="form-group">
              <div class="col-md-6 pull-left">
                  <input type="radio" class="flat-red" name="rt" id="rt">&nbsp&nbsp<label for="rt">YES</label>
              </div>
             <div class="col-md-6 pull-Left">
                   <input type="radio" class="flat-red" name="rt" id="rt1">&nbsp&nbsp<label for="rt1">NO</label>
              </div>
            </div>
              </div>
              <div class="col-md-3">
            <label  class="control-label">FEEDER NAME</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER FEEDER NAME" name="feeder_name" id="feeder_name" value="{{old('feeder_name')}}">
              </div>
              <div class="col-md-3">
            <label  class="control-label">FEEDER CODE</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER FEEDER CODE" name="feeder_code" id="feeder_code" value="{{old('feeder_code')}}">
              </div>
            </div>
            <div class="row">

              <div class="col-md-3">
              <label  class="control-label"> NAME OF SUBSTATION</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER SUBSTATION NAME" id="name_of_substation" name="name_of_substation" value="{{old('name_of_substation')}}">
              </div>
              <div class="col-md-3">
            <label  class="control-label">MAXIMUM INJECTION QUANTUM</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER INJECTION QUANTUM" name="maxm_injection" id="maxm_injection" value="{{old('maxm_injection')}}">
              </div>
              <div class="col-md-3">
            <label  class="control-label">MAXIMUM WITHDRAWAL QUANTUM</label>
            <input class="form-control input-sm" type="text" placeholder="ENTER WITHDRAWAL QUANTUM" name="maxm_withdrawal" id="maxm_withdrawal" value="{{old('maxm_withdrawal')}}">
              </div>
            </div>

        <h5><label  class="control-label"><u>FINANCIAL ARRANGEMENT</u></label></h5><hr>
            <div class="row">
              <div class="col-md-3">
              <label  class="control-label">LATER PAYMENT PENALTY(%)</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER DISCOM" name="payment" id="payment" value="{{old('payment')}}">
              </div>
              <div class="col-md-3">
              <label  class="control-label">PAYMENT OBLIGATION</label>
              <select class="form-control input-sm" style="width: 100%;" name="obligation" id="obligation">
                  <option value="">PLEASE SELECT</option>
                  <option value="PSM" @if(old('obligation')=='PSM')selected @endif>PSM</option>
                  <option value="Advance" @if(old('obligation')=='Advance')selected @endif>Advance</option>
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

})

</script>
<script type="text/javascript">
$('input[type="checkbox"]#saroa,.saroa').click(function(){
     if($("#saroa").prop("checked") == true){
       $("#bill_line1").val($("#reg_line1").val());
       $("#bill_line2").val($("#reg_line2").val());
       $("#bill_country").val($("#reg_country").val());
       $("#bill_state").val($("#reg_state").val());
       $("#bill_city").val($("#reg_city").val());
       $("#bill_pin").val($("#reg_pin").val());
       $("#bill_mob").val($("#reg_mob").val());
       $("#bill_telephone").val($("#reg_telephone").val());
     }
     else if($("#saroa").prop("checked") == false){
       $("#bill_line1").val("");
       $("#bill_line2").val("");
       $("#bill_country").val("");
       $("#bill_state").val("");
       $("#bill_city").val("");
       $("#bill_pin").val("");
       $("#bill_mob").val("");
       $("#bill_telephone").val("");
     }
   });
$('input[type="checkbox"]#saba,.saba').click(function(){
     if($("#saba").prop("checked") == true){
       $("#del_lin1").val($("#bill_line1").val());
       $("#del_lin2").val($("#bill_line2").val());
       $("#del_country").val($("#bill_country").val());
       $("#del_state").val($("#bill_state").val());
       $("#del_city").val($("#bill_city").val());
       $("#del_pin").val($("#bill_pin").val());
       $("#del_mob").val($("#bill_mob").val());
       $("#del_telephone").val($("#bill_telephone").val());
     }
     else if($("#saba").prop("checked") == false){
       $("#del_lin1").val("");
       $("#del_lin2").val("");
       $("#del_country").val("");
       $("#del_state").val("");
       $("#del_city").val("");
       $("#del_pin").val("");
       $("#del_mob").val("");
       $("#del_telephone").val("");
     }
   });
</script>
@endsection
