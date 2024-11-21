<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $primaryKey = 'user_id';

  protected $fillable = [
    'account',
    'name',
    'password',
    'gender',
    'profile',
    'refresh_token',
  ];

  // 인증 관련 숨겨야 되는 컬럼
  protected $hidden = [
    'password',
    'refresh_token',
  ];
  
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function serializeDate(DateTimeInterface $date) {
    return $date->format('Y-m-d H:i:s');
  }
}
