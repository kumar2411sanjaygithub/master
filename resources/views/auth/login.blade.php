@extends('layouts.auth')

@section('content')
<style>
.box {
    border-top: 0px solid #d2d6de !important;
}
</style>

<div class="login-box-body">
  <h3 style="margin-top:-4px!important;">&nbsp; TPTCL  ONLINE  BIDDING  PORTAL </h3>
  <div class="row">&nbsp;</div>
  <div class="nav-tabs-custom">
      <ul class="nav nav-tabs" id="myTab">
       <li style="float:left!important;width:48%;"><a href="#tab_1" data-toggle="tab"><span style="margin-left:40px;font-size:16px;">CLIENT</span></a></li>
       <li style="float:right!important;width:49%;"><a href="#tab_2" data-toggle="tab"><span style="margin-left:40px;font-size:16px;">TRADER</span></a></li>
    </ul>
  </div>
        @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were problems with input:
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
        @if (\Session::has('error'))
            <div class="alert alert-danger" id="successMessage1">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif
  <div class="tab-content">
     <div class="tab-pane active" id="tab_1">
        <div class="row">&nbsp;</div>
        <form action="{{ route('admin.login.submit') }}" method="post" autocomplete="nope">
           @csrf
           <div class="form-group has-feedback">
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
           </div>
           <div class="form-group has-feedback">
               <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
           </div>
           <div class="row">
              <div class="col-md-12">
                 <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
              </div>
           </div>
        </form>
        <div class="row">&nbsp;</div>
        <a class="btn btn-link" href="{{ route('client.password.reset') }}">
            {{ __('Forgot Your Password?') }}
        </a>
     </div>
     <div class="tab-pane" id="tab_2">
        <div class="row">&nbsp;</div>
        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" autocomplete="nope">
        @csrf
           <div class="form-group has-feedback">
              <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus placeholder="Username">
           </div>
           <div class="form-group has-feedback">
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
           </div>
           <div class="row">
              <div class="col-md-12">
                 <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
              </div>
           </div>
        </form>
        <div class="row">&nbsp;</div>
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
     </div>
  </div>
</div>
@endsection
