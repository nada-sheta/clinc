@include('dashboard.layouts.header')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('dashboard')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
@include('dashboard.layouts.nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
@include('dashboard.layouts.aside')
  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  @include('dashboard.layouts.footer')