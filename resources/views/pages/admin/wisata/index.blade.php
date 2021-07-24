@extends('layouts.admin')

@section('title')
    <title>Wisata</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Wisata</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Wisata</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            <form action="{{ route('wisata-filter') }}">
                <div class="row">
                    <div class="form-group col-4">
                        <select name="filter" id="filter" class="form-control">
                            <option value="">--Filter--</option>
                            <option value="buka">Buka</option>
                            <option value="tutup">Tutup</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('wisata.index') }}" class="btn btn-info">Refresh</a>
                    </div>
                </div>
            </form>
            <a href="{{ route('wisata.create') }}" class="btn btn-primary mt-2">Tambah Wisata</a>
            <a href="#" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#modal">Print Laporan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive px-3 py-3">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Wisata</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Status</th>
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
                            <td>{{ $item->nama_wisata }}</td>
                            <td>
                                @if ($item->stok != NULL)
                                    {{ $item->stok }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ rupiah($item->harga) }}</td>
                            <td>
                                @if ($item->status == 0)
                                    <span class="badge bg-success">Buka</span>
                                @elseif ($item->status == 1)
                                    <span class="badge bg-danger">Tutup</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('wisata.edit', $item->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                @if ($item->status == 0)
                                    <a href="{{ route('wisata.tutup', $item->id) }}" class="btn btn-warning">
                                        <i class="bi bi-dash-circle"></i>
                                    </a>
                                @elseif ($item->status == 1)
                                <a href="{{ route('wisata.buka', $item->id) }}" class="btn btn-info">
                                    <i class="bi bi-check-square"></i>
                                </a>
                                @endif
                                <form action="{{ route('wisata.destroy', $item->id) }}" method="POST" class="d-inline">
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="transition: all .3s ease-in-out;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Print Laporan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">
                    Berdasarkan Kondisi Wisata
                </h5>
                <form action="{{ route('wisata-laporan') }}" target="_blank">
                    <div class="form-group row">
                        <div class="col-6">
                            <select name="kondisi" id="kondisi" class="form-control" required>
                                <option value="">--Pilih Kondisi--</option>
                                <option value="buka">Buka</option>
                                <option value="tutup">Tutup</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Print Sesuai Kondisi</button>
                        </div>
                    </div>
                </form>
                <h5 class="text-center mt-3">
                    Semua Wisata
                </h5>
                <form action="{{ route('wisata-laporan') }}" target="_blank">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="">Semua Wisata</label>
                        </div>
                        <div class="col-6">
                            <input type="hidden" name="filter" value="semua">
                            <button type="submit" class="btn btn-primary">Print Semua Wisata</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script>
        $(document).ready( function () {
            $('#table').DataTable();
        });
    </script>

    <script src="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    @if (Session::get('data-kosong'))
        <script>
            Swal.fire('Data Kosong');
        </script>
    @endif

    @if (Session::get('pilih-filter'))
        <script>
            Swal.fire('Pilih Filter Terlebih Dahulu');
        </script>
    @endif

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

    @if (Session::get('gagal-hapus'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Data Tidak Bisa Dihapus'
        })
    </script>
    @endif
@endpush

@push('addon-style')
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
