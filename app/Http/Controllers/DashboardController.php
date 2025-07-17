<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $totalProduk = Product::count();
    $transaksiHariIni = Sale::whereDate('created_at', today())->count();
    $pendapatanBulanIni = Sale::whereMonth('created_at', now()->month)->sum('total');
    $stokHampirHabis = Product::where('stock', '<=', 5)->count();

    // Data grafik: 12 bulan terakhir
    $bulanPenjualan = [];
    $totalPenjualan = [];

    foreach (range(1, 12) as $bulan) {
        $bulanPenjualan[] = Carbon::create()->month($bulan)->translatedFormat('F');
        $totalPenjualan[] = Sale::whereMonth('created_at', $bulan)->sum('total');
    }

    return view('dashboard', compact(
        'totalProduk',
        'transaksiHariIni',
        'pendapatanBulanIni',
        'stokHampirHabis',
        'bulanPenjualan',
        'totalPenjualan'
    ));
}
}
