<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Penjualan</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      font-size: 12px;
      color: #333;
      margin: 40px;
    }

    h2 {
      text-align: center;
      margin-bottom: 5px;
    }


    .subheading {
      text-align: center;
      margin-bottom: 20px;
      font-size: 14px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #999;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    tfoot th {
      background-color: #e0e0e0;
    }

    .text-left {
      text-align: left;
    }

    .footer {
      margin-top: 40px;
      text-align: right;
      font-size: 11px;
    }

    .no-data {
      text-align: center;
      padding: 20px;
      font-style: italic;
    }
  </style>
</head>
<body>
  <h2>LAPORAN PENJUALAN <br> DAFFA TANI</h2>
  <div class="subheading">
    Bulan: <strong>{{ $month ? \Carbon\Carbon::createFromDate(null, (int) $month)->translatedFormat('F') : 'Semua' }}</strong> |
    Tahun: <strong>{{ $year ?? 'Semua' }}</strong>
  </div>

  @if($sales->isEmpty())
    <div class="no-data">Tidak ada data penjualan untuk periode ini.</div>
  @else
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Tanggal</th>
          <th class="text-left">Invoice</th>
          <th>Total</th>
          <th>Laba</th>
        </tr>
      </thead>
      <tbody>
        @php $grandTotal = 0; $grandProfit = 0; @endphp
        @foreach ($sales as $sale)
          @php
            $profit = 0;
            foreach ($sale->details as $detail) {
              $cost = $detail->product->cost ?? 0;
              $profit += ($detail->price - $cost) * $detail->qty;
            }
            $grandTotal += $sale->total;
            $grandProfit += $profit;
          @endphp
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $sale->created_at->format('d-m-Y') }}</td>
            <td class="text-left">{{ $sale->invoice }}</td>
            <td>Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($profit, 0, ',', '.') }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3">Total Keseluruhan</th>
          <th>Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
          <th>Rp {{ number_format($grandProfit, 0, ',', '.') }}</th>
        </tr>
      </tfoot>
    </table>
  @endif

  <div class="footer">
    Dicetak pada: {{ now()->format('d-m-Y H:i') }}
  </div>
</body>
</html>
