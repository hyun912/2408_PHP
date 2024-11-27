<?php

namespace App\Services;

use App\Services\Interfaces\BoardServiceInterface;
use App\Repositories\Interfaces\BoardRepositoryInterface;

class BoardService implements BoardServiceInterface {
  private $boardRepository;

  public function __construct(BoardRepositoryInterface $boardRepository) {
    $this->boardRepository = $boardRepository;
  }

  public function getBoardDetail(int $id) {
    return $this->boardRepository->showDetail($id);
  }
} 