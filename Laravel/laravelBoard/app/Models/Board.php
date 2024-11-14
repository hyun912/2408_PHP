<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model {
  use HasFactory, SoftDeletes;

  protected $primaryKey = 'b_id';

  protected $fillable = [
    'u_id',
    'bc_type',
    'b_title',
    'b_content',
    'b_img'
  ];

  // 시간 제데로 출력할때 고정으로 사용
  protected function serializeDate(DateTimeInterface $date) {
    return $date->format('Y-m-d H:i:s');
  }
}