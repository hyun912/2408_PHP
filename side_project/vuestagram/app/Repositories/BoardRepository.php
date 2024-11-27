<?php

namespace App\Repositories;

use App\Models\Board;
use App\Repositories\Interfaces\BoardRepositoryInterface;

class BoardRepository implements BoardRepositoryInterface {
  public function showDetail(int $id) {
    return Board::with('user')->find($id);
  }
}