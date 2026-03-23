<?php

/**
 * @file
 * Provides taxonomy management routes.
 */

use App\Http\Controllers\Taxonomy\ComputerModelController;
use App\Http\Controllers\Taxonomy\PoolController;
use App\Http\Controllers\Taxonomy\StatusController;
use App\Http\Controllers\Taxonomy\SupportCategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'permission:laptops.admin'])->prefix('taxonomy')->name('taxonomy.')->group(function () {
  Route::resource('status', StatusController::class)->except(['show']);
  Route::post('status/reorder', [StatusController::class, 'reorder'])->name('status.reorder');

  Route::resource('pool', PoolController::class)->except(['show']);
  Route::post('pool/reorder', [PoolController::class, 'reorder'])->name('pool.reorder');

  Route::prefix('computer-models')->name('computer_models.')->controller(ComputerModelController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{model}/edit', 'edit')->name('edit');
    Route::patch('/{model}', 'patch')->name('patch');
    Route::delete('/{model}', 'delete')->name('delete');
  });
});

Route::middleware(['auth', 'permission:support.admin'])->prefix('taxonomy')->name('taxonomy.')->group(function () {
  Route::resource('support_category', SupportCategoryController::class)->except(['show']);
  Route::post('support_category/reorder', [SupportCategoryController::class, 'reorder'])->name('support_category.reorder');
});
