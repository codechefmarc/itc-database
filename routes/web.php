<?php

/**
 * @file
 * Default routes.
 */

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('welcome');
Route::get('/it/laptop-checkout', fn() => view('welcome'));

if (app()->environment('local')) {
  Route::get('/style-guide', fn() => view('dev.style-guide'));
}
