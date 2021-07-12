@extends('layouts.user')

@section('content')
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Produk Komoditas Masyarakat</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Produk Komoditas Masyarakat</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <!-- ======= Doctors Section ======= -->
    <section id="produk" class="produk" style="background-color: #fff">
        <div class="container">

            <h4 class="text-center mb-3">
                Produk Komoditas Masyarakat
            </h4>

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
                        @if ($produk->status == 1)
                            <h5 style="top: 10%; left:0; z-index: 9999; position: absolute; color: #fff; background-color: #CD113B; padding: 5px; border-radius: 10px; font-size: 14px">Produk Habis</h5>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $produks->links() }}
            </div>
        </div>
    </section><!-- End Doctors Section -->
</main><!-- End #main -->
@endsection
