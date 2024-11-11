<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Livewire\Storingen;
use App\Models\Malfunction;
use Database\Seeders\MalfunctionsSeeder;

Route::get('/', function () {
    return redirect('/login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware(['auth', 'verified'])->name('dashboard');


route::get('/products', function () {
    return view('products');
})->name('products');

route::get('/machines', function () {
    return view('machines');
})->name('machines');

route::get('/customers', function () {
    return view('customers');
})->name('customers');

route::get('/orders', function () {
    return view('orders');
})->name('orders');


Route::get('/storingen', [MaintenanceController::class, 'index'])->name('storingen');

require __DIR__.'/auth.php';
