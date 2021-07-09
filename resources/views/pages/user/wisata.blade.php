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
                    <li>Wisata</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <!-- ======= Services Section ======= -->
    <section id="wisata" class="wisata">
        <div class="container">

            <div class="row">
                @foreach ($wisatas as $wisata)
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-2">
                    <a href="">
                        <div class="icon-box">
                            <div class="icon">
                                @foreach ($wisata->gambar_wisata as $re => $ii)
                                    @if($wisata->gambar_wisata->first() == $ii)
                                        <img src="{{ asset('storage/images/gambar-wisata/'. $ii->gambar_url) }}" alt="">
                                    @endif
                                @endforeach
                            </div>
                            <h4><a href="">{{ $wisata->nama_wisata }}</a></h4>
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

            <div class="d-flex justify-content-center mt-3">
                {{ $wisatas->links() }}
            </div>
        </div>
    </section><!-- End Services Section -->
</main><!-- End #main -->
@endsection
