<?php

namespace App\Observers;

use App\Models\AccessLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    public function created(User $user): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'user_created',
            'model_type' => 'User',
            'model_id' => $user->id,
            'description' => 'Created user ' . $user->full_name,
        ]);
    }

    public function updated(User $user): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'user_updated',
            'model_type' => 'User',
            'model_id' => $user->id,
            'description' => 'Updated user ' . $user->full_name,
        ]);
    }

    public function deleted(User $user): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'user_deleted',
            'model_type' => 'User',
            'model_id' => $user->id,
            'description' => 'Deleted user ' . $user->full_name,
        ]);
    }
}
