@extends('layouts.admin')

@section('title')
    <title>Wisata - Edit Data</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Wisata</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.html">Data Wisata</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('wisata.index') }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('wisata.update', $item->id) }}" method="POST" class="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_wisata">Nama Wisata</label>
                        <input type="text" name="nama_wisata" class="form-control @error('nama_wisata') is-invalid @enderror" id="nama_wisata" placeholder="Masukkan Nama Wisata" value="{{ $item->nama_wisata }}" required>
                        @error('nama_wisata')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            <option value="wisata" @if ($item->kategori == 'wisata')
                                selected
                            @endif>Wisata</option>
                            <option value="glamping" @if ($item->kategori == 'glamping')
                                selected
                            @endif>Glamping</option>
                            <option value="tubing" @if ($item->kategori == 'tubing')
                                selected
                            @endif>Tubing</option>
                            <option value="camping" @if ($item->kategori == 'camping')
                                selected
                            @endif>Camping Ground</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control @error('deskripsi') is-invalid @enderror" required>{!! $item->deskripsi !!}</textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ketentuan">Ketentuan</label>
                        <input type="text" name="ketentuan" class="form-control @error('ketentuan') is-invalid @enderror" id="ketentuan" placeholder="Masukkan Ketentuan Wisata" value="{{ $item->ketentuan }}" required>
                        @error('ketentuan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fasilitas">Fasilitas</label>
                        <input type="text" name="fasilitas" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas" placeholder="Masukkan Fasilitas Wisata" value="{{ $item->fasilitas }}" required>
                        @error('fasilitas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hari_buka">Hari Buka</label>
                        <div class="form-group">
                            <label for="senin" class="text-center"><input type="checkbox" name="hari_buka[]" id="senin" class="form-check-input form-check-info form-check-glow mr-5" value="senin" @foreach (explode('|', $item->hari_buka) as $value)
                                @if ($value == 'senin')
                                    checked
                                @endif
                            @endforeach>Senin</label>
                            <label for="selasa"  class="text-center"><input type="checkbox" name="hari_buka[]" id="selasa" class="form-check-input form-check-info form-check-glow mr-5" value="selasa" @foreach (explode('|', $item->hari_buka) as $value)
                                @if ($value == 'selasa')
                                    checked
                                @endif
                            @endforeach>Selasa</label>
                            <label for="rabu"  class="text-center"><input type="checkbox" name="hari_buka[]" id="rabu" class="form-check-input form-check-info form-check-glow mr-5" value="rabu" @foreach (explode('|', $item->hari_buka) as $value)
                                @if ($value == 'rabu')
                                    checked
                                @endif
                            @endforeach>Rabu</label>
                            <label for="kamis"  class="text-center"><input type="checkbox" name="hari_buka[]" id="kamis" class="form-check-input form-check-info form-check-glow mr-5" value="kamis" @foreach (explode('|', $item->hari_buka) as $value)
                                @if ($value == 'kamis')
                                    checked
                                @endif
                            @endforeach>Kamis</label>
                            <label for="jumat"  class="text-center"><input type="checkbox" name="hari_buka[]" id="jumat" class="form-check-input form-check-info form-check-glow mr-5" value="jumat" @foreach (explode('|', $item->hari_buka) as $value)
                                @if ($value == 'jumat')
                                    checked
                                @endif
                            @endforeach>Jum'at</label>
                            <label for="sabtu"  class="text-center"><input type="checkbox" name="hari_buka[]" id="sabtu" class="form-check-input form-check-info form-check-glow mr-5" value="sabtu" @foreach (explode('|', $item->hari_buka) as $value)
                                @if ($value == 'sabtu')
                                    checked
                                @endif
                            @endforeach>Sabtu</label>
                            <label for="minggu"  class="text-center"><input type="checkbox" name="hari_buka[]" id="minggu" class="form-check-input form-check-info form-check-glow mr-5" value="minggu" @foreach (explode('|', $item->hari_buka) as $value)
                                @if ($value == 'minggu')
                                    checked
                                @endif
                            @endforeach>Minggu</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jam_buka">Jam Buka</label>
                        <input type="time" name="jam_buka" class="form-control @error('jam_buka') is-invalid @enderror" id="jam_buka" placeholder="Masukkan Jam Buka Wisata" value="{{ $item->jam_buka }}">
                        @error('jam_buka')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jam_tutup">Jam Tutup</label>
                        <input type="time" name="jam_tutup" class="form-control @error('jam_tutup') is-invalid @enderror" id="jam_buka" placeholder="Masukkan Jam Tutup Wisata" value="{{ $item->jam_tutup }}">
                        @error('jam_tutup')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Masukkan Harga Wisata" value="{{ $item->harga }}" min="0" required>
                        @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Foto Wisata</label><br>
                        @foreach ($item->gambar_wisata as $gambar)
                            <img src="{{ asset('storage/images/gambar-wisata/'. $gambar->gambar_url) }}" alt="" class="img-thumbnail" style="width: 200px">
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="foto_wisata">Ganti Foto Wisata</label>
                        <input type="file" name="image[]" class="form-control" id="foto_wisata" multiple>
                    </div>
                    <button class="btn btn-primary btn-block btn-confirm" type="submit">Simpan Data</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.btn-confirm').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Simpan Data?',
            text: "Pastikan Data Sudah Benar",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }else {
                    Swal.fire('Data Batal Disimpan');
                }
            });
        });
    </script>

    @if (Session::get('gagal-ubah'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Nama Wisata Sudah Tersedia'
        })
    </script>
    @endif
@endpush

@push('addon-style')
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
