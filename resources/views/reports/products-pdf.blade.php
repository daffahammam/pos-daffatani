<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Produk Terjual</title>
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

    .text-left {
      text-align: left;
    }

    .no-data {
      text-align: center;
      padding: 20px;
      font-style: italic;
    }

    .footer {
      margin-top: 40px;
      text-align: right;
      font-size: 11px;
    }
  </style>
</head>
<body>
  <h2>LAPORAN PRODUK TERJUAL</h2>
  <div class="subheading">
    Bulan: <strong>{{ $month ? \Carbon\Carbon::createFromDate(null, (int) $month)->translatedFormat('F') : 'Semua' }}</strong> |
    Tahun: <strong>{{ $year ?? 'Semua' }}</strong>
  </div>

  @if ($details->isEmpty())
    <div class="no-data">Tidak ada data produk terjual untuk periode ini.</div>
  @else
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th class="text-left">Nama Produk</th>
          <th>Jumlah Terjual</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($details as $detail)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-left">{{ $detail->product->name ?? '-' }}</td>
            <td>{{ $detail->total_sold }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif

  <div class="footer">
    Dicetak pada: {{ now()->format('d-m-Y H:i') }}
  </div>
</body>
</html>
