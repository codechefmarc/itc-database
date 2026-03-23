<?php

/**
 * @file
 * Temporary redirects for legacy URLs.
 * @todo Remove once old URLs are no longer in use.
 */

use Illuminate\Support\Facades\Route;

// Checkouts.
Route::permanentRedirect('/log', '/checkouts/log');
Route::permanentRedirect('/search', '/checkouts/search');

// Walk-in.
Route::permanentRedirect('/walk-in-log', '/walk-in');
