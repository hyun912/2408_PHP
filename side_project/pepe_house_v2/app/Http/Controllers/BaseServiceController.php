<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\BoardRepositoryInterface;
use Illuminate\Http\Request;

class BaseServiceController extends Controller {
  protected $boardRepository;

  public function __construct(BoardRepositoryInterface $boardRepository) {
    $this->boardRepository = $boardRepository;
  }
}
