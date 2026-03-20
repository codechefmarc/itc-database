<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Access Log controller.
 */
class AccessLogController extends Controller {

  /**
   * Access log list.
   */
  public function index(Request $request) {
    $accessLogs = AccessLog::with('user')
      ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
      ->when($request->model_type, fn($q) => $q->where('model_type', $request->model_type))
      ->latest()
      ->paginate(20);

    $users = User::orderBy('first_name')->get();
    $modelTypes = AccessLog::distinct()->pluck('model_type')->filter()->sort()->values();

    return view('reports.access-log', compact('accessLogs', 'users', 'modelTypes'));
  }

  /**
   * Clear logs.
   */
  public function destroy(Request $request) {
    $range = $request->input('range');

    match($range) {
      'all' => AccessLog::truncate(),
      'month' => AccessLog::where('created_at', '<', now()->subMonth())->delete(),
      '6months' => AccessLog::where('created_at', '<', now()->subMonths(6))->delete(),
    };

    return redirect()->route('admin.access_log')->with('success', 'Access logs cleared.');
  }

}
