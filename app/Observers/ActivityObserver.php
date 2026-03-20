<?php

namespace App\Observers;

use App\Models\AccessLog;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

/**
 * Logs events for activities.
 */
class ActivityObserver {

  /**
   * Logs creation events.
   */
  public function created(Activity $activity): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'checkout_logged',
      'model_type' => 'Activity',
      'model_id' => $activity->id,
      'description' => 'Logged a checkout activity',
    ]);
  }

  /**
   * Logs updated events.
   */
  public function updated(Activity $activity): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'checkout_updated',
      'model_type' => 'Activity',
      'model_id' => $activity->id,
      'description' => 'Updated a checkout activity',
    ]);
  }

  /**
   * Logs deletion events.
   */
  public function deleted(Activity $activity): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'checkout_deleted',
      'model_type' => 'Activity',
      'model_id' => $activity->id,
      'description' => 'Deleted a checkout activity',
    ]);
  }

}
