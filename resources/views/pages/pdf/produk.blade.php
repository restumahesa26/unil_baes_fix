<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Ticket</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <center>
        <h2>Invoice</h2><br>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($item->id . ' - ' . $item->user->id . ' - ' . $item->produk->nama_produk)) !!} ">
        <h5 class="mt-3">Detail Pesanan</h5>
        <table class="table table-bordered mt-1 text-center text-nowrap">
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
                    <td style="text-align: center; vertical-align: middle;">{{ $item->user->name }} <br> ( 0{{ $item->user->no_hp }} ) </td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->produk->nama_produk }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->quantitas }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ rupiah($item->total_harga) }}</td>
                </tr>
            </tbody>
        </table>

        <h5 class="mt-3">Alamat Penerima</h5>

        <table class="table table-bordered mt-1 text-center text-nowrap">
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
                    <td style="text-align: center; vertical-align: middle;">{{ $item->kelurahan->name }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->kecamatan->name }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->kota->name }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->provinsi->name }}</td>
                </tr>
            </tbody>
        </table>
    </center>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
