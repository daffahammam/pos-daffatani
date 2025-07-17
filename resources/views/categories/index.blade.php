@extends('layouts.dashboard')

@section('content')
<div class="flex flex-col h-[calc(100vh-100px)] px-4 pb-4 space-y-4">
  <h1 class="text-xl font-bold">📂 Daftar Kategori</h1>

  <!-- Tombol Tambah -->
  <div class="flex justify-end">
    <a href="{{ route('categories.create') }}"
       class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded hover:bg-green-700 transition">
    Tambah Kategori
    </a>
  </div>

  <!-- Tabel Scrollable Responsive -->
  <div class="flex flex-col bg-white shadow rounded-lg overflow-hidden flex-1">
    <div class="overflow-auto flex-1">
      <table class="min-w-[500px] w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100 text-gray-600 font-semibold sticky top-0 z-10">
          <tr>
            <th class="px-4 py-2 text-left">#</th>
            <th class="px-4 py-2 text-left">Nama Kategori</th>
            <th class="px-4 py-2 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse($categories as $category)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
              <td class="px-4 py-2 whitespace-nowrap">{{ $category->name }}</td>
              <td class="px-4 py-2 whitespace-nowrap">
                <div class="flex items-center gap-3">
                  <a href="{{ route('categories.edit', $category->id) }}"
                     class="inline-flex items-center px-2 py-1 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                    Edit
                  </a>
                  <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-2 py-1 bg-red-600 text-white text-xs font-semibold rounded hover:bg-red-700 transition">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center py-6 text-gray-500">Belum ada kategori.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
