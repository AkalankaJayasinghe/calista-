<?php

use Illuminate\Support\Facades\Route;

// --- Controllers Import ---
use App\Http\Controllers\Marketplace\ProductController;
use App\Http\Controllers\Marketplace\CategoryController;
use App\Http\Controllers\Marketplace\ReviewController;
use App\Http\Controllers\Marketplace\CartController as MarketplaceCartController;
use App\Http\Controllers\Marketplace\CheckoutController;
use App\Http\Controllers\Marketplace\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
// Custom Furniture Controllers
use App\Http\Controllers\CustomFurniture\CustomRequestController;
use App\Http\Controllers\CustomFurniture\CustomQuotationController;
use App\Http\Controllers\CustomFurniture\CustomOrderController;
use App\Http\Controllers\CustomFurniture\DesignController;
use App\Http\Controllers\CustomFurniture\WorkshopController;
/*
|--------------------------------------------------------------------------
| Web Routes (Final Clean Version)
|--------------------------------------------------------------------------
*/

// 1. HOME PAGE
Route::get('/', function () {
    return view('home.index');
})->name('home');


// 2. MARKETPLACE ROUTES
Route::prefix('marketplace')->name('marketplace.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
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
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [MarketplaceCartController::class, 'index'])->name('index');
    Route::post('/add/{id}', [MarketplaceCartController::class, 'addToCart'])->name('add');
    Route::put('/update/{itemId}', [MarketplaceCartController::class, 'update'])->name('update');
    Route::delete('/remove/{itemId}', [MarketplaceCartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [MarketplaceCartController::class, 'clear'])->name('clear');
    Route::get('/count', [MarketplaceCartController::class, 'count'])->name('count');
});


// 4. CHECKOUT ROUTES (Protected)
Route::prefix('checkout')->name('checkout.')->middleware('auth')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('process');
    Route::get('/success/{orderId}', [CheckoutController::class, 'success'])->name('success');
});


// 5. WISHLIST ROUTES (Protected)
Route::prefix('wishlist')->name('wishlist.')->middleware('auth')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/toggle', [WishlistController::class, 'toggle'])->name('toggle');
    Route::delete('/{id}', [WishlistController::class, 'remove'])->name('remove');
    Route::get('/check/{productId}', [WishlistController::class, 'check'])->name('check');
});


// 6. CUSTOM FURNITURE ROUTES
// --------------------------------------------------------------------------
Route::prefix('custom-furniture')->name('custom-furniture.')->group(function () {

    // Public Pages
    Route::view('/', 'custom-furniture.index')->name('index');
    Route::view('/gallery', 'custom-furniture.gallery')->name('gallery');

    // Designs (Public + Auth Mixed)
    Route::get('/designs', [DesignController::class, 'index'])->name('designs.index');
    Route::get('/designs/{id}', [DesignController::class, 'show'])->name('designs.show'); // Single design view if needed

    // --- PROTECTED ROUTES (Login Required) ---
    Route::middleware(['auth'])->group(function () {

        // A. Custom Requests
        Route::get('/my-requests', [CustomRequestController::class, 'index'])->name('my-requests');
        Route::get('/request', [CustomRequestController::class, 'create'])->name('request');
        Route::post('/request', [CustomRequestController::class, 'store'])->name('store');
        Route::get('/request/{id}', [CustomRequestController::class, 'show'])->name('show');
        Route::post('/request/{id}/cancel', [CustomRequestController::class, 'cancel'])->name('cancel');

        // B. Quotations (Accept/Reject)
        Route::post('/quotes/{id}/accept', [CustomQuotationController::class, 'accept'])->name('quotations.accept');
        Route::post('/quotes/{id}/reject', [CustomQuotationController::class, 'reject'])->name('quotations.reject');

        // C. Custom Orders
        Route::get('/orders', [CustomOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/create', [CustomOrderController::class, 'create'])->name('orders.create'); // From Quote
        Route::post('/orders', [CustomOrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{id}', [CustomOrderController::class, 'show'])->name('orders.show');

        // D. My Designs
        Route::get('/my-designs', [DesignController::class, 'myDesigns'])->name('designs.my-designs');
        Route::get('/designs/create/new', [DesignController::class, 'create'])->name('designs.create');
        Route::post('/designs', [DesignController::class, 'store'])->name('designs.store');

        // --- WORKSHOPS ROUTES ---
Route::get('/workshops', [WorkshopController::class, 'index'])->name('workshops.index');
Route::get('/workshops/{id}', [WorkshopController::class, 'show'])->name('workshops.show');

    });

});


// 7. INTERIOR DESIGN (Static Views)
Route::prefix('interior-design')->name('interior-design.')->group(function () {
    Route::view('/', 'interior-design.index')->name('index');
    Route::view('/consultation', 'interior-design.consultation-form')->name('consultation');
    Route::view('/portfolio', 'interior-design.portfolio')->name('portfolio');
    Route::view('/projects', 'interior-design.projects')->name('projects');
});


// 8. STATIC PAGES & CONTACT
Route::view('/about', 'pages.about')->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


// 9. AUTH ROUTES
// --------------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    // Login Routes (Changed from 'view' to Controller)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    // Register Routes (මේ ටික එකතු කරන්න)
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    // Password Reset Placeholder Route
Route::get('/forgot-password', function () {
    return "Password Reset Page Coming Soon";
})->name('password.request');
    // Register Routes (ඔයාට පස්සේ Register View එකත් මේ වගේම හදන්න වෙනවා)
    Route::view('/register', 'auth.register')->name('register');
});

// Logout Route (මේක දැනටමත් ඔයාගේ ෆයිල් එකේ ඇති, ඒක තියන්න)
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout')->middleware('auth');

// 10. CUSTOMER DASHBOARD (Protected)
Route::prefix('customer')->name('customer.')->middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'customer.dashboard')->name('dashboard');
    Route::view('/orders', 'customer.orders')->name('orders'); // Main marketplace orders
    Route::view('/profile', 'customer.profile')->name('profile');
});
