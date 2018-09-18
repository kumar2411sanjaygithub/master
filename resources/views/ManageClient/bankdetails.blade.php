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
            <h5><label  class="control-label">BANK DETAILS <small>{{$client_details[0]['company_name']}}/{{$client_details[0]['crn_no']}}/{{$client_details[0]['iex_portfolio']}}/{{$client_details[0]['pxil_portfolio']}}</small></label></h5>
    </section>
    <section class="content">
      @if(session()->has('message'))
            <div class="alert alert-success mt10">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {{ session()->get('message') }}
            </div>
          @endif
      <div class="row">
        <div class="col-xs-12">
        <form method ="post" action="{{isset($get_bank_details)?url('bank_edit/'.$get_bank_details->id):route('bank_create')}}">
      {{ csrf_field() }}
  <div class="row {{(isset($get_bank_details)||!$errors->isEmpty())?'':'divhide'}}" id="bankbox">
  <div class="col-xs-12">
  <div class="box">
  <div class="box-body">
    <div class="row">
      <div class="col-md-3 {{ $errors->has('bank_name') ? 'has-error' : '' }}">
      <label  class="control-label">BANK NAME</label>

      <input type="hidden"  name="client_id" value="{{@$client_id}}" id="client">
       <input class="form-control input-sm" type="text" placeholder="ENTERE BANK NAME" id="bank_name" name="bank_name" value="{{isset($get_bank_details)?$get_bank_details->bank_name:old('bank_name')}}">
       <span class="text-danger">{{ $errors->first('bank_name') }}</span>
      </div>
      <div class="col-md-3 {{ $errors->has('branch_name') ? 'has-error' : '' }}">
       <label  class="control-label">BRANCH NAME</label>
        <input class="form-control input-sm" type="text" placeholder="ENTER BRANCH NAME" id="branch_name" name="branch_name" value="{{isset($get_bank_details)?$get_bank_details->branch_name:old('branch_name')}}">
        <span class="text-danger">{{ $errors->first('branch_name') }}</span>
      </div>
      <div class="col-md-3 {{ $errors->has('account_number') ? 'has-error' : '' }}">
        <label  class="control-label">ACCOUNT NUMBER</label><span class="text-danger"><strong>*</strong></span>
        <input class="form-control input-sm" type="text" placeholder="ENTER ACCOUNT NUMBER" id="account_number" name="account_number" value="{{isset($get_bank_details)?$get_bank_details->account_number:old('account_number')}}">
        <span class="text-danger">{{ $errors->first('account_number') }}</span>
      </div>
      <div class="col-md-3 {{ $errors->has('ifsc') ? 'has-error' : '' }}">
        <label  class="control-label">IFSC CODE</label>
        <input class="form-control input-sm" type="text" placeholder="ENTER IFSC CODE" id="ifsc" name="ifsc" value="{{isset($get_bank_details)?$get_bank_details->ifsc:old('ifsc')}}">
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <label  class="control-label">VIRTUAL ACCOUNT NUMBER</label>
        <input class="form-control input-sm" type="text" placeholder="ENTER ACCOUNT NUMBER" id="virtual_account_number" name="virtual_account_number" value="{{isset($get_bank_details)?$get_bank_details->virtual_account_number:old('virtual_account_number')}}">

      </div>
    </div>
      <div class="row">&nbsp;</div>
      <div class="row">
         <div class="col-md-5"></div>
         @if(isset($get_bank_details))
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
  <div class="col-md-9"></div>
   <div class="col-md-3 text-right"><button class="btn btn-info btn-xs"  id="add">
      <span class="glyphicon glyphicon-plus"></span>&nbspADD
    </button>   <a href="{{ route('basic.details') }}"><input type="button"  class="btn btn-info btn-xs" value=" BACK TO LIST"></a></div>
</div>
<div class="box">
  <div class="box-body table-responsive">
    <table class="table table-bordered text-center table-striped table-hover table-condensed" id="show-bank">
  <thead>
    <tr>
      <th>SR.NO</th>
      <th>BANK NAME</th>
      <th>BRANCH NAME</th>
      <th>ACCOUNT NUMBER</th>
      <th>IFSC CODE</th>
      <th>VIRTUAL ACCOUNT NUMBER</th>
      <th>ACTION</th>
    </tr>
  </thead>
  <tbody>
     @isset($bankdetails)
                    <?php
                    $i=1;
                    ?>
                    @foreach ($bankdetails as $key => $value)
                      <tr>
                        <td class="text-center">{{ $i }}</td>
                        <td class="text-center">{{ $value->bank_name }}</td>
                        <td class="text-center">{{ $value->branch_name }}</td>
                        <td class="text-center">{{ $value->account_number }}</td>
                        <td class="text-center">{{ $value->ifsc }}</td>
                        <td class="text-center">{{ $value->virtual_account_number }}</td>
                        <td class="text-center">
                          <a href="{{url('/editbankdetail/'.$client_id.'/eid/'.$value->id)}}"><span class="glyphicon glyphicon-pencil" id="edit-bank-detail" bank_detail_id="{{ $value->id }}"></span></a>
                          <a href="/delete/bank/{{$value->id}}"><span class="glyphicon glyphicon-trash text-danger" id="remove-bank-detail" bank_detail_id="{{ $value->id }}"></span></a>
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

     </section>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script>

     $(document).ready(function(){
      $('#add').on('click', function(){
      $('#bankbox').removeClass('divhide').addClass('divshow');
      });
      });
     </script>
     <script>
  function myFunction(){
    //alert(1);
    $('#bankbox').addClass('divhide').removeClass('divshow');
  }
  </script>
     <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
    @endsection
