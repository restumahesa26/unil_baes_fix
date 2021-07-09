@extends('layouts.admin')

@section('title')
    <title>Kritik & Saran</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kritik & Saran</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kritik & Saran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive px-3 py-3 text-nowrap">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
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
                            <td>{{ $item->user->name }}</td>
                            <td>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalKritik{{ $item->id }}">
                                    Lihat Kritik
                                </button>
                                <form action="{{ route('kritik-saran.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-delete">
                                        Hapus Review
                                    </button>
                                </form>
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

@foreach ($items as $itemKritik)
<div class="modal fade" id="modalKritik{{ $itemKritik->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="transition: all .3s ease-in-out;">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Kritik & Saran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Table with outer spacing -->
                <div class="table-responsive text-center">
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>{{ $itemKritik->kritik_saran }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('addon-script')
    <script>
        $(document).ready( function () {
            $('#table').DataTable();
        });
    </script>
@endpush
