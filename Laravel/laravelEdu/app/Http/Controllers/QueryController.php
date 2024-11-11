<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller {
  public function index() {
    // 
    // 쿼리빌더
    // 

    // 안쓰는 예
    // -- Select
    // $result = DB::select('SELECT * FROM users');
    // $result = DB::select('SELECT * FROM users WHERE u_email = :u_email', ['u_email' => 'admin@admin.com']);
    // $result = DB::select('SELECT * FROM users WHERE u_email = ?', ['admin@admin.com']);

    // -- Insert
    // DB::insert('INSERT INTO boards_category (bc_type, bc_name) VALUES (?, ?)', ['3', '아무게시판']);

    // -- Update
    // DB::update('UPDATE boards_category SET bc_name = ? WHERE bc_type = ?', ['무아게시판', '3']);

    // -- Delete
    // DB::delete('DELETE FROM boards_category WHERE bc_type = ?', ['3']);


    // 
    // 쿼리빌더 체이닝
    // 

    $result = DB::table('users')->get();

    return var_dump($result);
  }
}
