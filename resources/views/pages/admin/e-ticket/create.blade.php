@extends('layouts.admin')

@section('title')
    <title>E-Ticket</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>E-Ticket</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.html">E-Ticket</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('e-ticket.index') }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('e-ticket.store') }}" method="POST" class="">
                    @csrf
                    <div class="form-group">
                        <label for="wisata_id">Wisata</label>
                        <select name="wisata_id" id="wisata_id" class="choices form-control">
                            <option value="">--Pilih Wisata--</option>
                            @foreach ($wisatas as $wisata)
                                <option value="{{ $wisata->id }}">{{ $wisata->nama_wisata }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6" id="tiket-section">
                            <h5>Tiket</h5>
                            <div class="form-group">
                                <label for="jumlah_orang">Jumlah Orang</label>
                                <input type="number" name="jumlah_orang" class="form-control @error('jumlah_orang') is-invalid @enderror" id="jumlah_orang" placeholder="Masukkan Jumlah Orang" value="{{ old('jumlah_orang') }}" min="1">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_tiket">Tanggal Tiket</label>
                                <input type="date" name="tanggal_tiket" class="form-control @error('tanggal_tiket') is-invalid @enderror" id="tanggal_tiket" placeholder="Masukkan Tanggal Tiket" value="{{ old('tanggal_tiket') }}" min="1">
                            </div>
                        </div>
                        <div class="col-lg-6" id="sewa-section">
                            <h5>Sewa <sup class="text-danger" id="test"></sup></h5>
                            <div class="form-group">
                                <label for="jam_sewa">Jam Sewa</label>
                                <select name="jam_sewa" id="jam_sewa" class="form-control">
                                    <option value="">--Pilih Jam--</option>
                                    <option value="Pagi">Pagi</option>
                                    <option value="Siang">Siang</option>
                                    <option value="Malam">Malam</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_sewa">Tanggal Sewa</label>
                                <input type="date" name="tanggal_sewa" class="form-control @error('tanggal_sewa') is-invalid @enderror" id="tanggal_sewa" placeholder="Masukkan Tanggal Sewa" value="{{ old('tanggal_sewa') }}" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total_bayar">Total Bayar</label>
                        <input type="number" name="total_bayar" class="form-control @error('total_bayar') is-invalid @enderror" id="total_bayar" placeholder="Masukkan Total Bayar" value="{{ old('total_bayar') }}" readonly>
                        <input type="hidden" id="total_bayar_2">
                        <input type="hidden" id="idd">
                    </div>
                    <button class="btn btn-primary btn-block btn-confirm" type="submit">Simpan Data</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('backend/assets/vendors/choices.js/choices.min.js') }}"></script>

    <script>
        $("#wisata_id").on("change", function() {
            $.ajax({
                url: `{{ route('put-harga.api') }}`,
                type: 'get',
                data: {
                    'id' : $(this).val()
                },
                dataType: 'json',
                success: function (response) {
                    if (response != null) {
                        document.getElementById('total_bayar_2').value = response.harga;
                        document.getElementById('total_bayar').value = response.harga;
                        document.getElementById('idd').value = response.id;
                    }
                }
            });
        });

        $("#jumlah_orang").on("change", function() {
            var harga = parseInt($('#total_bayar_2').val());
            var jumlah_orang = parseInt($('#jumlah_orang').val());
            var total = parseInt(harga * jumlah_orang);

            document.getElementById('total_bayar').value = total;
        });

        $("#tanggal_sewa, #jam_sewa").on("change", function() {
            var jam = $('#jam_sewa').val();
            var tanggal = $('#tanggal_sewa').val();
            var id = $('#idd').val();
            if(tanggal.length === 0) {

            }else {
                $.ajax({
                    url: `{{ route('cek-sewa-2.api') }}`,
                    type: 'get',
                    data: {
                        'jam' : jam,
                        'tanggal' : tanggal,
                        'id' : id
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            document.getElementById('test').innerHTML = response.pesan;
                        }
                    }
                });
            }
        });

        $("#wisata_id").on("change", function() {
            $.ajax({
                url: `{{ route('cek-kategori-wisata.api') }}`,
                type: 'get',
                data: {
                    'id' : $(this).val()
                },
                dataType: 'json',
                success: function (response) {
                    if (response != null) {
                        if (response.pesan == 'wisata') {
                            document.getElementById("sewa-section").setAttribute("style","opacity:0; transition: all .4s ease-in-out;");
                            document.getElementById("tiket-section").setAttribute("style","opacity:1; transition: all .4s ease-in-out;");
                        }else if(response.pesan == 'camping') {
                            document.getElementById("tiket-section").setAttribute("style","opacity:0; transition: all .4s ease-in-out;");
                            document.getElementById("sewa-section").setAttribute("style","opacity:1; transition: all .4s ease-in-out;");
                        }
                    }
                }
            });
        });
    </script>
@endpush

@push('addon-style')
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/choices.js/choices.min.css') }}" />
@endpush
