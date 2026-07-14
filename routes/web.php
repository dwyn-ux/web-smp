<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\DocumentAdminController;
use App\Http\Controllers\Admin\AlumniAdminController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profile'])->name('profile');
Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/dokumentasi', [DocumentController::class, 'index'])->name('dokumentasi.index');
Route::get('/dokumentasi/{id}', [DocumentController::class, 'show'])->name('dokumentasi.show');
Route::get('/dokumentasi/{id}/stream', [DocumentController::class, 'stream'])->name('dokumentasi.stream');
Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::get('/alumni/pendataan', [AlumniController::class, 'create'])->name('alumni.create');
Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() { return view('admin.dashboard'); })->name('dashboard');
    Route::post('articles/upload', [ArticleAdminController::class, 'uploadImage'])->name('articles.upload');
    Route::post('articles/generate', [ArticleAdminController::class, 'generate'])->name('articles.generate');
    Route::resource('articles', ArticleAdminController::class);
    Route::resource('gallery', GalleryAdminController::class);
    Route::resource('documents', DocumentAdminController::class);
    Route::post('alumni/{alumnus}/approve', [AlumniAdminController::class, 'approve'])->name('alumni.approve');
    Route::post('alumni/{alumnus}/toggle-visibility', [AlumniAdminController::class, 'toggleVisibility'])->name('alumni.toggleVisibility');
    Route::get('alumni/export', [AlumniAdminController::class, 'export'])->name('alumni.export');
    Route::post('alumni/graduation-years', [AlumniAdminController::class, 'storeGraduationYear'])->name('alumni.graduation-years.store');
    Route::delete('alumni/graduation-years/{graduationYear}', [AlumniAdminController::class, 'destroyGraduationYear'])->name('alumni.graduation-years.destroy');
    Route::resource('alumni', AlumniAdminController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});
