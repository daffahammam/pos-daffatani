@extends('layouts.dashboard')

@section('content')
<div class="flex flex-col h-[calc(100vh-100px)] px-4 pb-4 space-y-4">
  <h1 class="text-xl font-bold">📦 Daftar Produk</h1>
<!-- Filter & Tambah -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
  <!-- Form Pencarian -->
  <form method="GET" action="{{ route('products.index') }}" class="flex flex-1 gap-2 flex-wrap">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..."
           class="w-full sm:w-64 px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-green-300 text-sm">

    <select name="category_id"
            class="w-full sm:w-48 px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-green-300 text-sm">
      <option value="">Semua Kategori</option>
      @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
          {{ $category->name }}
        </option>
      @endforeach
    </select>

    <button type="submit"
            class="px-4 py-2 bg-gray-400 text-white text-sm font-semibold rounded hover:bg-gray-500 transition">
      Cari
    </button>
  </form>

  <!-- Tombol Tambah -->
  <a href="{{ route('products.create') }}"
     class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded hover:bg-green-700 transition">
    Tambah Produk
  </a>
</div>


  <!-- Tabel Scrollable Responsive -->
  <div class="flex flex-col bg-white shadow rounded-lg overflow-hidden flex-1">
    <div class="overflow-auto flex-1">
      <table class="min-w-[900px] w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100 text-gray-600 font-semibold sticky top-0 z-10">
          <tr>
            <th class="px-4 py-2 text-left">#</th>
            <th class="px-4 py-2 text-left">Foto</th>
            <th class="px-4 py-2 text-left">Nama Produk</th>
            <th class="px-4 py-2 text-left">Kategori</th>
            <th class="px-4 py-2 text-left">Harga Beli</th>
            <th class="px-4 py-2 text-left">Harga Jual</th>
            <th class="px-4 py-2 text-left">Stok</th>
            <th class="px-4 py-2 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($products as $product)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
              <td class="px-4 py-2 whitespace-nowrap">
                @if($product->photo)
                  <img src="{{ asset('storage/' . $product->photo) }}" alt="Foto Produk"
                       class="w-14 h-14 object-cover rounded border">
                @else
                  <span class="text-gray-400 italic">-</span>
                @endif
              </td>
              <td class="px-4 py-2 whitespace-nowrap">{{ $product->name }}</td>
              <td class="px-4 py-2 whitespace-nowrap">{{ $product->category->name }}</td>
              <td class="px-4 py-2 whitespace-nowrap">Rp {{ number_format($product->cost, 0, ',', '.') }}</td>
              <td class="px-4 py-2 whitespace-nowrap">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
              <td class="px-4 py-2 whitespace-nowrap">{{ $product->stock }}</td>
              <td class="px-4 py-2 whitespace-nowrap space-x-2">
                <a href="{{ route('products.edit', $product->id) }}"
                   class="inline-flex items-center px-2 py-1 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                    Edit
                </a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                      class="inline-block" onsubmit="return confirm('Hapus produk ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="inline-flex items-center px-2 py-1 bg-red-600 text-white text-xs font-semibold rounded hover:bg-red-700 transition">
                    Hapus
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-6 text-gray-500">Belum ada produk.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
