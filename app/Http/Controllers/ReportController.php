<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $sales = Sale::with('details')
            ->when($month, fn($query) => $query->whereMonth('created_at', $month))
            ->when($year, fn($query) => $query->whereYear('created_at', $year))
            ->latest()
            ->get();

        return view('reports.index', compact('sales', 'month', 'year'));
    }



public function productReport(Request $request)
{
    $month = $request->get('month', now()->month);
    $year = $request->get('year', now()->year);

    $details = SaleDetail::with('product')
        ->whereHas('sale', function ($query) use ($month, $year) {
            $query->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year);
        })
        ->selectRaw('product_id, SUM(qty) as total_sold')
        ->groupBy('product_id')
        ->get()
        ->sortBy(function ($item) {
            return $item->product->name ?? ''; // fallback jika product null
        });

    return view('reports.product_report', [
        'details' => $details,
        'month' => $month,
        'year' => $year,
    ]);
}

    public function SalesPdf(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $sales = Sale::with('details.product')
            ->when($month, fn($q) => $q->whereMonth('created_at', $month))
            ->when($year, fn($q) => $q->whereYear('created_at', $year))
            ->get();

        $pdf = Pdf::loadView('reports.sales-pdf', compact('sales', 'month', 'year'))
            ->setPaper('A4', 'portrait');

            $bulan = $month ? \Carbon\Carbon::createFromDate(null, (int) $month)->translatedFormat('F') : 'Semua-Bulan';
            $tahun = $year ?? 'Semua-Tahun';

        $filename = 'laporan-penjualan-' . $bulan . '-' . $tahun . '.pdf';

        return $pdf->download($filename);
    }

    public function ProductSalesPdf(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $details = SaleDetail::select('product_id', DB::raw('SUM(qty) as total_sold'))
            ->when($month, fn($q) => $q->whereMonth('created_at', $month))
            ->when($year, fn($q) => $q->whereYear('created_at', $year))
            ->with('product')
            ->groupBy('product_id')
            ->get();

        $pdf = Pdf::loadView('reports.products-pdf', compact('details', 'month', 'year'))
            ->setPaper('A4', 'portrait');

            $bulan = $month ? \Carbon\Carbon::createFromDate(null, (int) $month)->translatedFormat('F') : 'Semua-Bulan';
            $tahun = $year ?? 'Semua-Tahun';

        $filename = 'produk-terjual-' . $bulan . '-' . $tahun . '.pdf';

        return $pdf->download($filename);
    }

}
