<?php

/**
 * @file
 * Provides report routes.
 */

use App\Http\Controllers\Reports\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('reports')->name('reports.')->group(function () {
  Route::middleware('permission:laptops.reports')
    ->get('/checkout-laptops', [ReportController::class, 'checkoutLaptopReports'])
    ->name('checkout_laptops');

  Route::middleware('permission:walkin.reports')
    ->get('/walk-in-log', [ReportController::class, 'walkInLog'])
    ->name('walk_in_log');
});
