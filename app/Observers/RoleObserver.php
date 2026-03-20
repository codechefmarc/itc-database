<?php

namespace App\Observers;

use App\Models\AccessLog;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

/**
 * Observes role actions.
 */
class RoleObserver {

  /**
   * Logs creation actions.
   */
  public function created(Role $role): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'role_created',
      'model_type' => 'Role',
      'model_id' => $role->id,
      'description' => 'Created role ' . $role->name,
    ]);
  }

  /**
   * Logs updated actions.
   */
  public function updated(Role $role): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'role_updated',
      'model_type' => 'Role',
      'model_id' => $role->id,
      'description' => 'Updated role ' . $role->name,
    ]);
  }

  /**
   * Logs deleted actions.
   */
  public function deleted(Role $role): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'role_deleted',
      'model_type' => 'Role',
      'model_id' => $role->id,
      'description' => 'Deleted role ' . $role->name,
    ]);
  }

}
