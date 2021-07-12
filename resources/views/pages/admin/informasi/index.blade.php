@extends('layouts.admin')

@section('title')
    <title>Informasi</title>
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
                        <li class="breadcrumb-item active" aria-current="page">Informasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('informasi.create') }}" class="btn btn-primary">Tambah Data Informasi</a>
        </div>
        <div class="card-body">
            <div class="table-responsive px-3 py-3">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0"
                    id="cerita-rakyat-table">
                    <thead>
                        <tr class="text-center">
                            <th>Informasi</th>
                            <th>Status</th>
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
                                @if ($item->status == 0)
                                    <span class="badge bg-success">Aktif</span>
                                @elseif ($item->status == 1)
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 0)
                                    <a href="{{ route('informasi.tidak-aktif', $item->id) }}" class="btn btn-warning">
                                        Set Tidak Aktif
                                    </a>
                                @elseif ($item->status == 1)
                                    <a href="{{ route('informasi.aktif', $item->id) }}" class="btn btn-info">
                                        Set Aktif
                                    </a>
                                @endif
                                <a href="{{ route('kirim-email-informasi', $item->id) }}" class="btn btn-success">
                                    Kirim Email
                                </a>
                                <a href="{{ route('informasi.edit', $item->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('informasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-delete">
                                        <i class="bi bi-trash-fill"></i>
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
@foreach ($items as $item)
<div class="modal fade text-left w-100" id="exampleModalLong{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true" style="transition: all .3s ease-in-out;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel20">Informasi</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                {!! $item->informasi !!}
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
<script src="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    @if (Session::get('sukses-tambah'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Berhasil Menambah Data'
        })
    </script>
    @endif

    @if (Session::get('sukses-ubah'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Berhasil Mengubah Data'
        })
    </script>
    @endif

    @if (Session::get('sukses-hapus'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Berhasil Menghapus Data'
        })
    </script>
    @endif

<script>
    $(document).ready(function () {
        $('#cerita-rakyat-table').DataTable({
            ordering: false
        });
    });

    $('.btn-delete').on('click', function (e) {
        e.preventDefault(); // prevent form submit
        var form = event.target.form;
        Swal.fire({
        title: 'Yakin Menghapus Data?',
        text: "Data Akan Terhapus Permanen",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }else {
                Swal.fire('Data Batal Dihapus');
            }
        });
    });
</script>
@endpush

@push('addon-style')
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
