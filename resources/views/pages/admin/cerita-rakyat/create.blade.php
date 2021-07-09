@extends('layouts.admin')

@section('title')
    <title>Cerita Rakyat - Tambah Data</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Cerita Rakyat</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.html">Data Cerita Rakyat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('cerita-rakyat.index') }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('cerita-rakyat.store') }}" method="POST" class="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="gambar_cerita">Gambar Cerita</label>
                        <input type="file" class="form-control @error('gambar_cerita') is-invalid @enderror" name="gambar_cerita" id="gambar_cerita">
                        @error('gambar_cerita')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul" placeholder="Masukkan Judul Berita" value="{{ old('judul') }}" required>
                        @error('judul')
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
                        <label for="isi_cerita">Isi Cerita</label>
                        <textarea name="isi_cerita" id="isi_cerita" cols="30" rows="10" class="form-control @error('isi_cerita') is-invalid @enderror" required>{!! old('isi_cerita') !!}</textarea>
                        @error('isi_cerita')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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

    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('isi_cerita', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

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

    @if (Session::get('gagal-foto'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Foto Belum Dimasukkan'
        })
    </script>
    @endif
@endpush

@push('addon-style')
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
