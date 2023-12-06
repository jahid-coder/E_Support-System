<!DOCTYPE html>
<html>
<head>
    @include('layouts.adminpartial.layoutheader')
   
   @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @Auth
        @include('layouts.adminpartial.topbar')

        @include('layouts.adminpartial.sidebar')
    @endauth

    @yield('content')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
  @include('layouts.adminpartial.layoutscript')

</body>
</html>
