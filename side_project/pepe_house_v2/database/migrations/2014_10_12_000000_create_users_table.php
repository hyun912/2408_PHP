<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('account', 30)->unique();
      $table->string('password');
      $table->string('auth', 10)->default('normal')->comment('normal: 일반, admin: 관리자');
      $table->string('name', 20);
      $table->string('profile', 100)->default('/profile/default.png');
      $table->string('refresh_token', 512)->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down() {
      Schema::dropIfExists('users');
  }
};
