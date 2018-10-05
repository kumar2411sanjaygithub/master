@extends('layouts.auth')
@section('content')
<style>
   .box {
   border-top: 0px solid #d2d6de !important;
   }
</style>
<div class="login-box-body">
   <div class="row text-center"><div nowrap class="col-lg-12"><span class="text-center" style="margin-top:-4px!important;font-size:20px; font-weight:600;">&nbsp; TPTCL  ONLINE  BIDDING  PORTAL </span></div></div>
   <div class="row">&nbsp;</div>
   <div class="nav-tabs-custom">
      <ul class="nav nav-pills">
         <li  class="active" style="width:50%;"><a data-toggle="pill" href="#tab_1" class="text-center" style="font-size:14px;font-weight:600;">CLIENT</a></li>
         <li style="width:49%;"><a data-toggle="pill" href="#tab_2" class="text-center" style="font-size:14px;font-weight:600;">TRADER</a></li>
      </ul>
   </div>
   @if (count($errors) > 0)
   <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
         <span class="glyphicon glyphicon-alert"></span>  {{ $error }}
      @endforeach
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
      <div id="tab_1" class="tab-pane fade in active">
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
                  <button type="submit" class="btn  btn-block btn-flat" style="background-color:#377ab7!important; color:white;">LOGIN</button>
               </div>
            </div>
         </form>
         <div class="row">&nbsp;</div>
        {{-- <a class="btn btn-link" href="{{ route('client.password.reset') }}">
         {{ __('Forgot Password?') }} --}}
         </a>
      </div>
      <div id="tab_2" class="tab-pane fade">
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
                  <button type="submit" class="btn btn-primary btn-block btn-flat" style="background-color:#377ab7!important; color:white;">LOGIN</button>
               </div>
            </div>
         </form>
         <div class="row">&nbsp;</div>
         {{--<a class="btn btn-link" href="{{ route('password.request') }}">
         {{ __('Forgot Password?') }} --}}
         </a>
      </div>
   </div>
</div>
@endsection
