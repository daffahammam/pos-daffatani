@extends('layouts.dashboard')

@section('content')
<div class="flex-1 flex flex-col overflow-hidden">
  <div class="max-w-xl mx-auto px-4 pt-4 pb-8 h-[calc(100vh-100px)]">
    <div class="bg-white shadow rounded-lg h-full flex flex-col overflow-hidden">

      <!-- Header -->
      <div class="px-6 py-4 border-b">
        <h1 class="text-xl font-bold">👤 Tambah User Baru</h1>
      </div>

      <!-- Form -->
      <div class="px-6 py-4 overflow-y-auto flex-1">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
          @csrf

          <div>
            <label for="name" class="block text-sm font-medium">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-full mt-1 rounded-md border-gray-300 shadow-sm">
            @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   class="w-full mt-1 rounded-md border-gray-300 shadow-sm">
            @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="password" class="block text-sm font-medium">Password</label>
            <input type="password" name="password" id="password"
                   class="w-full mt-1 rounded-md border-gray-300 shadow-sm">
            @error('password') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="w-full mt-1 rounded-md border-gray-300 shadow-sm">
          </div>

          <div>
            <label for="role" class="block text-sm font-medium">Role</label>
            <select name="role" id="role"
                    class="w-full mt-1 rounded-md border-gray-300 shadow-sm">
              @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                  {{ ucfirst($role->name) }}
                </option>
              @endforeach
            </select>
            @error('role') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div class="pt-4">
            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
              Simpan
            </button>
            <a href="{{ route('users.index') }}"
               class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
              Batal
            </a>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection
