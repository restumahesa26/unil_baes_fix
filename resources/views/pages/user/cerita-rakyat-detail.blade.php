@extends('layouts.user')

@section('content')
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Cerita Rakyat</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('cerita-rakyat') }}">Cerita Rakyat</a></li>
                    <li>{{ $item->judul }}</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section id="cerita" class="cerita" style="margin-top: -40px;">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h3>{{ $item->judul }}</h3>
                <span><strong>Diposting : {{ Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</strong> </span>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-lg-8">
                    <h5 class="text-center">Deskripsi</h5>
                    <p>{{ $item->deskripsi }}</p>
                </div>
            </div>
            <div class="text-center">
                <img src="{{ asset('storage/images/gambar-cerita/'. $item->gambar_cerita) }}" alt="" class="mt-4" style="width: 800px">
            </div>
            <p class="mt-4">{!! $item->isi_cerita !!}</p>
        </div>
    </section><!-- End Services Section -->
</main><!-- End #main -->
@endsection
