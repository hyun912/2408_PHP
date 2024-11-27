<?php

namespace App\Services;

use App\Services\Interfaces\BoardServiceInterface;
use App\Repositories\Interfaces\BoardRepositoryInterface;
use App\Services\Validators\BoardValidator;

class BoardService implements BoardServiceInterface {
  private $boardRepository;
  private $boardValidator;

  public function __construct(BoardRepositoryInterface $boardRepository, BoardValidator $boardValidator) {
    $this->boardRepository = $boardRepository;
    $this->boardValidator = $boardValidator;
  }

  public function getBoardDetail(int $id) {
    return $this->boardRepository->showDetail($id);
  }
} 