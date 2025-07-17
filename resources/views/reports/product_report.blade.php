@extends('layouts.dashboard')

@section('content')
<div class="px-4 py-6 space-y-6">
  <h1 class="text-xl font-bold">📦 Laporan Produk Terjual</h1>

  <!-- Filter -->
  <form method="GET" action="{{ route('reports.products') }}" class="flex flex-col sm:flex-row gap-3">
    <select name="month" class="w-full sm:w-auto pr-8 pl-2 py-2 border rounded-md">
      @foreach(range(1, 12) as $m)
        @php $bulan = \Carbon\Carbon::create()->month($m)->translatedFormat('F'); @endphp
        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ $bulan }}</option>
      @endforeach
    </select>

    <select name="year" class="w-full sm:w-auto pl-2 pr-8 py-2 border rounded-md">
      @foreach(range(now()->year, now()->year - 5) as $y)
        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
      @endforeach
    </select>

    <button type="submit"
            class="w-full sm:w-auto bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
      Filter
    </button>
    <a href="{{ route('reports.products-pdf', request()->only('month', 'year')) }}"
       class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
      Cetak
    </a>
  </form>

  <!-- Tabel Responsif Scroll -->
  <div class="bg-white rounded-lg shadow overflow-auto">
    <div class="w-full overflow-x-auto">
      <table class="min-w-[600px] w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100 text-gray-600 font-semibold">
          <tr>
            <th class="px-2 py-2 text-left">No</th>
            <th class="px-2 py-2 text-left">Produk</th>
            <th class="px-2 py-2 text-left">Jumlah Terjual</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($details as $detail)
            <tr>
              <td class="px-2 py-2">{{ $loop->iteration }}</td>
              <td class="px-2 py-2">{{ $detail->product->name ?? '-' }}</td>
              <td class="px-2 py-2">{{ $detail->total_sold }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="px-4 py-4 text-center text-gray-500">Tidak ada data penjualan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
