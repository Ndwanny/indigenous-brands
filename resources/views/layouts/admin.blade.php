<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title')@yield('title') | Admin Panel@else Admin Panel | Indigenous Brands @endif</title>

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
            background-color: #0f172a;
            margin: 0;
            padding: 0;
            color: #e2e8f0;
        }

        /* ---- Top Navbar ---- */
        .admin-topbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 60px;
            background: #1e293b;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem 0 270px;
            z-index: 1040;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            box-shadow: 0 1px 8px rgba(0,0,0,0.4);
            transition: padding-left 0.3s;
        }

        .admin-topbar .page-title {
            color: #e2e8f0;
            font-weight: 600;
            font-size: 1rem;
        }

        .admin-topbar .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-topbar .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #fd7e14, #e65c00);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.875rem;
        }

        .admin-topbar .user-name {
            color: #94a3b8;
            font-size: 0.875rem;
        }

        .admin-topbar .admin-badge {
            background: #fd7e14;
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* ---- Sidebar ---- */
        .admin-sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: 250px;
            background: #0f172a;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.06);
        }

        .admin-sidebar::-webkit-scrollbar { width: 4px; }
        .admin-sidebar::-webkit-scrollbar-track { background: transparent; }
        .admin-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }

        .admin-sidebar-logo {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            text-align: center;
        }

        .admin-sidebar-logo img {
            max-width: 110px;
        }

        .admin-sidebar-logo .portal-label {
            display: block;
            color: #fd7e14;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 0.4rem;
        }

        .admin-sidebar nav {
            flex: 1;
            padding: 1rem 0;
        }

        .admin-sidebar .nav-section-label {
            color: rgba(255,255,255,0.25);
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.75rem 1.5rem 0.25rem;
        }

        .admin-sidebar .nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: rgba(255,255,255,0.55);
            padding: 0.65rem 1.5rem;
            font-size: 0.845rem;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            border-left: 3px solid transparent;
        }

        .admin-sidebar .nav-link .nav-link-inner {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .admin-sidebar .nav-link i {
            width: 18px;
            text-align: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .admin-sidebar .nav-link:hover {
            background: rgba(255,255,255,0.05);
            color: #e2e8f0;
            text-decoration: none;
        }

        .admin-sidebar .nav-link.active {
            background: rgba(253,126,20,0.12);
            color: #fd7e14;
            border-left-color: #fd7e14;
        }

        .admin-sidebar .sidebar-divider {
            border-top: 1px solid rgba(255,255,255,0.06);
            margin: 0.75rem 0;
        }

        .admin-sidebar .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            color: rgba(255,255,255,0.45);
            padding: 0.65rem 1.5rem;
            font-size: 0.845rem;
            font-weight: 500;
            background: none;
            border: none;
            border-left: 3px solid transparent;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            text-align: left;
        }

        .admin-sidebar .logout-btn:hover {
            background: rgba(220,53,69,0.12);
            color: #f87171;
        }

        /* ---- Badge counts ---- */
        .nav-badge {
            background: #fd7e14;
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
            line-height: 1.6;
        }

        .nav-badge.badge-danger {
            background: #dc3545;
        }

        .nav-badge.badge-info {
            background: #17a2b8;
        }

        /* ---- Main Content ---- */
        .admin-main {
            margin-left: 250px;
            padding-top: 60px;
            min-height: 100vh;
            background-color: #f1f5f9;
            color: #1e293b;
        }

        .admin-content {
            padding: 2rem;
        }

        .admin-page-header {
            margin-bottom: 1.75rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .admin-page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 0.25rem;
        }

        .admin-page-header p {
            color: #64748b;
            margin: 0;
            font-size: 0.875rem;
        }

        /* ---- Flash alerts area ---- */
        .admin-alerts {
            padding: 1rem 2rem 0;
        }

        /* ---- Responsive ---- */
        @media (max-width: 991.98px) {
            .admin-sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-topbar { padding-left: 1.5rem; }
            .admin-main { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Sidebar --}}
    <aside class="admin-sidebar">
        <div class="admin-sidebar-logo">
            <img src="https://i.ibb.co/yBPckHLQ/IBZ-Logo-Colour.png" alt="Indigenous Brands">
            <span class="portal-label">Admin Panel</span>
        </div>

        <nav>
            {{-- Core --}}
            <div class="nav-section-label">Overview</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-link-inner">
                    <i class="fa fa-tachometer"></i>
                    <span>Dashboard</span>
                </span>
            </a>

            {{-- People --}}
            <div class="nav-section-label">People</div>

            <a href="{{ route('admin.users.index') }}"
               class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <span class="nav-link-inner">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </span>
            </a>

            <a href="{{ route('admin.volunteers.index') }}"
               class="nav-link {{ request()->routeIs('admin.volunteers.*') ? 'active' : '' }}">
                <span class="nav-link-inner">
                    <i class="fa fa-hand-paper-o"></i>
                    <span>Volunteers</span>
                </span>
            </a>

            {{-- Content --}}
            <div class="nav-section-label">Content</div>

            <a href="{{ route('admin.brands.index') }}"
               class="nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                <span class="nav-link-inner">
                    <i class="fa fa-building"></i>
                    <span>Brands</span>
                </span>
            </a>

            <a href="{{ route('admin.posts.index') }}"
               class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <span class="nav-link-inner">
                    <i class="fa fa-file-text-o"></i>
                    <span>Posts</span>
                </span>
            </a>

            <a href="{{ route('admin.events.index') }}"
               class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <span class="nav-link-inner">
                    <i class="fa fa-calendar"></i>
                    <span>Events</span>
                </span>
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="nav-link-inner">
                    <i class="fa fa-tags"></i>
                    <span>Categories</span>
                </span>
            </a>

            {{-- Engagement --}}
            <div class="nav-section-label">Engagement</div>

            <a href="{{ route('admin.comments.index') }}"
               class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                <span class="nav-link-inner">
                    <i class="fa fa-comments-o"></i>
                    <span>Comments</span>
                </span>
                @php $pendingComments = \App\Models\Comment::where('approved', false)->count() @endphp
                @if($pendingComments > 0)
                    <span class="nav-badge badge-danger">{{ $pendingComments }}</span>
                @endif
            </a>

            <a href="{{ route('admin.messages.index') }}"
               class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <span class="nav-link-inner">
                    <i class="fa fa-envelope-o"></i>
                    <span>Messages</span>
                </span>
                @php $unreadMessages = \App\Models\Message::where('read', false)->count() @endphp
                @if($unreadMessages > 0)
                    <span class="nav-badge badge-info">{{ $unreadMessages }}</span>
                @endif
            </a>

            <div class="sidebar-divider"></div>

            {{-- External --}}
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <span class="nav-link-inner">
                    <i class="fa fa-globe"></i>
                    <span>View Site</span>
                </span>
            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" id="admin-logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </button>
            </form>
        </nav>
    </aside>

    {{-- Top Navbar --}}
    <header class="admin-topbar">
        <div class="page-title">
            @yield('page-title', 'Admin Panel')
        </div>

        <div class="user-info">
            <span class="admin-badge d-none d-sm-inline">Admin</span>
            @auth
                <span class="user-name d-none d-md-inline">{{ auth()->user()->name }}</span>
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endauth
        </div>
    </header>

    {{-- Main Content Area --}}
    <main class="admin-main">

        {{-- Flash Messages --}}
        <div class="admin-alerts">
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
        <div class="admin-content">
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
