<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pcon extends Model {
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name'
  ];

  public function serializeDate(DateTimeInterface $date) {
    return $date->format('Y-m-d H:i:s');
  }

  public function boards() {
    return $this->hasMany(Board::class);
  }
}
