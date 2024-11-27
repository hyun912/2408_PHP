<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use MyToken;

class BoardController extends BaseServiceController {
  public function index() {
    $boardList = Board::latest()->paginate(8);
    
    $responseData = [
      'success' => true
      ,'msg' => '게시글 획득 성공'
      ,'boardList' => $boardList->toArray()
    ];
    return response()->json($responseData, 200);
  }

  public function show($id) {
    // $id 유효성 검사, 유저인지 검사 헤야됨

    // join방식, 삭제된 데이터도 가져올수 있으므로 주의
    // $board = Board::join('users', 'boards.user_id', '=', 'users.user_id') 
    //                 ->select('boards.*', 'users.name')
    //                 ->where('boards.board_id', $id)
    //                 ->first();
    
    // 관계 방식
    // with('user:user_id,name,account) // 따로 뺄시 컬럼 지정
    $board = Board::with('user')->find($id);

    // 개인적으로 해본 서비스 호출방식
    // $board = $this->boardService->getBoardDetail($id);

    $responseData = [
      'success' => true
      ,'msg' => '상세 정보 획득 성공'
      ,'board' => $board->toArray()
    ];

    return response()->json($responseData, 200);
  }

  public function store(Request $request) {
    // TODO: 유효성 체크 넣어야함

    $insertData = $request->only('content');
    $insertData['user_id'] = MyToken::getValueInPayLoad($request->bearerToken(), 'idt');
    $insertData['like'] = 0;
    $insertData['img'] = $request->file('file')->store('img');

    // insert
    $board = Board::create($insertData);

    $responseData = [
      'success' => true
      ,'msg' => '게시글 작성 성공'
      ,'board' => $board->toArray()
    ];

    return response()->json($responseData, 200);
  }
}
