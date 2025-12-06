<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [StoreController::class, 'home'])->name('home');
Route::get('/umkm', [StoreController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{slug}', [StoreController::class, 'show'])->name('umkm.detail');
Route::post('/chat', [StoreController::class, 'chat'])->name('chat');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
       return Inertia::location('/console');
    })->name('dashboard');
});

// Route::middleware(['auth', 'verified'])->get('dashboard', function () {
//     return redirect('/console');
// })->name('dashboard');

require __DIR__ . '/settings.php';
