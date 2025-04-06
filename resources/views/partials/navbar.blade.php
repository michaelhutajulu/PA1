<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #0d3b66;">
    <div class="container">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 35px;" class="me-2">
            Bintang Serasi
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('katalog.index') }}">Katalog</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('profil_toko') }}">Profil Toko</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Wishlist</a></li>
            </ul>

            <form class="d-flex ms-3 me-3" role="search" action="{{ route('home') }}">
                <input class="form-control" type="search" name="query" placeholder="Search">
            </form>

            <a href="{{ route('login') }}" class="btn btn-outline-light d-flex align-items-center">
                <i class="bi bi-person-circle me-1"></i> Login
            </a>
        </div>
    </div>
</nav>
