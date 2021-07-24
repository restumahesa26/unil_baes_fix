@extends('layouts.admin')

@section('title')
    <title>Informasi - Tambah Data</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Informasi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.html">Informasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('informasi.index') }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('informasi.store') }}" method="POST" class="px-4 py-4">
                    @csrf
                    <div class="form-group">
                        <label for="informasi">Informasi</label>
                        <input name="informasi" id="informasi" class="form-control @error('informasi') is-invalid @enderror" value="{{ old('informasi') }}" placeholder="Masukkan Informasi">
                        @error('informasi')
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

@push('addon-script')
    <script src="{{ url('backend/assets/vendors/ckeditor/ckeditor.js') }}"></script>
@endpush
