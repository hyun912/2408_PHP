<?php

namespace App\Repositories;

use App\Models\Board;
use App\Repositories\Interfaces\BoardRepositoryInterface;

class BoardRepository implements BoardRepositoryInterface {
  public function paginatedBoards() {
    return Board::latest()->paginate(10);
  }
}
