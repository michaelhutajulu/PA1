<!-- Google Material Symbols and Bootstrap Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<style>
    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24;
        vertical-align: middle;
        font-size: 24px;
    }

    /* Hover underline effect for navbar links */
    .nav-link.hover-underline {
        position: relative;
        display: block;
        text-transform: uppercase;
        padding: 10px 20px;
        color: #fff;
        font-weight: 600;
        transition: .5s;
        z-index: 1;
        text-decoration: none;
    }

    .nav-link.hover-underline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-top: 2px solid #fff;
        border-bottom: 2px solid #fff;
        transform: scaleY(2);
        opacity: 0;
        transition: .3s;
    }

    .nav-link.hover-underline::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.15);
        transform: scale(0);
        opacity: 0;
        transition: .3s;
        z-index: -1;
    }

    .nav-link.hover-underline:hover {
        color: #fff;
    }

    .nav-link.hover-underline:hover::before {
        transform: scaleY(1);
        opacity: 1;
    }

    .nav-link.hover-underline:hover::after {
        transform: scaleY(1);
        opacity: 1;
    }

    .navbar.scrolled {
        padding: 0.4rem 0;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        transition: all 0.3s ease;
    }

    .custom-search-btn {
        transition: all 0.2s ease;
    }

    .custom-search-btn:hover {
        background-color: #0d3b66;
        color: white;
    }

    .navbar-icon {
        transition: all 0.3s ease;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .navbar-icon:hover {
        background-color: rgba(255, 255, 255, 0.15);
        transform: scale(1.1);
    }

    .dropdown-menu {
        border: none;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #e9f0ff;
    }
</style>

<nav class="navbar navbar-expand-lg shadow-sm sticky-top" style="background-color: #0d3b66;">
    <div class="container d-flex align-items-center">
        {{-- Kiri: Logo --}}
        <a class="navbar-brand text-white fw-bold d-flex align-items-center me-4" href="{{ route('home') }}">
            <div class="rounded-circle me-2 d-flex align-items-center justify-content-center"
                 style="height: 38px; width: 38px;">
                <img src="{{ asset('logo.png') }}" alt="Logo Bintang Serasi"
                     style="height: 30px; object-fit: contain;">
            </div>
            <span style="letter-spacing: 0.5px;">Bintang Serasi</span>
        </a>

                {{-- Tengah: Search Bar --}}
        <form class="flex-grow-1 me-4 d-none d-md-block" role="search" action="{{ route('search') }}" method="GET">
            <div class="input-group position-relative">
                <input class="form-control rounded-pill px-4 border-0 shadow-sm" type="search" name="query"
                    placeholder="Cari di Bintang Serasi" style="height: 42px;">
                <button
                    class="btn custom-search-btn rounded-pill position-absolute end-0 me-2 d-flex align-items-center justify-content-center"
                    type="submit" style="z-index: 1; height: 34px; width: 34px; margin-top: 4px;">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        {{-- Mobile Toggle Button --}}
        <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>

        {{-- Kanan: Menu + Auth --}}
        <div class="collapse navbar-collapse" id="navbarContent">
            <div class="d-flex align-items-center ms-auto">
                <ul class="navbar-nav flex-row gap-2 me-3">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold hover-underline" href="{{ route('home') }}">BERANDA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold hover-underline"
                            href="{{ route('katalog.index') }}">KATALOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold hover-underline" href="{{ route('profil_toko') }}">PROFIL
                            TOKO</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold hover-underline"
                                href="{{ route('favorit.index') }}">FAVORIT</a>
                        </li>
                    @endauth
                </ul>

                {{-- Auth Section --}}
                @guest
                    <a href="javascript:void(0)" onclick="toggleLoginModal()" class="text-white navbar-icon" title="Login">
                        <span class="material-symbols-outlined">login</span>
                    </a>
                @else
                    <div class="dropdown">
                        <a class="text-white navbar-icon" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="material-symbols-outlined">person</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-2 mt-2">
                            <li class="dropdown-item-text fw-semibold text-primary mb-1 ps-2">
                                {{ Auth::user()->name }}
                            </li>
                            <li>
                                <hr class="dropdown-divider my-2" style="border-color: #0d6efd; opacity: 0.2;">
                            </li>

                            @if (Auth::user()->email === 'admin@bintangserasi.com')
                                <li><a class="dropdown-item py-2" href="{{ url('/dashboard') }}">Dashboard</a></li>
                            @endif

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger py-2">
                                        <span class="material-symbols-outlined me-2" style="font-size: 18px;">logout</span>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest

                {{-- Mobile Search --}}
                <a class="text-white navbar-icon ms-2 d-md-none" data-bs-toggle="collapse" href="#mobileSearch"
                    role="button" aria-expanded="false" aria-controls="mobileSearch">
                    <span class="material-symbols-outlined" style="color:white;">search</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Mobile Search Collapsible --}}
    <div class="collapse w-100 mt-2 px-3 pb-3 d-md-none" id="mobileSearch">
        <form role="search" action="{{ route('search') }}" method="GET">
            <div class="input-group position-relative">
                <input class="form-control rounded-pill px-4 border-0 shadow-sm" type="search" name="query"
                    placeholder="Cari di Bintang Serasi" style="height: 42px;">
                <button
                    class="btn custom-search-btn rounded-pill position-absolute end-0 me-2 d-flex align-items-center justify-content-center"
                    type="submit" style="z-index: 1; height: 34px; width: 34px; margin-top: 4px;">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
</nav>
