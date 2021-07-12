@extends('layouts.user')

@section('content')
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Produk</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('produk') }}">Produk Komoditas Masyarakat</a></li>
                    <li>{{ $item->nama_produk }}</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="detail-wisata" class="detail-wisata" style="margin-top: -40px;">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="owl-carousel detail-wisata-carousel">
                        @foreach ($item->gambar_produk as $re => $ii)
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('storage/images/gambar-produk/'. $ii->gambar_url) }}" class="detail-wisata-img" alt="" height="500px">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <h5 style="top: 0; left:2%; z-index: 9999; position: absolute; color: #fff; background-color: #CD113B; padding: 5px; border-radius: 10px; font-size: 16px">Produk Habis</h5>
                </div>
                <div class="col-lg-4 col-sm-12 mt-3">
                    <h5 style="color: #1977cc; font-size: 24px;">Detail Produk</h5>
                    <p style="font-size: 20px; margin-bottom: 0px;">{{ $item->nama_produk }}</p>
                    <p style="font-size: 16px" class="text-gray-50">{{ $item->kategori }}</p>
                    <p style="font-size: 18px; overflow-wrap: break-word;">{{ $item->deskripsi }}</p>
                    <p style="font-size: 18px;">Stok : {{ $item->stok }}</p>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <h4>{{ rupiah($item->harga) }}</h4>
                        <a href="{{ route('beli-produk', $item->id) }}" class="btn @if ($item->status == 1)
                            btn-danger
                        @else
                            btn-primary
                        @endif btn-beli-tiket @if ($item->status == 1)
                            disabled
                        @endif">Beli Produk</a>
                    </div>
                </div>
            </div>

            @if ($item->story != NULL)
                <div class="row mt-3">
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
