<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model {
  use HasFactory, SoftDeletes;

  protected $primaryKey = 'board_id';

  protected $fillable = [
    'user_id',
    'content',
    'img',
    'like',
  ];

  public function serializeDate(DateTimeInterface $date) {
    return $date->format('Y-m-d H:i:s');
  }

  public function user() {
    return $this->belongsTo(User::class, 'user_id')->select('user_id', 'name'); // select 할땐 FK 컬럼도 같이 가져와야함 무조건
  }
}
