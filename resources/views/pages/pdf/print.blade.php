<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print E-Ticket</title>
    <style>
        @page {
            size: auto;
            size: A5;
        }
    </style>
</head>
<body>

    <center>
        <h2>E-Ticket</h2><br>
        {!! QrCode::size(200)->generate($item->qr_code); !!}
        <p>Perlihatkan QR-Code Tiket ini kepada petugas penjaga</p>
    </center>

</body>
<script>
    window.print();
</script>
</html>
