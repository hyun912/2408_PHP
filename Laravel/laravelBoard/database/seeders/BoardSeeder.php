<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // 만개이상 돌릴시 한번에 돌리면 터지니 작게 나눠 반복문으로 돌리는 편이 나음
    Board::factory(100)->create();

    // 30만개 예시
    // $total = 100000;
    // $interval = 5000;
    // for ($i = 0; $i < $total; $i += $interval) {
    //   Board::factory($interval)->create();
    // } 
  }
}
