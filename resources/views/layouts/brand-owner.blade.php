<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title')@yield('title') | Brand Owner Portal@else Brand Owner Portal | Indigenous Brands @endif</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    {{-- Font Awesome 4.7.0 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Local CSS Assets --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        /* ---- Top Navbar ---- */
        .bo-topbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 60px;
            background: linear-gradient(135deg, #fd7e14, #e65c00);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem 0 270px;
            z-index: 1040;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: padding-left 0.3s;
        }

        .bo-topbar .brand-name {
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 55%;
        }

        .bo-topbar .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .bo-topbar .user-info .user-avatar {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .bo-topbar .user-info .user-name {
            color: #fff;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* ---- Sidebar ---- */
        .bo-sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: 250px;
            background: #1a1a2e;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        }

        .bo-sidebar-logo {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            text-align: center;
        }

        .bo-sidebar-logo img {
            max-width: 110px;
        }

        .bo-sidebar-logo .portal-label {
            display: block;
            color: #fd7e14;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 0.4rem;
        }

        .bo-sidebar nav {
            flex: 1;
            padding: 1rem 0;
        }

        .bo-sidebar .nav-section-label {
            color: rgba(255,255,255,0.35);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 0.75rem 1.5rem 0.25rem;
        }

        .bo-sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255,255,255,0.65);
            padding: 0.7rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            border-left: 3px solid transparent;
        }

        .bo-sidebar .nav-link i {
            width: 18px;
            text-align: center;
            font-size: 0.95rem;
        }

        .bo-sidebar .nav-link:hover {
            background: rgba(255,255,255,0.07);
            color: #fff;
        }

        .bo-sidebar .nav-link.active {
            background: rgba(253,126,20,0.15);
            color: #fd7e14;
            border-left-color: #fd7e14;
        }

        .bo-sidebar .sidebar-divider {
            border-top: 1px solid rgba(255,255,255,0.08);
            margin: 0.75rem 0;
        }

        .bo-sidebar .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255,255,255,0.55);
            padding: 0.7rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            background: none;
            border: none;
            border-left: 3px solid transparent;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            text-align: left;
        }

        .bo-sidebar .logout-btn:hover {
            background: rgba(220,53,69,0.15);
            color: #f87171;
        }

        /* ---- Main Content ---- */
        .bo-main {
            margin-left: 250px;
            padding-top: 60px;
            min-height: 100vh;
        }

        .bo-content {
            padding: 2rem;
        }

        .bo-page-header {
            margin-bottom: 1.75rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .bo-page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0 0 0.25rem;
        }

        .bo-page-header p {
            color: #6c757d;
            margin: 0;
            font-size: 0.875rem;
        }

        /* ---- Flash Messages ---- */
        .bo-alerts {
            padding: 1rem 2rem 0;
        }

        /* ---- Responsive ---- */
        @media (max-width: 767.98px) {
            .bo-sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            .bo-sidebar.open { transform: translateX(0); }
            .bo-topbar { padding-left: 1.5rem; }
            .bo-main { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Sidebar --}}
    <aside class="bo-sidebar">
        <div class="bo-sidebar-logo">
            <img src="https://i.ibb.co/yBPckHLQ/IBZ-Logo-Colour.png" alt="Indigenous Brands">
            <span class="portal-label">Brand Owner Portal</span>
        </div>

        <nav>
            <div class="nav-section-label">Main Menu</div>

            <a href="{{ route('brand-owner.dashboard') }}"
               class="nav-link {{ request()->routeIs('brand-owner.dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer"></i>
                <span>Dashboard</span>
            </a>

            @auth
                <a href="{{ auth()->user()->brand
                            ? route('brand-owner.brand.edit', auth()->user()->brand)
                            : route('brand-owner.brand.create') }}"
                   class="nav-link {{ request()->routeIs('brand-owner.brand.*') ? 'active' : '' }}">
                    <i class="fa fa-building"></i>
                    <span>Brand Profile</span>
                </a>
            @endauth

            <div class="nav-section-label">Content</div>

            <a href="{{ route('brand-owner.posts.index') }}"
               class="nav-link {{ request()->routeIs('brand-owner.posts.index') ? 'active' : '' }}">
                <i class="fa fa-file-text-o"></i>
                <span>My Posts</span>
            </a>

            <a href="{{ route('brand-owner.posts.create') }}"
               class="nav-link {{ request()->routeIs('brand-owner.posts.create') ? 'active' : '' }}">
                <i class="fa fa-plus-circle"></i>
                <span>New Post</span>
            </a>

            <div class="sidebar-divider"></div>

            <div class="nav-section-label">Other</div>

            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <i class="fa fa-globe"></i>
                <span>View Site</span>
            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" id="bo-logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </button>
            </form>
        </nav>
    </aside>

    {{-- Top Navbar --}}
    <header class="bo-topbar">
        <div class="brand-name">
            @auth
                @if(auth()->user()->brand)
                    <i class="fa fa-building mr-2"></i>{{ auth()->user()->brand->name }}
                @else
                    <i class="fa fa-building-o mr-2"></i>My Brand
                @endif
            @endauth
        </div>

        <div class="user-info">
            @auth
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="user-name d-none d-sm-inline">{{ auth()->user()->name }}</span>
            @endauth
        </div>
    </header>

    {{-- Main Content Area --}}
    <main class="bo-main">

        {{-- Flash Messages --}}
        <div class="bo-alerts">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle mr-2"></i>{{ session('success') }}
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

            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-triangle mr-2"></i>{{ session('warning') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fa fa-info-circle mr-2"></i>{{ session('info') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle mr-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <div class="bo-content">
            @yield('content')
        </div>

    </main>

    {{-- JavaScript --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    @stack('scripts')

</body>
</html>
