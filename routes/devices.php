<?php

/**
 * @file
 * Defines routes for device management.
 */

use App\Http\Controllers\Checkouts\ActivityController;
use App\Http\Controllers\Checkouts\DeviceController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Taxonomy\ComputerModelController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

  Route::middleware('permission:laptops.reports')->group(function () {
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::prefix('export')->name('export.')->controller(ExportController::class)->group(function () {
      Route::get('/activities', 'activities')->name('activities');
      Route::get('/devices', 'devices')->name('devices');
      Route::get('/flagged-devices', 'flaggedDevices')->name('flagged-devices');
    });
  });

  Route::middleware('permission:laptops.edit')->controller(ActivityController::class)->group(function () {
    Route::get('/log', 'logActivity')->name('log');
    Route::post('/log', 'store');
    Route::patch('/{activity}', 'patch')->name('activities.patch');
    Route::get('/activity/edit/{activity}', 'edit')->name('activities.edit');
    Route::delete('/activity/delete/{activity}', [ActivityController::class, 'delete'])->name('activities.delete');
  });

  Route::controller(DeviceController::class)->group(function () {
    Route::patch('/device/{device}', 'patch')->name('devices.patch');
    Route::get('/device/edit/{device}', 'edit')->name('devices.edit');
    Route::delete('/device/delete/{device}', 'delete')->name('devices.delete');
  });

  // Computer model admin routes — laptops.admin only.
  // Note: static segments (/create) must be declared before wildcard segments (/{model})
  // to prevent Laravel from treating "create" as a model ID.
  Route::middleware('permission:laptops.admin')
    ->prefix('admin/computer-models')
    ->controller(ComputerModelController::class)
    ->group(function () {
      Route::get('/', 'index')->name('computer-models.index');
      Route::get('/create', 'create')->name('computer-models.create');
      Route::post('/', 'store')->name('computer-models.store');
      Route::get('/{model}/edit', 'edit')->name('computer-models.edit');
      Route::patch('/{model}', 'patch')->name('computer-models.patch');
      Route::delete('/{model}', 'delete')->name('computer-models.delete');
    });

  // Computer model API routes (used by TomSelect autocomplete and inline modal).
  Route::prefix('api/computer-models')->controller(ComputerModelController::class)->group(function () {
    Route::get('/search', 'search')->name('api.computer-models.search');
    Route::post('/', 'apiStore')->name('api.computer-models.store');
  });

});

Route::any('{catchall}', [PageController::class, 'notfound'])->where('catchall', '.*');
