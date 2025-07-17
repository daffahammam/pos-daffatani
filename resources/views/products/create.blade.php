@extends('layouts.dashboard')

@section('content')
  <div class="flex-1 overflow-y-auto h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto p-4 sm:p-6 lg:p-8 min-h-screen">
      <div class="bg-white shadow-lg rounded-xl overflow-hidden">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 px-6 py-5 border-b">
          <h2 class="text-2xl font-semibold text-gray-800">📦 Tambah Produk</h2>
          <a href="{{ route('products.index') }}"
             class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-semibold rounded-md hover:bg-gray-300 transition">
            ← Kembali
          </a>
        </div>

        <!-- Form -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-4 space-y-5">
          @csrf

          <!-- Nama Produk -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" id="name" name="name"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500"
                   placeholder="Contoh: Pupuk Organik" required>
          </div>

          <!-- Kategori -->
          <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select id="category_id" name="category_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500"
                    required>
              <option value="" disabled selected>-- Pilih Kategori --</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <!-- Harga Modal -->
          <div>
            <label for="cost" class="block text-sm font-medium text-gray-700">Harga Modal</label>
            <input type="number" id="cost" name="cost"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500"
                   placeholder="Contoh: 20000" required>
          </div>

          <!-- Harga Jual -->
          <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Harga Jual</label>
            <input type="number" id="price" name="price"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500"
                   placeholder="Contoh: 25000" required>
          </div>

          <!-- Stok -->
          <div>
            <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" id="stock" name="stock"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500"
                   placeholder="Contoh: 100" required>
          </div>

          <!-- Upload Foto -->
          <div>
            <label for="photo" class="block text-sm font-medium text-gray-700">Foto Produk</label>
            <input type="file" id="photo" name="photo"
                   class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-green-500"
                   accept="image/*">
          </div>

          <!-- Tombol Simpan -->
          <div class="pt-4 pb-8">
            <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition">
              💾 Simpan Produk
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
@endsection
