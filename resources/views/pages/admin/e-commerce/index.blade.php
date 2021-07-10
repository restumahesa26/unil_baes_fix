@extends('layouts.admin')

@section('title')
    <title>E-Commerce</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>E-Commerce</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">E-Commerce</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('e-commerce-filter') }}">
                <div class="row">
                    <div class="form-group col-4">
                        <select name="filter" id="filter" class="form-control">
                            <option value="">--Filter--</option>
                            <option value="hari-ini">Tanggal Hari Ini</option>
                            <option value="belum-bayar">Belum Bayar</option>
                            <option value="belum-konfirmasi">Belum Dikonfirmasi</option>
                            <option value="belum-set-pengiriman">Belum Set Pengiriman</option>
                            <option value="belum-bayar-ongkir">Belum Bayar Ongkos Kirim</option>
                            <option value="belum-konfirmasi-ongkir">Belum Dikonfirmasi Ongkos Kirim</option>
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <input type="date" name="filter_tanggal" placeholder="Masukkan Tanggal" class="form-control">
                    </div>
                    <div class="form-group col-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('e-commerce.index') }}" class="btn btn-info">Refresh</a>
                    </div>
                </div>
            </form>
            <div class="table-responsive px-3 py-3 text-nowrap">
                <table class="table table-bordered table-hover" id="table">
                    <thead>
                        <tr class="text-center">
                            <th>Nama</th>
                            <th>Produk</th>
                            <th>Quantitas</th>
                            <th>Total Harga</th>
                            <th>Status Bayar</th>
                            <th>Status Pengiriman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @forelse ($items as $item)
                        <tr class="text-center">
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->produk->nama_produk }}</td>
                            <td>{{ $item->quantitas }}</td>
                            <td>{{ rupiah($item->total_harga) }}</td>
                            <td>
                                @if ($item->status_bayar == 'belum-bayar')
                                <span class="badge bg-danger">Belum Bayar</span>
                                @elseif ($item->status_bayar == 'menunggu-konfirmasi')
                                <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                @elseif ($item->status_bayar == 'sudah-bayar')
                                <span class="badge bg-success">Sudah Bayar</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status_pengiriman == NULL)
                                -
                                @elseif ($item->status_pengiriman == 'bayar-ongkir')
                                <span class="badge bg-danger">Belum Bayar Ongkir</span>
                                @elseif ($item->status_pengiriman == 'sudah-bayar-ongkir')
                                <span class="badge bg-warning">Menunggu Dikirim</span>
                                @elseif ($item->status_pengiriman == 'dikirim')
                                <span class="badge bg-success">Dikirim</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status_bayar == 'belum-bayar')
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id }}">
                                    <i class="fas fa-book"></i>
                                </button>
                                <form action="{{ route('e-commerce.batal-pesanan', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-delete">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @elseif ($item->status_bayar == 'menunggu-konfirmasi')
                                <a href="{{ route('e-commerce.bukti-bayar', $item->id) }}"
                                    class="btn btn-info ">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('e-commerce.konfirmasi-pembayaran', $item->id) }}"
                                    class="btn btn-primary btn-konfirmasi-pembayaran">
                                    <i class="fas fa-check"></i>
                                </a>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id }}">
                                    <i class="fas fa-book"></i>
                                </button>
                                <a href="{{ route('e-commerce.batal-pembayaran', $item->id) }}" class="btn btn-danger btn-batal-konfirmasi">
                                    <i class="fas fa-trash"></i>
                                </a>
                                @elseif ($item->status_bayar == 'sudah-bayar' && $item->status_pengiriman == NULL)
                                <a href="{{ route('e-commerce.bukti-bayar', $item->id) }}"
                                    class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id }}">
                                    <i class="fas fa-book"></i>
                                </button>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modalPengiriman{{ $item->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @elseif ($item->status_pengiriman == 'sudah-bayar-ongkir')
                                <a href="{{ route('e-commerce.bukti-bayar', $item->id) }}"
                                    class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('e-commerce.bukti-ongkos-kirim', $item->id) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id }}">
                                    <i class="fas fa-book"></i>
                                </button>
                                <a href="{{ route('e-commerce.batal-pembayaran-ongkir', $item->id) }}" class="btn btn-danger btn-batal-konfirmasi-ongkir">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modalResi{{ $item->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @elseif ($item->status_pengiriman == 'bayar-ongkir')
                                <a href="{{ route('e-commerce.bukti-bayar', $item->id) }}"
                                    class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('e-commerce.bukti-ongkos-kirim', $item->id) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id }}">
                                    <i class="fas fa-book"></i>
                                </button>
                                @elseif ($item->status_bayar == 'sudah-bayar' && $item->status_pengiriman ==
                                'dikirim')
                                <a href="{{ route('e-commerce.bukti-bayar', $item->id) }}"
                                    class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('e-commerce.bukti-ongkos-kirim', $item->id) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id }}">
                                    <i class="fas fa-book"></i>
                                </button>
                                <a href="{{ route('pdf-invoice', $item->id) }}"
                                    class="btn btn-danger text-white btn-download">
                                    <i class="fa fa-file-pdf"></i>
                                </a>
                                <form action="{{ route('e-commerce.batal-pesanan', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-warning btn-delete">
                                        <i class="fas fa-times"></i>
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
</div>
@foreach ($items as $ite)
<div class="modal fade" id="modalPengiriman{{ $ite->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Pilih Jenis Pengiriman</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('e-commerce.set-pengiriman', $ite->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="metode_pengiriman" class="col-form-label">Metode Pengiriman</label>
                        <select name="metode_pengiriman" id="metode_pengiriman" class="form-control" required>
                            <option value="">Pilih Metode Pengiriman</option>
                            <option value="Ojek Lokal">Ojek Lokal</option>
                            <option value="J&T">J&T</option>
                            <option value="JNE">JNE</option>
                            <option value="Pos Indonesia">Pos Indonesia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ongkos_kirim" class="col-form-label">Ongkos Kirim</label>
                        <input type="number" class="form-control" min="1" name="ongkos_kirim" placeholder="Masukkan Ongkos Kirim">
                    </div>
                    <button class="btn btn-block btn-info btn-pengiriman" type="submit">Set Pengiriman</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($items as $itemResi)
<div class="modal fade" id="modalResi{{ $itemResi->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Masukkan Kode Resi atau No. HP</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('e-commerce.kirim-pesanan', $itemResi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="metode_pengiriman" class="col-form-label">Kode Resi / No. HP</label>
                    <input type="text" class="form-control" name="kode_resi" placeholder="Kode Resi / No. HP" required>
                </div>
                <button class="btn btn-block btn-info btn-resi" type="submit">Kirim Pesanan</button>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach

@foreach ($items as $itemDetail)
<div class="modal fade" id="modalDetail{{ $itemDetail->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Detail Pesanan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Table with outer spacing -->
                <div class="table-responsive">
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>Penerima</th>
                                <th>Produk</th>
                                <th>Quantitas</th>
                                <th>Total Harga</th>
                                <th>Tanggal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">{{ $itemDetail->user->name }}</td>
                                <td class="text-bold-500">{{ $itemDetail->produk->nama_produk }}</td>
                                <td class="text-bold-500">{{ $itemDetail->quantitas }}</td>
                                <td class="text-bold-500">{{ rupiah($itemDetail->total_harga) }}</td>
                                <td class="text-bold-500">{{ Carbon\Carbon::parse($itemDetail->created_at)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>Provinsi</th>
                                <th>Kota / Kabupaten</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan / Desa</th>
                                <th>Alamat Lengkap</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">{{ $itemDetail->provinsi->name }}</td>
                                <td class="text-bold-500">{{ $itemDetail->kota->name }}</td>
                                <td class="text-bold-500">{{ $itemDetail->kecamatan->name }}</td>
                                <td class="text-bold-500">{{ $itemDetail->kelurahan->name }}</td>
                                <td class="text-bold-500">{{ $itemDetail->alamat_lengkap }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('addon-script')
    <script src="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('backend/assets/vendors/fontawesome/all.min.js') }}"></script>

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
        $(document).ready( function () {
            $('#table').DataTable({
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

        $('.btn-konfirmasi-pembayaran').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href');
            Swal.fire({
                title: 'Konfirmasi',
                text: "Setujui Pembayaran?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Setuju',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = form;
                }else {
                    Swal.fire('Pembayaran Batal Disetujui');
                }
            });
        });

        $('.btn-batal-konfirmasi').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href');
            Swal.fire({
                title: 'Konfirmasi',
                text: "Batalkan Pembayaran?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Setuju',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = form;
                }else {
                    Swal.fire('Pembayaran Batal Disetujui');
                }
            });
        });

        $('.btn-batal-konfirmasi-ongkir').on('click', function (event) {
            event.preventDefault(); // prevent form submit
            var form = $(this).attr('href');
            Swal.fire({
                title: 'Konfirmasi',
                text: "Batalkan Pembayaran Ongkos Kirim?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Setuju',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = form;
                }else {
                    Swal.fire('Pembayaran Batal Disetujui');
                }
            });
        });

        $('.btn-delete').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Yakin Menghapus Pesanan?',
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
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
