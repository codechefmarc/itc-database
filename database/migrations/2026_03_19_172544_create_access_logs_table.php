<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('access_logs', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id')->nullable();
      $table->string('action');
      $table->string('model_type')->nullable();
      $table->unsignedBigInteger('model_id')->nullable();
      $table->string('description')->nullable();
      $table->timestamps();

      $table->index('action');
      $table->index('model_type');
      $table->index('user_id');
      $table->index('created_at');
    });

    Schema::table('access_logs', function (Blueprint $table) {
        $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('access_logs');
  }

};
