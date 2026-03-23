<?php

/**
 * @file
 * Provides admin routes for user and role management.
 */

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Reports\AccessLogController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'permission:users.admin'])->prefix('admin')->name('admin.')->group(function () {
  Route::resource('users', UserController::class)->except(['show']);
  Route::resource('roles', RoleController::class)->except(['show']);
  Route::get('/access-log', [AccessLogController::class, 'index'])->name('access_log');
  Route::delete('/access-log/clear', [AccessLogController::class, 'destroy'])->name('access_log.destroy');
});
