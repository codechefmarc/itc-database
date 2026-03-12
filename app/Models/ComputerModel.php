<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Represents a computer model (e.g. Dell Latitude 5420).
 */
class ComputerModel extends Model {
  use HasFactory;

  /**
   * Protected fields from mass assignment.
   *
   * @var array
   */
  protected $guarded = [
    'id',
    'created_at',
    'updated_at',
  ];

  /**
   * Cast purchase_date to a Carbon date instance.
   *
   * @var array
   */
  protected $casts = [
    'purchase_date' => 'date',
  ];

  /**
   * Each computer model can be assigned to many devices.
   */
  public function devices() {
    return $this->hasMany(Device::class);
  }

  /**
   * Returns the full display name: "Manufacturer ModelName".
   */
  public function getFullNameAttribute(): string {
    return $this->manufacturer . ' ' . $this->model_name;
  }

  /**
   * Returns the age of the model in years based on release_year or null.
   */
  public function getAgeInYearsAttribute(): ?int {
    if (!$this->purchase_date && !$this->release_year) {
      return NULL;
    }
    if ($this->purchase_date) {
      return (int) $this->purchase_date->diffInYears(now());
    }
    return now()->year - $this->release_year;
  }

  /**
   * Format for age of model.
   */
  public function getAgeFormattedAttribute(): string {
    $age = $this->age_in_years;
    if ($age === NULL) {
      return '—';
    }
    if ($age < 1) {
      return '< 1 year';
    }

    return $age . ' ' . Str::plural('year', $age);
  }

  /**
   * Returns the number of years since purchase_date or null.
   */
  public function getYearsSincePurchaseAttribute(): ?int {
    if (!$this->purchase_date) {
      return NULL;
    }
    return (int) $this->purchase_date->diffInYears(now());
  }

}
