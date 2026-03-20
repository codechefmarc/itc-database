<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Describes a user and provides user methods.
 */
class User extends Authenticatable {
  use HasFactory, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   */
  protected function casts(): array {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * Each user has many activities.
   */
  public function activities() {
    return $this->hasMany(Activity::class, 'uid');
  }

  /**
   * Each user has many walk in logs.
   */
  public function walkInLog() {
    return $this->hasMany(WalkInLog::class, 'uid');
  }

  /**
   * Connects access logs to users.
   */
  public function accessLogs() {
    return $this->hasMany(AccessLog::class);
  }

  /**
   * Gets the full name of the user.
   */
  public function getFullNameAttribute(): string {
    return trim($this->first_name . ' ' . $this->last_name) ?: 'Unknown';
  }

}
