@extends('layouts.admin')

@section('title')
    <title>E-Commerce - Bukti Ongkir</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Bukti Bayar E-Commerce</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.html">E-Commerce</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bukti Bayar Ongkir</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('e-commerce.index') }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body text-center">
                <h2 class="mt-3">Bukti Ongkos Kirim</h2>
                <img src="{{ asset('storage/images/bukti-bayar-ongkos-kirim/'. $item->bukti_bayar_2) }}" alt="" class="img-fluid">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Ongkos Kirim</th>
                            <th scope="col">Nomor Rekening</th>
                            <th scope="col">Pilihan Rekening</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">{{ rupiah($item->ongkos_kirim) }}</th>
                            <th scope="row">{{ $item->nomor_rekening_2 }}</th>
                            <td scope="row">{{ $item->rekening_2 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
