<?php

/**
 * @file
 * Seeds computer_models table from existing plain-text model_number values
 * and backfills computer_model_id on all devices.
 *
 * Strategy:
 * - Split each model_number string into manufacturer (first word) and
 *   model_name (remainder). e.g. "Dell Latitude 5420" -> "Dell" + "Latitude 5420"
 * - Deduplicate before inserting.
 * - Match each device back to its new computer_model_id.
 *
 * This migration is intentionally non-destructive: model_number is NOT dropped
 * here. Run the separate drop migration only after verifying the backfill.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    // Grab every distinct non-null model_number.
    $modelNumbers = DB::table('devices')
      ->whereNotNull('model_number')
      ->where('model_number', '!=', '')
      ->select('model_number')
      ->distinct()
      ->pluck('model_number');

    foreach ($modelNumbers as $modelNumber) {
      $parts = explode(' ', trim($modelNumber), 2);
      $manufacturer = $parts[0] ?? 'Unknown';
      $modelName = $parts[1] ?? $modelNumber;

      // Insert only if this manufacturer + model_name pair doesn't exist yet.
      $existing = DB::table('computer_models')
        ->where('manufacturer', $manufacturer)
        ->where('model_name', $modelName)
        ->first();

      if (!$existing) {
        DB::table('computer_models')->insert([
          'manufacturer' => $manufacturer,
          'model_name'   => $modelName,
          'created_at'   => now(),
          'updated_at'   => now(),
        ]);
      }
    }

    // Backfill computer_model_id on each device by matching model_number.
    $computerModels = DB::table('computer_models')->get();

    foreach ($computerModels as $model) {
      // Reconstruct the original model_number string to match against.
      $modelNumberString = $model->manufacturer . ' ' . $model->model_name;

      DB::table('devices')
        ->where('model_number', $modelNumberString)
        ->update(['computer_model_id' => $model->id]);
    }
  }

  /**
   * Reverse the migrations.
   *
   * Clears backfilled FKs and removes all seeded computer_models rows.
   * Safe to run because model_number was never dropped.
   */
  public function down(): void {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('devices')->update(['computer_model_id' => NULL]);
    DB::table('computer_models')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }

};
