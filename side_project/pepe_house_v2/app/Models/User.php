<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable, SoftDeletes;

  /**
   * 화이트 리스트
   *
   * @var array<int, string>
  */
  protected $fillable = [
    'account'
    ,'password'
    ,'auth'
    ,'name'
    ,'profile'
    ,'refresh_token'
  ];

  /**
   * 인증 관련 숨겨야 되는 컬럼
   *
   * @var array<int, string>
  */
  protected $hidden = [
      'password',
      'refresh_token',
  ];
}
