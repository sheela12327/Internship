<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderInfoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('product.detail');

Route::get('/aboutus', [AboutUsController::class, 'aboutus'])->name('aboutus');

Route::get('/contact', [ContactusController::class, 'contact'])->name('contact');
Route::post('/contact/send', [ContactusController::class, 'submitContactForm'])
    ->name('contact.send');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER (CUSTOMER) ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index1'])->name('home');

    // Product
    Route::get('/product/view/{id}', [ProductController::class, 'show'])
        ->name('product.show');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])
        ->name('cart.updateQuantity');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])
        ->name('checkout.placeOrder');

    // Payments
    Route::get('/payment/esewa/success/{order}', [PaymentController::class, 'esewaSuccess'])
        ->name('payment.esewa.success');
    Route::get('/payment/esewa/cancel/{order}', [PaymentController::class, 'esewaCancel'])
        ->name('payment.esewa.cancel');

    Route::get('/payment/khalti/success/{order}', [PaymentController::class, 'khaltiSuccess'])
        ->name('payment.khalti.success');

    // Orders
    Route::get('/order/confirmation/{id}', [OrderController::class, 'confirmation'])
        ->name('order.confirmation');
    Route::get('/orderinfo', [OrderInfoController::class, 'index'])
        ->name('orderinfo');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| ADMIN PANEL ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class)
        ->except(['show']);

    // Products
    Route::resource('products', ProductController::class)
        ->except(['show']);

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.view');
    Route::post('/orders/update-status/{id}', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.view');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->name('users.delete');

    // About Us CMS
    Route::get('/about', [AboutUsController::class, 'list'])->name('about.list');
    Route::get('/about/create', [AboutUsController::class, 'create'])->name('about.create');
    Route::post('/about/store', [AboutUsController::class, 'store'])->name('about.store');
    Route::get('/about/edit/{id}', [AboutUsController::class, 'edit'])->name('about.edit');
    Route::post('/about/update/{id}', [AboutUsController::class, 'update'])->name('about.update');
    Route::delete('/about/{id}', [AboutUsController::class, 'destroy'])->name('about.delete');
});


/*
|--------------------------------------------------------------------------
| TEST / UTILITY ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/gmail-test', function () {
    Mail::raw('Laravel Gmail SMTP test', function ($message) {
        $message->to('sthsarita18@gmail.com')->subject('SMTP TEST');
    });
    return 'Mail sent';
});

require __DIR__ . '/auth.php';
