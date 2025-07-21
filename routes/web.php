<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomendasiController; // Untuk form rekomendasi
use App\Http\Controllers\PageController;      // Untuk dokumentasi API (jika masih digunakan)
use App\Http\Controllers\JobRecommendationController; // Untuk halaman beranda

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk halaman beranda (menampilkan rekomendasi terkini/dummy)
Route::get('/', [JobRecommendationController::class, 'index'])->name('beranda');

// Route untuk menampilkan form rekomendasi jabatan.
// Nama route: rekomendasi.form
Route::get('/rekomendasi', [RekomendasiController::class, 'showForm'])->name('rekomendasi.form');

// Route untuk memproses data form dan memanggil API Node.js.
// Nama route: rekomendasi.proses
Route::post('/proses-rekomendasi', [RekomendasiController::class, 'processRecommendation'])->name('rekomendasi.proses');

// Route untuk halaman Dokumentasi API (Opsional)
Route::get('/dokumentasi-api', [PageController::class, 'apiDocs'])->name('api.docs');