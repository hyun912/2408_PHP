<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BoardController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
      $result = Board::select('b_id', 'b_title', 'b_content', 'b_img')
                        ->orderBy('b_id', 'DESC')
                        ->latest()->paginate(10);
      return view('board')
              ->with('data', $result);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('insert');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    // 유효성 검사
    $validator = Validator::make(
      $request->only('b_title', 'b_content', 'file')
      ,[
        'b_title' => 'required'
        ,'b_content' => 'required'
        ,'file' => 'required|image|max:1024'
      ]
    );

    if($validator->fails()) {
      return redirect()->route('boards.create')
              ->withInput()->withErrors($validator->errors());
    }
    
    try{
      DB::beginTransaction();
      
      if($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
        $filePath = '/'.$file->storeAs('img', $fileName, 'local');
      }

      $boardInsert = new Board();
      $boardInsert->u_id = Auth::id();
      $boardInsert->bc_type = 0;
      $boardInsert->b_title = $request->b_title;
      $boardInsert->b_content = $request->b_content;
      $boardInsert->b_img = isset($filePath) ? $filePath : '';
      $boardInsert->save();
      DB::commit();

      return redirect()->route('boards.index');
    }catch(Throwable $th) {
      DB::rollBack();

      return redirect()->route('boards.create')
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
    // Log::debug('get detail data', $result->toArray());

    return response()->json($result->toArray());
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
  public function destroy($id)
  {
      //
  }
}
