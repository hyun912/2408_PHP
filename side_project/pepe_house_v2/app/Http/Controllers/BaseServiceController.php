<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\BoardServiceInterface;
use Illuminate\Http\Request;

class BaseServiceController extends Controller {
  protected $boardService;

  public function __construct(BoardServiceInterface $boardService) {
    $this->boardService = $boardService;
  }
}
