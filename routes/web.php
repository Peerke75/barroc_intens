<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}/info', [ProductController::class, 'show'])->name('products.info');

Route::get('/products/{product}/buy', [ProductController::class, 'buy'])->name('products.buy');
Route::post('/products/{product}/buy', [ProductController::class, 'storeOrder'])->name('products.storeOrder');



// Andere bestaande routes
Route::get('/machines', function () {
    return view('machines');
})->name('machines');

Route::get('/customers', function () {
    return view('customers');
})->name('customers');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');

require __DIR__.'/auth.php';
