@extends('layouts.auth')

@section('content')

<style>
.box {
    border-top: 0px solid #d2d6de !important;
}
</style>

<div class="login-box-body">
  <h3 style="margin-top:-4px!important;text-decoration: underline;">&nbsp TPTCL  ONLINE  BIDDING  PORTAL </h3>
  <div class="row">&nbsp;</div>
  <h4 style="margin-top:-4px!important;color: #3e2121;" align='center'>&nbsp Reset Password</h4>
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
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

  <div class="tab-content">
     <div class="tab-pane active" id="tab_1">
        <div class="row">&nbsp;</div>
        <form method="POST" action="{{ route('client.password.reset') }}" aria-label="{{ __('Reset Password') }}">
        {{ csrf_field() }}
           <div class="form-group has-feedback">
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="EMAIL ID">
           </div>
           <div class="row">
              <div class="col-md-12">
                 <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Send Password Reset Link') }}</button>
              </div>
           </div>
        </form>
        <div class="row" style="text-align: center;">&nbsp;
            <a class="btn btn-link" href="{{ route('login') }}" >
            {{ __('Back To Login') }}
        </a></div>
        
     </div>
  </div>
</div>

@endsection
