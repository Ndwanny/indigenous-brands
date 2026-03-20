<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">

        {{-- Brand Logo --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <img style="width: 20%;" src="https://i.ibb.co/yBPckHLQ/IBZ-Logo-Colour.png" alt="Indigenous Brands Logo">
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler ibz-hamburger"
                type="button"
                data-toggle="collapse"
                data-target="#ftco-nav"
                aria-controls="ftco-nav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="ibz-bar"></span>
            <span class="ibz-bar"></span>
            <span class="ibz-bar"></span>
        </button>

        {{-- Collapsible Nav Items --}}
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">

                {{-- Home --}}
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>

                {{-- About --}}
                <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                </li>

                {{-- Brands --}}
                <li class="nav-item {{ request()->routeIs('brands.*') ? 'active' : '' }}">
                    <a href="{{ route('brands.index') }}" class="nav-link">Brands</a>
                </li>

                {{-- Events --}}
                <li class="nav-item {{ request()->routeIs('events.*') ? 'active' : '' }}">
                    <a href="{{ route('events.index') }}" class="nav-link">Events</a>
                </li>

                {{-- Blog --}}
                <li class="nav-item {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                    <a href="{{ route('blog.index') }}" class="nav-link">Blog</a>
                </li>

                {{-- Get Involved --}}
                <li class="nav-item {{ request()->routeIs('get-involved') ? 'active' : '' }}">
                    <a href="{{ route('get-involved') }}" class="nav-link">Get Involved</a>
                </li>

                {{-- Contact --}}
                <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                </li>

                {{-- Auth-conditional links --}}
                @guest
                    {{-- Login --}}
                    <li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="fa fa-sign-in mr-1"></i>Login
                        </a>
                    </li>

                    {{-- Register --}}
                    <li class="nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
                        <a href="{{ route('register') }}"
                           class="nav-link btn btn-outline-warning btn-sm px-3 ml-lg-2"
                           style="border-radius: 20px; line-height: 1.8;">
                            <i class="fa fa-user-plus mr-1"></i>Register
                        </a>
                    </li>
                @else
                    @if(auth()->user()->is_admin || auth()->user()->role === 'admin')
                        {{-- Admin Panel link --}}
                        <li class="nav-item {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="fa fa-cogs mr-1"></i>Admin Panel
                            </a>
                        </li>
                    @elseif(auth()->user()->role === 'brand_owner' || auth()->user()->is_brand_owner)
                        {{-- Brand Owner Dashboard link --}}
                        <li class="nav-item {{ request()->routeIs('brand-owner.*') ? 'active' : '' }}">
                            <a href="{{ route('brand-owner.dashboard') }}" class="nav-link">
                                <i class="fa fa-tachometer mr-1"></i>Dashboard
                            </a>
                        </li>
                    @endif

                    {{-- Logout --}}
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" id="navbar-logout-form" style="display:inline;">
                            @csrf
                            <a href="#"
                               class="nav-link"
                               onclick="event.preventDefault(); document.getElementById('navbar-logout-form').submit();">
                                <i class="fa fa-sign-out mr-1"></i>Logout
                            </a>
                        </form>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>
