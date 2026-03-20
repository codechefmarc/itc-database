<?php

namespace App\Providers;

use App\Models\AccessLog;
use App\Models\Activity;
use App\Models\ComputerModel;
use App\Models\Device;
use App\Models\User;
use App\Models\WalkInLog;
use App\Observers\ActivityObserver;
use App\Observers\ComputerModelObserver;
use App\Observers\DeviceObserver;
use App\Observers\RoleObserver;
use App\Observers\UserObserver;
use App\Observers\WalkInLogObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;


/**
 * Provides application services.
 */
class AppServiceProvider extends ServiceProvider {

  /**
   * Register any application services.
   */
  public function register(): void {

  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void {
    Gate::define('edit-user', function ($currentUser, $targetUser) {
      return $currentUser->can('users.admin') || $currentUser->id === $targetUser->id;
    });

    // Observers - to log activity.

    Activity::observe(ActivityObserver::class);
    Device::observe(DeviceObserver::class);
    ComputerModel::observe(ComputerModelObserver::class);
    WalkInLog::observe(WalkInLogObserver::class);
    User::observe(UserObserver::class);
    Role::observe(RoleObserver::class);

    // Auth events
    Event::listen(Login::class, function ($event) {
        AccessLog::create([
            'user_id' => $event->user->id,
            'action' => 'login',
            'model_type' => 'User',
            'model_id' => $event->user->id,
            'description' => $event->user->full_name . ' logged in',
        ]);
    });

    Event::listen(Logout::class, function ($event) {
        AccessLog::create([
            'user_id' => $event->user->id,
            'action' => 'logout',
            'model_type' => 'User',
            'model_id' => $event->user->id,
            'description' => $event->user->full_name . ' logged out',
        ]);
    });

  }

}
