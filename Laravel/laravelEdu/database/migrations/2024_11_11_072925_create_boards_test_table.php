<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards_test', function (Blueprint $table) {
            $table->id('b_id');
            $table->bigInteger('u_id')->unsigned();
            $table->char('bc_type', 1);
            $table->string('b_title', 50);
            $table->string('b_content', 200);
            $table->string('b_img', 100);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    // 생성 php artisan make:migration 파일명
    // 실행 php artisan migrate
    // 롤백 php artisan migrate:rollback
    // 리셋 php artisan migrate:reset

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards_test');
    }
};
