<header class="flex items-center justify-between bg-white shadow px-4 py-3 lg:py-4 lg:px-6">
  <div class="flex items-center space-x-4">
    <!-- Sidebar toggle button on mobile -->
    <button @click="sidebarOpen = true" class="text-green-700 lg:hidden focus:outline-none text-2xl">
      ☰
    </button>

    <!-- Judul dashboard -->
    <h2 class="text-xl font-semibold">
        Dashboard {{ auth()->user()->getRoleNames()->first() }}
    </h2>
  </div>

  <!-- Nama user login -->
  @auth
    <div class="bg-green-100 px-3 py-1 rounded-full text-sm font-medium text-green-800">
      {{ auth()->user()->name }}
    </div>
  @endauth
</header>
