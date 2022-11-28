<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataLayananController;
use App\Http\Controllers\Admin\DataPelangganController;
use App\Http\Controllers\Admin\DataPenggunaController;
use App\Http\Controllers\Admin\DataPromoController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {
    Route::permanentRedirect('/', '/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('level:AuthMaster,AuthCRO,AuthSalesManager,AuthSales');
    Route::resource('data-pelanggan', DataPelangganController::class)->middleware('level:AuthMaster,AuthCRO,AuthSalesManager,AuthSales');
    Route::post('data-pelanggan/{id_pelanggan}/approved', [DataPelangganController::class, 'approvalMessage']);
    Route::post('data-pelanggan/{id_pelanggan}/rejected', [DataPelangganController::class, 'rejectedMessage']);
    Route::get('data-pelanggan/{id_pelanggan}/download', [DataPelangganController::class, 'downloadPDFCustomer']);
    Route::resource('data-layanan', DataLayananController::class)->middleware('level:AuthMaster,AuthCRO,AuthSalesManager,AuthSales');
    Route::resource('data-promo', DataPromoController::class)->middleware('level:AuthMaster,AuthCRO,AuthSalesManager,AuthSales');
    Route::resource('data-pengguna', DataPenggunaController::class)->middleware('level:AuthMaster');
    Route::get('profil-saya', [ProfileController::class, 'index']);
    Route::post('profil-saya', [ProfileController::class, 'updateProfile']);
    Route::get('ubah-password', [ProfileController::class, 'indexChangePassword']);
    Route::post('ubah-password', [ProfileController::class, 'updatePassword']);
});

require __DIR__ . '/auth.php';
