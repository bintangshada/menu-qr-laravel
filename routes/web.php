<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\QRController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/dashboard', [MenuController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/upload', [MenuController::class, 'upload'])->name('admin.upload');
    Route::get('/admin/qr/{id}', [QRController::class, 'generate'])->name('admin.qr');
    Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])->name('admin.delete');
    Route::get('/admin/qr/{id}/download', [QRController::class, 'download'])->name('admin.download');
});

Route::get('/menu/{id}', function ($id) {
    $menu = \App\Models\Menu::with('images')->findOrFail($id);
    return view('menu.show', compact('menu'));
})->name('menu.show');


require __DIR__.'/auth.php';
