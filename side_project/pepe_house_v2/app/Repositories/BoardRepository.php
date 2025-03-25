<?php

namespace App\Repositories;

use App\Models\Board;
use App\Repositories\Interfaces\BoardRepositoryInterface;

class BoardRepository implements BoardRepositoryInterface {
  public function paginatedBoards() {
    return Board::where('notice', '<>', 1)
            ->latest()->latest('id')
            ->paginate(10);
  }

  public function showDetail(int $id) {
    
  }
}
