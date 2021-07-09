@extends('layouts.admin')

@section('title')
    <title>Referensi</title>
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
                        <li class="breadcrumb-item active" aria-current="page">Referensi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        @if ($items->count() < 4)
        <div class="card-header">
            <a href="{{ route('referensi.create') }}" class="btn btn-sm btn-neutral">Tambah Data Referensi</a>
        </div>
        @endif
        <div class="card-body">
            <div class="table-responsive px-3 py-3">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="cerita-rakyat-table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Value</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @php
                            $no = 0;
                        @endphp
                        @forelse ($items as $item)
                        @php
                            $no++
                        @endphp
                        <tr class="text-center">
                            <td>{{ $no }}</td>
                            <td>
                                @if ($item->kategori == 'luas-desa')
                                    Luas Desa
                                @elseif ($item->kategori == 'jumlah-penduduk')
                                    Jumlah Penduduk
                                @elseif ($item->kategori == 'destinasi-wisata')
                                    Destinasi Wisata
                                @elseif ($item->kategori == 'jarak-ke-kecamatan')
                                    Jarak Ke Kecamatan
                                @endif
                            </td>
                            <td>{{ $item->value }}</td>
                            <td>
                                <a href="{{ route('referensi.edit', $item->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Data Kosong
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script>
        $(document).ready( function () {
            $('#cerita-rakyat-table').DataTable();
        });
    </script>
@endpush
