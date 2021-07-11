@extends('layouts.admin')

@section('title')
    <title>Wisata - Tambah Data</title>
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
                <form action="{{ route('wisata.store') }}" method="POST" class="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_wisata">Nama Wisata</label>
                        <input type="text" name="nama_wisata" class="form-control @error('nama_wisata') is-invalid @enderror" id="nama_wisata" placeholder="Masukkan Nama Wisata" value="{{ old('nama_wisata') }}" required>
                        @error('nama_wisata')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="wisata" @if (old('kategori') == 'wisata')
                                selected
                            @endif>Wisata</option>
                            <option value="glamping" @if (old('kategori') == 'glamping')
                                selected
                            @endif>Glamping</option>
                            <option value="tubing" @if (old('kategori') == 'tubing')
                                selected
                            @endif>Tubing</option>
                            <option value="camping" @if (old('kategori') == 'camping')
                                selected
                            @endif>Camping Ground</option>
                        </select>
                        @error('kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ketentuan">Ketentuan</label>
                        <input type="text" name="ketentuan" class="form-control @error('ketentuan') is-invalid @enderror" id="ketentuan" placeholder="Masukkan Ketentuan Wisata" value="{{ old('ketentuan') }}" required>
                        @error('ketentuan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fasilitas">Fasilitas</label>
                        <input type="text" name="fasilitas" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas" placeholder="Masukkan Fasilitas Wisata" value="{{ old('fasilitas') }}" required>
                        @error('fasilitas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hari_buka">Hari Buka</label>
                        <div class="form-group">
                            <label for="senin" class="text-center"><input type="checkbox" name="hari_buka[]" id="senin" class="form-check-input form-check-info form-check-glow mr-5" value="senin">Senin</label>
                            <label for="selasa"  class="text-center"><input type="checkbox" name="hari_buka[]" id="selasa" class="form-check-input form-check-info form-check-glow mr-5" value="selasa">Selasa</label>
                            <label for="rabu"  class="text-center"><input type="checkbox" name="hari_buka[]" id="rabu" class="form-check-input form-check-info form-check-glow mr-5" value="rabu">Rabu</label>
                            <label for="kamis"  class="text-center"><input type="checkbox" name="hari_buka[]" id="kamis" class="form-check-input form-check-info form-check-glow mr-5" value="kamis">Kamis</label>
                            <label for="jumat"  class="text-center"><input type="checkbox" name="hari_buka[]" id="jumat" class="form-check-input form-check-info form-check-glowl mr-5" value="jumat">Jum'at</label>
                            <label for="sabtu"  class="text-center"><input type="checkbox" name="hari_buka[]" id="sabtu" class="form-check-input form-check-info form-check-glow mr-5" value="sabtu">Sabtu</label>
                            <label for="minggu"  class="text-center"><input type="checkbox" name="hari_buka[]" id="minggu" class="form-check-input form-check-info form-check-glow mr-5" value="minggu">Minggu</label>
                        </div>
                        @error('hari_buka')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu</label>
                        <select name="waktu" id="waktu" class="form-control">
                            <option value="">Pilih Waktu</option>
                            <option value="pagi">Pagi</option>
                            <option value="siang">Siang</option>
                            <option value="malam">Malam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam_buka">Jam Buka</label>
                        <input type="time" name="jam_buka" class="form-control" id="jam_buka" placeholder="Masukkan Jam Buka Wisata" value="{{ old('jam_buka') }}">
                    </div>
                    <div class="form-group">
                        <label for="jam_tutup">Jam Tutup</label>
                        <input type="time" name="jam_tutup" class="form-control" id="jam_buka" placeholder="Masukkan Jam Tutup Wisata" value="{{ old('jam_tutup') }}">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Masukkan Harga Wisata" value="{{ old('harga') }}" min="0" required>
                        @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="story">Story</label>
                        <textarea name="story" id="story" cols="30" rows="10" class="ckeditor form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto_wisata">Foto Wisata</label>
                        <input type="file" name="image[]" class="form-control @error('image') is-invalid @enderror" id="foto_wisata" placeholder="Masukkan Foto Wisata" multiple required>
                    </div>
                    <button class="btn btn-primary btn-block btn-confirm" type="submit">Simpan Data</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('isi_cerita', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

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

    @if (Session::get('gagal-hari'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Hari Buka Belum Dipilih'
        })
    </script>
    @endif

    @if (Session::get('gagal-foto'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Foto Belum Dimasukkan'
        })
    </script>
    @endif

    @if (Session::get('gagal-tambah'))
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
