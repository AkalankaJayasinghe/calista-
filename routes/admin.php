<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| These routes are for the admin panel and require admin authentication.
| All routes are prefixed with /admin and protected by AdminMiddleware.
|
*/

Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/activities', [\App\Http\Controllers\Admin\DashboardController::class, 'recentActivities'])->name('dashboard.activities');
    Route::get('/dashboard/analytics', [\App\Http\Controllers\Admin\DashboardController::class, 'salesAnalytics'])->name('dashboard.analytics');
    Route::get('/dashboard/user-growth', [\App\Http\Controllers\Admin\DashboardController::class, 'userGrowth'])->name('dashboard.user-growth');
    Route::get('/dashboard/top-products', [\App\Http\Controllers\Admin\DashboardController::class, 'topProducts'])->name('dashboard.top-products');
    Route::get('/dashboard/revenue-by-category', [\App\Http\Controllers\Admin\DashboardController::class, 'revenueByCategory'])->name('dashboard.revenue-category');
    Route::get('/dashboard/system-health', [\App\Http\Controllers\Admin\DashboardController::class, 'systemHealth'])->name('dashboard.system-health');

    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserManagementController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Admin\UserManagementController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\Admin\UserManagementController::class, 'show'])->name('show');
        Route::put('/{id}', [\App\Http\Controllers\Admin\UserManagementController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\UserManagementController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/suspend', [\App\Http\Controllers\Admin\UserManagementController::class, 'suspend'])->name('suspend');
        Route::post('/{id}/reactivate', [\App\Http\Controllers\Admin\UserManagementController::class, 'reactivate'])->name('reactivate');
        Route::get('/{id}/statistics', [\App\Http\Controllers\Admin\UserManagementController::class, 'statistics'])->name('statistics');
        Route::post('/bulk-action', [\App\Http\Controllers\Admin\UserManagementController::class, 'bulkAction'])->name('bulk-action');
    });

    // Order Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\OrderManagementController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\OrderManagementController::class, 'show'])->name('show');
        Route::put('/{id}/status', [\App\Http\Controllers\Admin\OrderManagementController::class, 'updateStatus'])->name('update-status');
        Route::put('/{id}/payment-status', [\App\Http\Controllers\Admin\OrderManagementController::class, 'updatePaymentStatus'])->name('update-payment-status');
        Route::post('/{id}/cancel', [\App\Http\Controllers\Admin\OrderManagementController::class, 'cancel'])->name('cancel');
        Route::get('/statistics/overview', [\App\Http\Controllers\Admin\OrderManagementController::class, 'statistics'])->name('statistics');
        Route::post('/export', [\App\Http\Controllers\Admin\OrderManagementController::class, 'export'])->name('export');
    });

    // Category Management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Marketplace\CategoryController::class, 'all'])->name('index');
        Route::post('/', [\App\Http\Controllers\Marketplace\CategoryController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\Marketplace\CategoryController::class, 'show'])->name('show');
        Route::put('/{id}', [\App\Http\Controllers\Marketplace\CategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Marketplace\CategoryController::class, 'destroy'])->name('destroy');
    });

    // Product Management (Admin CRUD)
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('destroy');
    });

    // Seller Management
    Route::prefix('sellers')->name('sellers.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Seller\ProfileController::class, 'all'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Seller\ProfileController::class, 'show'])->name('show');
        Route::post('/{id}/verify', [\App\Http\Controllers\Seller\ProfileController::class, 'verify'])->name('verify');
        Route::post('/{id}/suspend', [\App\Http\Controllers\Seller\ProfileController::class, 'suspend'])->name('suspend');
        Route::post('/{id}/activate', [\App\Http\Controllers\Seller\ProfileController::class, 'activate'])->name('activate');
        Route::get('/{id}/statistics', [\App\Http\Controllers\Seller\DashboardController::class, 'statistics'])->name('statistics');
    });

    // Workshop Management (Custom Furniture)
    Route::prefix('workshops')->name('workshops.')->group(function () {
        Route::get('/', [\App\Http\Controllers\CustomFurniture\WorkshopController::class, 'all'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\CustomFurniture\WorkshopController::class, 'show'])->name('show');
        Route::post('/{id}/verify', [\App\Http\Controllers\CustomFurniture\WorkshopController::class, 'verify'])->name('verify');
        Route::post('/{id}/activate', [\App\Http\Controllers\CustomFurniture\WorkshopController::class, 'activate'])->name('activate');
        Route::post('/{id}/deactivate', [\App\Http\Controllers\CustomFurniture\WorkshopController::class, 'deactivate'])->name('deactivate');
        Route::get('/{id}/statistics', [\App\Http\Controllers\CustomFurniture\WorkshopController::class, 'statistics'])->name('statistics');
    });

    // Designer Management (Interior Design)
    Route::prefix('designers')->name('designers.')->group(function () {
        Route::get('/', [\App\Http\Controllers\InteriorDesign\DesignerController::class, 'all'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\InteriorDesign\DesignerController::class, 'show'])->name('show');
        Route::post('/{id}/verify', [\App\Http\Controllers\InteriorDesign\DesignerController::class, 'verify'])->name('verify');
        Route::get('/{id}/statistics', [\App\Http\Controllers\InteriorDesign\DesignerController::class, 'statistics'])->name('statistics');
    });

    // Material Management (Custom Furniture)
    Route::prefix('materials')->name('materials.')->group(function () {
        Route::get('/', [\App\Http\Controllers\CustomFurniture\MaterialController::class, 'all'])->name('index');
        Route::post('/', [\App\Http\Controllers\CustomFurniture\MaterialController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\CustomFurniture\MaterialController::class, 'show'])->name('show');
        Route::put('/{id}', [\App\Http\Controllers\CustomFurniture\MaterialController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\CustomFurniture\MaterialController::class, 'destroy'])->name('destroy');
    });

    // Design Categories (Interior Design)
    Route::prefix('design-categories')->name('design-categories.')->group(function () {
        Route::get('/', [\App\Http\Controllers\InteriorDesign\DesignCategoryController::class, 'all'])->name('index');
        Route::post('/', [\App\Http\Controllers\InteriorDesign\DesignCategoryController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\InteriorDesign\DesignCategoryController::class, 'show'])->name('show');
        Route::put('/{id}', [\App\Http\Controllers\InteriorDesign\DesignCategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\InteriorDesign\DesignCategoryController::class, 'destroy'])->name('destroy');
    });

    // Payment Method Management
    Route::prefix('payment-methods')->name('payment-methods.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Payment\PaymentMethodController::class, 'all'])->name('index');
        Route::post('/', [\App\Http\Controllers\Payment\PaymentMethodController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\Payment\PaymentMethodController::class, 'show'])->name('show');
        Route::put('/{id}', [\App\Http\Controllers\Payment\PaymentMethodController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Payment\PaymentMethodController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle', [\App\Http\Controllers\Payment\PaymentMethodController::class, 'toggleActive'])->name('toggle');
    });

    // Payment & Transaction Oversight
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Payment\PaymentController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Payment\PaymentController::class, 'show'])->name('show');
        Route::get('/statistics/overview', [\App\Http\Controllers\Payment\PaymentController::class, 'statistics'])->name('statistics');
    });

    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Payment\TransactionController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Payment\TransactionController::class, 'show'])->name('show');
        Route::put('/{id}/status', [\App\Http\Controllers\Payment\TransactionController::class, 'updateStatus'])->name('update-status');
        Route::get('/statistics/overview', [\App\Http\Controllers\Payment\TransactionController::class, 'statistics'])->name('statistics');
    });

    // Reviews Management
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Marketplace\ReviewController::class, 'all'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Marketplace\ReviewController::class, 'show'])->name('show');
        Route::post('/{id}/approve', [\App\Http\Controllers\Marketplace\ReviewController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [\App\Http\Controllers\Marketplace\ReviewController::class, 'reject'])->name('reject');
        Route::delete('/{id}', [\App\Http\Controllers\Marketplace\ReviewController::class, 'destroy'])->name('destroy');
    });

    // Custom Furniture Requests (Admin oversight)
    Route::prefix('custom-requests')->name('custom-requests.')->group(function () {
        Route::get('/', [\App\Http\Controllers\CustomFurniture\CustomRequestController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\CustomFurniture\CustomRequestController::class, 'show'])->name('show');
    });

    // Custom Orders (Admin oversight)
    Route::prefix('custom-orders')->name('custom-orders.')->group(function () {
        Route::get('/', [\App\Http\Controllers\CustomFurniture\CustomOrderController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\CustomFurniture\CustomOrderController::class, 'show'])->name('show');
    });

    // Interior Design Projects (Admin oversight)
    Route::prefix('design-projects')->name('design-projects.')->group(function () {
        Route::get('/', [\App\Http\Controllers\InteriorDesign\ProjectController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\InteriorDesign\ProjectController::class, 'show'])->name('show');
    });

    // Consultations (Admin oversight)
    Route::prefix('consultations')->name('consultations.')->group(function () {
        Route::get('/', [\App\Http\Controllers\InteriorDesign\ConsultationController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\InteriorDesign\ConsultationController::class, 'show'])->name('show');
    });

    // Contact Messages
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [\App\Http\Controllers\ContactController::class, 'all'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\ContactController::class, 'show'])->name('show');
        Route::put('/{id}/status', [\App\Http\Controllers\ContactController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{id}', [\App\Http\Controllers\ContactController::class, 'destroy'])->name('destroy');
    });
});
