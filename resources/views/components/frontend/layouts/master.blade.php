<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Auction360</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/frontend/home/images/logo.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('assets/frontend/home/images/apple-touch-icon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/home/css/bootstrap.min.css') }}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/home/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/home/css/responsive.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/home/css/custom.css') }}">

    @stack('css')



</head>

<body>


    <!-- Start Products  -->
    {{ $slot }}
    <!-- End Products  -->

    <!-- Start Blog  -->

    <!-- End Blog  -->





    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="{{ asset('assets/frontend/home/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/bootstrap.min.js') }}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{ asset('assets/frontend/home/js/jquery.superslides.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/inewsticker.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/bootsnav.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/images-loded.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/baguetteBox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/contact-form-script.js') }}"></script>
    <script src="{{ asset('assets/frontend/home/js/custom.js') }}"></script>
</body>

</html>
