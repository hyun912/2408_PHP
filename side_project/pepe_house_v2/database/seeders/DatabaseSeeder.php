<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
  public function run() {
    $this->call([
      UserSeeder::class
    ]);

    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    Board::factory(50)->create();
  }
}
