<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    // $user = new User();
    // $user->u_email = 'admin@admin.com';
    // $user->u_password = Hash::make('Qwer123!');
    // $user->u_name = '관리자';
    // $user->save();

    User::factory(30)->create();
  }
}
