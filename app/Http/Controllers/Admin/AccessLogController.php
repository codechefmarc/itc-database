<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AccessLogController extends Controller {

  public function accessLog() {
    return view('admin.reports.access-log');
  }

}
