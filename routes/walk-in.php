<?php

/**
 * @file
 * Provides walk-in log routes.
 */

use App\Http\Controllers\WalkInLogController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'permission:walkin.edit'])->prefix('walk-in')->name('walk_in.')->controller(WalkInLogController::class)->group(function () {
  Route::get('/', 'walkInLog')->name('index');
  Route::post('/', 'storeWalkIn')->name('store');
  Route::get('/edit/{walkIn}', 'edit')->name('edit');
  Route::patch('/{walkIn}', 'patch')->name('update');
  Route::patch('/complete/{walkIn}', 'complete')->name('complete');
});
