<html>
    <body>
        @extends('layouts.dashboard')

@section('content')
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <!-- Total Produk -->
    <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-600">
      <h3 class="text-lg font-semibold">Total Produk</h3>
      <p class="text-2xl font-bold mt-2">{{ $totalProduk }}</p>
    </div>

    <!-- Transaksi Hari Ini -->
    <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-600">
      <h3 class="text-lg font-semibold">Transaksi Hari Ini</h3>
      <p class="text-2xl font-bold mt-2">{{ $transaksiHariIni }}</p>
    </div>

    <!-- Pendapatan Bulan Ini -->
    <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-600">
      <h3 class="text-lg font-semibold">Penjualan Bulan Ini</h3>
      <p class="text-2xl font-bold mt-2">
        {{ ($pendapatanBulanIni ?? 0) > 0 ? 'Rp ' . number_format($pendapatanBulanIni, 0, ',', '.') : 'Rp 0' }}
      </p>
    </div>

    <!-- Stok Hampir Habis -->
    <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-600">
      <h3 class="text-lg font-semibold">Stok Hampir Habis</h3>
      <p class="text-2xl font-bold mt-2">{{ $stokHampirHabis }} Produk</p>
    </div>
  </div>

  <!-- Grafik Penjualan Bulanan -->
  <div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-semibold mb-4">📈 Grafik Penjualan Bulanan</h3>
    <div class="relative h-[300px]">
      <canvas id="salesChart"></canvas>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const ctx = document.getElementById('salesChart');
      if (!ctx) return;

      const chartData = {
        labels: {!! json_encode($bulanPenjualan ?? []) !!},
        datasets: [{
          label: 'Total Penjualan',
          data: {!! json_encode($totalPenjualan ?? []) !!},
          backgroundColor: 'rgba(34,197,94,0.7)',
          borderColor: 'rgba(22,163,74,1)',
          borderWidth: 1
        }]
      };

      const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value) {
                return 'Rp ' + value.toLocaleString('id-ID');
              }
            }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      };

      new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: chartOptions
      });
    });
  </script>
@endpush
@stack('scripts')
    </body>
</html>
