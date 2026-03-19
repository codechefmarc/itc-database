<?php

/**
 * @file
 * Adds user_id foreign key to activities and walk in log table.
 */

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::table('activities', function (Blueprint $table) {
      $table->foreignIdFor(User::class, 'uid')
        ->nullable()
        ->after('id')
        ->constrained()
        ->nullOnDelete();
    });

    Schema::table('walk_in_log', function (Blueprint $table) {
      $table->foreignIdFor(User::class, 'uid')
        ->nullable()
        ->after('id')
        ->constrained()
        ->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::table('activities', function (Blueprint $table) {
      $table->dropForeign(['uid']);
      $table->dropColumn('uid');
    });

    Schema::table('walk_in_log', function (Blueprint $table) {
      $table->dropForeign(['uid']);
      $table->dropColumn('uid');
    });
  }

};
