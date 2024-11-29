<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('board_tabs', function (Blueprint $table) {
      $table->id();
      $table->integer('number')->unique()->comment('10개로 제한');
      $table->string('name', 50);
      $table->timestamps();
      $table->softDeletes();
    });
  }
  
  public function down() {
    Schema::dropIfExists('board_tabs');
  }
};
