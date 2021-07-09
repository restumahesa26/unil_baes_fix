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
                    <li><a href="{{ route('wisata-detail', $item->id) }}">{{ $item->nama_wisata }}</a></li>
                    <li>Beli Tiket</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="beli-tiket" class="beli-tiket">
        <div class="container">
            <p>Lengkapi form dibawah ini : </p>
            <form action="{{ route('bayar-tiket')}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col">
                        <label for="jumlah_orang">Jumlah Orang @if ($item->kategori == 'tubing')
                            <sup class="text-danger">* minimal 5 orang</sup>
                        @else

                        @endif </label>
                        <input type="number" class="form-control" placeholder="Masukkan Jumlah Orang" id="jumlah_orang" name="jumlah_orang" required
                        @if ($item->kategori == 'tubing')
                            min="5"
                        @else
                            min="1"
                        @endif>
                    </div>
                    <div class="form-group col">
                        <label for="tanggal">Tanggal Tiket <span class="ml-3 text-danger" id="pesan-tanggal"></span></label>
                        <input type="date" class="form-control" placeholder="Masukkan Tanggal Tiket" id="tanggal" required name="tanggal">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group row label-harga">
                            <label class="col-sm-4 col-form-label">Harga Tiket</label>
                            <input type="hidden" id="harga" value="{{ $item->harga }}">
                            <input type="hidden" value="{{ $item->id }}" name="wisata_id" id="wisata_id">
                            <div class="col-sm-8">
                                <label class="col-sm-12 col-form-label">{{ rupiah($item->harga) }}</label>
                            </div>
                        </div>
                        <div class="form-group row label-total">
                            <label class="col-sm-4 col-form-label">Total Bayar</label>
                            <div class="col-sm-8">
                                <label class="col-sm-12 col-form-label"><b id="total">-</b></label>
                                <input type="hidden" name="total" id="total-value">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-bayar" id="bayar">Bayar</button>
                    </div>
                </div>
            </form>
        </div>
    </section><!-- End Testimonials Section -->
</main><!-- End #main -->
@endsection

@push('addon-script')
    <script>
        $("#jumlah_orang").on("change keyup", function() {
            var val = $('#jumlah_orang').val();
            var harga = $('#harga').val();
            $.ajax({
                    url: `{{ route('total-harga-tiket.api') }}`,
                    type: 'get',
                    data: {
                        'jumlah_orang' : val,
                        'harga' : harga
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            document.getElementById('total').innerHTML = response.harga;
                            document.getElementById('total-value').value = response.total;
                        }
                    }
                });
        });

        $("#tanggal").on("change", function() {
            var tanggal = $('#tanggal').val();
            var id = $('#wisata_id').val();
            if(tanggal.length === 0) {

            }else {
                $.ajax({
                    url: `{{ route('cek-hari.api') }}`,
                    type: 'get',
                    data: {
                        'wisata_id' : id,
                        'tanggal' : tanggal
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            document.getElementById('pesan-tanggal').innerHTML = response.pesan;
                            if (response.pesan == '') {
                                document.getElementById('bayar').disabled = false;
                            } else {
                                document.getElementById('bayar').disabled = true;
                            }
                        }
                    }
                });
            }
        });

        $("#tanggal").on("change", function() {
            var tanggal = $('#tanggal').val();
            if(tanggal.length === 0) {

            }else {
                $.ajax({
                    url: `{{ route('cek-tanggal.api') }}`,
                    type: 'get',
                    data: {
                        'tanggal' : tanggal
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            document.getElementById('pesan-tanggal').innerHTML = response.pesan;
                            if (response.pesan == '') {
                                document.getElementById('bayar').disabled = false;
                            } else {
                                document.getElementById('bayar').disabled = true;
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush

@push('addon-style')
    <style>
        .beli-tiket .label-total {
            margin-top: -25px;
        }

        .beli-tiket .label-total , .beli-tiket .label-harga {
            font-size: 16px;
        }

        .beli-tiket .btn-bayar {
            color: #fff;
            background-color: #1977cc;
        }

        .beli-tiket .btn-bayar:hover {
            background-color: #176bb4;
        }
    </style>
@endpush
