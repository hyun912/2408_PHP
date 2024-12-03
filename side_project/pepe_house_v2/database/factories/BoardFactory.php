<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BoardFactory extends Factory {
  public function definition() {
    return [
      'user_id' => rand(1,4),
      'title' => $this->faker->realText(rand(10, 30)),
      'content' => $this->faker->realText(rand(10, 100)),
    ];
  }
}
