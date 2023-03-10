<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

Route::prefix('users')->middleware('auth')->name('')->group(base_path('routes/web/user.php'));
Route::prefix('profile')->middleware('auth')->name('')->group(base_path('routes/web/profile.php'));
Route::prefix('setup')->middleware('auth')->name('')->group(base_path('routes/web/setup.php'));
Route::prefix('tenant')->middleware('auth')->name('')->group(base_path('routes/web/tenant.php'));
Route::prefix('accounts')->middleware('auth')->name('')->group(base_path('routes/web/account.php'));
