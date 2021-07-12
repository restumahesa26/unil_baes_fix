@extends('layouts.admin')

@section('title')
    <title>Referensi - Edit Data</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Referensi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.html">Referensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('referensi.index') }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('referensi.update', $item->id) }}" method="POST" class="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="luas_desa">Luas Desa</label>
                        <input type="number" name="luas_desa" class="form-control @error('luas_desa') is-invalid @enderror" placeholder="Masukkan Luas Desa" required value="{{ $item->luas_desa }}">
                        @error('luas_desa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jml_penduduk">Jumlah Penduduk</label>
                        <input type="number" name="jml_penduduk" class="form-control @error('jml_penduduk') is-invalid @enderror" placeholder="Masukkan Jumlah Penduduk" required value="{{ $item->jml_penduduk }}">
                        @error('jml_penduduk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jarak_kecamatan">Jarak Ke Kecamatan</label>
                        <input type="number" name="jarak_kecamatan" class="form-control @error('jarak_kecamatan') is-invalid @enderror" placeholder="Masukkan Jarak Ke Kecamatan" required value="{{ $item->jarak_kecamatan }}">
                        @error('jarak_kecamatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Simpan Data</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
