<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('pcons', function (Blueprint $table) {
      $table->id();
      $table->string('name', 50)->comment('alt 출력문');
      $table->string('img', 100)->comment('.webp로 통일');
      $table->timestamps();
      $table->softDeletes();
    });
  }
  
  public function down() {
    Schema::dropIfExists('pcons');
  }
};
