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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Public Routes
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/shop', [ShopController::class,'index'])->name('shop');
Route::get('/product/{slug}', [ShopController::class,'show'])->name('product.detail');  

// Authenticated (customer)
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index1'])->name('home');

    // Product detail page
    Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

    Route::get('/cart', [CartController::class,'index'])->name('cart');
    Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class,'remove'])->name('cart.remove');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])
    ->name('cart.updateQuantity');

    Route::get('/checkout', [CheckoutController::class,'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class,'placeOrder'])->name('checkout.placeOrder');

    Route::post('/payment/esewa', [PaymentController::class,'esewaPayment'])->name('payment.esewa');
    Route::post('/payment/khalti', [PaymentController::class,'khaltiPayment'])->name('payment.khalti');

    Route::get('/order/confirmation/{id}', [OrderController::class,'confirmation'])->name('order.confirmation');

   Route::get('/shop', [ShopController::class,'index'])->name('shop');

    // Wishlist Routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');

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
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

     // ================= ORDERS =================
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('admin.orders.index');
    Route::get('/orders/view/{id}', [OrderController::class, 'show'])
        ->name('admin.orders.view');
    Route::post('/orders/update-status/{id}', [OrderController::class, 'updateStatus'])
        ->name('admin.orders.updateStatus');


    // ================= USERS =================
    Route::get('/users', [UserController::class, 'index'])
        ->name('admin.users.index');
    Route::get('/users/view/{id}', [UserController::class, 'show'])
        ->name('admin.users.view');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])
        ->name('admin.users.delete');

});

Route::get('/contact_us', [ContactusController::class, 'contact'])
        ->name('contact');

Route::get('/aboutus', [AboutUsController::class, 'aboutus'])
        ->name('aboutus');

require __DIR__ . '/auth.php';
