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

    <h3 class="text-center">Laporan E-Ticket</h3>
        <table class="table table-bordered table-hover mt-4" id="table1">
            <thead>
                <tr class="text-center">
                    <th style="text-align: center; vertical-align: middle;">Nama</th>
                    <th style="text-align: center; vertical-align: middle;">Tempat</th>
                    <th style="text-align: center; vertical-align: middle;">Jumlah Orang</th>
                    <th style="text-align: center; vertical-align: middle;">Waktu Sewa</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal</th>
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
                    <td style="text-align: center; vertical-align: middle;">{{ $item->wisata->nama_wisata }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        @if ($item->jumlah_orang == null)
                            -
                        @else
                            {{ $item->jumlah_orang }}
                        @endif
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        @if ($item->jam_sewa == null)
                            -
                        @else
                            {{ $item->jam_sewa }}
                        @endif
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        @if ($item->tanggal_tiket == null)
                            {{ Carbon\Carbon::parse($item->tanggal_sewa)->translatedFormat('l, d F Y') }}
                        @elseif ($item->tanggal_sewa == null)
                            {{ Carbon\Carbon::parse($item->tanggal_tiket)->translatedFormat('l, d F Y') }}
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

    <script src="{{ url('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('backend/assets/vendors/jquery/jquery.min.js') }}"></script>
</body>
<script>
    window.print();
</script>
</html>
