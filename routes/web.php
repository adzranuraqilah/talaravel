<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstimasiHargaController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\customController;
use App\Http\Controllers\AdminGaleriController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/estimasi-harga', [EstimasiHargaController::class, 'store'])->name('estimasi-harga.store');

Route::get('/estimasi-harga', function () {
    return view('estimasi-form');
});



Route::get('/custom', [customController::class, 'showForm']);
Route::post('/custom', [customController::class, 'submit']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/register', function () {
    return view('register');
});

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->middleware('auth');
Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->middleware('auth');

Route::get('/order-detail', function () {
    return view('order-detail');
});

Route::get('/edit-akun', function () {
    return view('edit-akun');
});

Route::get('/produk-list', [App\Http\Controllers\EstimasiHargaController::class, 'produkList']);
Route::get('/produk-names', [App\Http\Controllers\EstimasiHargaController::class, 'getProdukList']);
Route::get('/jenis-produk', [App\Http\Controllers\EstimasiHargaController::class, 'getProdukList'])->name('jenis-produk.index');
Route::get('/bahan/{jenisProduk}', [App\Http\Controllers\EstimasiHargaController::class, 'getBahanByProduk']);
Route::get('/warna/{jenisProduk}/{jenisBahan}', [App\Http\Controllers\EstimasiHargaController::class, 'getWarnaByBahan']);

// Admin routes with middleware protection
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/admin/produk', [App\Http\Controllers\AdminProdukController::class, 'index']);

    Route::get('/admin/produk-tambah', [App\Http\Controllers\AdminProdukController::class, 'create']);

    Route::get('/admin/pesanan', [App\Http\Controllers\AdminPesananController::class, 'index']);

    Route::get('/admin/pesanan-edit', function () {
        return view('admin.pesanan-edit');
    });

    Route::get('/admin/pelanggan', [App\Http\Controllers\AdminPelangganController::class, 'index']);

    Route::get('/admin/laporan', [App\Http\Controllers\AdminLaporanController::class, 'index']);
    Route::get('/admin/laporan/pdf', [App\Http\Controllers\AdminLaporanController::class, 'exportPdf']);

    Route::get('/admin/produksi', [App\Http\Controllers\ProduksiController::class, 'index']);
    Route::post('/admin/produksi/{id}/update-status', [App\Http\Controllers\ProduksiController::class, 'updateStatus']);

    Route::get('/admin/produksi-tambah', function () {
        return view('admin.produksi-tambah');
    });

    Route::get('/admin/produksi-edit', function () {
        return view('admin.produksi-edit');
    });

    Route::get('/admin/pengaturan', [App\Http\Controllers\AdminPengaturanController::class, 'index']);
    Route::post('/admin/pengaturan', [App\Http\Controllers\AdminPengaturanController::class, 'update']);
    
    Route::get('/admin/pricing-settings', [App\Http\Controllers\AdminPricingController::class, 'index']);
    Route::put('/admin/pricing-settings', [App\Http\Controllers\AdminPricingController::class, 'update']);

    Route::get('/admin/galeri', [App\Http\Controllers\GaleriPratinjauController::class, 'index']);
    Route::post('/admin/galeri-upload', [App\Http\Controllers\GaleriPratinjauController::class, 'upload']);
    Route::get('/admin/preview-history', [App\Http\Controllers\AdminGaleriController::class, 'previewHistory'])->name('admin.preview.history');

    Route::post('/admin/tools/tambah', [ToolController::class, 'store'])->name('admin.tools.store');
    Route::get('/admin/tools/tambah', function () {
        return view('admin.tools-tambah');
    });
    Route::get('/admin/tools/edit/{id}', [ToolController::class, 'edit'])->name('admin.tools.edit');
    Route::put('/admin/tools/update/{id}', [ToolController::class, 'update'])->name('admin.tools.update');
    Route::delete('/admin/tools/delete/{id}', [ToolController::class, 'destroy'])->name('admin.tools.destroy');
    Route::get('/admin/portfolio/tambah', function () {
        return view('admin.portfolio-tambah');
    });
    Route::post('/admin/portfolio/tambah', [App\Http\Controllers\GaleriPratinjauController::class, 'upload']);
    Route::get('/admin/portfolio/edit/{id}', [App\Http\Controllers\GaleriPratinjauController::class, 'edit'])->name('admin.portfolio.edit');
    Route::put('/admin/portfolio/update/{id}', [App\Http\Controllers\GaleriPratinjauController::class, 'update'])->name('admin.portfolio.update');
    Route::delete('/admin/portfolio/delete/{id}', [App\Http\Controllers\GaleriPratinjauController::class, 'destroy'])->name('admin.portfolio.destroy');
    Route::resource('/admin/produk', App\Http\Controllers\AdminProdukController::class)->except(['show']);

    
});

Route::get('/personal', [OrderController::class, 'showPersonalForm']);
Route::post('/personal', [OrderController::class, 'submitPersonal'])->middleware('auth');

Route::get('/tender', [OrderController::class, 'showTenderForm']);
Route::post('/tender', [OrderController::class, 'submitTender'])->middleware('auth');

Route::get('/terima-kasih', function () {
    return view('terima-kasih');
});

Route::get('/order/{id}', [OrderController::class, 'showDetail'])->middleware('auth');

Route::get('/admin/pesanan/{id}', [App\Http\Controllers\AdminPesananController::class, 'show']);
Route::put('/admin/pesanan/{id}', [App\Http\Controllers\AdminPesananController::class, 'update']);

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/logout', function() { return redirect('/login'); });

Route::resource('pratinjau', App\Http\Controllers\GaleriPratinjauController::class);
