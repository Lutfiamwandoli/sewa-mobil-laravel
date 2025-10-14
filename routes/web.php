<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\Admin\MobillController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Manager\DashboardManagerController;
use App\Http\Controllers\Manager\ProfilManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\RiwayatController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
// Dashboard
Route::get('/', [DashboardUserController::class, 'index'])->name('user.dashboard');
Route::get('/search', [DashboardUserController::class, 'search'])->name('user.search');

// Mobil (User)
Route::prefix('mobil')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('mobil.index');
    Route::get('/{id_mobil}', [CarController::class, 'show'])->name('mobil.show');
});

// Mobil Search (with Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search');
});

// Checkout
Route::get('/checkout/{mobil}/{paket}', [CheckoutController::class, 'index'])->name('checkout.index');
Route::prefix('user/checkout')->group(function () {
Route::post('/store', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/invoice/{id}', [CheckoutController::class, 'invoice'])->name('checkout.invoice');

    Route::get('/payment/{id}', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::get('/invoice/{id}', [CheckoutController::class, 'invoice'])->name('checkout.invoice');
});
Route::post('/payment/{pemesanan}', [CheckoutController::class, 'uploadPayment'])->name('checkout.upload');
Route::get('/checkout/show/{id}', [CheckoutController::class, 'show'])->name('checkout.show');

// Static Pages
Route::prefix('panduan')->group(function () {
    Route::get('/lepas-kunci', fn() => view('user.panduan.lepas_kunci'))->name('panduan.lepas_kunci');
    Route::get('/driver', fn() => view('user.panduan.driver'))->name('panduan.driver');
});
Route::get('/about', fn() => view('user.about'))->name('about');
Route::get('/cara-sewa', fn() => view('user.cara_sewa'))->name('cara.sewa');
Route::get('/contact', fn() => view('user.contact'))->name('contact');

// Profile & Riwayat (User - Auth Required)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/{id_user}', [RiwayatController::class, 'show'])->name('riwayat.show');

    Route::get('/user/password', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::post('/user/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// Review
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
});

// Data Master
Route::prefix('admin')->group(function () {
    Route::resource('datauser', DataUserController::class);
    Route::delete('/admin/datauser/{id_user}', [DataUserController::class, 'destroy'])->name('datauser.destroy');
    Route::resource('mobill', MobillController::class);
    Route::resource('paket', PaketController::class);
});

// Pemesanan & Pembayaran
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/{id}', [PemesananController::class, 'show'])->name('pemesanan.show');
    Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');

    Route::resource('review', \App\Http\Controllers\Admin\ReviewController::class);
    Route::resource('pembayaran', PembayaranController::class);

    // Profile
    Route::get('/profile', [ProfilController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfilController::class, 'update'])->name('profile.update');

    // Laporan
    Route::get('/laporan/pemesanan', [App\Http\Controllers\Admin\LaporanController::class, 'pemesanan'])->name('laporan.pemesanan');
    Route::get('/laporan/pemesanan/{id}', [App\Http\Controllers\Admin\LaporanController::class, 'pemesananDetail'])->name('laporan.pemesanan.detail');
    Route::get('/laporan/pemesanan/cetak/{id}', [App\Http\Controllers\Admin\LaporanController::class, 'pemesananCetak'])->name('laporan.pemesanan.cetak');

    Route::get('/laporan/pembayaran', [App\Http\Controllers\Admin\LaporanController::class, 'pembayaran'])->name('laporan.pembayaran');
    Route::get('/laporan/pembayaran/{id}', [App\Http\Controllers\Admin\LaporanController::class, 'pembayaranDetail'])->name('laporan.pembayaran.detail');
    Route::get('/laporan/pembayaran/cetak/{id}', [App\Http\Controllers\Admin\LaporanController::class, 'pembayaranCetak'])->name('laporan.pembayaran.cetak');
});

/*
|--------------------------------------------------------------------------
| Manager Routes
|--------------------------------------------------------------------------
*/
Route::prefix('manager')->name('manager.')->middleware(['auth', 'role:Manajer'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardManagerController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfilManagerController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfilManagerController::class, 'update'])->name('profile.update');

    // Laporan Pemesanan
    Route::get('/laporan/pemesanan', [App\Http\Controllers\Manager\LaporanManagerController::class, 'pemesanan'])->name('laporan.pemesanan');
    Route::get('/laporan/pemesanan/{id}', [App\Http\Controllers\Manager\LaporanManagerController::class, 'pemesananDetail'])->name('laporan.pemesanan.detail');
    Route::get('/laporan/pemesanan/cetak/{id}', [App\Http\Controllers\Manager\LaporanManagerController::class, 'pemesananCetak'])->name('laporan.pemesanan.cetak');

    // Laporan Pembayaran
    Route::get('/laporan/pembayaran', [App\Http\Controllers\Manager\LaporanManagerController::class, 'pembayaran'])->name('laporan.pembayaran');
    Route::get('/laporan/pembayaran/{id}', [App\Http\Controllers\Manager\LaporanManagerController::class, 'pembayaranDetail'])->name('laporan.pembayaran.detail');
    Route::get('/laporan/pembayaran/cetak/{id}', [App\Http\Controllers\Manager\LaporanManagerController::class, 'pembayaranCetak'])->name('laporan.pembayaran.cetak');
});
