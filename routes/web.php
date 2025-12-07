<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [StoreController::class, 'home'])->name('home');
Route::prefix('umkm')->group(function () {
    Route::get('/search/q', [StoreController::class, 'search'])->name('stores.search');
    Route::get('/', [StoreController::class, 'index'])->name('stores.index');
    Route::get('/{slug}', [StoreController::class, 'show'])->name('stores.show');
});

Route::post('/chat', [StoreController::class, 'chat'])
    ->middleware('throttle:20,1') 
    ->name('chat');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
       return Inertia::location('/console');
    })->name('dashboard');
});

// Route::middleware(['auth', 'verified'])->get('dashboard', function () {
//     return redirect('/console');
// })->name('dashboard');

require __DIR__ . '/settings.php';
