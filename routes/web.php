<?php

use App\Http\Controllers\Admin\BahanController;
use App\Http\Controllers\Admin\WarnaBahanController;
use App\Http\Controllers\Admin\SablonController;
use App\Http\Controllers\Admin\JahitanController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\TambahanLainController;
use App\Http\Controllers\Admin\WaktuPengerjaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstimasiHargaController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\customController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminGaleriController;
use App\Models\WarnaBahan;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/estimasi-harga', [EstimasiHargaController::class, 'store'])->name('estimasi-harga.store');

Route::get('/estimasi-harga', function () {
    return view('estimasi-form');
});

Route::post('/midtrans/webhook', [PaymentController::class, 'handleWebhook'])
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

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

// API Routes untuk form estimasi (public)
Route::get('/api/jahitan', [App\Http\Controllers\Admin\JahitanController::class, 'getAll']);
Route::get('/api/sablon', [App\Http\Controllers\Admin\SablonController::class, 'getAll']);
Route::get('/api/tambahan-lain', [App\Http\Controllers\Admin\TambahanLainController::class, 'getAll']);
Route::get('/api/waktu-pengerjaan', [App\Http\Controllers\Admin\WaktuPengerjaanController::class, 'getByProduk']);
Route::get('/api/warna-bahan', [App\Http\Controllers\Admin\WarnaBahanController::class, 'getAll']);

// Admin routes with middleware protection
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

    //Bahan
    Route::get('admin/bahan', [BahanController::class, 'index'])->name('admin.bahan.index');
    Route::get('admin/bahan-tambah', [BahanController::class, 'create'])->name('admin.bahan.create');
    Route::post('admin/bahan', [BahanController::class, 'store'])->name('admin.bahan.store');
    Route::get('admin/bahan-edit/{id}', [BahanController::class, 'edit'])->name('admin.bahan.edit');
    Route::put('admin/bahan/{id}', [BahanController::class, 'update'])->name('admin.bahan.update');
    Route::delete('admin/bahan/{id}', [BahanController::class, 'destroy'])->name('admin.bahan.destroy');

    // Warna Bahan Routes
    Route::get('admin/warna-bahan', [WarnaBahanController::class, 'index'])->name('admin.warna-bahan.index');
    Route::get('admin/warna-bahan-tambah', [WarnaBahanController::class, 'create'])->name('admin.warna-bahan.create');
    Route::post('admin/warna-bahan', [WarnaBahanController::class, 'store'])->name('admin.warna-bahan.store');
    Route::get('admin/warna-bahan-edit/{id}', [WarnaBahanController::class, 'edit'])->name('admin.warna-bahan.edit');
    Route::put('admin/warna-bahan/{id}', [WarnaBahanController::class, 'update'])->name('admin.warna-bahan.update');
    Route::delete('admin/warna-bahan/{id}', [WarnaBahanController::class, 'destroy'])->name('admin.warna-bahan.destroy');

    // Sablon Routes
    Route::get('admin/sablon', [SablonController::class, 'index'])->name('admin.sablon.index');
    Route::get('admin/sablon-tambah', [SablonController::class, 'create'])->name('admin.sablon.create');
    Route::post('admin/sablon', [SablonController::class, 'store'])->name('admin.sablon.store');
    Route::get('admin/sablon-edit/{id}', [SablonController::class, 'edit'])->name('admin.sablon.edit');
    Route::put('admin/sablon/{id}', [SablonController::class, 'update'])->name('admin.sablon.update');
    Route::delete('admin/sablon/{id}', [SablonController::class, 'destroy'])->name('admin.sablon.destroy');

    // Jahitan Routes
    Route::get('admin/jahitan', [JahitanController::class, 'index'])->name('admin.jahitan.index');
    Route::get('admin/jahitan-tambah', [JahitanController::class, 'create'])->name('admin.jahitan.create');
    Route::post('admin/jahitan', [JahitanController::class, 'store'])->name('admin.jahitan.store');
    Route::get('admin/jahitan-edit/{id}', [JahitanController::class, 'edit'])->name('admin.jahitan.edit');
    Route::put('admin/jahitan/{id}', [JahitanController::class, 'update'])->name('admin.jahitan.update');
    Route::delete('admin/jahitan/{id}', [JahitanController::class, 'destroy'])->name('admin.jahitan.destroy');

    // Produk Routes
    Route::get('admin/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('admin/produk-tambah', [ProdukController::class, 'create'])->name('admin.produk.create');
    Route::post('admin/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::get('admin/produk-edit/{id}', [ProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::put('admin/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('admin/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');
    Route::post('admin/produk/get-warna-bahan', [ProdukController::class, 'getWarnaBahanByBahan'])->name('admin.produk.get-warna-bahan');

    // Waktu Pengerjaan Routes
    Route::get('admin/waktu-pengerjaan', [WaktuPengerjaanController::class, 'index'])->name('admin.waktu-pengerjaan.index');
    Route::get('admin/waktu-pengerjaan-tambah', [WaktuPengerjaanController::class, 'create'])->name('admin.waktu-pengerjaan.create');
    Route::post('admin/waktu-pengerjaan', [WaktuPengerjaanController::class, 'store'])->name('admin.waktu-pengerjaan.store');
    Route::get('admin/waktu-pengerjaan-edit/{id}', [WaktuPengerjaanController::class, 'edit'])->name('admin.waktu-pengerjaan.edit');
    Route::put('admin/waktu-pengerjaan/{id}', [WaktuPengerjaanController::class, 'update'])->name('admin.waktu-pengerjaan.update');
    Route::delete('admin/waktu-pengerjaan/{id}', [WaktuPengerjaanController::class, 'destroy'])->name('admin.waktu-pengerjaan.destroy');

    // Tambahan Lain Routes
    Route::get('admin/tambahan-lain', [TambahanLainController::class, 'index'])->name('admin.tambahan-lain.index');
    Route::get('admin/tambahan-lain-tambah', [TambahanLainController::class, 'create'])->name('admin.tambahan-lain.create');
    Route::post('admin/tambahan-lain', [TambahanLainController::class, 'store'])->name('admin.tambahan-lain.store');
    Route::get('admin/tambahan-lain-edit/{id}', [TambahanLainController::class, 'edit'])->name('admin.tambahan-lain.edit');
    Route::put('admin/tambahan-lain/{id}', [TambahanLainController::class, 'update'])->name('admin.tambahan-lain.update');
    Route::delete('admin/tambahan-lain/{id}', [TambahanLainController::class, 'destroy'])->name('admin.tambahan-lain.destroy');




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



});

Route::get('/personal', [OrderController::class, 'showPersonalForm']);
Route::post('/personal', [OrderController::class, 'submitPersonal'])->middleware('auth');

Route::get('/tender', [OrderController::class, 'showTenderForm']);
Route::post('/tender', [OrderController::class, 'submitTender'])->middleware('auth');

Route::get('/terima-kasih', function () {
    return view('terima-kasih');
});

Route::get('/order/{id}', [OrderController::class, 'showDetail'])->middleware('auth');

Route::post('/api/payment/token', [PaymentController::class, 'getSnapToken'])->middleware('auth');

Route::get('/admin/pesanan/{id}', [App\Http\Controllers\AdminPesananController::class, 'show']);
Route::put('/admin/pesanan/{id}', [App\Http\Controllers\AdminPesananController::class, 'update']);

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/logout', function() { return redirect('/login'); });

Route::resource('pratinjau', App\Http\Controllers\GaleriPratinjauController::class);





