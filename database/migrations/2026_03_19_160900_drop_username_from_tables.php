<?php

/**
 * @file
 * Drops the legacy username plain-text column from tables.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::table('activities', function (Blueprint $table) {
      $table->dropColumn('username');
    });

    Schema::table('walk_in_log', function (Blueprint $table) {
      $table->dropColumn('username');
    });
  }

  /**
   * Reverse the migrations.
   *
   * Restores the column as nullable. Original data is not restored.
   */
  public function down(): void {
    Schema::table('activities', function (Blueprint $table) {
      $table->string('username')->nullable()->after('status_id');
    });

    Schema::table('walk_in_log', function (Blueprint $table) {
      $table->string('username')->nullable()->after('id');
    });
  }

};
