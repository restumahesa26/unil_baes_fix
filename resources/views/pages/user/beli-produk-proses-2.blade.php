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
                    <li><a href="{{ route('produk') }}">Produk</a></li>
                    <li><a href="{{ route('produk-detail', $item->id) }}">{{ $item->produk->nama_produk }}</a></li>
                    <li>Bayar Ongkos Kirim</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="bayar-tiket" class="bayar-tiket">
        <div class="container">
            <p>Detail Transaksi</p>
            <div class="row">
                <div class="col-2">
                    Nama Produk
                </div>
                <div class="col-10">
                    : {{ $item->produk->nama_produk }}
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    Quantitas
                </div>
                <div class="col-10">
                    : {{ $item->quantitas }}
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    Ongkos Kirim
                </div>
                <div class="col-10">
                    : <b>{{ rupiah($item->ongkos_kirim) }}</b>
                </div>
            </div>
            <form action="{{ route('proses-pembayaran-ongkos-kirim', $item->id) }}" method="POST" class="mt-3" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="rekening">Pilih Rekening Pembayaran</label>
                    <select name="rekening" id="rekening" class="form-control">
                        <option value="">Pilih Rekening</option>
                        @foreach ($rekenings as $rekening)
                            <option value="{{ $rekening->nama_rekening }}">{{ $rekening->nama_rekening }} - {{ $rekening->nomor_rekening }} a/n {{ $rekening->atas_nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="no_rekening">Masukkan Nomor Rekening</label>
                    <input type="text" class="form-control" name="no_rekening" id="no_rekening" placeholder="Masukkan Nomor Rekening">
                </div>
                <div class="form-group">
                    <label for="bukti_bayar">Masukkan Bukti Pembayaran</label>
                    <input type="file" class="form-control" name="bukti_bayar" id="bukti_bayar">
                </div>
                <button class="btn btn-block btn-info">Bayar Sekarang</button>
            </form>
        </div>
    </section><!-- End Testimonials Section -->
</main><!-- End #main -->
@endsection

@push('addon-script')

@endpush

@push('addon-style')
    <style>
        .bayar-tiket p {
            font-size: 20px;
            padding-top: 10px;
        }
    </style>
@endpush
