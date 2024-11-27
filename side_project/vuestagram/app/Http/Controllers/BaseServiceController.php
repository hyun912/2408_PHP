<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\BoardServiceInterface;

class BaseServiceController extends Controller {

  protected $boardService;
  
  public function __construct(BoardServiceInterface $boardService) {
    $this->boardService = $boardService;
  }
}
