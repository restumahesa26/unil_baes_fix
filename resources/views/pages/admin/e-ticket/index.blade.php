@extends('layouts.admin')

@section('title')
    <title>E-Ticket</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <form action="{{ route('e-ticket-filter') }}">
            <div class="row">
                <div class="form-group col-4">
                    <select name="filter" id="filter" class="form-control">
                        <option value="">--Filter--</option>
                        <option value="hari-ini">Tanggal Hari Ini</option>
                        <option value="belum-bayar">Belum Bayar</option>
                        <option value="belum-konfirmasi">Belum Dikonfirmasi</option>
                    </select>
                </div>
                <div class="form-group col-3">
                    <input type="date" name="filter_tanggal" placeholder="Masukkan Tanggal" class="form-control">
                </div>
                <div class="form-group col-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('e-ticket.index') }}" class="btn btn-info">Refresh</a>
                </div>
            </div>
        </form>
        <a href="{{ route('e-ticket.create') }}" class="btn btn-primary mt-2">Tambah Data E-Ticket</a>
        <a href="#" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#modal">Print Laporan</a>
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
                    Berdasarkan Tanggal Pembelian
                </h5>
                <form action="{{ route('e-ticket-laporan') }}" target="_blank">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="">Semua Tanggal</label>
                        </div>
                        <div class="col-6">
                            <input type="hidden" name="filter" value="semua">
                            <button type="submit" class="btn btn-primary">Print Semua Tanggal</button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('e-ticket-laporan') }}" target="_blank">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="">Tanggal Hari Ini</label>
                        </div>
                        <div class="col-6">
                            <input type="hidden" name="filter" value="hari-ini">
                            <button type="submit" class="btn btn-primary">Print Tanggal Hari Ini</button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('e-ticket-laporan') }}" target="_blank">
                    <div class="form-group row mt-2">
                        <div class="col-6 text-center">
                            <label for="tanggal_awal">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
                        </div>
                        <div class="col-6 text-center">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary btn-block">Print Sesuai Tanggal</button>
                        </div>
                    </div>
                </form>
                <h5 class="text-center mt-3">
                    Berdasarkan Tanggal Tiket
                </h5>
                <form action="{{ route('e-ticket-laporan') }}" target="_blank">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="">Tanggal Hari Ini</label>
                        </div>
                        <div class="col-6">
                            <input type="hidden" name="filter" value="tiket-hari-ini">
                            <button type="submit" class="btn btn-primary">Print Tiket Hari Ini</button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('e-ticket-laporan') }}" target="_blank">
                    <div class="form-group row mt-2">
                        <div class="col-6 text-center">
                            <label for="tanggal_awal">Tanggal Awal</label>
                            <input type="date" name="tiket_tanggal_awal" id="tanggal_awal" class="form-control">
                        </div>
                        <div class="col-6 text-center">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="date" name="tiket_tanggal_akhir" id="tanggal_akhir" class="form-control">
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary btn-block">Print Sesuai Tanggal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>E-Ticket Wisata</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive px-3 py-3 text-nowrap">
                    <table class="table table-bordered table-hover" id="table1">
                        <thead>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Wisata</th>
                                <th>Jumlah Orang</th>
                                <th>Tanggal Tiket</th>
                                <th>Status Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @forelse ($items->where('wisata.kategori', 'wisata') as $wisata)
                            <tr class="text-center">
                                <td>
                                    @if ($wisata->user->roles == 'ADMIN')
                                        Admin
                                    @elseif ($wisata->user->roles == 'USER')
                                        {{ $wisata->user->name }}
                                    @endif
                                </td>
                                <td>{{ $wisata->wisata->nama_wisata }}</td>
                                <td>{{ $wisata->jumlah_orang }}</td>
                                <td>{{ Carbon\Carbon::parse($wisata->tanggal_tiket)->translatedFormat('l, d F Y') }}</td>
                                <td>@if ($wisata->status_bayar == 'belum-bayar')
                                    <span class="badge bg-danger">Belum Bayar</span>
                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                    <a href="{{ route('e-ticket.bukti-bayar', $wisata->id) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                <span class="badge bg-success">Sudah Bayar</span>
                                @endif</td>
                                <td>
                                    @if ($wisata->status_bayar == 'sudah-bayar')
                                    <a href="{{ route('e-ticket.bukti-bayar', $wisata->id) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pdf-tiket', $wisata->id) }}" class="btn btn-danger text-white btn-download">
                                        <i class="fa fa-file-pdf"></i>
                                    </a>
                                    <a href="{{ route('e-ticket.print', $wisata->id) }}" class="btn btn-primary text-white" target="_blank">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-warning btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @elseif ($wisata->status_bayar == 'belum-bayar')
                                    <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-warning btn-delete">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @elseif($wisata->status_bayar == 'menunggu-konfirmasi')
                                        <a href="{{ route('e-ticket.konfirmasi-pembayaran', $wisata->id) }}" class="btn btn-primary btn-konfirmasi">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="{{ route('e-ticket.batal-pembayaran', $wisata->id) }}" class="btn btn-danger btn-batal-konfirmasi">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-warning btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
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
    </section>
</div>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>E-Ticket Camping Ground</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive px-3 py-3 text-nowrap">
                    <table class="table table-bordered table-hover" id="table2">
                        <thead>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Camping</th>
                                <th>Tanggal</th>
                                <th>Status Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @forelse ($items->where('wisata.kategori', 'camping') as $wisata)
                            <tr class="text-center">
                                <td>
                                    @if ($wisata->user->roles == 'ADMIN')
                                        Admin
                                    @elseif ($wisata->user->roles == 'USER')
                                        {{ $wisata->user->name }}
                                    @endif
                                </td>
                                <td>{{ $wisata->wisata->nama_wisata }}</td>
                                <td>{{ Carbon\Carbon::parse($wisata->tanggal_sewa)->translatedFormat('l, d F Y') }}</td>
                                <td>@if ($wisata->status_bayar == 'belum-bayar')
                                    <span class="badge bg-danger">Belum Bayar</span>
                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                    <a href="{{ route('e-ticket.bukti-bayar', $wisata->id) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                <span class="badge bg-success">Sudah Bayar</span>
                                @endif</td>
                                <td>
                                    @if ($wisata->status_bayar == 'sudah-bayar')
                                    <a href="{{ route('e-ticket.bukti-bayar', $wisata->id) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pdf-sewa', $wisata->id) }}" class="btn btn-danger text-white btn-download">
                                        <i class="fa fa-file-pdf"></i>
                                    </a>
                                    <a href="{{ route('e-ticket.print', $wisata->id) }}" class="btn btn-primary text-white" target="_blank">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-warning btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @elseif ($wisata->status_bayar == 'belum-bayar')
                                    <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-warning btn-delete">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @elseif($wisata->status_bayar == 'menunggu-konfirmasi')
                                        <a href="{{ route('e-ticket.konfirmasi-pembayaran', $wisata->id) }}" class="btn btn-primary btn-konfirmasi">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="{{ route('e-ticket.batal-pembayaran', $wisata->id) }}" class="btn btn-danger btn-batal-konfirmasi">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-warning btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
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
    </section>
</div>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>E-Ticket Glamping</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive px-3 py-3 text-nowrap">
                    <table class="table table-bordered table-hover" id="table3">
                        <thead>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Glamping</th>
                                <th>Tanggal</th>
                                <th>Status Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @forelse ($items->where('wisata.kategori', 'glamping') as $wisata)
                            <tr class="text-center">
                                <td>
                                    @if ($wisata->user->roles == 'ADMIN')
                                        Admin
                                    @elseif ($wisata->user->roles == 'USER')
                                        {{ $wisata->user->name }}
                                    @endif
                                </td>
                                <td>{{ $wisata->wisata->nama_wisata }}</td>
                                <td>{{ Carbon\Carbon::parse($wisata->tanggal_sewa)->translatedFormat('l, d F Y') }}</td>
                                <td>@if ($wisata->status_bayar == 'belum-bayar')
                                    <span class="badge bg-danger">Belum Bayar</span>
                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                    <a href="{{ route('e-ticket.bukti-bayar', $wisata->id) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                <span class="badge bg-success">Sudah Bayar</span>
                                @endif</td>
                                <td>
                                    @if ($wisata->status_bayar == 'sudah-bayar')
                                    <a href="{{ route('e-ticket.bukti-bayar', $wisata->id) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pdf-sewa', $wisata->id) }}" class="btn btn-danger text-white btn-download">
                                        <i class="fa fa-file-pdf"></i>
                                    </a>
                                    <a href="{{ route('e-ticket.print', $wisata->id) }}" class="btn btn-primary text-white" target="_blank">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-warning btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @elseif ($wisata->status_bayar == 'belum-bayar')
                                    <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-warning btn-delete">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @elseif($wisata->status_bayar == 'menunggu-konfirmasi')
                                        <a href="{{ route('e-ticket.konfirmasi-pembayaran', $wisata->id) }}" class="btn btn-primary btn-konfirmasi">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="{{ route('e-ticket.batal-pembayaran', $wisata->id) }}" class="btn btn-danger btn-batal-konfirmasi">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-warning btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
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
    </section>
</div>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>E-Ticket Tubing</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive px-3 py-3 text-nowrap">
                    <table class="table table-bordered table-hover" id="table4">
                        <thead>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Jumlah Orang</th>
                                <th>Tanggal Tiket</th>
                                <th>Status Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @forelse ($items->where('wisata.kategori', 'tubing') as $wisata)
                            <tr class="text-center">
                                <td>
                                    @if ($wisata->user->roles == 'ADMIN')
                                        Admin
                                    @elseif ($wisata->user->roles == 'PETUGAS')
                                        Petugas
                                    @elseif ($wisata->user->roles == 'USER')
                                        {{ $wisata->user->name }}
                                    @endif
                                </td>
                                <td>{{ $wisata->jumlah_orang }}</td>
                                <td>{{ Carbon\Carbon::parse($wisata->tanggal_tiket)->translatedFormat('l, d F Y') }}</td>
                                <td>@if ($wisata->status_bayar == 'belum-bayar')
                                    <span class="badge bg-danger">Belum Bayar</span>
                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                    <a href="{{ route('e-ticket.bukti-bayar', $wisata->id) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                <span class="badge bg-success">Sudah Bayar</span>
                                @endif</td>
                                <td>
                                    @if ($wisata->status_bayar == 'sudah-bayar')
                                    <a href="{{ route('e-ticket.bukti-bayar', $wisata->id) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pdf-tiket', $wisata->id) }}" class="btn btn-danger text-white btn-download">
                                        <i class="fa fa-file-pdf"></i>
                                    </a>
                                    <a href="{{ route('e-ticket.print', $wisata->id) }}" class="btn btn-primary text-white" target="_blank">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-warning btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @elseif ($wisata->status_bayar == 'belum-bayar')
                                    <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-warning btn-delete">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @elseif($wisata->status_bayar == 'menunggu-konfirmasi')
                                        <a href="{{ route('e-ticket.konfirmasi-pembayaran', $wisata->id) }}" class="btn btn-primary btn-konfirmasi">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="{{ route('e-ticket.batal-pembayaran', $wisata->id) }}" class="btn btn-danger btn-batal-konfirmasi">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <form action="{{ route('e-ticket.batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-warning btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
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
    </section>
</div>
@endsection

@push('addon-script')
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

    @if (Session::get('success-konfirmasi'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Berhasil Mengkonfirmasi Pembayaran'
        })
    </script>
    @endif

    @if (Session::get('success-tambah'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Berhasil Menambah Transaksi'
        })
    </script>
    @endif

    @if (Session::get('batal-pembayaran'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Pembayaran Berhasil Dibatalkan'
        })
    </script>
    @endif

    @if (Session::get('batal-produk'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Transaksi Berhasil Dibatalkan'
        })
    </script>
    @endif

    <script>
        $(document).ready( function () {
            $('#table1').DataTable({
                ordering: false
            });
        });
        $(document).ready( function () {
            $('#table2').DataTable({
                ordering: false
            });
        });
        $(document).ready( function () {
            $('#table3').DataTable({
                ordering: false
            });
        });
        $(document).ready( function () {
            $('#table4').DataTable({
                ordering: false
            });
        });

        $('.btn-download').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href');
            Swal.fire({
                title: 'Konfirmasi',
                text: "Download QR-Code",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Konfirmasi',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = form;
                }
            });
        });

        $('.btn-konfirmasi').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href');
            Swal.fire({
                title: 'Konfirmasi',
                text: "Konfirmasi Pembayaran?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Konfirmasi',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = form;
                }else {
                    Swal.fire('Data Batal Dikonfirmasi');
                }
            });
        });

        $('.btn-batal-konfirmasi').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href');
            Swal.fire({
                title: 'Konfirmasi',
                text: "Batalkan Pembayaran?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Batalkan',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = form;
                }else {
                    Swal.fire('Data Batal Diubah');
                }
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

    <script src="{{ url('backend/assets/vendors/fontawesome/all.min.js') }}"></script>
@endpush

@push('addon-style')
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
