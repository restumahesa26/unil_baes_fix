<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Medilab</h3>
                    <p>
                        Desa Rindu Hati<br>
                        Kecamatan Taba Penanjung<br>
                        Kabupaten Bengkulu Tengah<br><br>
                        <strong>Phone :</strong> <a href="tel:082375790919" style="text-decoration: none; color: inherit;">0823-7579-0919</a><br>
                        <strong>Email :</strong> <a href="mailto:rinduhati@gmail.com" style="text-decoration: none; color: inherit;">rinduhati@gmail.com</a><br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Menu</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('wisata') }}">Destinasi</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('produk') }}">Produk</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('cerita-rakyat') }}">Cerita Rakyat</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('kamus-bahasa-daerah') }}">Kamus </a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Fitur Web</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#why-us" class="scrollto">Serba-Serbi Rindu Hati</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#informasi-desa" class="scrollto">Informasi Desa</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#produk" class="scrollto">E-Commerce</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#wisata" class="scrollto">E-Ticket</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#gallery" class="scrollto">Galeri</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#contact" class="scrollto">Petunjuk Arah</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Join Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    <form action="{{ route('subscribe-email') }}" method="POST">
                        @csrf
                        <input type="email" name="email" class="form-control">
                        <input type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="mr-md-auto text-center text-md-left">
            <div class="copyright">
                &copy; Copyright <strong><span>Desa Rindu Hati</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/ -->
                Designed & Developed by <a href="#">Unil Ba'es</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="https://web.facebook.com/Desawisata.rinduhati?__tn__=%3C" class="facebook" target="_blank"><i class="icofont-facebook"></i></a>
            <a href="https://www.instagram.com/desa_rinduhati/" class="instagram" target="_blank"><i class="icofont-instagram"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->
