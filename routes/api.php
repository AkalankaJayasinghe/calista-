<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public API Routes
Route::prefix('v1')->group(function () {
    // Authentication
    Route::prefix('auth')->group(function () {
        Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
        Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    });

    // Marketplace - Products
    Route::prefix('products')->group(function () {
        Route::get('/', [\App\Http\Controllers\Marketplace\ProductController::class, 'index']);
        Route::get('/search', [\App\Http\Controllers\Marketplace\ProductController::class, 'search']);
        Route::get('/featured', [\App\Http\Controllers\Marketplace\ProductController::class, 'featured']);
        Route::get('/latest', [\App\Http\Controllers\Marketplace\ProductController::class, 'latest']);
        Route::get('/{id}', [\App\Http\Controllers\Marketplace\ProductController::class, 'show']);
        Route::get('/{id}/related', [\App\Http\Controllers\Marketplace\ProductController::class, 'related']);
    });

    // Categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [\App\Http\Controllers\Marketplace\CategoryController::class, 'index']);
        Route::get('/tree', [\App\Http\Controllers\Marketplace\CategoryController::class, 'tree']);
        Route::get('/{id}', [\App\Http\Controllers\Marketplace\CategoryController::class, 'show']);
        Route::get('/{id}/products', [\App\Http\Controllers\Marketplace\CategoryController::class, 'products']);
    });

    // Reviews (public read)
    Route::get('products/{productId}/reviews', [\App\Http\Controllers\Marketplace\ReviewController::class, 'index']);

    // Custom Furniture - Materials (public)
    Route::get('materials', [\App\Http\Controllers\CustomFurniture\MaterialController::class, 'index']);
    Route::get('materials/{id}', [\App\Http\Controllers\CustomFurniture\MaterialController::class, 'show']);

    // Custom Furniture - Designs (public)
    Route::get('designs', [\App\Http\Controllers\CustomFurniture\DesignController::class, 'index']);
    Route::get('designs/search', [\App\Http\Controllers\CustomFurniture\DesignController::class, 'search']);
    Route::get('designs/popular', [\App\Http\Controllers\CustomFurniture\DesignController::class, 'popular']);
    Route::get('designs/{id}', [\App\Http\Controllers\CustomFurniture\DesignController::class, 'show']);

    // Workshops (public)
    Route::get('workshops', [\App\Http\Controllers\CustomFurniture\WorkshopController::class, 'index']);
    Route::get('workshops/{id}', [\App\Http\Controllers\CustomFurniture\WorkshopController::class, 'show']);

    // Interior Design - Designers (public)
    Route::get('designers', [\App\Http\Controllers\InteriorDesign\DesignerController::class, 'index']);
    Route::get('designers/search', [\App\Http\Controllers\InteriorDesign\DesignerController::class, 'search']);
    Route::get('designers/{id}', [\App\Http\Controllers\InteriorDesign\DesignerController::class, 'show']);

    // Interior Design - Portfolios (public)
    Route::get('portfolios', [\App\Http\Controllers\InteriorDesign\PortfolioController::class, 'index']);
    Route::get('portfolios/featured', [\App\Http\Controllers\InteriorDesign\PortfolioController::class, 'featured']);
    Route::get('portfolios/search', [\App\Http\Controllers\InteriorDesign\PortfolioController::class, 'search']);
    Route::get('portfolios/{id}', [\App\Http\Controllers\InteriorDesign\PortfolioController::class, 'show']);

    // Payment Methods (public)
    Route::get('payment-methods', [\App\Http\Controllers\Payment\PaymentMethodController::class, 'index']);
});

// Protected API Routes (Require Authentication)
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {

    // User Info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Authentication - logout
    Route::prefix('auth')->group(function () {
        Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    });

    // Cart Management
    Route::prefix('cart')->group(function () {
        Route::get('/', [\App\Http\Controllers\Marketplace\CartController::class, 'index']);
        Route::post('/add', [\App\Http\Controllers\Marketplace\CartController::class, 'add']);
        Route::put('/update/{itemId}', [\App\Http\Controllers\Marketplace\CartController::class, 'update']);
        Route::delete('/remove/{itemId}', [\App\Http\Controllers\Marketplace\CartController::class, 'remove']);
        Route::delete('/clear', [\App\Http\Controllers\Marketplace\CartController::class, 'clear']);
        Route::post('/sync', [\App\Http\Controllers\Marketplace\CartController::class, 'sync']);
    });

    // Checkout
    Route::prefix('checkout')->group(function () {
        Route::post('/validate', [\App\Http\Controllers\Marketplace\CheckoutController::class, 'validateCart']);
        Route::post('/process', [\App\Http\Controllers\Marketplace\CheckoutController::class, 'process']);
        Route::get('/order/{orderId}', [\App\Http\Controllers\Marketplace\CheckoutController::class, 'getOrder']);
    });

    // Wishlist
    Route::prefix('wishlist')->group(function () {
        Route::get('/', [\App\Http\Controllers\Marketplace\WishlistController::class, 'index']);
        Route::post('/toggle', [\App\Http\Controllers\Marketplace\WishlistController::class, 'toggle']);
        Route::delete('/{id}', [\App\Http\Controllers\Marketplace\WishlistController::class, 'remove']);
        Route::get('/check/{productId}', [\App\Http\Controllers\Marketplace\WishlistController::class, 'check']);
    });

    // Reviews (authenticated actions)
    Route::prefix('reviews')->group(function () {
        Route::post('/', [\App\Http\Controllers\Marketplace\ReviewController::class, 'store']);
        Route::put('/{id}', [\App\Http\Controllers\Marketplace\ReviewController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\Marketplace\ReviewController::class, 'destroy']);
        Route::post('/{id}/helpful', [\App\Http\Controllers\Marketplace\ReviewController::class, 'helpful']);
    });

    // Customer Dashboard
    Route::prefix('customer')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Customer\CustomerDashboardController::class, 'index']);
        Route::get('/orders', [\App\Http\Controllers\Customer\CustomerDashboardController::class, 'orderHistory']);
        Route::get('/orders/recent', [\App\Http\Controllers\Customer\CustomerDashboardController::class, 'recentOrders']);
        Route::get('/wishlist', [\App\Http\Controllers\Customer\CustomerDashboardController::class, 'wishlist']);
        Route::get('/payments', [\App\Http\Controllers\Customer\CustomerDashboardController::class, 'paymentHistory']);
        Route::get('/reviews', [\App\Http\Controllers\Customer\CustomerDashboardController::class, 'myReviews']);
        Route::get('/custom-requests', [\App\Http\Controllers\Customer\CustomerDashboardController::class, 'customRequests']);
        Route::get('/design-projects', [\App\Http\Controllers\Customer\CustomerDashboardController::class, 'designProjects']);
        Route::get('/consultations', [\App\Http\Controllers\Customer\CustomerDashboardController::class, 'consultations']);
        Route::get('/summary', [\App\Http\Controllers\Customer\CustomerDashboardController::class, 'accountSummary']);
    });

    // Customer Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [\App\Http\Controllers\Customer\ProfileController::class, 'show']);
        Route::put('/', [\App\Http\Controllers\Customer\ProfileController::class, 'update']);
        Route::post('/change-password', [\App\Http\Controllers\Customer\ProfileController::class, 'changePassword']);
        Route::put('/email', [\App\Http\Controllers\Customer\ProfileController::class, 'updateEmail']);
        Route::delete('/', [\App\Http\Controllers\Customer\ProfileController::class, 'deleteAccount']);
        Route::get('/completion', [\App\Http\Controllers\Customer\ProfileController::class, 'completionStatus']);
        Route::get('/preferences', [\App\Http\Controllers\Customer\ProfileController::class, 'getPreferences']);
        Route::put('/preferences', [\App\Http\Controllers\Customer\ProfileController::class, 'updatePreferences']);
    });

    // Custom Furniture - Requests
    Route::prefix('custom-furniture/requests')->group(function () {
        Route::get('/', [\App\Http\Controllers\CustomFurniture\CustomRequestController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\CustomFurniture\CustomRequestController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\CustomFurniture\CustomRequestController::class, 'show']);
        Route::put('/{id}', [\App\Http\Controllers\CustomFurniture\CustomRequestController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\CustomFurniture\CustomRequestController::class, 'destroy']);
        Route::post('/{id}/cancel', [\App\Http\Controllers\CustomFurniture\CustomRequestController::class, 'cancel']);
    });

    // Custom Furniture - Quotations
    Route::prefix('custom-furniture/quotations')->group(function () {
        Route::get('/', [\App\Http\Controllers\CustomFurniture\CustomQuotationController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\CustomFurniture\CustomQuotationController::class, 'store']);
        Route::get('/request/{requestId}', [\App\Http\Controllers\CustomFurniture\CustomQuotationController::class, 'getByRequest']);
        Route::get('/{id}', [\App\Http\Controllers\CustomFurniture\CustomQuotationController::class, 'show']);
        Route::put('/{id}', [\App\Http\Controllers\CustomFurniture\CustomQuotationController::class, 'update']);
        Route::post('/{id}/accept', [\App\Http\Controllers\CustomFurniture\CustomQuotationController::class, 'accept']);
        Route::post('/{id}/reject', [\App\Http\Controllers\CustomFurniture\CustomQuotationController::class, 'reject']);
        Route::delete('/{id}', [\App\Http\Controllers\CustomFurniture\CustomQuotationController::class, 'destroy']);
    });

    // Custom Furniture - Orders
    Route::prefix('custom-furniture/orders')->group(function () {
        Route::get('/', [\App\Http\Controllers\CustomFurniture\CustomOrderController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\CustomFurniture\CustomOrderController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\CustomFurniture\CustomOrderController::class, 'show']);
        Route::put('/{id}/status', [\App\Http\Controllers\CustomFurniture\CustomOrderController::class, 'updateStatus']);
        Route::put('/{id}/payment', [\App\Http\Controllers\CustomFurniture\CustomOrderController::class, 'updatePaymentStatus']);
        Route::post('/{id}/cancel', [\App\Http\Controllers\CustomFurniture\CustomOrderController::class, 'cancel']);
        Route::post('/{id}/complete', [\App\Http\Controllers\CustomFurniture\CustomOrderController::class, 'complete']);
    });

    // Custom Furniture - Designs (authenticated)
    Route::prefix('designs')->group(function () {
        Route::get('/my-designs', [\App\Http\Controllers\CustomFurniture\DesignController::class, 'myDesigns']);
        Route::post('/', [\App\Http\Controllers\CustomFurniture\DesignController::class, 'store']);
        Route::put('/{id}', [\App\Http\Controllers\CustomFurniture\DesignController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\CustomFurniture\DesignController::class, 'destroy']);
    });

    // Interior Design - Consultations
    Route::prefix('interior-design/consultations')->group(function () {
        Route::get('/', [\App\Http\Controllers\InteriorDesign\ConsultationController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\InteriorDesign\ConsultationController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\InteriorDesign\ConsultationController::class, 'show']);
        Route::put('/{id}', [\App\Http\Controllers\InteriorDesign\ConsultationController::class, 'update']);
        Route::post('/{id}/confirm', [\App\Http\Controllers\InteriorDesign\ConsultationController::class, 'confirm']);
        Route::post('/{id}/complete', [\App\Http\Controllers\InteriorDesign\ConsultationController::class, 'complete']);
        Route::post('/{id}/cancel', [\App\Http\Controllers\InteriorDesign\ConsultationController::class, 'cancel']);
        Route::post('/{id}/reschedule', [\App\Http\Controllers\InteriorDesign\ConsultationController::class, 'reschedule']);
    });

    // Interior Design - Projects
    Route::prefix('interior-design/projects')->group(function () {
        Route::get('/', [\App\Http\Controllers\InteriorDesign\ProjectController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\InteriorDesign\ProjectController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\InteriorDesign\ProjectController::class, 'show']);
        Route::put('/{id}', [\App\Http\Controllers\InteriorDesign\ProjectController::class, 'update']);
        Route::put('/{id}/status', [\App\Http\Controllers\InteriorDesign\ProjectController::class, 'updateStatus']);
        Route::post('/{id}/milestone', [\App\Http\Controllers\InteriorDesign\ProjectController::class, 'addMilestone']);
        Route::delete('/{id}', [\App\Http\Controllers\InteriorDesign\ProjectController::class, 'destroy']);
        Route::get('/{id}/statistics', [\App\Http\Controllers\InteriorDesign\ProjectController::class, 'statistics']);
    });

    // Interior Design - Portfolios (authenticated)
    Route::prefix('portfolios')->group(function () {
        Route::get('/my-portfolios', [\App\Http\Controllers\InteriorDesign\PortfolioController::class, 'myPortfolios']);
        Route::post('/', [\App\Http\Controllers\InteriorDesign\PortfolioController::class, 'store']);
        Route::put('/{id}', [\App\Http\Controllers\InteriorDesign\PortfolioController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\InteriorDesign\PortfolioController::class, 'destroy']);
        Route::post('/{id}/toggle-publish', [\App\Http\Controllers\InteriorDesign\PortfolioController::class, 'togglePublish']);
    });

    // Payments
    Route::prefix('payments')->group(function () {
        Route::get('/', [\App\Http\Controllers\Payment\PaymentController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Payment\PaymentController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\Payment\PaymentController::class, 'show']);
        Route::post('/{id}/process', [\App\Http\Controllers\Payment\PaymentController::class, 'process']);
        Route::post('/{id}/cancel', [\App\Http\Controllers\Payment\PaymentController::class, 'cancel']);
        Route::post('/{id}/refund', [\App\Http\Controllers\Payment\PaymentController::class, 'refund']);
        Route::get('/order/{orderId}', [\App\Http\Controllers\Payment\PaymentController::class, 'getByOrder']);
        Route::get('/statistics/user', [\App\Http\Controllers\Payment\PaymentController::class, 'statistics']);
    });

    // Installments
    Route::prefix('installments')->group(function () {
        Route::get('/', [\App\Http\Controllers\Payment\InstallmentController::class, 'index']);
        Route::post('/create-plan', [\App\Http\Controllers\Payment\InstallmentController::class, 'createPlan']);
        Route::get('/payment/{paymentId}', [\App\Http\Controllers\Payment\InstallmentController::class, 'getByPayment']);
        Route::get('/{id}', [\App\Http\Controllers\Payment\InstallmentController::class, 'show']);
        Route::post('/{id}/pay', [\App\Http\Controllers\Payment\InstallmentController::class, 'pay']);
        Route::get('/status/overdue', [\App\Http\Controllers\Payment\InstallmentController::class, 'overdue']);
        Route::get('/status/upcoming', [\App\Http\Controllers\Payment\InstallmentController::class, 'upcoming']);
        Route::get('/statistics/user', [\App\Http\Controllers\Payment\InstallmentController::class, 'statistics']);
    });

    // Transactions
    Route::prefix('transactions')->group(function () {
        Route::get('/', [\App\Http\Controllers\Payment\TransactionController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\Payment\TransactionController::class, 'show']);
        Route::get('/payment/{paymentId}', [\App\Http\Controllers\Payment\TransactionController::class, 'getByPayment']);
        Route::get('/search', [\App\Http\Controllers\Payment\TransactionController::class, 'search']);
        Route::get('/statistics/user', [\App\Http\Controllers\Payment\TransactionController::class, 'statistics']);
    });
});
