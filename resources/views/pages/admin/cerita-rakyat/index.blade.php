@extends('layouts.admin')

@section('title')
    <title>Cerita Rakyat</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Cerita Rakyat</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Cerita Rakyat</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('cerita-rakyat.create') }}" class="btn btn-primary">Tambah Cerita Rakyat</a>
        </div>
        <div class="card-body">
            <div class="table-responsive px-3 py-3">
                <table class="table table-bordered table-hover table-responsive" width="100%" cellspacing="0" id="table-cerita-rakyat">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Judul Cerita Rakyat</th>
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
                            <td>{{ $item->judul }}</td>
                            <td>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#modalCerita{{ $item->id }}">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <a href="{{ route('cerita-rakyat.edit', $item->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('cerita-rakyat.destroy', $item->id) }}" method="POST" class="d-inline">
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
<div class="modal fade" id="modalCerita{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="transition: all .3s ease-in-out;">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $item->judul }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <span><strong>Diposting : {{ Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</strong></span>
                <div class="row mt-3">
                    <div class="col-2">
                        <p>Deksripsi &nbsp;</p>
                    </div>
                    <div class="col-10">
                        {{ $item->deskripsi }}
                    </div>
                </div>
                <div class="text-center">
                    <img src="{{ asset('storage/images/gambar-cerita/'. $item->gambar_cerita) }}" alt="" class="mt-4" style="width: 800px">
                </div>
                <p class="mt-4">{!! $item->isi_cerita !!}</p>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('addon-script')
    <script src="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('#table-cerita-rakyat').DataTable();
        });
    </script>

    <script>
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
