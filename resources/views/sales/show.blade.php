@extends('layouts.dashboard')

@section('content')
<div class="max-w-5xl mx-auto p-6">
  <div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b flex justify-between items-center">
      <div>
        <h2 class="text-xl font-bold text-gray-800">🧾 Detail Transaksi</h2>
        <p class="text-sm text-gray-500">Invoice: <span class="font-mono">{{ $sale->invoice }}</span></p>
        <p class="text-sm text-gray-500">Tanggal: {{ $sale->created_at->format('d M Y, H:i') }}</p>
        <p class="text-sm text-gray-500">Kasir: {{ $sale->user->name ?? 'N/A' }}</p>
      </div>
      <div class="flex justify-end gap-3 mt-4">
  <a href="{{ route('sales.pdf', $sale->id) }}"
     class="inline-flex items-center px-2 py-1 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition"
     target="_blank">
    Cetak
  </a>
  <a href="{{ route('sales.index') }}"
     class="inline-flex items-center px-2 py-1 text-xs font-semibold text-green-600 hover:underline">
    ← Kembali
  </a>
</div>

    </div>

    <div class="p-6">
      <table class="w-full text-sm text-left border">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 border">#</th>
            <th class="px-4 py-2 border">Produk</th>
            <th class="px-4 py-2 border">Harga</th>
            <th class="px-4 py-2 border">Qty</th>
            <th class="px-4 py-2 border">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sale->details as $index => $detail)
          <tr>
            <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
            <td class="px-4 py-2 border">{{ $detail->product->name }}</td>
            <td class="px-4 py-2 border">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
            <td class="px-4 py-2 border text-center">{{ $detail->qty }}</td>
            <td class="px-4 py-2 border">Rp {{ number_format($detail->price * $detail->qty, 0, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr class="bg-gray-100 font-semibold">
            <td colspan="4" class="px-4 py-2 border text-right">Total:</td>
            <td class="px-4 py-2 border">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
@endsection
