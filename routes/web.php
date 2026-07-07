<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FrontendCheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FrontendOrderController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'home'])
    ->name('home');

Route::get('/shop', [FrontendController::class, 'shop'])
    ->name('shop');

Route::get('/shop/category/{slug}',
    [FrontendController::class, 'category'])
    ->name('shop.category');

Route::get('/product/{slug}',
    [FrontendController::class, 'product'])
    ->name('product.details');

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::get('/cart',
    [CartController::class, 'index'])
    ->name('cart');

Route::post('/cart/add/{id}',
    [CartController::class, 'add'])
    ->name('cart.add');

Route::post('/cart/update',
    [CartController::class, 'update'])
    ->name('cart.update');

Route::get('/cart/remove/{id}',
    [CartController::class, 'remove'])
    ->name('cart.remove');

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

Route::get('/checkout',
    [CartController::class, 'checkout'])
    ->name('checkout');

Route::post('/checkout/place-order',
    [FrontendCheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get('/order-success/{order}',
    [FrontendCheckoutController::class, 'success'])
    ->name('order.success');

/*
|--------------------------------------------------------------------------
| CUSTOMER ORDER TRACKING
|--------------------------------------------------------------------------
*/Route::middleware('auth:customer')->group(function () {

    Route::get('/my-orders',
        [FrontendOrderController::class, 'index'])
        ->name('my.orders');

    Route::post('/my-orders',
        [FrontendOrderController::class, 'search'])
        ->name('my.orders.search');

    Route::get('/my-orders/{order}',
        [FrontendOrderController::class, 'show'])
        ->name('my.orders.show');

});

/*
|--------------------------------------------------------------------------
| ADMIN ERP ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard',
        [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/stock-report',
        [StockController::class, 'index'])
        ->name('stock.index');

    Route::resource('customers', CustomerController::class);

    Route::resource('expenses', ExpenseController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('orders', OrderController::class);

    Route::resource('purchases', PurchaseController::class);

    /*
    |--------------------------------------------------------------------------
    | Purchase Items
    |--------------------------------------------------------------------------
    */

    Route::post('/purchases/{purchase}/add-item',
        [PurchaseController::class, 'addItem'])
        ->name('purchases.addItem');

    Route::delete('/purchase-items/{item}',
        [PurchaseController::class, 'removeItem'])
        ->name('purchases.removeItem');

    /*
    |--------------------------------------------------------------------------
    | Order Items
    |--------------------------------------------------------------------------
    */

    Route::post('/orders/{order}/add-item',
        [OrderController::class, 'addItem'])
        ->name('orders.addItem');

    Route::delete('/order-items/{item}',
        [OrderController::class, 'removeItem'])
        ->name('orders.removeItem');

    /*
    |--------------------------------------------------------------------------
    | Invoice
    |--------------------------------------------------------------------------
    */

    Route::get('/orders/{order}/invoice',
        [InvoiceController::class, 'show'])
        ->name('orders.invoice');

    Route::get('/orders/{order}/invoice/pdf',
        [InvoiceController::class, 'download'])
        ->name('orders.invoice.pdf');

    /*
    |--------------------------------------------------------------------------
    | Exports
    |--------------------------------------------------------------------------
    */

    Route::get('/products-export',
        [ProductController::class, 'export'])
        ->name('products.export');

    Route::get('/customers-export',
        [CustomerController::class, 'export'])
        ->name('customers.export');

    Route::get('/orders-export',
        [OrderController::class, 'export'])
        ->name('orders.export');

    /*
    |--------------------------------------------------------------------------
    | Product Import
    |--------------------------------------------------------------------------
    */

    Route::post('/products-import',
        [ProductController::class, 'import'])
        ->name('products.import');

    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::get('/reports/sales',
        [ReportController::class, 'sales'])
        ->name('reports.sales');

});
/*
|--------------------------------------------------------------------------
| ADMIN ONLY ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    Route::resource('categories', CategoryController::class);

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    Route::resource('products', ProductController::class);

    /*
    |--------------------------------------------------------------------------
    | Gallary
    |--------------------------------------------------------------------------
    */

    Route::resource('galleries', GalleryController::class);
/*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);

    Route::patch('/users/{user}/status',
        [UserController::class, 'changeStatus'])
        ->name('users.status');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile',
        [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::put('/profile',
        [ProfileController::class, 'update'])
        ->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | Change Password
    |--------------------------------------------------------------------------
    */

    Route::get('/change-password',
        [ProfileController::class, 'password'])
        ->name('password.index');

    Route::put('/change-password',
        [ProfileController::class, 'updatePassword'])
        ->name('password.update');

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    Route::get('/settings',
        [SettingController::class, 'index'])
        ->name('settings.index');

    Route::post('/settings',
        [SettingController::class, 'update'])
        ->name('settings.update');

    /*
    |--------------------------------------------------------------------------
    | Activity Logs
    |--------------------------------------------------------------------------
    */

    Route::get('/activity-logs',
        [ActivityLogController::class, 'index'])
        ->name('activity.logs');

});
/*
|--------------------------------------------------------------------------
| CUSTOMER AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::get('/customer/register',
    [CustomerAuthController::class, 'showRegister'])
    ->name('customer.register');

Route::post('/customer/register',
    [CustomerAuthController::class, 'register'])
    ->name('customer.register.store');

Route::get('/customer/login',
    [CustomerAuthController::class, 'showLogin'])
    ->name('customer.login');

Route::post('/customer/login',
    [CustomerAuthController::class, 'login'])
    ->name('customer.login.store');

Route::middleware('auth:customer')->group(function () {

    Route::get('/customer/dashboard',
        [CustomerAuthController::class, 'dashboard'])
        ->name('customer.dashboard');

    Route::post('/customer/auto-logout', function () {

        Auth::guard('customer')->logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('customer.login');

    })->name('customer.logout');

});

Route::middleware('auth:customer')->group(function () {

    Route::get('/wishlist',
        [WishlistController::class, 'index'])
        ->name('wishlist.index');

    Route::post('/wishlist/add/{id}',
        [WishlistController::class, 'add'])
        ->name('wishlist.add');

    Route::get('/wishlist/remove/{id}',
        [WishlistController::class, 'remove'])
        ->name('wishlist.remove');
    Route::get('/customer/profile',
        [CustomerAuthController::class, 'profile'])
        ->name('customer.profile');

    Route::post('/customer/profile',
        [CustomerAuthController::class, 'updateProfile'])
        ->name('customer.profile.update');
    Route::get('/customer/change-password',
        [CustomerAuthController::class, 'changePassword'])
        ->name('customer.password');

    Route::post('/customer/change-password',
        [CustomerAuthController::class, 'updatePassword'])
        ->name('customer.password.update');
    Route::get('/customer/orders',
        [FrontendOrderController::class, 'index'])
        ->name('customer.orders');

    Route::get('/customer/orders/{order}',
        [FrontendOrderController::class, 'show'])
        ->name('customer.orders.show');
    Route::get('/customer/orders/{order}/invoice',
        [FrontendOrderController::class, 'invoice'])
        ->name('customer.orders.invoice');
    Route::get('/customer/addresses',
        [CustomerAuthController::class, 'addresses'])
        ->name('customer.addresses');

});
Route::get('/shop/category/{slug}',
    [FrontendController::class, 'category'])
    ->name('shop.category');
Route::get('/search', [FrontendController::class, 'search'])
    ->name('search');
Route::get('/offers',
    [FrontendController::class, 'offers'])
    ->name('offers');
Route::get('/gallery', [FrontendController::class, 'gallery'])
    ->name('gallery');

Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactStore'])->name('contact.store');

/*Websiste settings*/

//Route::middleware(['auth'])
//  ->prefix('admin')
// ->name('admin.')
// ->group(function () {

//  Route::resource('sliders', SliderController::class);

// });

Route::get('/about', [FrontendController::class, 'about'])
    ->name('about');

Route::get('/contact', [FrontendController::class, 'contact'])
    ->name('contact');

/*
|--------------------------------------------------------------------------
| LARAVEL AUTH (ADMIN LOGIN)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
