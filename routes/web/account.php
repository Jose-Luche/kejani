<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\accounts\LedgerController;
use App\Http\Controllers\Backend\accounts\ReceiptController;
use App\Http\Controllers\Backend\projections\RentController;
use App\Http\Controllers\Backend\projections\TenantFeeController;

//Tenant Fee Routes
Route::get('tenant/fee/view', [TenantFeeController::class, 'viewTenFee'])->name('tenant.fee.view');
Route::get('tenant/fee/add', [TenantFeeController::class, 'addTenFee'])->name('tenant.fee.add');

Route::post('tenant/fee/store', [TenantFeeController::class, 'storeTenFee'])->name('tenant.fee.store');
Route::get('tenant/gettenant', [TenantFeeController::class, 'getTenFee'])->name('tenant.gettenant');

//Rent Routes
Route::get('/rent/view', [RentController::class, 'viewRent'])->name('rent.view');
Route::get('/rent/add', [RentController::class, 'addRent'])->name('rent.add');

Route::post('/rent/store', [RentController::class, 'storeRent'])->name('rent.store');
Route::get('/getrent', [RentController::class, 'getRent'])->name('get.rent');

//Ledger Routes
Route::get('/ledger/view', [LedgerController::class, 'viewLedger'])->name('ledger.view');
Route::get('/ledger/add', [LedgerController::class, 'addLedger'])->name('ledger.add');

Route::post('/ledger/store', [LedgerController::class, 'storeLedger'])->name('ledger.store');

//Receipt Routes
Route::get('/receipt/view', [ReceiptController::class, 'viewReceipt'])->name('receipt.view');
Route::get('/receipt/add', [ReceiptController::class, 'addReceipt'])->name('receipt.add');

Route::get('/make_payment/{id}', [ReceiptController::class, 'billShow'])->name('make.payment');
Route::post('/make_payment/store/{id}', [ReceiptController::class, 'storePayment'])->name('make.payment.store');

//Tenant Receipts
Route::get('/receipt/{id}', [ReceiptController::class, 'ReceiptDts'])->name('tenant.receipt');

//Tenant Invoices
Route::get('/invoice/{id}', [ReceiptController::class, 'invoiceDts'])->name('invoice.view');

//Receipts PDF
Route::get('/rec/pdf/{id}', [ReceiptController::class, 'receipt_pdf']);

//Invoice PDF
Route::get('/inv/pdf/{id}', [ReceiptController::class, 'invoice_pdf']);
