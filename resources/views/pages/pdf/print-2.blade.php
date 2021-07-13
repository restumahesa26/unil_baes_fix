<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Invoice</title>
    <style>
        @page {
            size: auto;
            size: A4;
        }
    </style>
    <link rel="stylesheet" href="{{ url('backend/assets/css/bootstrap.css') }}">
</head>

<body>

    <div class="container">
        <center>
            <h2>Invoice</h2><br>
            {!! QrCode::size(200)->generate($item->id . ' - ' . $item->user->id . ' - ' . $item->produk->nama_produk); !!}
            <h5 class="mt-3">Detail Pesanan</h5>
            <table class="table table-bordered mt-1 text-center">
                <thead>
                    <tr>
                        <th>Penerima</th>
                        <th>Produk</th>
                        <th>Quantitas</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $item->user->name }} <br> ( 0{{ $item->user->no_hp }} ) </td>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td>{{ $item->quantitas }}</td>
                        <td>{{ rupiah($item->total_harga) }}</td>
                    </tr>
                </tbody>
            </table>

            <h5 class="mt-3">Alamat Penerima</h5>

            <table class="table table-bordered mt-1 text-center">
                <thead>
                    <tr>
                        <th>Desa / Kelurahan</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten / Kota</th>
                        <th>Provinsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $item->kelurahan->name }}</td>
                        <td>{{ $item->kecamatan->name }}</td>
                        <td>{{ $item->kota->name }}</td>
                        <td>{{ $item->provinsi->name }}</td>
                    </tr>
                </tbody>
            </table>
        </center>
    </div>

    <script src="{{ url('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('backend/assets/vendors/jquery/jquery.min.js') }}"></script>
</body>
<script>
    window.print();
</script>

</html>
