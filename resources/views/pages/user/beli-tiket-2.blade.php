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
            <h5>Nama Wisata : {{ $item->nama_wisata }}</h5>
            <p class="mt-3">Lengkapi form dibawah ini : </p>
            <form action="{{ route('bayar-sewa')}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="tanggal">Tanggal Sewa</label>
                        <input type="date" class="form-control" placeholder="Masukkan Tanggal Tiket" id="tanggal" required name="tanggal">
                    </div>
                </div>
                <h5 id="test" class="text-danger"></h5>
                <div class="row justify-content-end">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group row label-harga">
                        </div>
                        <div class="form-group row label-total">
                            <label class="col-sm-4 col-form-label">Total Bayar</label>
                            <div class="col-sm-8">
                                <label class="col-sm-12 col-form-label"><b id="total">{{ rupiah($item->harga) }}</b></label>
                                <input type="hidden" id="harga" value="{{ $item->harga }}">
                                <input type="hidden" name="total" id="total-value" value="{{ $item->harga }}">
                                <input type="hidden" value="{{ $item->id }}" name="wisata_id">
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
        $("#tanggal").on("change keyup", function() {
            var tanggal = $('#tanggal').val();
            if(tanggal.length === 0) {

            }else {
                $.ajax({
                    url: `{{ route('cek-sewa.api', $item->id) }}`,
                    type: 'get',
                    data: {
                        'tanggal' : tanggal
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            if (response.pesan == 'Bisa Dibooking') {
                                document.getElementById('bayar').disabled = false;
                                document.getElementById('test').innerHTML = "";
                            } else {
                                document.getElementById('bayar').disabled = true;
                                document.getElementById('test').innerHTML = response.pesan;
                            }
                        }
                    }
                });
            }
        });

        $("#tanggal").on("change keyup", function() {
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
                            if (response.pesan == '') {

                            } else {
                                document.getElementById('bayar').disabled = true;
                                document.getElementById('test').innerHTML = response.pesan;
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
