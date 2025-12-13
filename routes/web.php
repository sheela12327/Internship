<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Public Routes
Route::get('/', [IndexController::class, 'index'])->name('index');


// Authenticated (customer)
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index1'])->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Panel
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('admin.products.delete');

});

require __DIR__ . '/auth.php';
