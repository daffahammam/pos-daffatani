<aside
  class="fixed z-30 inset-y-0 left-0 w-64 transform bg-green-600 text-white p-4 flex flex-col transition duration-300
         lg:translate-x-0 lg:static lg:inset-0"
  :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
  x-show="sidebarOpen || window.innerWidth >= 1024"
  x-cloak
  @click.away="sidebarOpen = false"
>
  <!-- Header -->
  <div href="/dashboard" class="bg-white flex justify-center items-center ">
    <img src="{{ asset('images/daffatani.png') }}" class="w-12 text-center justify-center items-center"></img>
  </div>

  <!-- Menu -->
  <nav class="space-y-1 flex-1"
       x-data="{
         openMenu: {
            kategori:false,
           produk: false,
           transaksi: false,
           laporan: false,
           pengguna: false
         },
         toggle(menu) {
           this.openMenu[menu] = !this.openMenu[menu];
         }
       }"
  >
    <!-- Dashboard (Tetap biasa) -->
    <a href="/dashboard" class="flex items-center justify-between px-4 py-2 rounded hover:bg-green-600 transition-all">
      <span>Dashboard</span>
    </a>

    <!-- Menu Category -->
    @role('admin')
    <div>
      <button @click="toggle('kategori')"
              class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-green-600 transition-all focus:outline-none">
        <span>Kategori</span>
        <svg :class="{'rotate-90': openMenu.kategori}"
             class="w-4 h-4 transform transition-transform duration-300"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" /></svg>
      </button>
      <div x-show="openMenu.kategori"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="opacity-0 scale-95"
           x-transition:enter-end="opacity-100 scale-100"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="opacity-100 scale-100"
           x-transition:leave-end="opacity-0 scale-95"
           x-cloak
           class="ml-4 mt-1 space-y-1">
        <a href="{{ route('categories.index') }}" class="block px-4 py-1 rounded hover:bg-green-500 text-sm">Daftar Kategori</a>
        <a href="{{ route('categories.create') }}" class="block px-4 py-1 rounded hover:bg-green-500 text-sm">Tambah Kategori</a>
      </div>
    </div>
    @endrole

    <!-- Menu Produk -->
    @role('admin')
    <div>
      <button @click="toggle('produk')"
              class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-green-600 transition-all focus:outline-none">
        <span>Produk</span>
        <svg :class="{'rotate-90': openMenu.produk}"
             class="w-4 h-4 transform transition-transform duration-300"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" /></svg>
      </button>
      <div x-show="openMenu.produk"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="opacity-0 scale-95"
           x-transition:enter-end="opacity-100 scale-100"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="opacity-100 scale-100"
           x-transition:leave-end="opacity-0 scale-95"
           x-cloak
           class="ml-4 mt-1 space-y-1">
        <a href="{{ route('products.index') }}" class="block px-4 py-1 rounded hover:bg-green-500 text-sm">Daftar Produk</a>
        <a href="{{ route('products.create') }}" class="block px-4 py-1 rounded hover:bg-green-500 text-sm">Tambah Produk</a>
      </div>
    </div>
    @endrole

    <!-- Menu Transaksi -->
    <div>
      <button @click="toggle('transaksi')"
              class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-green-600 transition-all focus:outline-none">
        <span>Transaksi</span>
        <svg :class="{'rotate-90': openMenu.transaksi}"
             class="w-4 h-4 transform transition-transform duration-300"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" /></svg>
      </button>
      <div x-show="openMenu.transaksi"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="opacity-0 scale-95"
           x-transition:enter-end="opacity-100 scale-100"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="opacity-100 scale-100"
           x-transition:leave-end="opacity-0 scale-95"
           x-cloak
           class="ml-4 mt-1 space-y-1">
        <a href="{{ route('sales.index') }}" class="block px-4 py-1 rounded hover:bg-green-500 text-sm">Riwayat</a>
        <a href="{{ route('sales.create') }}" class="block px-4 py-1 rounded hover:bg-green-500 text-sm">Transaksi Baru</a>
      </div>
    </div>

    <!-- Menu Laporan -->
    @role('admin')
    <div>
      <button @click="toggle('laporan')"
              class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-green-600 transition-all focus:outline-none">
        <span>Laporan</span>
        <svg :class="{'rotate-90': openMenu.laporan}"
             class="w-4 h-4 transform transition-transform duration-300"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" /></svg>
      </button>
      <div x-show="openMenu.laporan"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="opacity-0 scale-95"
           x-transition:enter-end="opacity-100 scale-100"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="opacity-100 scale-100"
           x-transition:leave-end="opacity-0 scale-95"
           x-cloak
           class="ml-4 mt-1 space-y-1">
        <a href="{{ route('reports.index') }}" class="block px-4 py-1 rounded hover:bg-green-500 text-sm">Laporan Penjualan</a>
        <a href="{{ route('reports.products') }}" class="block px-4 py-1 rounded hover:bg-green-500 text-sm">Laporan Stok</a>
      </div>
    </div>
    @endrole

    <!-- Menu Pengguna -->
    @role('admin')
    <div>
      <button @click="toggle('pengguna')"
              class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-green-600 transition-all focus:outline-none">
        <span>Pengguna</span>
        <svg :class="{'rotate-90': openMenu.pengguna}"
             class="w-4 h-4 transform transition-transform duration-300"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" /></svg>
      </button>
      <div x-show="openMenu.pengguna"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="opacity-0 scale-95"
           x-transition:enter-end="opacity-100 scale-100"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="opacity-100 scale-100"
           x-transition:leave-end="opacity-0 scale-95"
           x-cloak
           class="ml-4 mt-1 space-y-1">
        <a href="{{ route('users.index') }}" class="block px-4 py-1 rounded hover:bg-green-500 text-sm">Daftar Pengguna</a>
        <a href="{{ route('users.create') }}" class="block px-4 py-1 rounded hover:bg-green-500 text-sm">Tambah Pengguna</a>
      </div>
    </div>
    @endrole
  </nav>



  <!-- Dropdown User Menu -->
  <div class="relative" x-data="{ open: false }">
 <div class="w-full flex justify-center">
  <button @click="open = !open"
         class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-green-600 transition-all focus:outline-none">
    <span>Setting</span>
    <svg :class="{'rotate-90': open}"
             class="w-4 h-4 transform transition-transform duration-300"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" /></svg>
  </button>
</div>

  <!-- Dropdown muncul ke atas -->
  <div x-show="open" @click.away="open = false" x-transition
       class="absolute right-0 bottom-full mb-2 w-40 bg-white border rounded shadow-lg z-50">
    <a href="{{ route('profile.edit') }}"
       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"
              class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Keluar</button>
    </form>
  </div>
</div>



</aside>
