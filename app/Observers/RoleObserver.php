<?php

namespace App\Observers;

use App\Models\AccessLog;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleObserver
{
    public function created(Role $role): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'role_created',
            'model_type' => 'Role',
            'model_id' => $role->id,
            'description' => 'Created role ' . $role->name,
        ]);
    }

    public function updated(Role $role): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'role_updated',
            'model_type' => 'Role',
            'model_id' => $role->id,
            'description' => 'Updated role ' . $role->name,
        ]);
    }

    public function deleted(Role $role): void
    {
        AccessLog::create([
            'user_id' => Auth::id(),
            'action' => 'role_deleted',
            'model_type' => 'Role',
            'model_id' => $role->id,
            'description' => 'Deleted role ' . $role->name,
        ]);
    }
}
