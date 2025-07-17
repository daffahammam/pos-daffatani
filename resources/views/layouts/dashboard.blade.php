<!-- resources/views/layouts/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $title ?? 'Dashboard' }}</title>
  <link rel="icon" type="image/png" href="{{ asset('images/daffatani.png') }}">

  @vite('resources/css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-green-50 text-green-900">
  <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Topbar -->
      <x-topbar />

      <!-- Content -->
      <div class="p-4 md:p-6 lg:p-8">

          @yield('content')
      </div>
    </div>
  </div>
</body>
</html>
