@extends('layouts.admin')

@section('title')
    <title>Rekening</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Rekening</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Rekening</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('rekening.create') }}" class="btn btn-primary">Tambah Rekening</a>
        </div>
        <div class="card-body">
            <div class="table-responsive px-3 py-3">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Rekening</th>
                            <th>Nomor Rekening</th>
                            <th>Atas Nama</th>
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
                            <td>{{ $item->nama_rekening }}</td>
                            <td>{{ $item->nomor_rekening }}</td>
                            <td>{{ $item->atas_nama }}</td>
                            <td>
                                <a href="{{ route('rekening.edit', $item->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('rekening.destroy', $item->id) }}" method="POST" class="d-inline">
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
@endsection

@push('addon-script')
    <script src="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('#table').DataTable({
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
@endpush

@push('addon-style')
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
