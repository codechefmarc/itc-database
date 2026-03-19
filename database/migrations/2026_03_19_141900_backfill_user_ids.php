<?php

/**
 * @file
 * Backfills uid on all activities and walk in logs.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    $users = DB::table('users')->get();

    foreach ($users as $user) {
      $userName = $user->first_name . ' ' . $user->last_name;

      DB::table('activities')
        ->where('username', $userName)
        ->update(['uid' => $user->id]);

      DB::table('walk_in_log')
        ->where('username', $userName)
        ->update(['uid' => $user->id]);
    }
  }

  /**
   * Reverse the migrations.
   *
   * Clears backfilled users IDs.
   */
  public function down(): void {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('activities')->update(['uid' => NULL]);
    DB::table('walk_in_log')->update(['uid' => NULL]);
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }

};
