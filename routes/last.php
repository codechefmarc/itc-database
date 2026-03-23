<?php

/**
 * @file
 * Default routes.
 */

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::any('{catchall}', [PageController::class, 'notfound'])->where('catchall', '.*');
