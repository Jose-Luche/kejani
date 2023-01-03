<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\tenant\TenantController;
use App\Http\Controllers\Backend\accounts\ReceiptController;
use App\Http\Controllers\Backend\tenant\TenantProfileController;

//Tenant Routes
Route::get('/index', [TenantController::class, 'index'])->name('charts.view');
Route::get('/view', [TenantController::class, 'viewTen'])->name('tenant.view');
Route::get('/add', [TenantController::class, 'addTen'])->name('tenant.add');

Route::post('/store', [TenantController::class, 'storeTen'])->name('tenant.store');
Route::get('/edit/{id}', [TenantController::class, 'editTen'])->name('tenant.edit');

Route::post('/update/{id}', [TenantController::class, 'updateTen'])->name('tenant.update');

//Tenant Profile Routes
Route::get('/profile/{id}', [TenantProfileController::class, 'viewProf'])->name('tenant.profile');

//Statement
Route::get('/statement/{id}', [ReceiptController::class, 'statements']);

//Excel Export Routes
Route::get('/export-excel', [TenantController::class, 'exportInExcel'])->name('tenant.excel');
