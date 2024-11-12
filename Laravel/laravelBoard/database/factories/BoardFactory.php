<?php

namespace Database\Factories;

use App\Models\BoardsCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $arrImg = [
      '/img/001.png'
      ,'/img/002.png'
      ,'/img/003.png'
      ,'/img/004.png'
      ,'/img/005.png'
      ,'/img/006.png'
    ];

    $userInfo = User::inRandomOrder()->first();
    $date = $this->faker->dateTimeBetween($userInfo->created_at);

    return [
      'u_id' => $userInfo->u_id
      ,'bc_type' => BoardsCategory::inRandomOrder()->first()->bc_type
      ,'b_title' => $this->faker->realText(50)
      ,'b_content' => $this->faker->realText(200)
      ,'b_img' => Arr::random($arrImg)
      ,'created_at' => $date
      ,'updated_at' => $date
    ];
  }
}
