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
                </div>
                <div class="col-lg-4 col-sm-12 mt-3">
                    <h5 style="color: #1977cc; font-size: 24px;">Detail Produk</h5>
                    <p style="font-size: 20px; margin-bottom: 0px;">{{ $item->nama_produk }}</p>
                    <p style="font-size: 16px" class="text-gray-50">{{ $item->kategori }}</p>
                    <p style="font-size: 20px; overflow-wrap: break-word;">{{ $item->deskripsi }}</p>
                    <p style="font-size: 18px;">Stok : {{ $item->stok }}</p>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <h4>{{ rupiah($item->harga) }}</h4>
                        <a href="{{ route('beli-produk', $item->id) }}" class="btn btn-primary btn-beli-tiket">Beli Produk</a>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-12">
                    <h5 class="text-center">Story About</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique amet culpa inventore ex totam exercitationem eos aperiam earum eius commodi, aliquid distinctio, quam sint assumenda aut ad possimus! Modi, ex. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla nisi totam minima, pariatur et recusandae exercitationem quod? Quas, placeat rem, debitis consequatur soluta eos aspernatur quos libero odio possimus nemo.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique amet culpa inventore ex totam exercitationem eos aperiam earum eius commodi, aliquid distinctio, quam sint assumenda aut ad possimus! Modi, ex. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla nisi totam minima, pariatur et recusandae exercitationem quod? Quas, placeat rem, debitis consequatur soluta eos aspernatur quos libero odio possimus nemo.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique amet culpa inventore ex totam exercitationem eos aperiam earum eius commodi, aliquid distinctio, quam sint assumenda aut ad possimus! Modi, ex. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla nisi totam minima, pariatur et recusandae exercitationem quod? Quas, placeat rem, debitis consequatur soluta eos aspernatur quos libero odio possimus nemo.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique amet culpa inventore ex totam exercitationem eos aperiam earum eius commodi, aliquid distinctio, quam sint assumenda aut ad possimus! Modi, ex. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla nisi totam minima, pariatur et recusandae exercitationem quod? Quas, placeat rem, debitis consequatur soluta eos aspernatur quos libero odio possimus nemo.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique amet culpa inventore ex totam exercitationem eos aperiam earum eius commodi, aliquid distinctio, quam sint assumenda aut ad possimus! Modi, ex. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla nisi totam minima, pariatur et recusandae exercitationem quod? Quas, placeat rem, debitis consequatur soluta eos aspernatur quos libero odio possimus nemo.</p>
                </div>
            </div>
        </div>
    </section><!-- End Testimonials Section -->
</main><!-- End #main -->
@endsection
