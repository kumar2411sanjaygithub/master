<!DOCTYPE html>
<html>
<head>
     @include('theme.includes.header')
     @yield('content_head')
</head>
<body class="hold-transition skin-black-light fixed sidebar-mini sidebar-mini-expand-feature">
   <div class="wrapper">
       @include('theme.includes.top')
       @include('theme.includes.navbar')
        <!-- Content Wrapper. Contains page content -->
        <br>
      <div class="content-wrapper">
         @yield('content')
         <!-- /.content -->
      </div>
         <!-- /.content-wrapper -->
      @include('theme.includes.footer')
      <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
   </div>
   <!-- ./wrapper -->
   <!-- jQuery 3 -->
   @include('theme.includes.footer_files')
   @yield('content_foot')
</body>
</html>
