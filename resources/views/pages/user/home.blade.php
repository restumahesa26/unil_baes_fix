@extends('layouts.user')

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <marquee width="100%" height="30" style="font-size: 20px; color: #fff;">@foreach ($informasis as $informasi)
            {{ $informasi->informasi }}. &nbsp; &nbsp; &nbsp;
        @endforeach</marquee>
        <h1>Selamat Datang Di Desa Rindu Hati</h1>
        <h2>Tempat Destinasi Wisata Favorit dan Beragam Cerita Rakyat Menarik</h2>
        <a href="#about" class="btn-get-started scrollto">Jelajahi</a>
    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="content">
                        <h3>Desa Rindu Hati</h3>
                        <p style="text-align: justify">
                            Rindu Hati adalah salah satu desa di Kecamatan Taba Penanjung yang terletak sekitar 8 km di sebelah timur Kantor Kecamatan Taba Penanjung Kabupaten Bengkulu Tengah. Sebelah utara dibatasi oleh Desa Tanjung Heran, sebelah timur dibatasi oleh Kabupaten Kepahiang, sebelah selatan adalah Kabupaten Seluma dan di sebelah barat adalah Desa Taba Teret Kec. Taba Penanjung.
                        </p>
                        <div class="text-center">
                            <a href="{{ route('serba-serbi') }}" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-cart"></i>
                                    <h4>E-Commerce</h4>
                                    <p>Fitur ini merupakan tempat jual-beli produk komoditas masyarakat Desa Rindu Hati.
                                    </p>
                                    <a href="{{ route('produk') }}" class="btn btn-info btn-detail-home" style="background-color: #1977cc; padding: 7px 50px; border-radius: 20px;">Detail</a>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-spreadsheet"></i>
                                    <h4>E-Ticket</h4>
                                    <p>Fitur ini merupakan tempat pemesanan tiket wisata maupun sewa tempat di Desa Rindu Hati.
                                    </p>
                                    <a href="{{ route('wisata') }}" class="btn btn-info btn-detail-home" style="background-color: #1977cc; padding: 7px 50px; border-radius: 20px;">Detail</a>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-happy"></i>
                                    <h4>Serba-Serbi Rindu Hati</h4>
                                    <p>Fitur ini berisikan tentang asal-usul dan sejarah dari Desa Rindu Hati.
                                    </p>
                                    <a href="{{ route('serba-serbi') }}" class="btn btn-info btn-detail-home" style="background-color: #1977cc; padding: 7px 50px; border-radius: 20px;">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch">
                    <a href="https://www.youtube.com/watch?v=2EhAzLxQHMw" class="venobox play-btn mb-4"
                        data-vbtype="video" data-autoplay="true"></a>
                </div>

                <div
                    class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                    <h3>Penjelasan Fitur Aplikasi</h3>
                    <p>Video tersebut adalah video tutorial penggunan aplikasi, mulai dari dari pemesanan tiket wisata, penyewaan tenda atau camp, membaca cerita rakyat, pembelian produk komoditas masyarakat, serta fitur belajar bahasa rejang melalui kamus online.</p>

                    <div class="icon-box">
                        <div class="icon"><i class='bx bx-barcode-reader'></i></div>
                        <h4 class="title"><a href="{{ route('wisata') }}">E-Ticket</a></h4>
                        <p class="description">Pemesanan tiket wisata maupun penyewaan tenda atau camp bisa dilakukan secara online dengan bukti pemesanan atau penyewaan berupa QR-Code.</p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class='bx bxs-cart-add'></i></div>
                        <h4 class="title"><a href="{{ route('produk') }}">E-Commerce</a></h4>
                        <p class="description">Pembelian produk komoditas masyarakat Desa Rindu Hati dapat dilakukan secara cepat dan mudah dari rumah masing-masing secara online. </p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class='bx bxs-book-reader'></i></div>
                        <h4 class="title"><a href="{{ route('cerita-rakyat') }}">Cerita Rakyat</a></h4>
                        <p class="description">Membaca sejumlah cerita rakyat menarik yang dapat menambah wawasan tentang kebudayaan Desa Rindu Hati</p>
                    </div>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <section id="appointment" class="appointment section-bg" style="margin-top: -90px !important;">
            <div class="container">

                <div class="section-title">
                    <h2>Kamus Bahasa Daerah Rejang</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="text-center">
                    <a href="{{ route('kamus-bahasa-daerah') }}" class="btn btn-cari-tahu" style="background-color: #1977cc; color: #fff; border-radius: 20px; padding: 8px 40px;">Cari Tahu Sekarang</a>
                </div>

            </div>
        </section><!-- End Appointment Section -->

        <section id="informasi-desa" class="informasi-desa" style="margin-bottom: -50px;">
            <div class="container" >

                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="icofont-earth"></i>
                            <span data-toggle="counter-up">{{ $referensis->luas_desa }}</span>
                            <p>Luas Desa ( Km <sup>2</sup> )</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="count-box">
                            <i class="icofont-users-alt-5"></i>
                            <span data-toggle="counter-up">{{ $referensis->jml_penduduk }}</span>
                            <p>Jumlah Penduduk</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="icofont-image"></i>
                            <span data-toggle="counter-up">{{ $wisata2 }}</span>
                            <p>Destinasi Wisata</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="icofont-long-drive"></i>
                            <span data-toggle="counter-up">{{ $referensis->jarak_kecamatan }}</span>
                            <p>Jarak Ke Kecamatan ( Km )</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="wisata" class="wisata">
        <div class="container">

            <div class="section-title">
                <h2>Destinasi</h2>
                <p>Kunjungi semua destinasi wisata menarik dan favorit yang terdapat di Desa Rindu Hati. Dengan menggunakan fitur e-ticket, pemesanan dan pemriksaan tiket menjadi lebih mudah dan cepat.</p>
            </div>

            <div class="row">
                @foreach ($wisatas as $wisata)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-2">
                        <a href="{{ route('wisata-detail', $wisata->id) }}">
                            <div class="icon-box">
                                <div class="icon">
                                    @foreach ($wisata->gambar_wisata as $re => $ii)
                                        @if($wisata->gambar_wisata->first() == $ii)
                                            <img src="{{ asset('storage/images/gambar-wisata/'. $ii->gambar_url) }}" alt="">
                                        @endif
                                    @endforeach
                                </div>
                                <h4><a href="{{ route('wisata-detail', $wisata->id) }}">{{ $wisata->nama_wisata }}</a></h4>
                                <h5 style="font-size: 14px; color: #1977cc">Kategori : @if ($wisata->kategori == 'wisata')
                                    Tempat Wisata
                                    @elseif ($wisata->kategori == 'glamping')
                                    Glamping
                                    @elseif ($wisata->kategori == 'tubing')
                                    Tubing
                                    @elseif ($wisata->kategori == 'camping')
                                    Camping Ground
                                @endif</h5>
                                <p>{!! $wisata->deskripsi !!}</p>
                                <a href="{{ route('wisata-detail', $wisata->id) }}" class="btn btn-info btn-detail-wisata">
                                    Detail
                                </a>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('wisata') }}" class="btn btn-primary mt-4 btn-lihat-lebih-wisata">Lihat Lebih Banyak Wisata</a>
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Doctors Section ======= -->
    <section id="produk" class="produk">
        <div class="container">

            <div class="section-title">
                <h2>Produk Komoditas Masyarakat</h2>
                <p>Pesan produk komoditas masyarakat Desa Rindu Hati. Produk-produk tersebut merupakan hasil asli dari masyarakat Desa Rindu Hati. Nikmati pemesanan produk secara mudah serta pengiriman yang cepat, yang memberdayakan ojek lokal Desa Rindu Hati.</p>
            </div>

            <div class="row">
                @foreach ($produks as $produk)
                <div class="col-lg-6">
                    <div class="member d-flex align-items-start">
                        <div class="pic">
                            @foreach ($produk->gambar_produk as $re => $ii)
                                @if($produk->gambar_produk->first() == $ii)
                                    <img src="{{ asset('storage/images/gambar-produk/'. $ii->gambar_url) }}" alt="">
                                @endif
                            @endforeach
                        </div>
                        <div class="member-info">
                            <h4>{{ $produk->nama_produk }}</h4>
                            <span>{{ $produk->kategori }}</span>
                            <p>{{ $produk->deskripsi }}</p>
                            <div class="social d-flex justify-content-end">
                                <a href="{{ route('produk-detail', $produk->id) }}" class="btn"><i class="icofont-eye-alt"></i></a>
                                <h5><strong>{{ rupiah($produk->harga) }}</strong></h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('produk') }}" class="btn btn-primary mt-4 btn-lihat-lebih-produk">Lihat Lebih Banyak Produk Komoditas</a>
            </div>
        </div>
    </section><!-- End Doctors Section -->

    <section id="cerita" class="cerita">
        <div class="container">

            <div class="section-title">
                <h2>Cerita Rakyat</h2>
                <p>Ketahui semua cerita rakyat dari Desa Rindu Hati untuk menambah pengetahuan serta wawasan tentang kebudayaan yang terdapat di Desa Rindu Hati. Serta melestarikan cerita rakyat yang terdapat di Desa Rindu Hati.</p>
            </div>

            <div class="row">
                @foreach ($ceritas as $cerita)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-2">
                        <a href="">
                            <div class="icon-box">
                                <div class="icon">
                                    <img src="{{ asset('storage/images/gambar-cerita/'. $cerita->gambar_cerita) }}" alt="">
                                </div>
                                <h4 class="h4"><a class="a" href="">{{ $cerita->judul }}</a></h4>
                                <p class="text-cerita">{!! $cerita->deskripsi !!}</p>
                                <a href="{{ route('cerita-rakyat-detail', $cerita->id) }}" class="btn btn-info btn-detail-wisata">
                                    Detail
                                </a>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('cerita-rakyat') }}" class="btn btn-primary mt-4 btn-lihat-lebih-cerita">Lihat Lebih Banyak Cerita Rakyat</a>
            </div>

        </div>
    </section><!-- End Services Section -->

    @if (Auth::user())
        @if ($review == null)
            <!-- ======= Appointment Section ======= -->
        <section id="appointment" class="appointment section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Review Website</h2>
                    <p>Masukkan review anda tentang pengalaman anda menggunakan website Rindu Hati</p>
                </div>

                <form action="{{ route('review.store') }}" method="POST">
                    @csrf
                    <div class="form-group text-center">
                        <label for="review" style="font-size: 22px;">Review</label>
                        <sup class="text-danger">**review yang anda masukkan tidak dapat dirubah</sup>
                        <textarea class="form-control" name="review" rows="4" id="review"
                            placeholder="Masukkan Review Anda Tentang Website RinduHati"></textarea>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn" style="background-color: #1977cc; color: #fff; border-radius: 20px; padding: 8px 40px;">Buat Review</button>
                    </div>
                </form>

            </div>
        </section><!-- End Appointment Section -->
        @endif
    @endif

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container">

            @if ($review != null)
                <h2 class="text-center" style="font-size: 32px; font-weight: bold;
            color: #2c4964;">Review Website</h2>
            @endif

            <div class="owl-carousel testimonials-carousel">

                @foreach ($reviews as $revi)
                    <div class="testimonial-wrap">
                        <div class="testimonial-item">
                            @if ($revi->user->jenis_kelamin === 'Laki-Laki')
                                <img src="{{ url('backend/assets/images/faces/2.jpg') }}" class="testimonial-img" alt="">
                            @elseif ($revi->user->jenis_kelamin === 'Perempuan')
                                <img src="{{ url('backend/assets/images/faces/3.jpg') }}" class="testimonial-img" alt="">
                            @endif
                            <h3>{{ $revi->user->name }}</h3>
                            <h4 style="text-transform: capitalize">{{ $revi->user->pekerjaan }}</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                {{ $revi->review }}
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container">

            <div class="section-title">
                <h2>Galeri</h2>
                <p>Galeri tentang Desa Rindu Hati, mulai dari objek wisata lokal, kegiatan masyarakat, produk komoditas masyarakat, serta banyak hal menarik lainnya.</p>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row no-gutters justify-content-center">
                @foreach ($galeris as $galeri)
                    <div class="col-lg-3 col-md-4 mt-2">
                        <div class="gallery-item">
                            <a href="{{ asset('storage/images/galeri/'. $galeri->image_url) }}" class="venobox" data-gall="gallery-item">
                                <img src="{{ asset('storage/images/galeri/'. $galeri->image_url) }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Petunjuk Arah</h2>
                <p>Klik google maps dibawah ini untuk melihat petunjuk arah ke Desa Rindu Hati.</p>
            </div>
        </div>

        <div>
            <iframe style="border:0; width: 100%; height: 350px;"
                src="https://maps.google.com/maps?q=unib&t=k&z=15&ie=UTF8&iwloc=&output=embed"
                frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="text-center mt-3">
            <h3>Supported By</h3>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <img src="{{ url('frontend/assets/img/kemdikbud.png') }}" alt="" width="250">
                    <p>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN <br> DIREKTORAT JENDERAL</p>
                </div>
                <div class="col-lg-3">
                    <img src="{{ url('frontend/assets/img/kemahbudaya.png') }}" alt="" width="250">
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->
@endsection

@push('addon-script')
<script src="{{ url('frontend/assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

@if (Session::get('berhasil-kritik'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Terimakasih',
        text: 'Kritik/Saran Anda Berhasil Dikirim'
    })
</script>
@endif

@if (Session::get('berhasil-review'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Terimakasih',
        text: 'Review Anda Berhasil Dikirim'
    })
</script>
@endif

@if (Session::get('success-subscribe'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Terimakasih',
        text: 'Berhasil Subscribe Website'
    })
</script>
@endif

@endpush

@push('addon-style')
    <link href="{{ url('frontend/assets/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
@endpush
