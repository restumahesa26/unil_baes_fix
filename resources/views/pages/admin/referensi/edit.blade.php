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
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            @if ($item->kategori == 'luas-desa')
                                <option value="luas-desa" @if ($item->kategori == 'luas-desa')
                                    selected
                                @endif>Luas Desa</option>
                            @endif
                            @if ($item->kategori == 'jumlah-penduduk')
                                <option value="jumlah-penduduk" @if ($item->kategori == 'jumlah-penduduk')
                                    selected
                                @endif>Jumlah Penduduk</option>
                            @endif
                            @if ($item->kategori == 'destinasi-wisata')
                                <option value="destinasi-wisata" @if ($item->kategori == 'destinasi-wisata')
                                    selected
                                @endif>Destinasi Wisata</option>
                            @endif
                            @if ($item->kategori == 'jarak-ke-kecamatan')
                                <option value="jarak-ke-kecamatan" @if ($item->kategori == 'jarak-ke-kecamatan')
                                    selected
                                @endif>Jarak Ke Kecamatan</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="value">Value</label>
                        <input type="number" name="value" class="form-control @error('value') is-invalid @enderror" placeholder="Masukkan Value" value="{{ $item->value }}" required>
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
