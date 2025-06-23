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