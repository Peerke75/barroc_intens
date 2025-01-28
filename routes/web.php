<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckUserId;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MalfunctionsController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LeaseController;

use App\Models\Malfunction;
use App\Models\Sales;
use App\Models\Event;
use App\Models\Customer;

use Database\Seeders\ProposalsSeeder;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/sales/export', [DashboardController::class, 'export'])
    ->middleware('auth')
    ->name('dashboard.sales.export');

Route::get('/proposals/search', [ProposalController::class, 'search'])->name('proposals.search');
Route::get('/proposals' , [ProposalsSeeder::class, 'index'])->name('proposals.index');
Route::resource('proposals', ProposalController::class)->middleware('auth');

Route::get('/proposals/create', [ProposalController::class, 'create'])->name('proposals.create');
Route::post('/proposals', [ProposalController::class, 'store'])->name('proposals.store');
Route::get('/proposals/{proposal}', [ProposalController::class, 'show'])->name('proposals.show');
Route::delete('proposals/{proposal}', [ProposalController::class, 'destroy'])->name('proposals.destroy');

Route::delete('/proposals/price-lines/{id}', [ProposalController::class, 'destroyPriceLine'])->name('proposals.priceLines.destroy');


Route::post('/proposals/{proposal}/price-line', [ProposalController::class, 'addPriceLine'])
    ->name('proposals.addPriceLine');
Route::delete('/price-line/{priceLine}', [ProposalController::class, 'removePriceLine'])
    ->name('proposals.removePriceLine');


Route::get('/proposals/{proposal}/download-pdf', [ProposalController::class, 'downloadPdf'])
    ->name('proposals.downloadPdf');



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



Route::get('/sales/head-sales', [OrderController::class, 'index'])
    ->middleware('auth', CheckUserId::class . ':5')
    ->name('head-sales.index');

Route::post('/orders/{productId}', [OrderController::class, 'store'])->name('orders.store');
Route::patch('/orders/{order}/approve', [OrderController::class, 'approveOrder'])->name('orders.approve');



Route::get('/customers/downloadPdf/{customer}', [CustomerController::class, 'downloadPdf'])->name('customers.downloadPdf');
Route::get('machines', [MachineController::class, 'index'])->name('machines.index');
Route::get('machines/create', [MachineController::class, 'create'])->name('machines.create');
Route::post('machines', [MachineController::class, 'store'])->name('machines.store');
Route::get('machines/{id}/edit', [MachineController::class, 'edit'])->name('machines.edit');
Route::put('machines/{id}', [MachineController::class, 'update'])->name('machines.update');
Route::get('machines/{id}', [MachineController::class, 'show'])->name('machines.show');
Route::delete('machines/{id}', [MachineController::class, 'destroy'])->name('machines.destroy');


Route::get('/machines', function () {
    return view('machines');
})->name('machines');

Route::middleware(['auth', CheckUserId::class . ':2,6'])->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/customers/{customer}/invoice', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
});



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

route::get('/api/events', function(){
    return Event::all();
});

route::get('/api/customers', function(){
    return Customer::all();
});

Route::resource('sales', SalesController::class)->names([
    'index' => 'sales.index',
    'create' => 'sales.create',
    'store' => 'sales.store',
    'show' => 'sales.show',
    'edit' => 'sales.edit',
    'update' => 'sales.update',
    'destroy' => 'sales.destroy',
]);
Route::get('/agenda', [SalesController::class, 'calendar'])->middleware('auth')->name('agenda');
Route::get('/events', [EventController::class, 'index'])->middleware('auth');
Route::post('/events', [EventController::class, 'store'])->middleware('auth');
Route::put('/events/{id}', [EventController::class, 'update'])->middleware('auth');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');


Route::resource('leasecontracts', LeaseController::class)->names([
    'index' => 'leasecontracts.index',
    'create' => 'leasecontracts.create',
    'store' => 'leasecontracts.store',
    'show' => 'leasecontracts.show',
    'edit' => 'leasecontracts.edit',
    'update' => 'leasecontracts.update',
    'destroy' => 'leasecontracts.destroy',
]);

require __DIR__.'/auth.php';
