<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Page Title -->
    <title>PearlCare</title>
    <!-- Favicon -->
    <link rel="icon" href="favicon.ico" />
    <link href="/medilab/assets/img/favicon.png" rel="icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!---IcoFont Icon font-->
    <link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
    <!-- Bootsrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Animate CSS -->
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gredients/granduer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/typography/poppins-quciksland.css') }}">

    <!-- Vendor CSS Files -->
    <link href="/medilab/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/medilab/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="/medilab/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/medilab/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/medilab/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/medilab/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/medilab/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/medilab/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/medilab/assets/css/style.css" rel="stylesheet">

</head>

<body data-spy="scroll" data-target="#navbarCodeply" data-offset="70">

    @include('client.partials.navbar')
    @yield('content')
</body>

<!-- jQuery -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.textillate.js') }}"></script>
<script src="{{ asset('js/jquery.lettering.js') }}"></script>
<script src="{{ asset('js/jquery.fittext.js') }}"></script>
<script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('js/swiper.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<!-- Vendor JS Files -->
<script src="/medilab/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="/medilab/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/medilab/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/medilab/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/medilab/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="/medilab/assets/js/main.js"></script>


</html>
