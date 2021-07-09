@extends('layouts.admin')

@section('title')
    <title>Serba-Serbi - Tambah Data</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Serba-Serbi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.html">Serba-Serbi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('serba-serbi.index') }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('serba-serbi.store') }}" method="POST" class="px-4 py-4">
                    @csrf
                    <div class="form-group">
                        <label for="serba_serbi">Serba-Serbi</label>
                        <textarea name="serba_serbi" id="serba_serbi" cols="30" rows="100" class="ckeditor form-control @error('serba_serbi') is-invalid @enderror">{!! old('serba_serbi') !!}</textarea>
                        @error('serba_serbi')
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
