<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #0d3b66;">
    <div class="container d-flex align-items-center">
        {{-- Kiri: Logo --}}
        <a class="navbar-brand text-white fw-bold d-flex align-items-center me-4" href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 35px;" class="me-2 rounded-circle bg-secondary p-1">
            Bintang Serasi
        </a>

        {{-- Tengah: Search Bar --}}
        <form class="flex-grow-1 me-4" role="search" action="{{ route('search') }}" method="GET">
        <div class="input-group">
                <input class="form-control rounded-pill px-4" type="search" name="query" placeholder="Cari di Bintang Serasi">
                <button class="btn btn-light rounded-pill position-absolute end-0 me-2" type="submit" style="z-index: 1;">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        {{-- Kanan: Menu + Auth --}}
        <div class="d-flex align-items-center">
            <ul class="navbar-nav flex-row gap-3 me-3">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="{{ route('home') }}">BERANDA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="{{ route('katalog.index') }}">KATALOG</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="{{ route('profil_toko') }}">PROFIL TOKO</a>
                </li>

                {{-- Tampilkan Favorit hanya jika user login --}}
                @auth
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold d-flex align-items-center" href="{{ route('favorit.index') }}">
                        <i></i> FAVORIT
                    </a>
                </li>
                @endauth
            </ul>

            {{-- Auth Section --}}
            @guest
                <a href="{{ route('login') }}" class="text-white fs-5">
                    <i class="bi bi-person-circle"></i>
                </a>
            @else
                <div class="dropdown">
                    <a class="text-white fs-5 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if (Auth::user()->email === 'admin@bintangserasi.com')
                            <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Kelola</a></li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
    </div>
</nav>
