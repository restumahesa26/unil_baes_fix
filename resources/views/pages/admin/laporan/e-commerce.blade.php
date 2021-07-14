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
            size: landscape;
        }
    </style>
    <link rel="stylesheet" href="{{ url('backend/assets/css/bootstrap.css') }}">
</head>

<body>

    <h3 class="text-center">Laporan E-Commerce</h3>
        <table class="table table-bordered table-hover mt-4" id="table1">
            <thead>
                <tr class="text-center">
                    <th style="text-align: center; vertical-align: middle;">Nama</th>
                    <th style="text-align: center; vertical-align: middle;">Produk</th>
                    <th style="text-align: center; vertical-align: middle;">Quantitas</th>
                    <th style="text-align: center; vertical-align: middle;">Total Harga</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @forelse ($items as $item)
                <tr class="text-center">
                    <td style="text-align: center; vertical-align: middle;">
                        @if ($item->user->roles == 'ADMIN')
                            Admin
                        @elseif ($item->user->roles == 'USER')
                            {{ $item->user->name }}
                        @endif
                    </td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->produk->nama_produk }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->quantitas }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ rupiah($item->total_harga) }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</td>
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

    <script src="{{ url('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('backend/assets/vendors/jquery/jquery.min.js') }}"></script>
</body>
<script>
    window.print();
</script>
</html>
