@extends('layouts.admin')

@section('title')
    <title>Referensi - Tambah Data</title>
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
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
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
                <form action="{{ route('referensi.store') }}" method="POST" class="px-4 py-4">
                    @csrf
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @if ($check->where('kategori', 'luas-desa')->count() == 0)
                                <option value="luas-desa">Luas Desa</option>
                            @endif
                            @if ($check->where('kategori', 'jumlah-penduduk')->count() == 0)
                                <option value="jumlah-penduduk">Jumlah Penduduk</option>
                            @endif
                            @if ($check->where('kategori', 'destinasi-wisata')->count() == 0)
                                <option value="destinasi-wisata">Destinasi Wisata</option>
                            @endif
                            @if ($check->where('kategori', 'jarak-ke-kecamatan')->count() == 0)
                                <option value="jarak-ke-kecamatan">Jarak Ke Kecamatan</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="value">Value</label>
                        <input type="number" name="value" class="form-control @error('value') is-invalid @enderror" placeholder="Masukkan Value" required>
                        @error('value')
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
