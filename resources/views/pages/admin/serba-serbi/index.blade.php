@extends('layouts.admin')

@section('title')
    <title>Serba-Serbi</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Serba-Serbi Rindu Hati</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Serba-Serbi Rindu Hati</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            @if ($items->count() < 1) <a href="{{ route('serba-serbi.create') }}" class="btn btn-sm btn-neutral">
                Tambah Data Serba-Serbi</a>
                @endif
        </div>
        <div class="card-body">
            <div class="table-responsive px-3 py-3">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0"
                    id="cerita-rakyat-table">
                    <thead>
                        <tr class="text-center">
                            <th>Serba-Serbi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @forelse ($items as $item)
                        <tr class="text-center">
                            <td>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalLong{{ $item->id }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                            </td>
                            <td>
                                <a href="{{ route('serba-serbi.edit', $item->id) }}" class="btn btn-primary">
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
@foreach ($items as $item)
<div class="modal fade text-left w-100" id="exampleModalLong{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true" style="transition: all .3s ease-in-out;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel20">Serba-Serbi</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                {!! $item->serba_serbi !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('addon-script')
<script>
    $(document).ready(function () {
        $('#cerita-rakyat-table').DataTable();
    });
</script>
@endpush
