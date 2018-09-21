<!DOCTYPE html>
<html lang="en">

<head>
    @include('login-partials.head')
    <style type="text/css">
      .background-img{
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url(http://localhost:8000/img/pets1.jpg);
      }
    </style>
    <style type="text/css">
      .alert-success {
        color: #3c763d !important;
        background-color: #dff0d8 !important;
        border-color: #d6e9c6 !important;
    }
    .alert-info {
        color: #31708f !important;
        background-color: #d9edf7 !important;
        border-color: #bce8f1 !important;
    }
    .alert-warning {
        color: #8a6d3b !important;
        background-color: #fcf8e3 !important;
        border-color: #faebcc !important;
    }
    .alert-danger {
        color: #a94442 !important;
        background-color: #f2dede !important;
        border-color: #ebccd1 !important;
    }
    </style>    
</head>

<body class="hold-transition sidebar-mini background-img">
  <section class="content">
     <div class="row">
        <div class="col-xs-12">
           <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                 <div class="box" style="margin-top:25%;">
                    <div class="well">
                    @yield('content')
                    </div>
                <!-- /.login-box-body -->
                </div>
             <div class="col-md-4"></div>
          </div>
       </div>
    </div>
    <!-- /.login-box -->
  </div>
  </div>


    @include('login-partials.javascripts')

</body>
</html>
