<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\DocumentAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profile'])->name('profile');
Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/dokumentasi', [DocumentController::class, 'index'])->name('dokumentasi.index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() { return view('admin.dashboard'); })->name('dashboard');
    Route::post('articles/upload', [ArticleAdminController::class, 'uploadImage'])->name('articles.upload');
    Route::resource('articles', ArticleAdminController::class);
    Route::resource('gallery', GalleryAdminController::class);
    Route::resource('documents', DocumentAdminController::class);
});
