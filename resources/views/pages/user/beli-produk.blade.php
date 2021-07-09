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
                    <li><a href="{{ route('produk-detail', $item->id) }}">{{ $item->nama_produk }}</a></li>
                    <li>Beli Produk</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="beli-tiket" class="beli-tiket">
        <div class="container">
            <div class="form-group row">
                <h5 class="col-md-3">Nama Produk</h5>
                <div class="col-md-8">
                    <h5> : {{ $item->nama_produk }}</h5>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-md-3">Kategori</h5>
                <div class="col-md-8">
                    <h5> : {{ $item->kategori }}</h5>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-md-3">Harga</h5>
                <div class="col-md-8">
                    <h5> : {{ rupiah($item->harga) }}</h5>
                </div>
            </div>
            <p>Lengkapi form dibawah ini : </p>
            <form action="{{ route('konfirmasi-produk') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="quantitas" class="col-md-3 col-form-label">Quantitas</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control" placeholder="Masukkan Quantitas Produk" id="quantitas" name="quantitas" min="1" max="{{ $item->stok }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label">Provinsi</label>

                    <div class="col-md-8">
                        <select name="provinsi_id" id="province" class="form-control">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinces as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label">Kabupaten / Kota</label>

                    <div class="col-md-8">
                        <select name="kota_id" id="city" class="form-control">
                            <option value="">Pilih Kabupaten / Kota</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label">Kecamatan</label>

                    <div class="col-md-8">
                        <select name="kecamatan_id" id="district" class="form-control">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label">Kelurahan / Desa</label>

                    <div class="col-md-8">
                        <select name="kelurahan_id" id="village" class="form-control">
                            <option value="">Pilih Kelurahan / Desa</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat_lengkap" class="col-md-3 col-form-label">Alamat Lengkap</label>

                    <div class="col-md-8">
                        <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_pos" class="col-md-3 col-form-label">Kode Pos</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control" placeholder="Masukkan Kode Pos" id="kode_pos" name="kode_pos" min="1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="total_bayar" class="col-md-3 col-form-label">Total Bayar</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="total_bayar" min="1" value="{{ rupiah($item->harga) }}" disabled>
                    </div>
                </div>
                <input type="hidden" name="total_harga" id="total_value">
                <input type="hidden" name="produk_id" id="produk_id" value="{{ $item->id }}">
                <input type="hidden" name="total_berat" id="total_berat">
                <input type="hidden" name="harga" value="{{ $item->harga }}" id="harga">
                <input type="hidden" name="berat" value="{{ $item->berat }}" id="berat">
                <button class="btn btn-block btn-primary">Konfirmasi Pesanan</button>
            </form>
        </div>
    </section><!-- End Testimonials Section -->
</main><!-- End #main -->
@endsection

@push('addon-script')
    <script>
        $("#province").on("change", function() {
            $.ajax({
                url: `{{ route('provinsi.kabupaten') }}`,
                type: 'get',
                data: {
                    'id' : $(this).val()
                },
                dataType: 'json',
                success: function (response) {
                    if (response != null) {
                        $('#city').empty();
                        $.each(response, function (id, name) {
                            $('#city').append(new Option(name, id))
                        });
                    }
                }
            });
        });

        $("#city").on("change", function() {
            $.ajax({
                url: `{{ route('provinsi.kecamatan') }}`,
                type: 'get',
                data: {
                    'id' : $(this).val()
                },
                dataType: 'json',
                success: function (response) {
                    if (response != null) {
                        $('#district').empty();
                        $.each(response, function (id, name) {
                            $('#district').append(new Option(name, id))
                        });
                    }
                }
            });
        });

        $("#district").on("change", function() {
            $.ajax({
                url: `{{ route('provinsi.kelurahan') }}`,
                type: 'get',
                data: {
                    'id' : $(this).val()
                },
                dataType: 'json',
                success: function (response) {
                    if (response != null) {
                        $('#village').empty();
                        $.each(response, function (id, name) {
                            $('#village').append(new Option(name, id))
                        });
                    }
                }
            });
        });

        $("#quantitas").on("change keyup", function() {
            var val = $('#quantitas').val();
            var harga = $('#harga').val();
            var berat = $('#berat').val();
            $.ajax({
                    url: `{{ route('total-harga-produk.api') }}`,
                    type: 'get',
                    data: {
                        'quantitas' : val,
                        'harga' : harga,
                        'berat' : berat
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            document.getElementById('total_bayar').value = response.harga;
                            document.getElementById('total_value').value = response.total;
                            document.getElementById('total_berat').value = response.berat;
                        }
                    }
                });
        });


    </script>
@endpush

@push('addon-style')
    <style>
        //
    </style>
@endpush
