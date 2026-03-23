<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Handles generic page controller requests.
 */
class PageController extends Controller {

  /**
   * Handles 404 errors.
   */
  public function notfound(Request $request) {
  return view('errors.404');
  }

}
