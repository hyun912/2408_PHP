<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {

    $date = $this->faker->dateTimeBetween('-1 years');
    return [
      'u_email' => $this->faker->unique()->safeEmail(),
      'u_password' => Hash::make('Qwer123!'),
      'u_name' => $this->faker->name(),
      'created_at' => $date,
      'updated_at' => $date
    ];
  }
}
