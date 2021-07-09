@extends('layouts.admin')

@section('title')
    <title>E-Ticket - Bukti Bayar</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Bukti Bayar E-Ticket</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.html">E-Ticket</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bukti Bayar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('e-ticket.index') }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body text-center">
                <h2 class="mt-3">Bukti Bayar</h2>
                <img src="{{ asset('storage/images/bukti-bayar-tiket/'. $item->bukti_bayar) }}" alt="" class="img-fluid">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Jumlah Bayar</th>
                            <th scope="col">Nomor Rekening</th>
                            <th scope="col">Pilihan Rekening</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">{{ rupiah($item->total_bayar) }}</th>
                            <th scope="row">{{ $item->nomor_rekening }}</th>
                            <td scope="row">{{ $item->rekening }}</td>
                        </tr>
                    </tbody>
                </table>
                @if ($item->status_bayar === 'menunggu-konfirmasi')
                <a href="{{ route('e-ticket.konfirmasi-pembayaran', $item->id) }}" class="btn btn-primary btn-block">Konfirmasi Pembayaran</a>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
