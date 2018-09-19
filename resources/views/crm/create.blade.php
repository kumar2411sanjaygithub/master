@extends('theme.layouts.default')
@section('content')

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="row">
          <div class="col-md-2 pull-left"><h5><label  class="control-label"><u>CREATE LEAD</u></label></h5></div>
          <div class="col-md-8"></div>
          <div class="col-md-2">
            <a href="{{ route('lead.index') }}" class="btn btn-info btn-xs pull-right"  id="ram" name="">
            <span class="glyphicon glyphicon-plus"> </span>&nbsp BACK TO LIST</a>
          </div>
          </div>
<!----------------------------------------->
          <form method="post" action="{{ route('lead.store') }}">
            {{csrf_field()}}
          <div class="box">
              <div class="box-body">

          <h5><label  class="control-label">LEAD INFORMATION</label></h5><hr>
              <div class="row">
              <div class="col-md-3 {{ $errors->has('company_name') ? 'has-error' : '' }}">
              <label  class="control-label">COMPANY NAME</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER COMPANY NAME" id="company_name" name="company_name" value="{{old('company_name')}}">
              <span class="text-danger">{{ $errors->first('company_name') }}</span>
              </div>
              <div class="col-md-3 {{ $errors->has('product') ? 'has-error' : '' }}">
              <label  class="control-label">PRODUCT</label><span class="text-danger"><strong>*</strong></span>
                <select class="form-control"  id="product"  name="product">
                  <option value="">CHOOSE PRODUCT</option>
                  @if(count($product)>0)
                    @foreach($product as $product_data)
                    <option value="{{ $product_data->id }}" @if(old('product') == $product_data->id) {{ 'selected' }} @endif>{{ $product_data->product_name }}</option>
                    @endforeach
                  @else
                    <option value="">No Data.</option>
                  @endif
                </select>
              <span class="text-danger">{{ $errors->first('product') }}</span>
              </div>
              <div class="col-md-3">
            <label  class="control-label">CONTACT PERSON</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER CONTACT PERSON" id="contact_person" name="contact_person" value="{{old('contact_person')}}">
              </div>
              <div class="col-md-3 {{ $errors->has('contact_number') ? 'has-error' : '' }}">
            <label  class="control-label">CONTACT NUMBER</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER  CONTACT NUMBER" id="contact_number" name="contact_number"  value="{{old('contact_number')}}">
              <span class="text-danger">{{ $errors->first('contact_number') }}</span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12"></div>
            </div>
            <div class="row">
              <div class="col-md-3">
            <label  class="control-label">EMAIL ID</label>
              <input class="form-control input-sm" type="email" placeholder="ENTER EMAIL ID" id="email_id" name="email_id" value="{{old('email_id')}}">
              </div>
              <div class="col-md-3">
            <label  class="control-label">INDUSTRY</label>
                <select class="form-control"  id="industry"  name="industry">
                  <option value="">CHOOSE INDUSTRY</option>
                  @if(count($industry)>0)
                    @foreach($industry as $industry_data)
                    <option value="{{ $industry_data->id }}" @if(old('industry') == $industry_data->id) {{ 'selected' }} @endif>{{ $industry_data->industry_name }}</option>
                    @endforeach
                  @else
                    <option value="">No Data.</option>
                  @endif
                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">LEAD OWNER</label>
                <select class="form-control"  id="lead_owner"  name="lead_owner">
                  <option value="">CHOOSE LEAD OWNER</option>
                  @if(count($user)>0)
                    @foreach($user as $user_data)
                    <option value="{{ $user_data->id }}" @if(old('lead_owner') == $user_data->id) {{ 'selected' }} @endif>{{ $user_data->name }}</option>
                    @endforeach
                  @else
                    <option value="">No Data.</option>
                  @endif
                </select>
              </div>
              <div class="col-md-3">
              <label  class="control-label">LEAD SOURCE</label>
                <select class="form-control"  id="lead_source"  name="lead_source">
                  <option value="">CHOOSE LEAD SOURCE</option>
                  @if(count($leadsource)>0)
                    @foreach($leadsource as $leadsource_data)
                    <option value="{{ $leadsource_data->id }}" @if(old('lead_source') == $leadsource_data->id) {{ 'selected' }} @endif>{{ $leadsource_data->name }}</option>
                    @endforeach
                  @else
                    <option value="">No Data.</option>
                  @endif
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 {{ $errors->has('quantum') ? 'has-error' : '' }}">
            <label  class="control-label">QUANTUM</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER QUANTUM" id="quantum" name="quantum" value="{{old('quantum')}}">
              <span class="text-danger">{{ $errors->first('quantum') }}</span>
              </div>
              <div class="col-md-3">
            <label  class="control-label">STATE</label>
              <select class="form-control input-sm" style="width: 100%;" id="state" name="state">
                  <option selected="selected">PLEASE SELECT STATE</option>
                   <?php
                    $state_list = \App\Common\StateList::get_states();
                        ?>
                  @foreach($state_list as $state_code=>$state_ar)
                    <option value="{{$state_code}}" {{ isset($officialstData) && $officialstData->comm_state == $state_code || old('state')==  $state_code? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                  @endforeach
              </select>
              </div>
              <div class="col-md-3">
                <label  class="control-label">DISCOM</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER DISCOM" id="discom" name="discom" value="{{old('discom')}}">
              </div>
              <div class="col-md-3">
              <label  class="control-label">VOLTAGE</label>
              <select class="form-control input-sm" style="width: 100%;" id="voltage" name="voltage">
                  <option selected="selected">PLEASE SELECT</option>
                  <option value="11K" {{ old('voltage')=='11K'? 'selected="selected"' : '' }}>11K</option>
                  <option value="22K" {{ old('voltage')=='22K'? 'selected="selected"' : '' }}>22K</option>
                  <option value="33k" {{ old('voltage')=='33k'? 'selected="selected"' : '' }}>33K</option>
                  <option value="66k" {{ old('voltage')=='66k'? 'selected="selected"' : '' }}>66K</option>
                  <option value="132K" {{ old('voltage')=='132K'? 'selected="selected"' : '' }}>132K</option>
                  <option value="220K" {{ old('voltage')=='220K'? 'selected="selected"' : '' }}>220K</option>
              </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
            <label  class="control-label">REMARKS</label>
              <input class="form-control input-sm" type="text" placeholder="ENTER REMARKS" id="remarks" name="remarks" value="{{old('remarks')}}">
              </div>
            </div>

            <h5 style="margin-top:10px!important;"><label  class="control-label">ADDRESS INFORMATION</label></h5><hr>
              <div class="row">
              <div class="col-md-3 {{ $errors->has('add_line1') ? 'has-error' : '' }}">
              <label  class="control-label">LINE-1</label><span class="text-danger"><strong>*</strong></span>
              <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS1" id="add_line1" name="add_line1"  value="{{old('add_line1')}}">
               <span class="text-danger">{{ $errors->first('add_line1') }}</span>
              </div>
              <div class="col-md-3  {{ $errors->has('add_lin2') ? 'has-error' : '' }}">
              <label  class="control-label">LINE-2</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER ADDRESS2" id="add_lin2" name="add_lin2" value="{{old('add_lin2')}}">
               <span class="text-danger">{{ $errors->first('add_lin2') }}</span>
              </div>
              <div class="col-md-3 {{ $errors->has('add_country') ? 'has-error' : '' }}">
              <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
              <select class="form-control input-sm" style="width: 100%;" id="add_country" name="add_country">
                  <option value="">PLEASE SELECT COUNTRY</option>
                  <option {{ old('add_country')=='INDIA'? 'selected="selected"' : '' }} value="INDIA">INDIA </option>
              </select>
               <span class="text-danger">{{ $errors->first('add_country') }}</span>
              </div>
              <div class="col-md-3 {{ $errors->has('add_state') ? 'has-error' : '' }}">
              <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
              <select class="form-control input-sm" style="width: 100%;" id="add_state" name="add_state">
                  <option value="">PLEASE SELECT STATE</option>
                   <?php
                    $state_list = \App\Common\StateList::get_states();
                        ?>
                  @foreach($state_list as $state_code=>$state_ar)
                    <option value="{{$state_code}}" {{ isset($officialstData) && $officialstData->comm_state == $state_code ||old('add_state')==$state_code? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
                  @endforeach
              </select>
               <span class="text-danger">{{ $errors->first('add_state') }}</span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12"></div>
            </div>
            <div class="row">
              <div class="col-md-3 {{ $errors->has('add_city') ? 'has-error' : '' }}">
              <label  class="control-label">CITY/TOWN</label><span class="text-danger"><strong>*</strong></span>
                <input class="form-control input-sm" type="text" placeholder="ENTER CITY" id="add_city" name="add_city" value="{{old('add_city')}}">
               <span class="text-danger">{{ $errors->first('add_city') }}</span>

              </div>
              <div class="col-md-3 {{ $errors->has('add_pincode') ? 'has-error' : '' }}">
            <label  class="control-label">PIN CODE</label>
                <input class="form-control input-sm" type="text" placeholder="ENTER PIN CODE" id="add_pincode" name="add_pincode" value="{{old('add_pincode')}}">
                <span class="text-danger">{{ $errors->first('add_pincode') }}</span>
              </div>
            </div>
            </div>

              <div class="row">
                 <div class="col-md-5"></div>
                  <div class="col-md-1"><button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button></div>
                  <div class="col-md-1"><a href="{{url('lead')}}" class="btn btn-block btn-danger btn-xs">CANCEL</a></div>
                <div class="col-md-5"></div>
              </div>
              <div class="row">&nbsp;</div>
              </div>
              <form>

<!------------new table start--->

<!---------------new table closed-->
      <!-- /.row -->
    </div>
  </div>
</section>
@endsection
