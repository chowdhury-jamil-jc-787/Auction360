<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('assets/frontend/home/images/logo.png') }}" rel="icon">
  <title>Admin - {{ $fav ?? 'Dashboard' }}</title>
  <link href="{{ asset('assets/backend/home/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/backend/home/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/backend/home/css/ruang-admin.min.css') }}" rel="stylesheet">
  @stack('css')
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <x-backend.layouts.partials.sidebar/>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <x-backend.layouts.partials.topbar/>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title1 ?? 'Auction360' }}</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $title ?? 'Auction360' }}</li>
            </ol>
          </div>

          {{ $slot }}
          <!--Row-->

          <!-- Modal Logout -->
          <x-backend.layouts.partials.logout/>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <x-backend.layouts.partials.footer/>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



  <script src="{{ asset('assets/backend/home/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/backend/home/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/backend/home/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/backend/home/js/ruang-admin.min.js') }}"></script>
  <script src="{{ asset('assets/backend/home/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/backend/home/js/demo/chart-area-demo.js') }}"></script>
  @stack('js')
</body>

</html>
