<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoardController extends BaseServiceController {
  
  public function index() {
    $boards = $this->boardService->getPaginatedBoards();
    return response()->json([
      'success' => true
      ,'msg' => '게시글 획득 성공'
      ,'boards' => $boards->toArray()
    ], 200);
  }
}
