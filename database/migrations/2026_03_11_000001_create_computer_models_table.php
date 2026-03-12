<?php

/**
 * @file
 * Creates the computer_models relational table.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('computer_models', function (Blueprint $table) {
      $table->id();
      $table->string('manufacturer');
      $table->string('model_name');
      $table->unsignedSmallInteger('release_year')->nullable();
      $table->date('purchase_date')->nullable();
      $table->timestamps();

      // Prevent duplicate manufacturer + model_name combinations.
      $table->unique(['manufacturer', 'model_name']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('computer_models');
  }

};
