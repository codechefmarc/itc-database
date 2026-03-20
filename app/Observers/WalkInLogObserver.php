<?php

namespace App\Observers;

use App\Models\AccessLog;
use App\Models\WalkInLog;
use Illuminate\Support\Facades\Auth;

/**
 * Observes walk-in log actions.
 */
class WalkInLogObserver {

  /**
   * Logs created actions.
   */
  public function created(WalkInLog $walkInLog): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'walkin_created',
      'model_type' => 'WalkInLog',
      'model_id' => $walkInLog->id,
      'description' => 'Logged a walk-in session',
    ]);
  }

  /**
   * Logs updated actions.
   */
  public function updated(WalkInLog $walkInLog): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'walkin_updated',
      'model_type' => 'WalkInLog',
      'model_id' => $walkInLog->id,
      'description' => 'Updated a walk-in session',
    ]);
  }

  /**
   * Logs deleted actions.
   */
  public function deleted(WalkInLog $walkInLog): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'walkin_deleted',
      'model_type' => 'WalkInLog',
      'model_id' => $walkInLog->id,
      'description' => 'Deleted a walk-in session',
    ]);
  }

}
