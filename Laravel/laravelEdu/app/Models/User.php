<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

  // SoftDeletes : 해당 모델 가벼운삭제 적용하고 싶을 때 추가
  // ↓ trait 트레이트 : 클래스 내에서 다른 클래스의 함수들을 사용하고 싶을때 쓰임
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

  // 테이블명 정의 (끝에 s나 ies가 없을시 사용)
  protected $table = 'users';

  // PK 지정 프로퍼티
  protected $primaryKey = 'u_id';

  // 컬렴명이 다르다면 따로 설정해줘야함
  // const CREATE_AT = 'created_at';
  // const UPDATED_AT = 'updated_at';

  /**
   *  upsert시 변경 허용할 컬럼 설정 프로퍼티 = 화이트 리스트
   */
  protected $fileable =[
    'u_email'
    ,'u_password'
    ,'u_name'
    ,'created_at'
    ,'updated_at'
    ,'deleted_at'
  ];

  /**
   *  upsert시 변경 불허용할 컬럼 설정 프로퍼티 = 블랙 리스트
   */
  // protected $guarded =[
  //   'u_id'
  // ];
}
