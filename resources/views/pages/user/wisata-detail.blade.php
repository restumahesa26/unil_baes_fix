@extends('layouts.user')

@section('content')
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Wisata</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('wisata') }}">Wisata</a></li>
                    <li>{{ $item->nama_wisata }}</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="detail-wisata" class="detail-wisata" style="margin-top: -40px;">
        <div class="container">

            <h3 class="text-center ">{{ $item->nama_wisata }}@if ($item->status == 1)
                <span style="color: #fff; background-color: #CD113B; padding: 5px; border-radius: 10px; font-size: 14px;">Tempat Tutup</span>
            @endif</h3>
            <p class="text-center mb-3" style="font-size: 18px">{{ $item->kategori }}</p>

            <div class="owl-carousel detail-wisata-carousel">
                @foreach ($item->gambar_wisata as $re => $ii)
                <div class="testimonial-wrap">
                    <div class="testimonial-item">
                        <img src="{{ asset('storage/images/gambar-wisata/'. $ii->gambar_url) }}" class="detail-wisata-img" alt="" height="500px">
                    </div>
                </div>
                @endforeach
            </div>

            <section id="faq" class="faq section-bg mt-4" style="padding: 0; background-color: #fff;">
                <div class="container">
                    <div class="faq-list">
                        <ul>
                            <li data-aos="fade-up">
                                <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse"
                                    href="#faq-list-1">Deskripsi tempat wisata <i
                                        class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-1" class="collapse show" data-parent=".faq-list" style="transition: all .4s ease-in-out;">
                                    <p>
                                        {{ $item->deskripsi }}
                                    </p>
                                </div>
                            </li>

                            <li data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-2"
                                    class="collapsed"> Fasilitas apa yang didapat pengunjung?<i
                                        class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-2" class="collapse" data-parent=".faq-list" style="transition: all .4s ease-in-out;">
                                    @if ($item->fasilitas === null)
                                        <p>Tidak Ada</p>
                                    @else
                                        <p>{{ $item->fasilitas }}</p>
                                    @endif
                                </div>
                            </li>

                            <li data-aos="fade-up" data-aos-delay="200">
                                <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-3"
                                    class="collapsed">Hari apa saja tempat dibuka?
                                    <i
                                        class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-3" class="collapse" data-parent=".faq-list" style="transition: all .4s ease-in-out;">
                                    <p style="text-transform: capitalize">
                                        @foreach (explode('|', $item->hari_buka) as $hari)
                                            {{ $hari  }} ,
                                        @endforeach
                                    </p>
                                </div>
                            </li>

                            <li data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-4"
                                    class="collapsed">@if ($item->jam_buka !== null)
                                    Dari dan Sampai jam berapa saja tempat dibuka?
                                @else
                                    Kapan tempat dibuka?
                                @endif <i
                                        class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-4" class="collapse" data-parent=".faq-list" style="transition: all .4s ease-in-out;">
                                    <p>
                                        @if ($item->jam_buka !== null)
                                        Dari Pukul {{ Carbon\Carbon::parse($item->jam_buka)->translatedFormat('H:i')  }} Sampai Pukul {{ Carbon\Carbon::parse($item->jam_tutup)->translatedFormat('H:i') }}
                                    @else
                                        Dibuka  @if ($item->waktu == 'malam')
                                            Malam
                                            @elseif ($item->waktu == 'setiap-hari')
                                            Setiap
                                        @endif Hari
                                    @endif
                                    </p>
                                </div>
                            </li>

                            <li data-aos="fade-up" data-aos-delay="400">
                                <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-5"
                                    class="collapsed">Apa saja ketentuannya? <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-5" class="collapse" data-parent=".faq-list" style="transition: all .4s ease-in-out;">
                                    <p>
                                        {{ $item->ketentuan }}
                                    </p>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </section><!-- End Frequently Asked Questions Section -->

        <div class="row justify-content-center align-items-center">
            <h4>Harga {{ rupiah($item->harga) }}</h4>
            @if ($item->kategori == 'wisata' || $item->kategori == 'tubing')
                <a href="{{ route('beli-tiket', $item->id) }}" class="btn @if ($item->status == 1)
                    btn-danger
                @else
                    btn-primary
                @endif ml-4 btn-beli-tiket @if ($item->status == 1)
                    disabled
                @endif">Beli Tiket</a>
            @elseif ($item->kategori == 'camping' || $item->kategori == 'glamping')
                <a href="{{ route('sewa', $item->id) }}" class="btn btn-info ml-4 btn-beli-tiket @if ($item->status == 1)
                    disabled
                @endif">Sewa</a>
            @endif
        </div>

        @if ($item->wisata_360 != null)
            <h4 class="mt-5 text-center">Wisata 360</h4>

            {!! $item->wisata_360 !!}
        @endif

        @if ($item->youtube_url != null)
            <h4 class="mt-5 text-center">VLOG</h4>

            <div class="text-center">
                {!! $item->youtube_url !!}
            </div>
        @endif

        @if ($item->story != NULL)
            <div class="row mt-4">
                <div class="col-lg-12">
                    <h5 class="text-center">Story About</h5>
                    {!! $item->story !!}
                </div>
            </div>
        @endif

        </div>
    </section><!-- End Testimonials Section -->
</main><!-- End #main -->
@endsection
