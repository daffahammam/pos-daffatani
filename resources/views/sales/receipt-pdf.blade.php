<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>{{ $sale->invoice }}</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 10px;
    }

    .center {
      text-align: center;
    }

    .bold {
      font-weight: bold;
    }

    .line {
      border-top: 1px dashed #000;
      margin: 5px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      vertical-align: top;
      padding: 2px 0;
    }

    .right {
      text-align: right;
    }

    .small {
      font-size: 9px;
    }
  </style>
</head>
<body>
  <div class="center bold">Daffa Tani</div>
  <div class="center small">Sribit, Delanggu, Klaten</div>
  <div class="center small">Telp: 0895-3239-01050</div>

  <div class="line"></div>

  <p class="small">
    Invoice: {{ $sale->invoice }}<br>
    Tanggal: {{ $sale->created_at->format('d/m/Y H:i') }}<br>
    Kasir: {{ $sale->user->name ?? '-' }}
  </p>

  <div class="line"></div>

  <table>
    @foreach ($sale->details as $detail)
    <tr>
      <td colspan="2">{{ $detail->product->name }}</td>
    </tr>
    <tr>
      <td class="small">{{ $detail->qty }} x Rp{{ number_format($detail->price, 0, ',', '.') }}</td>
      <td class="right">Rp{{ number_format($detail->qty * $detail->price, 0, ',', '.') }}</td>
    </tr>
    @endforeach
  </table>

  <div class="line"></div>

  <table>
    <tr>
      <td class="bold">TOTAL</td>
      <td class="right bold">Rp{{ number_format($sale->total, 0, ',', '.') }}</td>
    </tr>
  </table>

  <div class="line"></div>

  <div class="center small">
    Terima kasih telah berbelanja <br>
    Petani Sukses Bersama Daffa Tani
  </div>
</body>
</html>
