<?php

/**
 * @file
 * Drops the legacy model_number plain-text column from devices.
 *
 * IMPORTANT: Only run this migration after verifying that:
 *   1. All devices have a non-null computer_model_id.
 *   2. The application is fully updated to use computer_model_id.
 *
 * Verify with:
 *   SELECT COUNT(*) FROM devices WHERE computer_model_id IS NULL;
 *
 * The down() method restores model_number as nullable — data is not
 * recoverable from this migration alone, so ensure a DB backup exists.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::table('devices', function (Blueprint $table) {
      $table->dropColumn('model_number');
    });
  }

  /**
   * Reverse the migrations.
   *
   * Restores the column as nullable. Original data is not restored.
   */
  public function down(): void {
    Schema::table('devices', function (Blueprint $table) {
      $table->string('model_number')->nullable()->after('serial_number');
    });
  }

};
