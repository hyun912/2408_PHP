<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
  /**
   * 데이터베이스 시드를 실행합니다.
   *
   * @return void
   */
  public function run() {
    $data = [
      ['account' => 'admin', 'password' => Hash::make('admin'), 'auth' => 'admin', 'name' => '관리자', 'profile' => '/profile/default.png'],
      ['account' => 'admin2', 'password' => Hash::make('admin'), 'auth' => 'admin', 'name' => '관리자2', 'profile' => '/profile/default.png'],
      ['account' => 'admin3', 'password' => Hash::make('admin'), 'auth' => 'admin', 'name' => '관리자3', 'profile' => '/profile/default.png'],
      ['account' => 'admin4', 'password' => Hash::make('admin'), 'auth' => 'admin', 'name' => '관리자4', 'profile' => '/profile/default.png'],
    ];
    
    foreach($data as $item) {
      User::create($item);
    }
  }
}