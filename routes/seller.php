<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Seller Routes
|--------------------------------------------------------------------------
|
| These routes are for the seller dashboard and require seller authentication.
| All routes are prefixed with /seller and protected by SellerMiddleware.
|
*/

Route::middleware(['auth:sanctum', 'seller'])->prefix('seller')->name('seller.')->group(function () {
    
    // Seller Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Seller\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/statistics', [\App\Http\Controllers\Seller\DashboardController::class, 'statistics'])->name('dashboard.statistics');
    Route::get('/dashboard/recent-orders', [\App\Http\Controllers\Seller\DashboardController::class, 'recentOrders'])->name('dashboard.recent-orders');
    Route::get('/dashboard/sales-chart', [\App\Http\Controllers\Seller\DashboardController::class, 'salesChart'])->name('dashboard.sales-chart');
    Route::get('/dashboard/top-products', [\App\Http\Controllers\Seller\DashboardController::class, 'topSellingProducts'])->name('dashboard.top-products');
    Route::get('/dashboard/notifications', [\App\Http\Controllers\Seller\DashboardController::class, 'notifications'])->name('dashboard.notifications');

    // Seller Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Seller\ProfileController::class, 'show'])->name('show');
        Route::put('/', [\App\Http\Controllers\Seller\ProfileController::class, 'update'])->name('update');
        Route::post('/verification', [\App\Http\Controllers\Seller\ProfileController::class, 'requestVerification'])->name('verification');
        Route::get('/completion', [\App\Http\Controllers\Seller\ProfileController::class, 'completionStatus'])->name('completion');
    });

    // Product Management
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Seller\ProductManagementController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Seller\ProductManagementController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\Seller\ProductManagementController::class, 'show'])->name('show');
        Route::put('/{id}', [\App\Http\Controllers\Seller\ProductManagementController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Seller\ProductManagementController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/duplicate', [\App\Http\Controllers\Seller\ProductManagementController::class, 'duplicate'])->name('duplicate');
        Route::put('/{id}/status', [\App\Http\Controllers\Seller\ProductManagementController::class, 'updateStatus'])->name('update-status');
        Route::get('/{id}/analytics', [\App\Http\Controllers\Seller\ProductManagementController::class, 'analytics'])->name('analytics');
        
        // Product Variants
        Route::post('/{productId}/variants', [\App\Http\Controllers\Seller\ProductManagementController::class, 'addVariant'])->name('add-variant');
        Route::put('/variants/{variantId}', [\App\Http\Controllers\Seller\ProductManagementController::class, 'updateVariant'])->name('update-variant');
        Route::delete('/variants/{variantId}', [\App\Http\Controllers\Seller\ProductManagementController::class, 'deleteVariant'])->name('delete-variant');
        
        // Product Images
        Route::post('/{productId}/images', [\App\Http\Controllers\Seller\ProductManagementController::class, 'addImage'])->name('add-image');
        Route::delete('/images/{imageId}', [\App\Http\Controllers\Seller\ProductManagementController::class, 'deleteImage'])->name('delete-image');
        Route::put('/images/{imageId}/set-primary', [\App\Http\Controllers\Seller\ProductManagementController::class, 'setPrimaryImage'])->name('set-primary-image');
    });

    // Inventory Management
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Seller\ProductManagementController::class, 'inventory'])->name('index');
        Route::put('/{id}', [\App\Http\Controllers\Seller\ProductManagementController::class, 'updateInventory'])->name('update');
        Route::get('/low-stock', [\App\Http\Controllers\Seller\ProductManagementController::class, 'lowStock'])->name('low-stock');
        Route::post('/bulk-update', [\App\Http\Controllers\Seller\ProductManagementController::class, 'bulkUpdateInventory'])->name('bulk-update');
    });

    // Order Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Seller\OrderManagementController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Seller\OrderManagementController::class, 'show'])->name('show');
        Route::put('/{id}/status', [\App\Http\Controllers\Seller\OrderManagementController::class, 'updateStatus'])->name('update-status');
        Route::post('/{id}/ship', [\App\Http\Controllers\Seller\OrderManagementController::class, 'markAsShipped'])->name('ship');
        Route::post('/{id}/cancel', [\App\Http\Controllers\Seller\OrderManagementController::class, 'cancel'])->name('cancel');
        Route::get('/{id}/items', [\App\Http\Controllers\Seller\OrderManagementController::class, 'getOrderItems'])->name('items');
        Route::get('/statistics/overview', [\App\Http\Controllers\Seller\OrderManagementController::class, 'statistics'])->name('statistics');
        Route::post('/export', [\App\Http\Controllers\Seller\OrderManagementController::class, 'export'])->name('export');
    });

    // Sales Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/sales', [\App\Http\Controllers\Seller\DashboardController::class, 'salesReport'])->name('sales');
        Route::get('/products', [\App\Http\Controllers\Seller\DashboardController::class, 'productReport'])->name('products');
        Route::get('/revenue', [\App\Http\Controllers\Seller\DashboardController::class, 'revenueReport'])->name('revenue');
    });

    // Reviews (Seller view)
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Marketplace\ReviewController::class, 'sellerReviews'])->name('index');
        Route::get('/product/{productId}', [\App\Http\Controllers\Marketplace\ReviewController::class, 'productReviews'])->name('product');
        Route::post('/{id}/respond', [\App\Http\Controllers\Marketplace\ReviewController::class, 'respond'])->name('respond');
    });

    // Seller Documents
    Route::prefix('documents')->name('documents.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Seller\ProfileController::class, 'documents'])->name('index');
        Route::post('/', [\App\Http\Controllers\Seller\ProfileController::class, 'uploadDocument'])->name('upload');
        Route::delete('/{id}', [\App\Http\Controllers\Seller\ProfileController::class, 'deleteDocument'])->name('delete');
    });
});
