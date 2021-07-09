@extends('layouts.admin')

@section('title')
    <title>Scan QR-Code</title>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Scan QR-Code</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Scan QR-Code</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card" style="height: 515px">
        <div class="card-title text-center mt-3">
            <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                <label class="btn btn-primary active">
                    <input type="radio" name="options" value="1" autocomplete="off" checked> Kamera Depan
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="options" value="2" autocomplete="off"> Kamera Belakang
                </label>
            </div>
        </div>
        <div class="card-body text-center" style="margin-top: -60px;">
            <video id="preview"></video>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
        scanner.addListener('scan',function(content){
            $.ajax({
                    url: `{{ route('check-sewa.api') }}`,
                    type: 'get',
                    data: {
                        'qr_code' : content
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response != null) {
                            if(response.hasil === 'ada'){
                                Swal.fire({
                                    icon: "success",
                                    title: "Tiket Ditemukan",
                                    text: response.jumlah + ' ( ' + response.nama + ' )'
                                });
                            }else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Mohon Maaf",
                                    text: 'Tiket Hanya Berlaku Untuk ' + response.tanggal
                                });
                            }
                        }
                    }
                });
        });
        Instascan.Camera.getCameras().then(function (cameras){
            if(cameras.length>0){
                scanner.start(cameras[0]);
                $('[name="options"]').on('change',function(){
                    if($(this).val()==1){
                        if(cameras[0]!=""){
                            scanner.start(cameras[0]);
                        }else{
                            alert('No Front camera found!');
                        }
                    }else if($(this).val()==2){
                        if(cameras[1]!=""){
                            scanner.start(cameras[1]);
                        }else{
                            alert('No Back camera found!');
                        }
                    }
                });
            }else{
                console.error('No cameras found.');
                alert('No cameras found.');
            }
        }).catch(function(e){
            console.error(e);
            alert(e);
        });
    </script>
@endpush

@push('addon-style')
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
