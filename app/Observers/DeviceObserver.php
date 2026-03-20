<?php

namespace App\Observers;

use App\Models\AccessLog;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

/**
 * Observes device actions to log.
 */
class DeviceObserver {

  /**
   * Logs creation actions.
   */
  public function created(Device $device): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'device_created',
      'model_type' => 'Device',
      'model_id' => $device->id,
      'description' => 'Created device. SRJC: ' . $device->srjc_tag . ', Serial Number: ' . $device->serial_number,
    ]);
  }

  /**
   * Logs updated actions.
   */
  public function updated(Device $device): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'device_updated',
      'model_type' => 'Device',
      'model_id' => $device->id,
      'description' => 'Updated device. SRJC: ' . $device->srjc_tag . ', Serial Number: ' . $device->serial_number,
    ]);
  }

  /**
   * Logs deletion actions.
   */
  public function deleted(Device $device): void {
    AccessLog::create([
      'user_id' => Auth::id(),
      'action' => 'device_deleted',
      'model_type' => 'Device',
      'model_id' => $device->id,
      'description' => 'Deleted device. SRJC: ' . $device->srjc_tag . ', Serial Number: ' . $device->serial_number,
    ]);
  }
}
