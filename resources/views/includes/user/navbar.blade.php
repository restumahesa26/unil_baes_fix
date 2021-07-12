<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
        <div class="contact-info mr-auto">
            <i class="icofont-envelope"></i> <a href="mailto:rinduhati@gmail.com">rinduhati@gmail.com</a>
            <i class="icofont-phone"></i> <a href="tel:082375790919">0823-7579-0919</a>
            <i class="icofont-google-map"></i> Taba Penanjung, Kabupaten Bengkulu Tengah
        </div>
        <div class="social-links">
            <a href="https://web.facebook.com/Desawisata.rinduhati?__tn__=%3C" class="facebook" target="_blank"><i class="icofont-facebook"></i></a>
            <a href="https://www.instagram.com/desa_rinduhati/" class="instagram" target="_blank"><i class="icofont-instagram"></i></a>
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="#">RinduHati</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="@if (Route::is('home') || Route::is('serba-serbi'))
                    active
                @endif"><a href="{{ route('home') }}">Home</a></li>
                <li class="@if (Route::is('wisata') || Route::is('wisata-detail') || Route::is('beli-tiket') || Route::is('sewa'))
                    active
                @endif"><a href="{{ route('wisata') }}">Wisata</a></li>
                <li class="@if (Route::is('produk') || Route::is('produk-detail') || Route::is('beli-produk'))
                    active
                @endif"><a href="{{ route('produk') }}">Produk</a></li>
                <li class="@if (Route::is('cerita-rakyat') || Route::is('cerita-rakyat-detail'))
                    active
                @endif"><a href="{{ route('cerita-rakyat') }}">Cerita Rakyat</a></li>
                <li class="@if (Route::is('kamus-bahasa-daerah'))
                    active
                @endif"><a href="{{ route('kamus-bahasa-daerah') }}">Kamus</a></li>
                @if (Auth::user())
                    <li class="@if (Route::is('profile.edit'))
                    active
                @endif"><a href="{{ route('profile.edit') }}">Profile</a></li>
                    <li class="@if (Route::is('transaksi') || Route::is('bayar-tiket-show'))
                    active
                @endif"><a href="{{ route('transaksi') }}">Transaksi</a></li>
                @endif
                @if (Auth::user())
                @if (Auth::user()->roles == 'ADMIN')
                <li class=""><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @endif
                @endif
            </ul>
        </nav><!-- .nav-menu -->
        @if (Auth::user())
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="appointment-btn">Keluar</a>
            </form>
        @else
            <a href="{{ route('register') }}" class="appointment-btn" style="margin-right: 8px;">Register</a>
            <a href="{{ route('login') }}" class="appointment-btn" style="margin-left: 0px">Masuk</a>
        @endif
    </div>
</header><!-- End Header -->
