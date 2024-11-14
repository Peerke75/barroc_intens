<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MalfunctionsController;
use App\Http\Controllers\ProposalController;
use App\Models\Malfunction;


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('proposals', ProposalController::class)->middleware('auth');
// web.php
Route::get('/proposals/create', [ProposalController::class, 'create'])->name('proposals.create');
Route::post('/proposals', [ProposalController::class, 'store'])->name('proposals.store');
Route::get('/proposals/{proposal}', [ProposalController::class, 'show'])->name('proposals.show');
Route::delete('proposals/{proposal}', [ProposalController::class, 'destroy'])->name('proposals.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');


Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/products/{id}/info', [ProductController::class, 'show'])->name('products.info');


Route::get('/products/{product}/buy', [ProductController::class, 'buy'])->name('products.buy');
Route::post('/products/{product}/buy', [ProductController::class, 'storeOrder'])->name('products.storeOrder');



// Andere bestaande routes
Route::get('/machines', function () {
    return view('machines');
})->name('machines');

route::get('/customers', function () {
    return view('customers.klanten-show');
})->name('customers');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');  // Add this route for customer details

Route::get('/customers/{customer}/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::post('/customers/{customer}/invoice', [InvoiceController::class, 'store'])->name('invoice.store');


Route::get('/orders', function () {
    return view('orders');
})->name('orders');


Route::resource('/storingen', MalfunctionsController::class)->names([
    'index' => 'storingen.index',
    'create' => 'storingen.create',
    'store' => 'storingen.store',
    'show' => 'storingen.show',
    'edit' => 'storingen.edit',
    'update' => 'storingen.update',
    'destroy' => 'storingen.destroy',
]);


require __DIR__.'/auth.php';
