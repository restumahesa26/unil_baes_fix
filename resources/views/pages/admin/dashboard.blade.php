@extends('layouts.admin')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('wisata.create') }}">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Wisata</h6>
                                    <h6 class="font-extrabold mb-0">{{ $wisata }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('produk.create') }}">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldWork"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Produk</h6>
                                    <h6 class="font-extrabold mb-0">{{ $produk }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('cerita-rakyat.create') }}">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldMessage"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Cerita Rakyat</h6>
                                    <h6 class="font-extrabold mb-0">{{ $cerita }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('kamus.create') }}">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldPaper"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Kamus</h6>
                                    <h6 class="font-extrabold mb-0">{{ $kamus }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('review.index') }}">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldHeart"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Review</h6>
                                    <h6 class="font-extrabold mb-0">{{ $review }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('e-ticket.index') }}">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldTicket"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">E-Ticket</h6>
                                    <h6 class="font-extrabold mb-0">{{ $e_ticket }} Belum Konfirmasi  </h6>
                                    <h6 class="text-muted font-semibold"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('e-commerce.index') }}">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldBuy"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">E-Commerce</h6>
                                    <h6 class="font-extrabold mb-0">{{ $e_commerce }} Belum Konfirmasi</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('e-commerce.index') }}">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldBuy"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">E-Commerce</h6>
                                    <h6 class="font-extrabold mb-0">{{ $e_commerce_2 }} Belum Dikirim</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kritik & Saran Pengunjung</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kritik & Saran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kritik as $item)
                                    <tr>
                                        <td class="col-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md">
                                                    @if ($item->user->jenis_kelamin === 'Laki-Laki')
                                                        <img src="{{ url('backend/assets/images/faces/2.jpg') }}">
                                                    @elseif ($item->user->jenis_kelamin === 'Perempuan')
                                                        <img src="{{ url('backend/assets/images/faces/3.jpg') }}">
                                                    @endif
                                                </div>
                                                <p class="font-bold ms-3 mb-0">{{ $item->user->name }}</p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">{{ $item->kritik_saran }}</p>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="3">Belum Ada Kritik & Saran Hari Ini</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="page-heading">
    <h3>Profile</h3>
</div>
<div class="page-content">
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Profile</h4>
                </div>
                <div class="card-content" style="margin-top: -40px">
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>No Hp / WA</th>
                                        <th>Email</th>
                                        <th>Pekerjaan</th>
                                        <th>Roles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-bold-500">{{ Auth::user()->name }}</td>
                                        <td class="text-bold-500">0{{ Auth::user()->no_hp }}</td>
                                        <td class="text-bold-500">{{ Auth::user()->email }}</td>
                                        <td class="text-bold-500">{{ Auth::user()->pekerjaan }}</td>
                                        <td class="text-bold-500">{{ Auth::user()->roles }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
