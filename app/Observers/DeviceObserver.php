<?php

namespace App\Observers;

use App\Models\AccessLog;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

class DeviceObserver
{
    public function created(Device $device): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'device_created',
            'model_type' => 'Device',
            'model_id' => $device->id,
            'description' => 'Created device ' . $device->name,
        ]);
    }

    public function updated(Device $device): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'device_updated',
            'model_type' => 'Device',
            'model_id' => $device->id,
            'description' => 'Updated device ' . $device->name,
        ]);
    }

    public function deleted(Device $device): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'device_deleted',
            'model_type' => 'Device',
            'model_id' => $device->id,
            'description' => 'Deleted device ' . $device->name,
        ]);
    }
}
