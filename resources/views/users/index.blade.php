@extends('layouts.dashboard')

@section('content')
<div class="px-4 py-6 space-y-6">
  <h1 class="text-xl font-bold">👥 Daftar Pengguna</h1>

  <!-- Tabel Scrollable -->
  <div class="bg-white rounded-lg shadow overflow-auto">
    <div class="w-full overflow-x-auto">
      <table class="min-w-[700px] w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100 text-gray-600 font-semibold sticky top-0 z-10">
          <tr>
            <th class="px-4 py-2 text-left">#</th>
            <th class="px-4 py-2 text-left">Nama</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">Role</th>
            <th class="px-4 py-2 text-left">Terdaftar</th>
            <th class="px-4 py-2 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($users as $user)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
              <td class="px-4 py-2 whitespace-nowrap">{{ $user->name }}</td>
              <td class="px-4 py-2 whitespace-nowrap">{{ $user->email }}</td>
              <td class="px-4 py-2 whitespace-nowrap">
                @foreach ($user->roles as $role)
                  <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">
                    {{ $role->name }}
                  </span>
                @endforeach
              </td>
              <td class="px-4 py-2 whitespace-nowrap">{{ $user->created_at->format('d M Y') }}</td>
              <td class="px-4 py-2 whitespace-nowrap space-x-2">
                <a href="{{ route('users.edit', $user->id) }}"
                   class="inline-flex items-center px-2 py-1 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                  Edit
                </a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                      class="inline-block" onsubmit="return confirm('Hapus pengguna ini?')">
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
              <td colspan="6" class="text-center py-6 text-gray-500">Belum ada pengguna.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
