<?php

use App\Http\Controllers\PurchasesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Arahkan ke halaman input transaksi sebagai default
    return redirect()->route('purchases.create');
});

// Rute untuk halaman input transaksi
Route::get('/purchases/create', [PurchasesController::class, 'create'])->name('purchases.create');
Route::post('/purchases', [PurchasesController::class, 'store'])->name('purchases.store');

// Rute untuk MENAMPILKAN HALAMAN report customer
// Ini akan memanggil method showCustomerReportPage() di PurchasesController
Route::get('/report/customers', [PurchasesController::class, 'showCustomerReportPage'])->name('report.customers.page');

// Rute untuk AJAX DataTables (MENGAMBIL DATA untuk report customer)
// Ini akan dipanggil oleh JavaScript DataTables untuk mendapatkan data JSON
// dan akan memanggil method getCustomerReportData() di PurchasesController
Route::get('/report/customers/data', [PurchasesController::class, 'getCustomerReportData'])->name('report.customers.data.ajax');
