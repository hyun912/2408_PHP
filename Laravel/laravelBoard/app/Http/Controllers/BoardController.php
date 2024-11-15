<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BoardController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {

    $bcType = '0';
    if($request->has('bc_type')) { // 있냐
      $bcType = $request->bc_type;
    }

    $result = Board::select('b_id', 'b_title', 'b_content', 'b_img')
                      ->where('bc_type', $bcType)
                      ->latest()
                      ->orderBy('b_id', 'DESC')
                      ->paginate(10);

    $boardInfo = BoardsCategory::where('bc_type', $bcType)->first();

    return view('board')->with([
      'data' => $result
      ,'boardInfo' => $boardInfo
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
      return view('insert')->with('bcType', $request->bc_type);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    // 유효성 검사
    
    // 방법 1. 실패시 자동으로 반환. 단점은 다른걸 with을 같이 못보냄
    $request->validate([
      'b_title' => ['required', 'between:1,50']
      ,'b_content' => ['required', 'max:200']
      ,'file' => ['required', 'image']
      ,'bc_type' => ['required', 'integer', 'exists:boards_category,bc_type']
    ]);

    // 방법 2.
    // $validator = Validator::make(
    //   $request->only('b_title', 'b_content', 'file', 'bc_type')
    //   ,[
    //     'b_title' => ['required', 'between:1,50']
    //     ,'b_content' => ['required', 'max:200']
    //     ,'file' => ['required', 'image']
    //     ,'bc_type' => ['required', 'integer', 'exists:boards_category,bc_type']
    //   ]
    // );

    // if($validator->fails()) {
    //   return redirect()->route('boards.create', ['bc_type' => $request->bc_type])
    //           ->withInput()->withErrors($validator->errors());
    // }
    

    // 글 작성
    try{
      DB::beginTransaction();
      
      if($request->hasFile('file')) {
        // $file = $request->file('file');
        // $fileName = uniqid().'.'.$file->getClientOriginalExtension();
        // $filePath = '/'.$file->storeAs('img', $fileName, 'local');
        $filePath = $request->file('file')->store('img'); // 유니크ID는 자동으로 잡아줌
      }
      
      // $boardInsert = new Board();
      // $boardInsert->u_id = Auth::id();
      // $boardInsert->bc_type = $request->bc_type;
      // $boardInsert->b_title = $request->b_title;
      // $boardInsert->b_content = $request->b_content;
      // $boardInsert->b_img = isset($filePath) ? $filePath : '';
      // $boardInsert->save();

      $insertData = $request->only('b_title', 'b_content', 'u_id', 'bc_type');
      $insertData['b_img'] = '/'.$filePath;
      $insertData['u_id'] = Auth::id();
      Board::create($insertData);

      DB::commit();

      return redirect()->route('boards.index', ['bc_type' => $request->bc_type]);
    }catch(Throwable $th) {
      DB::rollBack();
      
      if(Storage::exists($filePath)) {
        Storage::delete($filePath);
      }

      return redirect()->route('boards.create', ['bc_type' => $request->bc_type])
              ->withInput()->withErrors($th->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    // Log::debug('** boards.show start **');
    // Log::debug('request id : '. $id);

    $result = Board::find($id);

    $responseData = $result->toArray();
    $responseData['delete_flg'] = $result->u_id === Auth::id();

    // Log::debug('get detail data', $result->toArray());

    return response()->json($responseData);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $result = Board::destroy($id);
    $responseData = [
      'success' => $result === 1 ? true : false
    ];

    return response()->json($responseData);
  }
}
