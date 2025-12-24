<?php

use Illuminate\Support\Facades\Route;
// Controllers Import කිරීම (Namespaces හරියට බලන්න)
use App\Http\Controllers\Marketplace\ProductController;
use App\Http\Controllers\Marketplace\CategoryController;
use App\Http\Controllers\Marketplace\ReviewController;
use App\Http\Controllers\Marketplace\CartController as MarketplaceCartController;
use App\Http\Controllers\Marketplace\CheckoutController;
use App\Http\Controllers\Marketplace\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Marketplace\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes (Final Version with Controllers)
|--------------------------------------------------------------------------
*/

// 1. HOME PAGE
// --------------------------------------------------------------------------
Route::get('/', function () {
    return view('home.index'); // home folder එක ඇතුලේ තියෙන index ෆයිල් එක
})->name('home');


// 2. MARKETPLACE ROUTES
// --------------------------------------------------------------------------
Route::prefix('marketplace')->name('marketplace.')->group(function () {

    // Main Product Listing (Handles category filtering too)
    Route::get('/', [ProductController::class, 'index'])->name('index');

    // Specific Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/quick-view/{id}', [ProductController::class, 'quickView'])->name('product.quick-view');
    Route::get('/search', [ProductController::class, 'search'])->name('search');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

    // Reviews
    Route::get('/products/{productId}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{id}/helpful', [ReviewController::class, 'helpful'])->name('reviews.helpful');
});


// 3. CART ROUTES
// --------------------------------------------------------------------------
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [MarketplaceCartController::class, 'index'])->name('index');
    Route::post('/add/{id}', [MarketplaceCartController::class, 'addToCart'])->name('add');
    Route::put('/update/{itemId}', [MarketplaceCartController::class, 'update'])->name('update');
    Route::delete('/remove/{itemId}', [MarketplaceCartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [MarketplaceCartController::class, 'clear'])->name('clear');
    Route::get('/count', [MarketplaceCartController::class, 'count'])->name('count');
});


// 4. CHECKOUT ROUTES (Protected by 'auth' middleware)
// --------------------------------------------------------------------------
Route::prefix('checkout')->name('checkout.')->middleware('auth')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('process');
    Route::get('/success/{orderId}', [CheckoutController::class, 'success'])->name('success');
});


// 5. WISHLIST ROUTES (Protected by 'auth' middleware)
// --------------------------------------------------------------------------
Route::prefix('wishlist')->name('wishlist.')->middleware('auth')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/toggle', [WishlistController::class, 'toggle'])->name('toggle');
    Route::delete('/{id}', [WishlistController::class, 'remove'])->name('remove');
    Route::get('/check/{productId}', [WishlistController::class, 'check'])->name('check');
});


// 6. CUSTOM FURNITURE (Static Views)
// --------------------------------------------------------------------------
Route::prefix('custom-furniture')->name('custom-furniture.')->group(function () {
    Route::view('/', 'custom-furniture.index')->name('index');
    Route::view('/gallery', 'custom-furniture.gallery')->name('gallery');
    Route::view('/request', 'custom-furniture.request-form')->name('request');

    // Protected User Requests
    Route::middleware('auth')->get('/my-requests', function () {
        return view('custom-furniture.my-requests');
    })->name('my-requests');
});


// 7. INTERIOR DESIGN (Static Views)
// --------------------------------------------------------------------------
Route::prefix('interior-design')->name('interior-design.')->group(function () {
    Route::view('/', 'interior-design.index')->name('index');
    Route::view('/consultation', 'interior-design.consultation-form')->name('consultation');
    Route::view('/portfolio', 'interior-design.portfolio')->name('portfolio');
    Route::view('/projects', 'interior-design.projects')->name('projects');
});


// 8. STATIC PAGES & CONTACT
// --------------------------------------------------------------------------
Route::view('/about', 'pages.about')->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


// 9. AUTH ROUTES
// --------------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
    Route::view('/seller/register', 'auth.seller-register')->name('seller.register');
});

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout')->middleware('auth');


// 10. CUSTOMER DASHBOARD (Protected)
// --------------------------------------------------------------------------
Route::prefix('customer')->name('customer.')->middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'customer.dashboard')->name('dashboard');
    Route::view('/orders', 'customer.orders')->name('orders');
    Route::view('/profile', 'customer.profile')->name('profile');
});
