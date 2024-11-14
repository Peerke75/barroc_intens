<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
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

route::get('/products', function () {
    return view('products');
})->name('products');

route::get('/machines', function () {
    return view('machines');
})->name('machines');

route::get('/customers', function () {
    return view('customers.klanten-show');
})->name('customers');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');  // Add this route for customer details

Route::get('/customers/{customer}/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::post('/customers/{customer}/invoice', [InvoiceController::class, 'store'])->name('invoice.store');


route::get('/orders', function () {
    return view('orders');
})->name('orders');


require __DIR__.'/auth.php';
