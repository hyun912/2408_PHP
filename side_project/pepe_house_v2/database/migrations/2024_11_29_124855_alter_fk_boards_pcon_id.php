<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::table('boards', function(Blueprint $table) {
      $table->foreign('pcon_id')->references('id')->on('pcons');
    });
  }
  
  public function down() {
    Schema::table('boards', function(Blueprint $table) {
      $table->dropForeign(['pcon_id']);
    });
  }
};
