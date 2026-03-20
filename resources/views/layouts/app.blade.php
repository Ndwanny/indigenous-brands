<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title')@yield('title') | Indigenous Brands@else Indigenous Brands Zambia @endif</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

    {{-- Font Awesome 4.7.0 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Local CSS Assets --}}
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Scroll-to-top button styles --}}
    <style>
        .scroll-to-top {
            position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px;
            background-color: #28a745; color: #fff; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; opacity: 0; visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;
            z-index: 1000; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .scroll-to-top:hover { background-color: #e65c00; transform: scale(1.1); }
        .scroll-to-top.active { opacity: 1; visibility: visible; }
        .scroll-to-top i { font-size: 24px; }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Loader --}}
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
        </svg>
    </div>

    {{-- Navigation --}}
    @include('partials.navbar')

    {{-- Scroll-to-top button --}}
    <div class="scroll-to-top" onclick="scrollToTop()" title="Back to top">
        <i class="fa fa-chevron-up"></i>
    </div>

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('partials.footer')

    {{-- JavaScript Assets --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.animatenumber.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="{{ asset('js/google-map.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    {{-- Scroll-to-top behaviour --}}
    <script>
        function scrollToTop() { window.scrollTo({ top: 0, behavior: 'smooth' }); }
        window.addEventListener('scroll', function() {
            const btn = document.querySelector('.scroll-to-top');
            if (window.scrollY > 300) btn.classList.add('active');
            else btn.classList.remove('active');
        });
    </script>

    {{-- Page-specific scripts --}}
    @stack('scripts')

</body>
</html>
