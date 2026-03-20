<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title')@yield('title') | Indigenous Brands@else Indigenous Brands Zambia @endif</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    {{-- Bootstrap 4.5 CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    {{-- Font Awesome 4.7.0 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 0 1rem;
        }

        .auth-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        }

        .auth-card-header {
            background: linear-gradient(135deg, #fd7e14, #e65c00);
            padding: 2rem;
            text-align: center;
        }

        .auth-card-header img {
            max-width: 140px;
            margin-bottom: 0.75rem;
        }

        .auth-card-header h4 {
            color: #fff;
            font-weight: 700;
            margin: 0;
            font-size: 1.25rem;
        }

        .auth-card-body {
            padding: 2rem;
        }

        .btn-primary {
            background-color: #fd7e14;
            border-color: #fd7e14;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background-color: #e65c00;
            border-color: #e65c00;
        }

        .form-control:focus {
            border-color: #fd7e14;
            box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.25);
        }

        .auth-footer-links {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.875rem;
        }

        .auth-footer-links a {
            color: #fd7e14;
            font-weight: 500;
        }

        .auth-footer-links a:hover {
            color: #e65c00;
            text-decoration: underline;
        }

        .back-home {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-home a {
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-home a:hover {
            color: #fd7e14;
        }

        .back-home i {
            margin-right: 4px;
        }
    </style>

    @stack('styles')
</head>
<body>

    <div class="auth-wrapper">

        {{-- Brand Logo & Card Header --}}
        <div class="auth-card">
            <div class="auth-card-header">
                <img src="https://i.ibb.co/yBPckHLQ/IBZ-Logo-Colour.png" alt="Indigenous Brands Logo">
                <h4>@yield('card-title', 'Welcome Back')</h4>
            </div>

            <div class="auth-card-body">

                {{-- Flash Messages --}}
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle mr-2"></i>{{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-circle mr-2"></i>{{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Page Content --}}
                @yield('content')

            </div>
        </div>

        {{-- Back to Home --}}
        <div class="back-home">
            <a href="{{ route('home') }}">
                <i class="fa fa-arrow-left"></i>Back to Indigenous Brands
            </a>
        </div>

    </div>

    {{-- Bootstrap 4.5 + jQuery CDN --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
            integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    @stack('scripts')

</body>
</html>
