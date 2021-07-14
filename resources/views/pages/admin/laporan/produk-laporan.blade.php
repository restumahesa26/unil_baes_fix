<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Produk</title>
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

    <h3 class="text-center">Laporan Produk {{ $text }}</h3>
        <table class="table table-bordered table-hover mt-4" id="table1">
            <thead>
                <tr class="text-center">
                    <th style="text-align: center; vertical-align: middle;">Nama Produk</th>
                    <th style="text-align: center; vertical-align: middle;">Kategori</th>
                    <th style="text-align: center; vertical-align: middle;">Stok</th>
                    <th style="text-align: center; vertical-align: middle;">Harga</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @forelse ($items as $item)
                <tr class="text-center">
                    <td style="text-align: center; vertical-align: middle;">{{ $item->nama_produk }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->kategori }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        @if ($item->stok == 0 || $item->status == 1)
                            -
                        @else
                            {{ $item->stok }}
                        @endif
                    </td>
                    <td style="text-align: center; vertical-align: middle;">{{ rupiah($item->harga) }}</td>
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
