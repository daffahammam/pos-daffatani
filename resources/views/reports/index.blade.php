@extends('layouts.dashboard')

@section('content')
<div class="flex flex-col h-[calc(100vh-100px)] px-4 pb-4 space-y-4"> {{-- tingginya disesuaikan dengan header --}}
  <h1 class="text-xl font-bold">📊 Laporan Penjualan</h1>

  <!-- Filter -->
  <form method="GET" action="{{ route('reports.index') }}" class="flex flex-col sm:flex-row gap-3">
    <select name="month" class="px-4 py-2 border rounded-md w-full sm:w-auto">
      <option value="">Semua Bulan</option>
      @foreach(range(1, 12) as $m)
        @php
          $bulan = Carbon\Carbon::create()->month($m)->translatedFormat('F');
          $selectedMonth = request('month', now()->month);
        @endphp
        <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>{{ $bulan }}</option>
      @endforeach
    </select>

    <select name="year" class="px-4 py-2 border rounded-md w-full sm:w-auto">
      <option value="">Semua Tahun</option>
      @foreach(range(now()->year, now()->year - 10) as $y)
        <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
      @endforeach
    </select>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition w-full sm:w-auto">
      Filter
    </button>
    <a href="{{ route('reports.sales-pdf', request()->only('month', 'year')) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full sm:w-auto">
      Cetak
    </a>
  </form>



  <!-- Container fleksibel tinggi penuh -->
  <div class="flex flex-col bg-white shadow rounded-lg overflow-hidden flex-1">
    <!-- Tabel scrollable -->
    <div class="overflow-auto flex-1">
      <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100 text-gray-600 font-semibold sticky top-0 z-10">
          <tr>
            <th class="px-4 py-2 text-left">#</th>
            <th class="px-4 py-2 text-left">Tanggal</th>
            <th class="px-4 py-2 text-left">Invoice</th>
            <th class="px-4 py-2 text-left">Total</th>
            <th class="px-4 py-2 text-left">Laba</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @php $grandTotal = 0; $grandProfit = 0; @endphp
          @forelse ($sales as $sale)
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
              <td class="px-4 py-2">{{ $loop->iteration }}</td>
              <td class="px-4 py-2">{{ $sale->created_at->translatedFormat('d M Y') }}</td>
              <td class="px-4 py-2">{{ $sale->invoice }}</td>
              <td class="px-4 py-2">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
              <td class="px-4 py-2">Rp {{ number_format($profit, 0, ',', '.') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-4 py-4 text-center text-gray-500">Tidak ada data penjualan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Footer Tetap Terlihat -->
    <div class="bg-gray-100 border-t px-4 py-3 text-sm font-semibold flex flex-col sm:flex-row justify-between sm:items-center">
      <div>Total Penjualan: <span class="text-green-700">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span></div>
      <div>Total Laba: <span class="text-green-700">Rp {{ number_format($grandProfit, 0, ',', '.') }}</span></div>
    </div>
  </div>
</div>
@endsection
