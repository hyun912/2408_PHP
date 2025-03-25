<?php

namespace App\Services;

use App\Repositories\Interfaces\BoardRepositoryInterface;
use App\Services\Interfaces\BoardServiceInterface;

class BoardService implements BoardServiceInterface {
  private $boardRepository;

  public function __construct(BoardRepositoryInterface $boardRepository) {
    $this->boardRepository = $boardRepository;
  }

  public function getPaginatedBoards() {
    $boards = $this->boardRepository->paginatedBoards();
    
    return $boards;
  }

  public function getBoardDetail(int $id) {
    
  }
}