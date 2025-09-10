@extends('layouts.dashboard')

@section('content')
  <div class="flex-1 flex flex-col overflow-hidden">
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">
      <div class="bg-white shadow-md rounded-xl p-6 sm:p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">✏️ Edit Kategori</h2>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6">
          @csrf
          @method('PUT')

          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $category->name) }}"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                   placeholder="Contoh: Pupuk Organik" required>
          </div>

          <div class="flex justify-end space-x-3">
            <a href="{{ route('categories.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
              Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
               Update Kategori
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
