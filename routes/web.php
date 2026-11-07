<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes Publik (Tanpa Login)
|--------------------------------------------------------------------------
*/

// Halaman Depan Publik Portal Berita
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Detail Berita
Route::get('/berita/{slug}', [HomeController::class, 'show'])->name('posts.show');

// Layanan Pengaduan & Pengajuan Masyarakat (Publik - Tanpa Akun)
Route::get('/pengaduan', [ComplaintController::class, 'create'])->name('complaints.create');
Route::post('/pengaduan', [ComplaintController::class, 'store'])->name('complaints.store');
Route::get('/pengaduan/sukses', [ComplaintController::class, 'success'])->name('complaints.success');
Route::get('/pengaduan/lacak', [ComplaintController::class, 'track'])->name('complaints.track');

/*
|--------------------------------------------------------------------------
| Web Routes Terproteksi (Login Member & Admin)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [PostController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Profil Pengguna Bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Berita / Artikel (create, store, edit, update, destroy)
    Route::resource('posts', PostController::class)->except(['index', 'show']);

    // Moderasi Berita oleh Admin
    Route::get('/admin/posts/pending', [PostController::class, 'pendingPosts'])->name('admin.posts.pending');
    Route::get('/admin/posts/{post}/review', [PostController::class, 'review'])->name('admin.posts.review');
    Route::patch('/admin/posts/{id}/status', [PostController::class, 'updateStatus'])->name('admin.posts.updateStatus');

    // Manajemen Pengaduan Masyarakat oleh Admin
    Route::get('/admin/pengaduan', [ComplaintController::class, 'adminIndex'])->name('admin.complaints.index');
    Route::get('/admin/pengaduan/{complaint}', [ComplaintController::class, 'adminShow'])->name('admin.complaints.show');
    Route::patch('/admin/pengaduan/{complaint}/status', [ComplaintController::class, 'adminUpdateStatus'])->name('admin.complaints.updateStatus');
    Route::delete('/admin/pengaduan/{complaint}', [ComplaintController::class, 'adminDestroy'])->name('admin.complaints.destroy');
});

require __DIR__ . '/auth.php';
