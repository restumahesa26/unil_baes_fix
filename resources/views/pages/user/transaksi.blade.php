@extends('layouts.user')

@section('content')
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Transaksi</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Transaksi</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="wisata-transaksi" class="wisata-transaksi">
        <div class="container">
            <div id="accordion" style="">
                <div class="card">
                    <div class="card-header bg-white" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none; color: inherit;">
                                Produk Komoditas Masyarakat
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="transition: all .4s ease-in-out;">
                        <div class="card-body">
                            <h3>Produk Komoditas Masyarakat</h3>
                            <div class="table-responsive px-3 py-3 text-nowrap">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="table1">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Quantitas</th>
                                            <th>Total Harga</th>
                                            <th>Status Bayar</th>
                                            <th>Status Pengiriman</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php
                                        $no = 0;
                                        @endphp
                                        @forelse ($produks as $produk)
                                        @php
                                        $no++
                                        @endphp
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td>{{ $produk->produk->nama_produk }}</td>
                                            <td>{{ $produk->quantitas }}</td>
                                            <td>{{ rupiah($produk->total_harga) }}</td>
                                            <td>
                                                @if ($produk->status_bayar == 'belum-bayar')
                                                <span class="badge bg-danger text-white">Belum Bayar</span>
                                                @elseif ($produk->status_bayar == 'menunggu-konfirmasi')
                                                <span class="badge bg-warning text-white">Menunggu Konfirmasi</span>
                                                @elseif ($produk->status_bayar == 'sudah-bayar')
                                                <span class="badge bg-success text-white">Sudah Bayar</span>
                                                @endif
                                            </td>
                                            <td>@if ($produk->status_pengiriman == NULL && $produk->status_bayar == 'sudah-bayar')
                                                <span class="badge bg-primary text-white">Menunggu Set Pengiriman</span>
                                                @elseif ($produk->status_pengiriman == 'bayar-ongkir')
                                                <span class="badge bg-danger text-white">Belum Bayar Ongkir</span>
                                                @elseif ($produk->status_pengiriman == 'sudah-bayar-ongkir')
                                                <span class="badge bg-primary text-white">Pesanan Diproses</span>
                                                @elseif ($produk->status_pengiriman == 'dikirim')
                                                <span class="badge bg-success text-white">Dikirim <br>( {{ $produk->kode_resi }}
                                                    )</span>
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($produk->status_bayar == 'belum-bayar')
                                                <a href="{{ route('bayar-produk-show', $produk->id) }}"
                                                    class="btn btn-primary text-white">
                                                    Bayar Sekarang
                                                </a>
                                                <form action="{{ route('e-commerce.batal-produk', $produk->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-warning text-white btn-delete">
                                                        Batal Pesanan
                                                    </button>
                                                </form>
                                                @elseif ($produk->status_bayar == 'menunggu-konfirmasi')
                                                <a href="https://api.whatsapp.com/send?phone=628117482512&text=Tolong%20konfirmasi%20pembayaran%20produk%20{{ $produk->produk->nama_produk }}%20atas%20nama%20{{ Auth::user()->name }}.%0ATerima%20kasih%20..."
                                                    class="btn btn-success" target="_blank"><i class="icofont-whatsapp"></i> Hubungi
                                                    Petugas</a>
                                                @elseif ($produk->status_bayar == 'sudah-bayar' && $produk->status_pengiriman == NULL)
                                                <a href="https://api.whatsapp.com/send?phone=628117482512&text=Tolong%20konfirmasi%20pengiriman%20produk%20{{ $produk->produk->nama_produk }}%20atas%20nama%20{{ Auth::user()->name }}.%0ATerima%20kasih%20..."
                                                    class="btn btn-success" target="_blank"><i class="icofont-whatsapp"></i> Hubungi
                                                    Petugas</a>
                                                @elseif ($produk->status_pengiriman == 'bayar-ongkir')
                                                <a href="{{ route('bayar-ongkos-kirim', $produk->id) }}"
                                                    class="btn btn-primary text-white">
                                                    Bayar Ongkos Kirim
                                                </a>
                                                @elseif ($produk->status_pengiriman == 'sudah-bayar-ongkir')

                                                @elseif ($produk->status_pengiriman == 'dikirim')
                                                <a href="{{ route('pdf-invoice', $produk->id) }}" class="btn btn-danger text-white">
                                                    <i class="icofont-file-pdf"></i>
                                                </a>
                                                <a href="{{ route('e-commerce.print', $produk->id) }}" class="btn btn-primary text-white" target="_blank">
                                                    <i class="icofont-print"></i>
                                                </a>
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
                <div class="card">
                    <div class="card-header bg-white" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo" style="text-decoration: none; color: inherit;">
                                Wisata
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion" style="transition: all .4s ease-in-out;">
                        <div class="card-body">
                            <h3>Wisata</h3>
                            <div class="table-responsive px-3 py-3 text-nowrap">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="table2">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Wisata</th>
                                            <th>Jumlah Orang</th>
                                            <th>Tanggal Tiket</th>
                                            <th>Status Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php
                                        $no = 0;
                                        @endphp
                                        @forelse ($wisatas->where('wisata.kategori', 'wisata') as $wisata)
                                        @php
                                        $no++
                                        @endphp
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td>{{ $wisata->wisata->nama_wisata }}</td>
                                            <td>{{ $wisata->jumlah_orang }}</td>
                                            <td>{{ Carbon\Carbon::parse($wisata->tanggal_tiket)->translatedFormat('l, d F Y') }}</td>
                                            <td>
                                                @if ($wisata->status_bayar == 'belum-bayar')
                                                <span class="badge bg-danger text-white">Belum Bayar</span>
                                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                                <span class="badge bg-warning text-white">Menunggu Konfirmasi</span>
                                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                                <span class="badge bg-success text-white">Sudah Bayar</span>
                                                @endif</td>
                                            <td>
                                                @if ($wisata->status_bayar == 'belum-bayar')
                                                <a href="{{ route('bayar-tiket-show', $wisata->id) }}"
                                                    class="btn btn-primary text-white">
                                                    Bayar Sekarang
                                                </a>
                                                <form action="{{ route('batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-warning text-white btn-delete">
                                                        Batal Tiket
                                                    </button>
                                                </form>
                                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                                <a href="{{ route('pdf-tiket', $wisata->id) }}" class="btn btn-danger text-white">
                                                    <i class="icofont-file-pdf"></i>
                                                </a>
                                                <a href="{{ route('e-ticket.print', $wisata->id) }}" class="btn btn-primary text-white" target="_blank">
                                                    <i class="icofont-print"></i>
                                                </a>
                                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                                <a href="https://api.whatsapp.com/send?phone=628117482512&text=Tolong%20konfirmasi%20pembayaran%20tiket%20wisata%20{{ $wisata->wisata->nama_wisata }}%20atas%20nama%20{{ Auth::user()->name }}.%0ATerima%20kasih%20..."
                                                    class="btn btn-success" target="_blank"><i class="icofont-whatsapp"></i> Hubungi
                                                    Petugas</a>
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
                <div class="card">
                    <div class="card-header bg-white" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree" style="text-decoration: none; color: inherit;">
                                Glamping
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse  show" aria-labelledby="headingThree" data-parent="#accordion" style="transition: all .4s ease-in-out;">
                        <div class="card-body">
                            <h3>Glamping</h3>
                            <div class="table-responsive px-3 py-3 text-nowrap">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="table3">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Glamping</th>
                                            <th>Tanggal</th>
                                            <th>Status Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php
                                        $no = 0;
                                        @endphp
                                        @forelse ($wisatas->where('wisata.kategori', 'glamping') as $wisata)
                                        @php
                                        $no++
                                        @endphp
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td>{{ $wisata->wisata->nama_wisata }}</td>
                                            <td>{{ Carbon\Carbon::parse($wisata->tanggal_sewa)->translatedFormat('l, d F Y') }}</td>
                                            <td>@if ($wisata->status_bayar == 'belum-bayar')
                                                <span class="badge bg-danger text-white">Belum Bayar</span>
                                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                                <span class="badge bg-warning text-white">Menunggu Konfirmasi</span>
                                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                                <span class="badge bg-success text-white">Sudah Bayar</span>
                                                @endif</td>
                                            <td>
                                                @if ($wisata->status_bayar == 'belum-bayar')
                                                <a href="{{ route('bayar-tiket-show', $wisata->id) }}"
                                                    class="btn btn-primary text-white">
                                                    Bayar Sekarang
                                                </a>
                                                <form action="{{ route('batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-warning text-white btn-delete">
                                                        Batal Tiket
                                                    </button>
                                                </form>
                                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                                <a href="{{ route('pdf-sewa', $wisata->id) }}" class="btn btn-danger text-white">
                                                    <i class="icofont-file-pdf"></i>
                                                </a>
                                                <a href="{{ route('e-ticket.print', $wisata->id) }}" class="btn btn-primary text-white" target="_blank">
                                                    <i class="icofont-print"></i>
                                                </a>
                                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                                <a href="https://api.whatsapp.com/send?phone=628117482512&text=Tolong%20konfirmasi%20pembayaran%20tiket%20sewa%20{{ $wisata->wisata->nama_wisata }}%20atas%20nama%20{{ Auth::user()->name }}.%0ATerima%20kasih%20..."
                                                    class="btn btn-success" target="_blank"><i class="icofont-whatsapp"></i> Hubungi
                                                    Petugas</a>
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
                <div class="card">
                    <div class="card-header bg-white" id="headingFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                                aria-expanded="false" aria-controls="collapseFour" style="text-decoration: none; color: inherit;">
                                Camping Ground
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion" style="transition: all .4s ease-in-out;">
                        <div class="card-body">
                            <h3>Camping Ground</h3>
                            <div class="table-responsive px-3 py-3 text-nowrap">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="table4">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Camping</th>
                                            <th>Tanggal</th>
                                            <th>Status Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php
                                        $no = 0;
                                        @endphp
                                        @forelse ($wisatas->where('wisata.kategori', 'camping') as $wisata)
                                        @php
                                        $no++
                                        @endphp
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td>{{ $wisata->wisata->nama_wisata }}</td>
                                            <td>{{ Carbon\Carbon::parse($wisata->tanggal_sewa)->translatedFormat('l, d F Y') }}</td>
                                            <td>@if ($wisata->status_bayar == 'belum-bayar')
                                                <span class="badge bg-danger text-white">Belum Bayar</span>
                                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                                <span class="badge bg-warning text-white">Menunggu Konfirmasi</span>
                                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                                <span class="badge bg-success text-white">Sudah Bayar</span>
                                                @endif</td>
                                            <td>
                                                @if ($wisata->status_bayar == 'belum-bayar')
                                                <a href="{{ route('bayar-tiket-show', $wisata->id) }}"
                                                    class="btn btn-primary text-white">
                                                    Bayar Sekarang
                                                </a>
                                                <form action="{{ route('batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-warning text-white btn-delete">
                                                        Batal Tiket
                                                    </button>
                                                </form>
                                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                                <a href="{{ route('pdf-sewa', $wisata->id) }}" class="btn btn-danger text-white">
                                                    <i class="icofont-file-pdf"></i>
                                                </a>
                                                <a href="{{ route('e-ticket.print', $wisata->id) }}" class="btn btn-primary text-white" target="_blank">
                                                    <i class="icofont-print"></i>
                                                </a>
                                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                                <a href="https://api.whatsapp.com/send?phone=628117482512&text=Tolong%20konfirmasi%20pembayaran%20tiket%20sewa%20{{ $wisata->wisata->nama_wisata }}%20atas%20nama%20{{ Auth::user()->name }}.%0ATerima%20kasih%20..."
                                                    class="btn btn-success" target="_blank"><i class="icofont-whatsapp"></i> Hubungi
                                                    Petugas</a>
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
                <div class="card">
                    <div class="card-header bg-white" id="headingFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive"
                                aria-expanded="false" aria-controls="collapseFive" style="text-decoration: none; color: inherit;">
                                Tubing
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordion" style="transition: all .4s ease-in-out;">
                        <div class="card-body">
                            <h3>Tubing</h3>
                            <div class="table-responsive px-3 py-3 text-nowrap">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="table5">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Tubing</th>
                                            <th>Jumlah Orang</th>
                                            <th>Tanggal</th>
                                            <th>Status Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php
                                        $no = 0;
                                        @endphp
                                        @forelse ($wisatas->where('wisata.kategori', 'tubing') as $wisata)
                                        @php
                                        $no++
                                        @endphp
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td>{{ $wisata->wisata->nama_wisata }}</td>
                                            <td>{{ $wisata->jumlah_orang }}</td>
                                            <td>{{ Carbon\Carbon::parse($wisata->tanggal_tiket)->translatedFormat('l, d F Y') }}</td>
                                            <td>@if ($wisata->status_bayar == 'belum-bayar')
                                                <span class="badge bg-danger text-white">Belum Bayar</span>
                                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                                <span class="badge bg-warning text-white">Menunggu Konfirmasi</span>
                                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                                <span class="badge bg-success text-white">Sudah Bayar</span>
                                                @endif</td>
                                            <td>
                                                @if ($wisata->status_bayar == 'belum-bayar')
                                                <a href="{{ route('bayar-tiket-show', $wisata->id) }}"
                                                    class="btn btn-primary text-white">
                                                    Bayar Sekarang
                                                </a>
                                                <form action="{{ route('batal-tiket', $wisata->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-warning text-white btn-delete">
                                                        Batal Tiket
                                                    </button>
                                                </form>
                                                @elseif ($wisata->status_bayar == 'sudah-bayar')
                                                <a href="{{ route('pdf-tiket', $wisata->id) }}" class="btn btn-danger text-white">
                                                    <i class="icofont-file-pdf"></i>
                                                </a>
                                                <a href="{{ route('e-ticket.print', $wisata->id) }}" class="btn btn-primary text-white" target="_blank">
                                                    <i class="icofont-print"></i>
                                                </a>
                                                @elseif ($wisata->status_bayar == 'menunggu-konfirmasi')
                                                <a href="https://api.whatsapp.com/send?phone=628117482512&text=Tolong%20konfirmasi%20pembayaran%20tiket%20wisata%20{{ $wisata->wisata->nama_wisata }}%20atas%20nama%20{{ Auth::user()->name }}.%0ATerima%20kasih%20..."
                                                    class="btn btn-success" target="_blank"><i class="icofont-whatsapp"></i> Hubungi
                                                    Petugas</a>
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
            </div>
        </div>
    </section><!-- End Testimonials Section -->
</main><!-- End #main -->
@endsection

@push('addon-script')
<script src="{{ url('frontend/assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

@if (Session::get('bayar-tiket'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'Segera Bayar Tiket'
    })
</script>
@endif

@if (Session::get('bayar-sewa'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'Segera Bayar Sewa'
    })
</script>
@endif

@if (Session::get('bayar-produk'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'Segera Bayar Produk'
    })
</script>
@endif

@if (Session::get('tunggu-konfirmasi'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'Tunggu Pembayaran Dikonfirmasi'
    })
</script>
@endif

@if (Session::get('hapus-produk'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Pesanan Berhasil Dibatalkan'
    })
</script>
@endif

@if (Session::get('batal-tiket'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Tiket/Sewa Berhasil Dibatalkan'
    })
</script>
@endif

<script>
    $(document).ready(function () {
        $('#table1').DataTable();
    });
    $(document).ready(function () {
        $('#table2').DataTable();
    });
    $(document).ready(function () {
        $('#table3').DataTable();
    });
    $(document).ready(function () {
        $('#table4').DataTable();
    });
    $(document).ready(function () {
        $('#table5').DataTable();
    });
</script>
@endpush

@push('addon-style')
    <link href="{{ url('frontend/assets/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
@endpush
