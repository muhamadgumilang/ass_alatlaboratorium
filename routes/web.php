<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('template', function () {
    return view('layouts.dashboard');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



use App\Http\Controllers\KategoriAlatController;
Route::resource('kategori', KategoriAlatController::class);

use App\Http\Controllers\AlatController;
Route::resource('alat', AlatController::class);

use App\Http\Controllers\PeminjamanController;
Route::resource('peminjaman', PeminjamanController::class);
