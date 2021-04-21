<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="{{asset('frontend/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!--  Main CSS File -->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/responcive.css')}}">

    <!-- Toastr -->
    <script src="{{asset('js/jquery-1.9.1.min.js')}}"></script>
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet" />
    <script src="{{asset('js/toastr.js')}}"></script>
    @yield('head-part')
</head>

<body>
    @yield('content')

    <!-- frontend JS Files -->
    <script src="{{asset('frontend/aos/aos.js')}}"></script>
    <script src="{{asset('frontend/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/php-email-form/validate.js')}}"></script>
    <script src="{{asset('frontend/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
</body>

</html>