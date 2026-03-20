<?php

namespace App\Observers;

use App\Models\AccessLog;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityObserver
{
    public function created(Activity $activity): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'checkout_logged',
            'model_type' => 'Activity',
            'model_id' => $activity->id,
            'description' => 'Logged a checkout activity',
        ]);
    }

    public function updated(Activity $activity): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'checkout_updated',
            'model_type' => 'Activity',
            'model_id' => $activity->id,
            'description' => 'Updated a checkout activity',
        ]);
    }

    public function deleted(Activity $activity): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'checkout_deleted',
            'model_type' => 'Activity',
            'model_id' => $activity->id,
            'description' => 'Deleted a checkout activity',
        ]);
    }
}
