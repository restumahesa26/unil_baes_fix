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
                    <li>Cerita Rakyat</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section id="cerita" class="cerita">
        <div class="container">

            <h4 class="text-center mb-3">
                Cerita Rakyat
            </h4>

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

            <div class="d-flex justify-content-center mt-3">
                {{ $ceritas->links() }}
            </div>
        </div>
    </section><!-- End Services Section -->
</main><!-- End #main -->
@endsection
