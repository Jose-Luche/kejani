<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\setup\UnitController;
use App\Http\Controllers\Backend\setup\BranchController;
use App\Http\Controllers\Backend\CompanyDetailsController;
use App\Http\Controllers\Backend\setup\FeeAmountController;
use App\Http\Controllers\Backend\setup\FeeCategoryController;
use App\Http\Controllers\Backend\setup\UnitCategoryController;

//Company Details
Route::get('/details/view', [CompanyDetailsController::class, 'viewDetails'])->name('details.view');
Route::get('/details/add', [CompanyDetailsController::class, 'addDetails'])->name('details.add');

Route::post('/details/store', [CompanyDetailsController::class, 'storeDetails'])->name('details.store');
Route::get('/details/edit/{id}', [CompanyDetailsController::class, 'editDetails'])->name('details.edit');
Route::post('/details/update/{id}', [CompanyDetailsController::class, 'updateDetails'])->name('details.update');

//Unit Category Routes
Route::get('/unit/cat/view', [UnitCategoryController::class, 'viewCat'])->name('unit.cat.view');
Route::get('/unit/cat/add', [UnitCategoryController::class, 'addCat'])->name('unit.cat.add');

Route::post('/unit/cat/store', [UnitCategoryController::class, 'storeCat'])->name('unit.cat.store');
Route::get('/unit/cat/edit/{id}', [UnitCategoryController::class, 'editCat'])->name('unit.cat.edit');

Route::post('/unit/cat/update/{id}', [UnitCategoryController::class, 'updateCat'])->name('unit.cat.update');
Route::get('/unit/cat/delete/{id}', [UnitCategoryController::class, 'deleteCat'])->name('unit.cat.delete');

//Unit Routes
Route::get('/unit/view', [UnitController::class, 'viewUnit'])->name('unit.view');
Route::get('/unit/add', [UnitController::class, 'addUnit'])->name('unit.add');

Route::post('/unit/store', [UnitController::class, 'storeUnit'])->name('unit.store');
Route::get('/unit/edit/{id}', [UnitController::class, 'editUnit'])->name('unit.edit');

Route::post('/unit/update/{id}', [UnitController::class, 'updateUnit'])->name('unit.update');
Route::get('/unit/delete/{id}', [UnitController::class, 'deleteUnit'])->name('unit.delete');

//Fee Category Routes
Route::get('/fee/cat/view', [FeeCategoryController::class, 'viewFeeCat'])->name('fee.cat.view');
Route::get('/fee/cat/add', [FeeCategoryController::class, 'addFeeCat'])->name('fee.cat.add');

Route::post('/fee/cat/store', [FeeCategoryController::class, 'storeFeeCat'])->name('fee.cat.store');
Route::get('/fee/cat/edit/{id}', [FeeCategoryController::class, 'editFeeCat'])->name('fee.cat.edit');

Route::post('/fee/cat/update/{id}', [FeeCategoryController::class, 'updateFeeCat'])->name('fee.cat.update');
Route::get('/fee/cat/delete/{id}', [FeeCategoryController::class, 'deleteFeeCat'])->name('fee.cat.delete');

//Apartment Routes
Route::get('/branch/view', [BranchController::class, 'viewBranch'])->name('branch.view');
Route::get('/branch/add', [BranchController::class, 'addBranch'])->name('branch.add');

Route::post('/branch/store', [BranchController::class, 'storeBranch'])->name('branch.store');
Route::get('/branch/edit/{id}', [BranchController::class, 'editBranch'])->name('branch.edit');

Route::post('/branch/update/{id}', [BranchController::class, 'updateBranch'])->name('branch.update');
Route::get('/branch/delete/{id}', [BranchController::class, 'deleteBranch'])->name('branch.delete');

//Fee Amount Routes
Route::get('/fee/amount/view', [FeeAmountController::class, 'viewAmount'])->name('fee.amount.view');
Route::get('/fee/amount/add', [FeeAmountController::class, 'addAmount'])->name('fee.amount.add');

Route::post('/fee/amount/store', [FeeAmountController::class, 'storeAmount'])->name('fee.amount.store');
Route::get('/fee/amount/edit/{id}', [FeeAmountController::class, 'editAmount'])->name('fee.amount.edit');

Route::post('/fee/amount/update/{id}', [FeeAmountController::class, 'upAmount'])->name('fee.amount.update');
