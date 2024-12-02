<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model {
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'user_id'
    ,'tab_id'
    ,'pcon_id'
    ,'title'
    ,'content'
    ,'view'
    ,'bookmark'
    ,'notice'
  ];

  public function serializeDate(DateTimeInterface $date) {
    return $date->format('Y-m-d H:i:s');
  }

  public function user() {
    return $this->belongsTo(User::class);
  }
  
  public function boardTab() {
    return $this->belongsTo(BoardTab::class);
  }

  public function pcon() {
    return $this->belongsTo(Pcon::class);
  }
}
