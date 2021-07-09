@extends('layouts.admin')

@section('title')
    <title>Kamus - Edit Data</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kamus</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.html">Data Kamus</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('kamus.index') }}" class="btn btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('kamus.update', $item->id) }}" method="POST" class="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kata_kunci">Kata Kunci</label>
                        <input type="text" name="kata_kunci" class="form-control @error('kata_kunci') is-invalid @enderror" id="kata_kunci" placeholder="Masukkan Kata Kunci" value="{{ $item->kata_kunci }}" required>
                        @error('kata_kunci')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="terjemahan">Terjemahan</label>
                        <input type="text" name="terjemahan" class="form-control @error('terjemahan') is-invalid @enderror" id="terjemahan" placeholder="Masukkan Terjemahan" value="{{ $item->terjemahan }}" required>
                        @error('terjemahan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-block btn-confirm" type="submit">Simpan Data</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.btn-confirm').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Simpan Data?',
            text: "Pastikan Data Sudah Benar",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }else {
                    Swal.fire('Data Batal Disimpan');
                }
            });
        });
    </script>

    @if (Session::get('gagal-ubah'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Kata Kunci Sudah Tersedia'
        })
    </script>
    @endif
@endpush

@push('addon-style')
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
