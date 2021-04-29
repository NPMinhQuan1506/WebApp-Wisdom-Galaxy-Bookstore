<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width= device-width, initial-scale = 1" />
    <title>Wisdom Galaxy Bookstore</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/swiper-bundle.css')}}" />
    <link rel="stylesheet" href="{{asset('public/frontend/css/swiper-bundle.min.css')}}" />
</head>

<body id="{{$pageId}}">


    @include('includes.header')
    <main>
        @yield('content')
    </main>
    @include('includes.footer')
    <!-- Bootstrap tether Core JavaScript -->
    <script type="text/javascript" src="{{asset('public/frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/frontend/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <!--sweetalest2 Message Box -->
    {{-- <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script> --}}
    <!-- *easing JS* -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script type="text/javascript" src="{{asset('public/frontend/js/index.js')}}"></script>
    <!-- *swiper JS* -->
    <script src="{{asset('public/frontend/js/swiper-bundle.js')}}"></script>
    <script src="{{asset('public/frontend/js/swiper-bundle.min.js')}}"></script>
    <!-- *Multi Slider JS*-->
    <script src="{{asset('public/frontend/js/multislider.min.js')}}"></script>
</body>
</html>