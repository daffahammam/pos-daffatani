@extends('layouts.dashboard')

@section('content')
<div class="flex flex-col h-[calc(100vh-100px)] px-4 pb-4 space-y-4"> {{-- Tinggi dikurangi header --}}
  <h1 class="text-xl font-bold">🧾 Daftar Penjualan</h1>

  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
  <!-- Form Filter -->
  <form method="GET" action="{{ route('sales.index') }}" class="flex flex-col sm:flex-row items-center gap-3 flex-wrap">
    <input type="date" name="start_date" value="{{ request('start_date') }}"
           class="px-4 py-2 border rounded-md w-full sm:w-auto text-sm">
    <input type="date" name="end_date" value="{{ request('end_date') }}"
           class="px-4 py-2 border rounded-md w-full sm:w-auto text-sm">
    <button type="submit"
            class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition w-full sm:w-auto text-sm">
      Filter
    </button>
  </form>

  <!-- Tombol Tambah Penjualan -->
  <a href="{{ route('sales.create') }}"
     class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition w-full sm:w-auto text-sm">
    Buat Penjualan
  </a>
</div>


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
            <th class="px-4 py-2 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($sales as $index => $sale)
            <tr>
              <td class="px-4 py-2">{{ $index + 1 }}</td>
              <td class="px-4 py-2">{{ $sale->created_at->format('d M Y') }}</td>
              <td class="px-4 py-2">{{ $sale->invoice }}</td>
              <td class="px-4 py-2">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
              <td class="px-4 py-2 space-x-2">
                <a href="{{ route('sales.show', $sale->id) }}"
                   class="inline-block px-3 py-1 bg-yellow-600 text-white rounded text-xs hover:bg-yellow-700 transition">
                  Lihat
                </a>
                <a href="{{ route('sales.pdf', $sale->id) }}"
                   class="inline-block px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700 transition" target="_blank">
                  Cetak
                </a>
                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="inline-block"
                      onsubmit="return confirm('Hapus data penjualan ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="px-3 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700 transition">
                    Hapus
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada data penjualan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
