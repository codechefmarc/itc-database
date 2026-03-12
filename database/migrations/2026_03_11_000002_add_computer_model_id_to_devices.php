<?php

/**
 * @file
 * Adds computer_model_id foreign key to devices table.
 * Keeps model_number column intact for safe rollback during migration period.
 */

use App\Models\ComputerModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::table('devices', function (Blueprint $table) {
      $table->foreignIdFor(ComputerModel::class, 'computer_model_id')
        ->nullable()
        ->after('model_number')
        ->constrained()
        ->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::table('devices', function (Blueprint $table) {
      $table->dropForeign(['computer_model_id']);
      $table->dropColumn('computer_model_id');
    });
  }

};
