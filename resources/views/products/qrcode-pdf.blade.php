<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>QR {{ $product->name }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; text-align: center; font-size: 10px; }
        .qr { margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="qr">
        <img src="{{ $qrCode }}" alt="QR Code">
    </div>
    <div>
        <strong>{{ $product->name }}</strong><br>
        Rp {{ number_format($product->price, 0, ',', '.') }}
    </div>
</body>
</html>
