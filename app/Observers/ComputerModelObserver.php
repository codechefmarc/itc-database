<?php

namespace App\Observers;

use App\Models\AccessLog;
use App\Models\ComputerModel;
use Illuminate\Support\Facades\Auth;

/**
 * Observes the computer model and logs to access log.
 */
class ComputerModelObserver {

  /**
   * Logs creation events.
   */
  public function created(ComputerModel $computerModel): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'computer_model_created',
      'model_type' => 'ComputerModel',
      'model_id' => $computerModel->id,
      'description' => 'Created computer model ' . $computerModel->getFullNameAttribute(),
    ]);
  }

  /**
   * Logs updated events.
   */
  public function updated(ComputerModel $computerModel): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'computer_model_updated',
      'model_type' => 'ComputerModel',
      'model_id' => $computerModel->id,
      'description' => 'Updated computer model ' . $computerModel->getFullNameAttribute(),
    ]);
  }

  /**
   * Logs deletion events.
   */
  public function deleted(ComputerModel $computerModel): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'computer_model_deleted',
      'model_type' => 'ComputerModel',
      'model_id' => $computerModel->id,
      'description' => 'Deleted computer model ' . $computerModel->getFullNameAttribute(),
    ]);
  }

}
