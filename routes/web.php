<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderInfoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopNewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/search', [ProductController::class, 'search'])->name('search.products');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('product.detail');
Route::get('/category/{slug}', [ProductController::class, 'categoryProducts'])
    ->name('category.products');

Route::get('/aboutus', [AboutUsController::class, 'aboutus'])->name('aboutus');

Route::get('/contact', [ContactusController::class, 'contact'])->name('contact');
Route::post('/contact/send', [ContactusController::class, 'submitContactForm'])
    ->name('contact.send');

// Route::get('/orderinfo', [OrderInfoController::class, 'index'])->name('orderinfo');
Route::get('/shopnow', [ShopNewController::class, 'index'])->name('shopnow');


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

    // Checkout page
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    // Place order (form submission)
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

    // Order confirmation page
    Route::get('/order/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

    //Customer order page
    Route::get('/my-orders', [CustomerOrderController::class, 'index'])
        ->name('customer.orders');

    Route::get('/my-orders/{id}', [CustomerOrderController::class, 'show'])
        ->name('customer.orders.show');

    Route::get('/my-orders/{id}/invoice', [CustomerOrderController::class, 'invoice'])
        ->name('customer.orders.invoice');

    // Payment callbacks
    Route::get('/payment/success', [CheckoutController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [CheckoutController::class, 'paymentCancel'])->name('payment.cancel');

    // eSewa payment
    Route::get('/payment/esewa/success/{order}', [PaymentController::class, 'esewaSuccess'])
        ->name('payment.esewa.success');
    Route::get('/payment/esewa/cancel/{order}', [PaymentController::class, 'esewaCancel'])
        ->name('payment.esewa.cancel');

    //Khalti payment    
    Route::post('/payment/khalti', [PaymentController::class, 'initiateKhalti'])
        ->name('khalti.payment');
    Route::get('/payment/khalti/success/{order}', [PaymentController::class, 'khaltiSuccess'])
        ->name('payment.khalti.success');

    // Orders
    Route::get('/order/confirmation/{id}', [OrderController::class, 'confirmation'])
        ->name('order.confirmation');
    // Route::get('/orderinfo', [OrderInfoController::class, 'index'])
    //     ->name('orderinfo');

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

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');

    // Products
    Route::get('/product', [ProductController::class, 'index'])->name('admin.products.index');
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

// });

// Route::get('/contact_us', [ContactusController::class, 'contact'])
//         ->name('contact');

// use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactusController::class, 'contact'])->name('contact');
Route::post('/contact/send', [ContactusController::class, 'submitContactForm'])->name('contact.send');

        



        // use App\Http\Controllers\AboutController;

// FRONTEND
// Route::get('/about', [AboutController::class, 'index'])->name('about');

// ADMIN CRUD


// use App\Http\Controllers\AboutUsController;
// 
// Route::middleware(['auth','admin'])
// Route::middleware(['auth', 'admin'])

Route::middleware(['auth','admin'])
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


 Route::get('/orderinfo', [OrderInfoController::class, 'index'])->name('orderinfo');



 Route::get('/shopnow', [ShopNewController::class, 'index'])->name('shopnow');





require __DIR__ . '/auth.php';
