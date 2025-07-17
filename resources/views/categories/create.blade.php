<!-- resources/views/categories/create.blade.php -->

@extends('layouts.dashboard')

@section('content')
  <div class="flex-1 flex flex-col overflow-hidden">
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">
      <div class="bg-white shadow-md rounded-xl p-6 sm:p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">📝 Buat Kategori Baru</h2>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
          @csrf

          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="name" id="name"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                   placeholder="Contoh: Pupuk Organik" required>
          </div>

          <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
              💾 Simpan Kategori
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
