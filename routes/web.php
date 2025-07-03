<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/estimasi-harga', function () {
    return view('estimasi-form');
});

Route::get('/tender', function () {
    return view('tender-form');
});

Route::get('/custom', function () {
    return view('custom-desain');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/order-detail', function () {
    return view('order-detail');
});

Route::get('/edit-akun', function () {
    return view('edit-akun');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/produk', function () {
    return view('admin.produk');
});

Route::get('/admin/produk-tambah', function () {
    return view('admin.produk-tambah');
});

Route::get('/admin/pesanan', function () {
    return view('admin.pesanan');
});

Route::get('/admin/pesanan-edit', function () {
    return view('admin.pesanan-edit');
});

Route::get('/admin/pelanggan', function () {
    return view('admin.pelanggan');
});

Route::get('/admin/laporan', function () {
    return view('admin.laporan');
});

Route::get('/admin/produksi', function () {
    return view('admin.produksi');
});

Route::get('/admin/produksi-tambah', function () {
    return view('admin.produksi-tambah');
});

Route::get('/admin/produksi-edit', function () {
    return view('admin.produksi-edit');
});

Route::get('/admin/pengaturan', function () {
    return view('admin.pengaturan');
});
