@extends('layouts.admin')

@section('title')
    <title>Galeri - Edit Data</title>
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
                        <li class="breadcrumb-item"><a href="index.html">Galeri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Galeri</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('galeri.index') }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('galeri.update', $item->id) }}" method="POST" class="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Gambar</label><br>
                        <img src="{{ asset('storage/images/galeri/'. $item->image_url) }}" alt="" width="400px">
                    </div>
                    <div class="form-group">
                        <label for="image_url">Masukkan Gambar Kembali</label>
                        <input type="file" name="image_url" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Simpan Data</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
