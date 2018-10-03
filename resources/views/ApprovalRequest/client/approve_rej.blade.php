@extends('theme.layouts.default')
@section('content')
<section class="content-header">
   <h5><label  class="control-label"><u>@if($action_info=='edit'){{'EDIT'}}@elseif($action_info=='view'){{'VIEW'}}@endif CLIENT</u></label></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="#">MANAGE CLIENT</a></li>
      <li class="#">CLIENT BASIC DETAILS</li>
      <li class="#"><u>@if($action_info=='edit'){{'EDIT'}}@elseif($action_info=='view'){{'VIEW'}}@endif CLIENT</u></li>
   </ol>
</section>
<section class="content">
   <!-- success msg -->
   @if(session()->has('message'))
   <div class="alert alert-success mt10">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      {{ session()->get('message') }}
   </div>
   @endif
   <div class="row">
      <div class="col-xs-12">
         <div class="pull-right">
            @if($action_info=='edit')
               <a href=""><button class="btn btn-info btn-xs enable_edit mt7" value=" EDIT">  <span class="glyphicon glyphicon-pencil"></span>&nbsp;EDIT</button></a>
               <a href="{{ route('basic.details') }}"><button  class="btn btn-info btn-xs mt7" value=" BACK TO LIST"><span class="glyphicon glyphicon-forward"></span>&nbsp;BACK TO LIST</button></a>
             @elseif($action_info=='view')
               <a href="/client/new"><button  class="btn btn-info btn-xs mt7" value=" BACK TO LIST"><span class="glyphicon glyphicon-forward"></span>&nbsp;BACK TO LIST</button></a>
            @endif
           </div>
      </div>
   </div>
   <form method="post" action="/client/updateclient/{{$id}}">
      {{ csrf_field() }}
      <div class="box" >
         <div class="box-body">
            <h5><label  class="control-label"><u>CLIENT DETAILS</u></label></h5>
            <hr>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">COMPANY NAME</label><span class="text-danger"><strong>*</strong></span>
                  <input class="form-control input-sm  disabled-class" disabled type="text" placeholder="ENTER COMPANY NAME" name="company_name" id="company_name" value="{{ $clientdata->company_name}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">GSTIN</label><span class="text-danger"><strong>*</strong></span>
                  <input class="form-control input-sm  disabled-class"  disabled type="text" placeholder="ENTER GSTIN" name="gstin" id="gstin" value="{{ $clientdata->gstin}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">PAN</label><span class="text-danger"><strong>*</strong></span>
                  <input class="form-control input-sm  disabled-class" disabled type="text" placeholder="ENTER PAN NUMBER" name="pan" id="pan" value="{{ $clientdata->pan}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">CIN</label><span class="text-danger"><strong>*</strong></span>
                  <input class="form-control input-sm  disabled-class"  disabled type="text" placeholder="ENTER CIN NUMBER" name="cin" id="cin"value="{{ $clientdata->cin}}">
               </div>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">PRIMARY CONTACT NUMBER</label><span class="text-danger"><strong>*</strong></span>
                  <input class="form-control input-sm disabled-class num" type="text" placeholder="ENTER PRIMARY CONTACT NUMBER" name="pri_contact_no" id="pri_contact_no" disabled  value="{{ $clientdata->cin}}">
               </div>
               <div class="col-md-3 ">
                  <label  class="control-label">PRIMARY EMAIL ID</label><span class="text-danger"><strong>*</strong></span>
                  <input class="form-control input-sm disabled-class" type="text"  disabled placeholder="ENTER PRIMARY MAIL ID"name="email" id="email" value="{{ $clientdata->email}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">SHORT ID</label>
                  <input class="form-control input-sm disabled-class"  type="text"  disabled placeholder="ENTER SHORT ID" name="short_id" id="short_id" value="{{ $clientdata->short_id}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">OLD SAP CODE</label>
                  <input class="form-control input-sm disabled-class" type="text"  disabled placeholder="ENTER OLD SAP CODE" name="old_sap" id="old_sap" value="{{ $clientdata->old_sap}}" >
               </div>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">SAP CODE</label>
                  <input class="form-control input-sm disabled-class" type="text"  disabled placeholder="ENTER SAP CODE" name="new_sap" id="new_sap" value="{{ $clientdata->new_sap}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">CRN</label>
                  <input class="form-control input-sm" type="text"  disabled placeholder="ENTER CRN NUMBER" name="crn_no" id="crn_no" value="{{ $clientdata->crn_no}}">
               </div>
            </div>
            <h5><label  class="control-label"><u>REGISTERED OFFICE ADDRESS</u></label></h5>
            <hr>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">LINE-1</label><span class="text-danger"><strong>*</strong></span>
                  <input class="form-control input-sm disabled-class" type="text"  disabled placeholder="ENTER ADDRESS LINE-1" name="reg_line1" id="reg_line1" value="{{ $clientdata->reg_line1}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">LINE-2</label>
                  <input class="form-control input-sm disabled-class" type="text"  disabled placeholder="ENTER ADDRESS  LINE-2"  name="reg_line2" id="reg_line2" value="{{ $clientdata->reg_line2}}">
               </div>
               <div class="col-md-3 {{ $errors->has('reg_country') ? 'has-error' : '' }}">
                  <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
                  <select class="form-control input-sm disabled-class"   disabled style="width: 100%;" id="reg_country" name="reg_country" value="{{ $clientdata->reg_country}}">
                      <option value="">SELECT</option>
                     <option value="India">India</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
                  <select class="form-control input-sm disabled-class"  disabled  style="width: 100%;"id="reg_state" name="reg_state" value="{{ $clientdata->reg_state}}">
                     <option value=" ">SELECT</option>
                     <?php
                        $state_list = \App\Common\StateList::get_states();
                        ?>
                     @foreach($state_list as $state_code=>$state_ar)
                     <option value="{{$state_code}}" {{ isset($clientdata) && $clientdata->reg_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3 ">
                  <label  class="control-label">CITY</label><span class="text-danger"><strong>*</strong></span>
                  <input class="form-control input-sm disabled-class"  disabled  type="text" name="reg_city" id="reg_city" value="{{ $clientdata->reg_city}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">PIN CODE</label><span class="text-danger"><strong>*</strong></span>
                  <input class="form-control input-sm disabled-class num" maxlength="6" type="text"  disabled  placeholder="ENTER PIN CODE" id="reg_pin" name="reg_pin" value="{{ $clientdata->reg_pin}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
                  <input class="form-control input-sm disabled-class num" maxlength="10" type="text"  disabled placeholder="ENTER MOBILE NUMBER"  id="reg_mob" name="reg_mob" value="{{ $clientdata->reg_mob}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">TELEPHONE</label>
                  <input class="form-control input-sm disabled-class num" maxlength="15" type="text"  disabled placeholder="ENTER TELEPHONE NUMBER" id="reg_telephone" name="reg_telephone" value="{{ $clientdata->reg_telephone}}">
               </div>
            </div>
            <div class="row">
               <div class="col-md-2">
                  <h5><label  class="control-label"><u>BILLING ADDRESS</u></label></h5>
               </div>
               <div class="col-md-5">
                  <input type="checkbox" class="minimal1 disabled-class" id="saroa" disabled style="position:relative; top:3px;">&nbsp<span><label for="saroa">SAME AS REGISTERED OFFICE ADDRESS</label></span>
               </div>
               <div class="col-md-5"></div>
            </div>
            <hr>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">LINE-1</label>
                  <input class="form-control input-sm disabled-class" type="text"  disabled  placeholder="ENTER ADDRESS LINE-1" id="bill_line1" name="bill_line1" value="{{ $clientdata->bill_line1}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">LINE-2</label>
                  <input class="form-control input-sm disabled-class" type="text"  disabled  placeholder="ENTER ADDRESS LINE-2" id="bill_line2" name="bill_line2" value="{{ $clientdata->bill_line2}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">COUNTRY</label>
                  <select class="form-control input-sm disabled-class" disabled style="width: 100%;" id="bill_country" name="bill_country" value="{{ $clientdata->bill_country}}" >
                      <option value="">SELECT</option>
                     <option value="India">India</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <label  class="control-label">STATE</label>
                  <select class="form-control input-sm disabled-class"   disabled style="width: 100%;" id="bill_state" name="bill_state" value="{{ $clientdata->bill_state}}">
                     <option value="">SELECT</option>
                     <?php
                        $state_list = \App\Common\StateList::get_states();
                        ?>
                     @foreach($state_list as $state_code=>$state_ar)
                     <option value="{{$state_code}}" {{ isset($clientdata) && $clientdata->bill_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">CITY</label>
                  <input class="form-control input-sm disabled-class"   disabled style="width: 100%;" id="bill_city" name="bill_city" value="{{ $clientdata->bill_city}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">PIN CODE</label>
                  <input class="form-control input-sm disabled-class num" maxlength="6"  disabled type="text" placeholder="ENTER PIN CODE" id="bill_pin" name="bill_pin" value="{{ $clientdata->bill_pin}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">MOBILE NUMBER</label>
                  <input class="form-control input-sm disabled-class num" maxlength="10"  disabled type="text" placeholder="ENTER MOBILE NUMBER" id="bill_mob" name="bill_mob" value="{{ $clientdata->bill_mob}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">TELEPHONE</label>
                  <input class="form-control input-sm disabled-class num" maxlength="15" disabled  type="text" placeholder="ENTER TELEPHONE NUMBER"id="bill_telephone" name="bill_telephone" value="{{ $clientdata->bill_telephone}}">
               </div>
            </div>
            <div class="row">
               <div class="col-md-2">
                  <h5><label  class="control-label"><u>DELIVERY ADDRESS</u></label></h5>
               </div>
               <div class="col-md-5">
                  <input type="checkbox" class="minimal1 disabled-class" disabled id="saba" style="position:relative; top:3px;">&nbsp<span><label for="saba">SAME AS BILLING ADDRESS</label></span>
               </div>
               <div class="col-md-5"></div>
            </div>
            <hr>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">LINE-1</label>
                  <input class="form-control input-sm disabled-class"  disabled type="text" placeholder="ENTER ADDRESS LINE-1" id="del_lin1" name="del_lin1" value="{{ $clientdata->del_lin1}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">LINE-2</label>
                  <input class="form-control input-sm disabled-class"   disabled type="text" placeholder="ENTER ADDRESS LINE-2" id="del_lin2" name="del_lin2" value="{{ $clientdata->del_lin2}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">COUNTRY</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;" id="del_country" name="del_country" value="{{ $clientdata->del_country}}">
                      <option value="">SELECT</option>
                     <option value="India">India</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <label  class="control-label">STATE</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;" id="del_state" name="del_state" value="{{ $clientdata->del_state}}">
                     <option value=" ">SELECT</option>
                     <?php
                        $state_list = \App\Common\StateList::get_states();
                        ?>
                     @foreach($state_list as $state_code=>$state_ar)
                     <option value="{{$state_code}}" {{ isset($clientdata) && $clientdata->del_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">CITY</label>
                  <input class="form-control input-sm disabled-class"  disabled style="width: 100%;" id="del_city" name="del_city" value="{{ $clientdata->del_city}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">PIN CODE</label>
                  <input class="form-control input-sm disabled-class num" maxlength="6"  disabled type="text" placeholder="ENTER PIN CODE" id="del_pin" name="del_pin" value="{{ $clientdata->del_pin}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">MOBILE NUMBER</label>
                  <input class="form-control input-sm disabled-class num" maxlength="10"  disabled type="text" placeholder="ENTER MOBILE NUMBER" id="del_mob" name="del_mob" value="{{ $clientdata->del_mob}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">TELEPHONE</label>
                  <input class="form-control input-sm disabled-class num" maxlength="15"  disabled type="text" placeholder="ENTER TELEPHONE NUMBER" id="del_telephone" name="del_telephone" value="{{ $clientdata->del_telephone}}">
               </div>
            </div>
            <h5><label  class="control-label"><u>EXCHANGE DETAILS</u></label></h5>
            <hr>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">IEX CLIENT NAME</label>
                  <input class="form-control input-sm disabled-class"  disabled type="text" placeholder="ENTER CLIENT NAME" id="iex_client_name" name="iex_client_name" value="{{ $clientdata->iex_client_name}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">IEX PORTFOLIO CODE</label>
                  <input class="form-control input-sm disabled-class"  disabled type="text" placeholder="ENTER PORTFOLIO CODE"  id="iex_portfolio" name="iex_portfolio" value="{{ $clientdata->iex_client_name}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">IEX STATUS</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;"  id="iex_status" name="iex_status" value="{{ $clientdata->iex_status}}">
                     <option value=" ">Select</option>
                     <option value="Active" {{ isset($clientdata) && $clientdata->iex_status == 'Active' ? 'selected="selected"' : '' }}>Active</option>
                     <option value="Inactive" {{ isset($clientdata) && $clientdata->iex_status == 'Inactive' ? 'selected="selected"' : '' }}>Inactive</option>
                     <option value="Suspended" {{ isset($clientdata) && $clientdata->iex_status == 'Suspended' ? 'selected="selected"' : '' }}>Suspended</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <label  class="control-label">IEX REGION</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;"id="iex_region" name="iex_region" value="{{ $clientdata->iex_region}}">
                     <option value=" ">Select Region</option>
                     <option value="A1" {{ (isset($clientdata) && $clientdata->iex_region=="A1") ? 'selected' : '' }}>A1(Tripura, Mainpur, Mizoram, Nagaland)</option>
                     <option value="A2" {{ (isset($clientdata) && $clientdata->iex_region=="A2") ? 'selected' : '' }}>A2(Assam, Arunachal Pradesh, Meghalaya)</option>
                     <option value="E1" {{ (isset($clientdata) && $clientdata->iex_region=="E1") ? 'selected' : '' }}>E1(West Bengal, Sikkim, Bihar, Jharkhand)</option>
                     <option value="E2" {{ (isset($clientdata) && $clientdata->iex_region=="E2") ? 'selected' : '' }}>E2(Odisha)</option>
                     <option value="N1" {{ (isset($clientdata) && $clientdata->iex_region=="N1") ? 'selected' : '' }}>N1(J&K, HP, Chandigarh, Haryana)</option>
                     <option value="N2" {{ (isset($clientdata) && $clientdata->iex_region=="N2") ? 'selected' : '' }}>N2(UP, Uttaranchal, Rajasthan, Delhi)</option>
                     <option value="N3" {{ (isset($clientdata) && $clientdata->iex_region=="N3") ? 'selected' : '' }}>N3(Punjab)</option>
                     <option value="S1" {{ (isset($clientdata) && $clientdata->iex_region=="S1") ? 'selected' : '' }}>S1(AP,Telangana, Karnataka, Pondicherry, SG)</option>
                     <option value="S2" {{ (isset($clientdata) && $clientdata->iex_region=="S2") ? 'selected' : '' }}>S2(Tamilnadu, Punducherry, Karaikal, Mahe)</option>
                     <option value="S3" {{ (isset($clientdata) && $clientdata->iex_region=="S3") ? 'selected' : '' }}>S3(Kerla)</option>
                     <option value="W1" {{ (isset($clientdata) && $clientdata->iex_region=="W1") ? 'selected' : '' }}>W1(Madhya Pradesh)</option>
                     <option value="W2" {{ (isset($clientdata) && $clientdata->iex_region=="W2") ? 'selected' : '' }}>W2(Maharashtra, Gujarat, DD, DNH, North Goa)</option>
                     <option value="W3" {{ (isset($clientdata) && $clientdata->iex_region=="W3") ? 'selected' : '' }}>W3(Chhattisharh)</option>
                  </select>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">PXIL CLIENT NAME</label>
                  <input class="form-control input-sm disabled-class"  disabled type="text" placeholder="ENTER CLIENT NAME"  id="pxil_client_name" name="pxil_client_name" value="{{ $clientdata->pxil_client_name}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">PXIL PORTFOLIO CODE</label>
                  <input class="form-control input-sm disabled-class"  disabled type="text" placeholder="ENTER PORTDOLIO CODE" id="pxil_portfolio" name="pxil_portfolio" value="{{ $clientdata->pxil_portfolio}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">PXIL STATUS</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;" id="pxil_status" name="pxil_status" value="{{old('pxil_status')}}">
                     <option value=" ">Select</option>
                     <option value="Active" {{ isset($clientdata) && $clientdata->iex_status == 'Active' ? 'selected="selected"' : '' }}>Active</option>
                     <option value="Inactive" {{ isset($clientdata) && $clientdata->iex_status == 'Inactive' ? 'selected="selected"' : '' }}>Inactive</option>
                     <option value="Suspended" {{ isset($clientdata) && $clientdata->iex_status == 'Suspended' ? 'selected="selected"' : '' }}>Suspended</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <label  class="control-label">PXIL REGION</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;" id="pxil_region" name="pxil_region" value="{{ $clientdata->pxil_region}}">
                     <option value=" ">Select Region</option>
                     <option value="A1" {{ (isset($clientdata) && $clientdata->pxil_region=="A1") ? 'selected' : '' }}>A1(Tripura, Mainpur, Mizoram, Nagaland)</option>
                     <option value="A2" {{ (isset($clientdata) && $clientdata->pxil_region=="A2") ? 'selected' : '' }}>A2(Assam, Arunachal Pradesh, Meghalaya)</option>
                     <option value="E1" {{ (isset($clientdata) && $clientdata->pxil_region=="E1") ? 'selected' : '' }}>E1(West Bengal, Sikkim, Bihar, Jharkhand)</option>
                     <option value="E2" {{ (isset($clientdata) && $clientdata->pxil_region=="E2") ? 'selected' : '' }}>E2(Odisha)</option>
                     <option value="N1" {{ (isset($clientdata) && $clientdata->pxil_region=="N1") ? 'selected' : '' }}>N1(J&K, HP, Chandigarh, Haryana)</option>
                     <option value="N2" {{ (isset($clientdata) && $clientdata->pxil_region=="N2") ? 'selected' : '' }}>N2(UP, Uttaranchal, Rajasthan, Delhi)</option>
                     <option value="N3" {{ (isset($clientdata) && $clientdata->pxil_region=="N3") ? 'selected' : '' }}>N3(Punjab)</option>
                     <option value="S1" {{ (isset($clientdata) && $clientdata->pxil_region=="S1") ? 'selected' : '' }}>S1(AP,Telangana, Karnataka, Pondicherry, SG)</option>
                     <option value="S2" {{ (isset($clientdata) && $clientdata->pxil_region=="S2") ? 'selected' : '' }}>S2(Tamilnadu, Punducherry, Karaikal, Mahe)</option>
                     <option value="S3" {{ (isset($clientdata) && $clientdata->pxil_region=="S3") ? 'selected' : '' }}>S3(Kerla)</option>
                     <option value="W1" {{ (isset($clientdata) && $clientdata->pxil_region=="W1") ? 'selected' : '' }}>W1(Madhya Pradesh)</option>
                     <option value="W2" {{ (isset($clientdata) && $clientdata->pxil_region=="W2") ? 'selected' : '' }}>W2(Maharashtra, Gujarat, DD, DNH, North Goa)</option>
                     <option value="W3" {{ (isset($clientdata) && $clientdata->pxil_region=="W3") ? 'selected' : '' }}>W3(Chhattisharh)</option>
                  </select>
               </div>
            </div>
            <h5><label  class="control-label"><u>CONNECTION DETAILS</u></label></h5>
            <hr>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">STATE TYPE</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;" id="state_type" name="state_type" value="{{ $clientdata->state_type}}">
                     <option value="">SELECT</option>
                     <option value="intra state" {{ isset($clientdata) && $clientdata->state_type == 'intra state' ? 'selected="selected"' : '' }}>Intra State </option>
                     <option value="inter state" {{ isset($clientdata) && $clientdata->state_type == 'inter state' ? 'selected="selected"' : '' }}>Inter State</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <label  class="control-label">STATE(For NOC)</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;" name="conn_state" id="conn_state" value="{{ $clientdata->conn_state}}">
                     <option value=''>Select</option>
                     <?php
                        $state_list = \App\Common\StateList::get_states();
                        ?>
                     @foreach($state_list as $state_code=>$state_ar)
                     <option value="{{$state_code}}" {{ isset($clientdata) && $clientdata->conn_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-3">
                  <label  class="control-label">DISCOM</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;" id="discom" name="discom" value="{{ $clientdata->discom}}">
                     <option value=''>CHOOSE</option>
                     @foreach($discom_array as $discom_list)
                      @if(isset($clientdata->discom))
                        <option value='{{$discom_list}}' @if((isset($clientdata->discom)&&$clientdata->discom==$discom_list))? selected="selected" @endif>{{$discom_list}}</option>
                       @endif
                     @endforeach
                  </select>
               </div>
               <div class="col-md-3">
                  <label  class="control-label">VOLTAGE LEVEL</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;" id="voltage" name="voltage" value="{{ $clientdata->voltage}}">
                    <option value=''>CHOOSE</option>
                    @foreach($voltage_array as $vol_list)
                     @if(isset($clientdata->voltage))
                       <option value='{{$vol_list}}' @if((isset($clientdata->voltage)&&$clientdata->voltage==$vol_list))? selected="selected" @endif>{{$vol_list}}</option>
                      @endif
                    @endforeach
                  </select>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12"></div>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">POINT OF INTERCONNECTION</label>
                  <div class="form-group">
                     <div class="col-md-1 " style="margin-left:-6px;">
                        <input type="checkbox" class="minimal1 pull-left disabled-class" id="inter_discom" name="inter_discom"  disabled  value="inter_discom" @if((isset($clientdata->inter_discom)&&$clientdata->inter_discom=='DISCOM'))? checked="checked" @endif >
                     </div>
                     <div class="col-md-3" style="margin-left:-7px;"><label for="inter_discom">DISCOM</label>
                     </div>
                     <div class="col-md-1 "  style="margin-left:-6px;">
                        <input type="checkbox" class="minimal1 disabled-class"  disabled id="inter_stu" name="inter_stu" value="inter_stu" @if((isset($clientdata->inter_stu)&&$clientdata->inter_stu=='STU'))? checked="checked" @endif>
                     </div>
                     <div class="col-md-1" style="margin-left:-7px;"><label for="inter_stu">STU</label>
                     </div>
                     <div class="col-md-1">
                        <input type="checkbox" class="minimal1 disabled-class"  disabled id="inter_poc" name="inter_poc" value="inter_poc" @if((isset($clientdata->inter_poc)&&$clientdata->inter_poc=='POC/CTU'))? checked="checked" @endif>
                     </div>
                     <div class="col-md-5" style="width:30%;margin-left:-5px;"><label for="inter_poc">POC/CTU</label></div>
                  </div>
               </div>
               <div class="col-md-3">
                  <label  class="control-label">DOES BELONG TO COMMON FEEDER?</label>
                  <div class="form-group">
                     <div class="col-md-6 pull-left">
                        <input  disabled type="radio" class="minimal1 disabled-class" value="yes" name="common_feeder_option" id="rt" @if((isset($clientdata->common_feeder_option)&&$clientdata->common_feeder_option=='yes'))? checked="checked" @endif>&nbsp&nbsp<label for="rt">YES</label>
                     </div>
                     <div class="col-md-6 pull-Left">
                        <input  disabled type="radio" class="minimal1 disabled-class" value="no" name="common_feeder_option" id="rt1" @if((isset($clientdata->common_feeder_option)&&$clientdata->common_feeder_option=='no'))? checked="checked" @endif>&nbsp&nbsp<label for="rt1">NO</label>
                     </div>
                  </div>
               </div>
               <div id="hidecontentDiv">
               <div class="col-md-3">
                  <label  class="control-label">FEEDER NAME</label>
                  <input class="form-control input-sm disabled-class"  disabled type="text" placeholder="ENTER FEEDER NAME" name="feeder_name" id="feeder_name" value="{{isset($clientdata->feeder_name)?$clientdata->feeder_name: old('feeder_name')}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">FEEDER CODE</label>
                  <input class="form-control input-sm disabled-class"  disabled type="text" placeholder="ENTER FEEDER CODE" name="feeder_code" id="feeder_code" value="{{isset($clientdata->feeder_code)?$clientdata->feeder_code: old('feeder_code')}}">
               </div>
            </div>

               <div class="col-md-3">
                  <label  class="control-label"> NAME OF SUBSTATION</label>
                  <input class="form-control input-sm disabled-class"  disabled type="text" placeholder="ENTER SUBSTATION NAME" id="name_of_substation" name="name_of_substation"  value="{{isset($clientdata->name_of_substation)?$clientdata->name_of_substation: old('name_of_substation')}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">MAXIMUM INJECTION QUANTUM</label>
                  <input class="form-control input-sm disabled-class"  disabled type="text" placeholder="ENTER INJECTION QUANTUM" name="maxm_injection" id="maxm_injection" value="{{isset($clientdata->maxm_injection)?$clientdata->maxm_injection: old('maxm_injection')}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">MAXIMUM WITHDRAWAL QUANTUM</label>
                  <input class="form-control input-sm disabled-class"  disabled type="text" placeholder="ENTER WITHDRAWAL QUANTUM" name="maxm_withdrawal" id="maxm_withdrawal" value="{{isset($clientdata->maxm_withdrawal)?$clientdata->maxm_withdrawal: old('maxm_withdrawal')}}">
               </div>
              <div class="col-md-3">
              <label  class="control-label">NOC APPLICATION PUNCHED BY</label>
              <select class="form-control input-sm  disabled-class" disabled style="width: 100%;" id="noc_punched_by" name="noc_punched_by">
                  <option value="">SELECT</option>
                  <option value="Trader" {{ isset($clientdata) && $clientdata->noc_punched_by == 'Trader' ? 'selected="selected"' : '' }}>Trader</option>
                  <option value="Client" {{ isset($clientdata) && $clientdata->noc_punched_by == 'Client' ? 'selected="selected"' : '' }}>Client</option>
                </select>
              </div>
               
            </div>
            <h5><label  class="control-label"><u>FINANCIAL ARRANGEMENT</u></label></h5>
            <hr>
            <div class="row">
               <div class="col-md-3">
                  <label  class="control-label">LATER PAYMENT PENALTY(%)</label>
                  <input class="form-control input-sm disabled-class" disabled  type="text" placeholder="ENTER DISCOM" name="payment" id="payment" value="{{isset($clientdata->payment)?$clientdata->payment: old('payment')}}">
               </div>
               <div class="col-md-3">
                  <label  class="control-label">PAYMENT OBLIGATION</label>
                  <select class="form-control input-sm disabled-class"  disabled style="width: 100%;" name="obligation" id="obligation">
                     <option value=''>SELECT</option>
                     <option @if((isset($clientdata->obligation)&&$clientdata->obligation=='PSM')||old('obligation') == 'PSM')? selected="selected" @endif >PSM</option>
                     <option @if((isset($clientdata->obligation)&&$clientdata->obligation=='Advance')||old('obligation') == 'Advance')? selected="selected" @endif >Advance</option>
                  </select>
               </div>
            </div>
            <hr>
            <div class="row">
               <div class="col-md-5"></div>
               @if($action_info=='edit')
                <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs saveButton" id="saveclient" style="display:none;">UPDATE</button></div>
               <div class="col-md-1"><a href="{{ route('basic.details') }}" class="btn btn-block btn-danger btn-xs">Cancel</a></div>
               @elseif($action_info=='view')
                  @if($clientdata->client_app_status =='0')
                   <div class="col-md-1">
                     <a href="/status/{{$clientdata->id}}/approve" class="btn  btn-info btn-xs">APPROVE</a>
                  </div>
                  <div class="col-md-1"><a href="/status/{{$clientdata->id}}/reject" class="btn  btn-danger btn-xs">REJECT</a></div>
                  @elseif($clientdata->client_app_status =='1')
                     <div class="col-md-1">
                        <a disabled class="btn btn-info btn-xs">APPROVED</a>
                     </div>
                  @elseif($clientdata->client_app_status =='2')
                     <div class="col-md-1">
                        <a disabled class="btn btn-danger btn-xs">REJECTED</a>
                     </div>
                  @endif   
               @endif
               <div class="col-md-4"></div>
            </div>
            <div class="row">&nbsp;</div>
         </div>
      </div>
   </form>
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

        $('.enable_edit').click(function(){
               $('#editMode').show();
               $('.disabled-class').removeAttr("disabled");
               $('.saveButton').show();
               return false;
             });
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

$(document).ready(function() {
   if ($('#rt1').is(":checked")) 
   {

      $("#hidecontentDiv").hide();
   }
   if ($('#rt').is(":checked")) 
   {
      $("#hidecontentDiv").show();
   }
});
</script>
@endsection
