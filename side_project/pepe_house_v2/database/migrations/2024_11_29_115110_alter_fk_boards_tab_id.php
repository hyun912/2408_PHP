<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::table('boards', function(Blueprint $table) {
      $table->foreign('tab_id')->references('id')->on('board_tabs');
    });
  }
  
  public function down() {
    Schema::table('boards', function(Blueprint $table) {
      $table->dropForeign(['tab_id']);
    });
  }
};
