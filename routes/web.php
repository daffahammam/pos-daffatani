<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
 use Illuminate\Support\Facades\Response;
use Spatie\SimpleExcel\SimpleExcelWriter;
use App\Models\Sale;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ADMIN ONLY
    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('users', UserController::class);
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/products', [ReportController::class, 'productReport'])->name('reports.products');
        Route::get('/reports/sales-pdf', [ReportController::class, 'SalesPdf'])->name('reports.sales-pdf');
        Route::get('/reports/products-pdf', [ReportController::class, 'ProductSalesPdf'])->name('reports.products-pdf');


    });

    // KASIR & ADMIN
    Route::middleware('role:admin|kasir')->group(function () {
        Route::resource('sales', SaleController::class);
        Route::get('/sales/{id}/pdf', [SaleController::class, 'downloadPdf'])->name('sales.pdf');
        Route::get('/products/{id}/qrcode-pdf', [ProductController::class, 'qrcodePdf'])->name('products.qrcode.pdf');

    });

});


require __DIR__.'/auth.php';
