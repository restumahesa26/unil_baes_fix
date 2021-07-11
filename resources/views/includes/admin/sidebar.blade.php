<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('dashboard') }}"><img src="{{ url('backend/assets/images/logo/logo-2.png') }}" alt="Logo" srcset="" width="100"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::routeIs('produk.index') || Request::routeIs('produk.create') || Request::routeIs('produk.edit') || Request::routeIs('wisata.index') || Request::routeIs('wisata.create') || Request::routeIs('wisata.edit') || Request::routeIs('cerita-rakyat.index') || Request::routeIs('cerita-rakyat.create') || Request::routeIs('cerita-rakyat.edit') || Request::routeIs('kamus.index') || Request::routeIs('kamus.create') || Request::routeIs('kamus.edit') || Request::routeIs('rekening.index') || Request::routeIs('rekening.create') || Request::routeIs('rekening.edit') || Request::routeIs('produk-filter') || Request::routeIs('wisata-filter') ? 'active' : '' }} has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Data</span>
                    </a>
                    <ul class="submenu {{ Request::routeIs('produk.index') || Request::routeIs('produk.create') || Request::routeIs('produk.edit') || Request::routeIs('wisata.index') || Request::routeIs('wisata.create') || Request::routeIs('wisata.edit') || Request::routeIs('cerita-rakyat.index') || Request::routeIs('cerita-rakyat.create') || Request::routeIs('cerita-rakyat.edit') || Request::routeIs('kamus.index') || Request::routeIs('kamus.create') || Request::routeIs('kamus.edit') || Request::routeIs('rekening.index') || Request::routeIs('rekening.create') || Request::routeIs('rekening.edit') || Request::routeIs('produk-filter') || Request::routeIs('wisata-filter') ? 'active' : '' }}">
                        <li class="submenu-item {{ Request::routeIs('produk.index') || Request::routeIs('produk.create') || Request::routeIs('produk.edit') || Request::routeIs('produk-filter') ? 'active' : '' }}">
                            <a href="{{ route('produk.index') }}">Produk</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('wisata.index') || Request::routeIs('wisata.create') || Request::routeIs('wisata.edit') || Request::routeIs('wisata-filter') ? 'active' : '' }}">
                            <a href="{{ route('wisata.index') }}">Wisata</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('cerita-rakyat.index') || Request::routeIs('cerita-rakyat.create') || Request::routeIs('cerita-rakyat.edit') ? 'active' : '' }}">
                            <a href="{{ route('cerita-rakyat.index') }}">Cerita Rakyat</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('kamus.index') || Request::routeIs('kamus.create') || Request::routeIs('kamus.edit') ? 'active' : '' }}">
                            <a href="{{ route('kamus.index') }}">Kamus</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('rekening.index') || Request::routeIs('rekening.create') || Request::routeIs('rekening.edit') ? 'active' : '' }}">
                            <a href="{{ route('rekening.index') }}">Rekening</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ Request::routeIs('e-ticket.index') || Request::routeIs('e-ticket.bukti-bayar') || Request::routeIs('e-commerce.index') || Request::routeIs('e-commerce.bukti-bayar') || Request::routeIs('e-commerce.pilih-pengiriman') || Request::routeIs('e-commerce.bukti-ongkos-kirim') || Request::routeIs('e-ticket-filter') || Request::routeIs('e-commerce-filter') ? 'active' : '' }} has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-cart-check-fill"></i>
                        <span>Transaksi</span>
                    </a>
                    <ul class="submenu {{ Request::routeIs('e-ticket.index') || Request::routeIs('e-ticket.bukti-bayar') || Request::routeIs('e-commerce.index') || Request::routeIs('e-commerce.bukti-bayar') || Request::routeIs('e-commerce.pilih-pengiriman') || Request::routeIs('e-commerce.bukti-ongkos-kirim') || Request::routeIs('e-ticket-filter') || Request::routeIs('e-commerce-filter') ? 'active' : '' }}">
                        <li class="submenu-item {{ Request::routeIs('e-ticket.index') || Request::routeIs('e-ticket.bukti-bayar') || Request::routeIs('e-ticket-filter') ? 'active' : '' }}">
                            <a href="{{ route('e-ticket.index') }}">E-Ticket</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('e-commerce.index') || Request::routeIs('e-commerce.bukti-bayar') || Request::routeIs('e-commerce.pilih-pengiriman') || Request::routeIs('e-commerce.bukti-ongkos-kirim') || Request::routeIs('e-commerce-filter') ? 'active' : '' }}">
                            <a href="{{ route('e-commerce.index') }}">E-Commerce</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ Request::routeIs('galeri.index') || Request::routeIs('galeri.create') || Request::routeIs('galeri.edit') || Request::routeIs('review.index') || Request::routeIs('serba-serbi.index') || Request::routeIs('serba-serbi.create') || Request::routeIs('serba-serbi.edit') || Request::routeIs('referensi.index') || Request::routeIs('referensi.create') || Request::routeIs('referensi.edit') || Request::routeIs('kritik-saran.index') || Request::routeIs('informasi.index') || Request::routeIs('informasi.create') || Request::routeIs('informasi.edit') ? 'active' : '' }} has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Option</span>
                    </a>
                    <ul class="submenu {{ Request::routeIs('galeri.index') || Request::routeIs('galeri.create') || Request::routeIs('galeri.edit') || Request::routeIs('review.index') || Request::routeIs('serba-serbi.index') || Request::routeIs('serba-serbi.create') || Request::routeIs('serba-serbi.edit') || Request::routeIs('referensi.index') || Request::routeIs('referensi.create') || Request::routeIs('referensi.edit') || Request::routeIs('kritik-saran.index') || Request::routeIs('informasi.index') || Request::routeIs('informasi.create') || Request::routeIs('informasi.edit') ? 'active' : '' }}" href="">
                        <li class="submenu-item {{ Request::routeIs('galeri.index') || Request::routeIs('galeri.create') || Request::routeIs('galeri.edit') ? 'active' : '' }}">
                            <a href="{{ route('galeri.index') }}">Galeri</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('informasi.index') || Request::routeIs('informasi.create') || Request::routeIs('informasi.edit') ? 'active' : '' }}">
                            <a href="{{ route('informasi.index') }}">Informasi</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('kritik-saran.index') ? 'active' : '' }}" href="{{ route('kritik-saran.index') }}">
                            <a href="{{ route('kritik-saran.index') }}">Kritik & Saran</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('review.index') ? 'active' : '' }}" href="{{ route('review.index') }}">
                            <a href="{{ route('review.index') }}">Review</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('serba-serbi.index') || Request::routeIs('serba-serbi.create') || Request::routeIs('serba-serbi.edit') ? 'active' : '' }}">
                            <a href="{{ route('serba-serbi.index') }}">Serba-Serbi</a>
                        </li>
                        <li class="submenu-item {{ Request::routeIs('referensi.index') || Request::routeIs('referensi.create') || Request::routeIs('referensi.edit') ? 'active' : '' }}">
                            <a href="{{ route('referensi.index') }}">Referensi</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('qr-code.index') }}" class='sidebar-link'>
                        <i class="bi bi-upc-scan"></i>
                        <span>Scan QR-Code</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('profile.index') }}" class='sidebar-link'>
                        <i class="bi bi-person-lines-fill"></i>
                        <span>User & Admin</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('profile.show') }}" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>Change Profile</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="{{ route('logout') }}" class="sidebar-link" onclick="event.preventDefault(); this.closest('form').submit();" class="">
                            <i class="bi bi-person-x-fill"></i>
                            <span>Log Out</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
