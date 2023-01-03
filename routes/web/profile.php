<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserProfileController;

Route::get('/view', [UserProfileController::class, 'ProfileView'])->name('profile.view');
Route::get('/edit', [UserProfileController::class, 'ProfileEdit'])->name('profile.edit');

Route::post('/store', [UserProfileController::class, 'ProfileStore'])->name('profile.store');
//Route::get('/password/view', [UserProfileController::class, 'PasswordView'])->name('password.view');
//Route::post('/password/update', [UserProfileController::class, 'PasswordUpdate'])->name('password.update');
