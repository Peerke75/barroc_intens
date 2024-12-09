<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MachineController;
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
Route::get('/proposals/{id}/edit', [ProposalController::class, 'edit'])->name('proposals.edit');
Route::get('/proposals/{proposal}', [ProposalController::class, 'show'])->name('proposals.show');
Route::delete('proposals/{proposal}', [ProposalController::class, 'destroy'])->name('proposals.destroy');

Route::delete('/proposals/price-lines/{id}', [ProposalController::class, 'destroyPriceLine'])->name('proposals.priceLines.destroy');

Route::post('/proposals/{proposal}/price-line', [ProposalController::class, 'addPriceLine'])
    ->name('proposals.addPriceLine');

Route::delete('/price-line/{priceLine}', [ProposalController::class, 'removePriceLine'])
    ->name('proposals.removePriceLine');


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


Route::get('machines', [MachineController::class, 'index'])->name('machines.index');
Route::get('machines/create', [MachineController::class, 'create'])->name('machines.create');
Route::post('machines', [MachineController::class, 'store'])->name('machines.store');
Route::get('machines/{id}/edit', [MachineController::class, 'edit'])->name('machines.edit');
Route::put('machines/{id}', [MachineController::class, 'update'])->name('machines.update');
Route::get('machines/{id}', [MachineController::class, 'show'])->name('machines.show');
Route::delete('machines/{id}', [MachineController::class, 'destroy'])->name('machines.destroy');


// Andere bestaande routes


Route::get('/customers', [CustomerController::class, 'index'])->name('customers');

Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

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
