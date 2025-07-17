<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function index(Request $request)
{
    $query = Sale::query()->latest();

    if ($request->filled('start_date')) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $sales = $query->get();

    return view('sales.index', compact('sales'));
}

    public function create()
    {
        $products = Product::all();
        $categories = \App\Models\Category::all();
        return view('sales.create', compact('products', 'categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'cart_data' => 'required|json',
    ]);

    $cartItems = json_decode($request->cart_data, true);
    if (!$cartItems || !is_array($cartItems)) {
        return back()->with('error', 'Data keranjang tidak valid.');
    }

    DB::beginTransaction();
    try {
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $date = now()->format('Ymd');

        // Hitung berapa transaksi yang sudah dibuat hari ini
        $todaySalesCount = Sale::whereDate('created_at', today())->count() + 1;

        // Format invoice: INV-YYYYMMDD-000X
        $invoice = 'INV-' . $date . '-' . str_pad($todaySalesCount, 4, '0', STR_PAD_LEFT);

        $sale = Sale::create([
            'invoice' => $invoice,
            'total'   => $total,
            'user_id' => auth()->id(),
        ]);

        foreach ($cartItems as $item) {
            $product = Product::findOrFail($item['id']);

            if ($product->stock < $item['qty']) {
                DB::rollBack();
                return back()->with('error', 'Stok produk ' . $product->name . ' tidak mencukupi.');
            }

            $product->decrement('stock', $item['qty']);

            SaleDetail::create([
                'sale_id'    => $sale->id,
                'product_id' => $product->id,
                'qty'        => $item['qty'],
                'price'      => $item['price'],
            ]);
        }

        DB::commit();
        return redirect()->route('sales.show', $sale->id)->with('success', 'Transaksi berhasil disimpan.')->with('success', 'Transaksi berhasil disimpan.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    public function show($id)
    {
        $sale = Sale::with('details.product')->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Transaksi berhasil dihapus.');
    }



public function downloadPdf($id)
{
    $sale = Sale::with('details.product', 'user')->findOrFail($id);

    $pdf = Pdf::loadView('sales.receipt-pdf', compact('sale'))
        ->setPaper([0, 0, 226.77, 600], 'portrait'); // ukuran 58mm x ~15cm (custom height)

    return $pdf->download('struk-' . $sale->invoice . '.pdf');
}
}
