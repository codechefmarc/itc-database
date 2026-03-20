<?php

/**
 * @file
 * Routes for reports.
 */

use App\Http\Controllers\Admin\AccessLogController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'permission:laptops.reports'])->prefix('reports')->name('reports.')->group(function () {
    Route::get('/checkout-laptops', [ReportsController::class, 'checkoutLaptopReports'])->name('checkout_laptops');
});


Route::middleware(['auth', 'permission:walkin.reports'])->prefix('reports')->name('reports.')->group(function () {
    Route::get('/walk-in-log', [ReportsController::class, 'walkInLog'])->name('walk_in_log');
});

Route::middleware(['auth', 'permission:users.admin'])->prefix('admin')->name('admin.')->group(function () {
  Route::get('/access-log', [AccessLogController::class, 'index'])->name('access_log');
  Route::delete('access-log/clear', [AccessLogController::class, 'destroy'])->name('access_log.destroy');
});
