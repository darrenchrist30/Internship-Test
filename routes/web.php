<?php

use App\Http\Controllers\PurchasesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('purchases.create'); //langsung ke halaman create
});

//halaman input
Route::get('/purchases/create', [PurchasesController::class, 'create'])->name('purchases.create');
Route::post('/purchases', [PurchasesController::class, 'store'])->name('purchases.store');

//halaman customer
Route::get('/report/customers', [PurchasesController::class, 'showCustomerReportPage'])->name('report.customers.page');

Route::get('/report/customers/data', [PurchasesController::class, 'getCustomerReportData'])->name('report.customers.data.ajax');
