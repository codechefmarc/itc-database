<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Access Log class for activities by users.
 */
class AccessLog extends Model {

  /**
   * Valid fields for UI fill in.
   *
   * @var fillable
   */
  protected $fillable = [
    'user_id',
    'action',
    'model_type',
    'model_id',
    'description',
  ];

  /**
   * Connects access logs to users.
   */
  public function user() {
    return $this->belongsTo(User::class);
  }

}
