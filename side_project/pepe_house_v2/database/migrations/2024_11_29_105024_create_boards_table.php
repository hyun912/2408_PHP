<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('boards', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('user_id')->unsigned();
      $table->bigInteger('tab_id')->unsigned()->default(0)->comment('0 아닐시 표시');
      $table->bigInteger('pcon_id')->unsigned()->default(0)->comment('0 아닐시 표시');
      $table->string('title', 50);
      $table->string('content', 1024);
      $table->bigInteger('view')->default(0);
      $table->char('bookmark', 1)->default(0)->comment('0: 일반, 1: 즐겨찾기');
      $table->char('notice', 1)->default(0)->comment('0: 일반, 1: 공지');
      $table->timestamps();
      $table->softDeletes();
    });
  }
  
  public function down() {
    Schema::dropIfExists('boards');
  }
};
