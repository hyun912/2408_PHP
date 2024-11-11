<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QueryController extends Controller {
  public function index(Request $request) {
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

    // select * from users
    // $result = DB::table('users')->get();

    // select * from users where name = ? ['관리자']
    // $result = DB::table('users')
    //             ->where('u_name', '관리자')
    //             ->get();

    // select * from boards where bc_type = ? and b_id < ? ['0', 5]
    // $result = DB::table('boards')
    //             ->where('bc_type', '=', '0')
    //             ->where('b_id', '<', '5')
    //             ->get();

    // select * from boards where bc_type = ? or b_id < ? [0, 10]
    // $result = DB::table('boards')
    //             ->where('bc_type', '=', '0')
    //             ->orWhere('b_id', '<', '10')
    //             ->get();

    // select b_title, b_content from boards where b_id in (?, ?) [1, 2]
    // $result = DB::table('boards')
    //             ->select('b_title', 'b_content')
    //             ->whereIn('b_id', [1, 2])
    //             ->get();
    
    // select * from boards where deleted_at is null
    // $result = DB::table('boards')
    //             ->whereNull('deleted_at')
    //             ->get();

    // select * from users where year(created_at) = ? [2024]
    // $result = DB::table('users') // 속도 느려서 잘안씀
    //             ->whereYear('created_at', '2024')
    //             ->get();

                    // ->dd(); // 출력후 exit, **쿼리문 볼려고 테스트용
    
    // 게시판별 게시글 개수
    // SELECT bc_type, COUNT(*) AS bc_cnt FROM boards GROUP BY bc_type 
    // $result = DB::table('boards')
    //             ->select('bc_type', DB::raw('count(*) as cnt'))
    //             ->whereNull('deleted_at')
    //             ->groupBy('bc_type')
    //             ->having('bc_type', '=', '0')
    //             ->get();

    // select b_id, b_title from boards orde by b_id limit ? offset ? [1, 2]
    // $result = DB::table('boards')
    //             ->select('b_id', 'b_title')
    //             ->orderBy('b_id', 'asc')
    //             ->limit(1)
    //             ->offset(2)
    //             ->get();

    // null, false, 0 , '', [] 일경우 when 실행안됨
    // select * from users where u_id = ?
    // $requestData = ['u_id' => 1];
    // $result = DB::table('users')
    //             ->when($requestData['u_id'], function ($q, $u_id) {
    //               $q->where('u_id', '=', $u_id);
    //             })
    //             ->get();

    // 삭제 안된 게시글 중 제목에 자유, 지물 포함 게시글 조회
    // select b_title from boards where (b_title like '%?%' or b_title like '%?%') and deleted_at is null
    // $result = DB::table('boards')
    //             ->select('b_title')
    //             ->whereNull('deleted_at')
    //             ->where(function ($q){
    //               $q->where('b_title', 'like', '%자유%')
    //                 ->orWhere('b_title', 'like', '%질문%');
    //             })->get();

    // first() : 첫번째거 반환
    // $result = DB::table('users')->first();

    // find(id) : 지정 pk 레코드 반환
    // $result = DB::table('users')->find(1);

    // count() : 갯수 반환
    // $result = DB::table('users')->count();

    // //--insert
    // $arr = [
    //   'u_email' => 'dororong@admin.com'
    //   ,'u_password' => Hash::make('Qwer123!')
    //   ,'u_name' => '도로롱',
    // ];
    // $result = DB::table('users')
    //             ->insert($arr);

    // //--update
    // $result = DB::table('users')
    //             ->where('u_id', '=', 3)
    //             ->update([
    //               'u_name' => '도롱'
    //             ]);

    // //--delete
    // $result = DB::table('users')
    //             ->where('u_id', '=', 3)
    //             ->delete();

    
    // 
    // Eloquent Model
    // 
    // $result = User::where('u_name', '=', '도롱')->first();
    // $result->u_name = '임시이름'; // 가변 변형, DB엔 반영안됨

    // //--insert
    // http://localhost:8000/query?u_email=dororong@admin.com&u_password=Qwer123!&u_name=도로롱
    // $userInsert = new User();
    // $userInsert->u_email = $request->u_email;
    // $userInsert->u_password = $request->u_password;
    // $userInsert->u_name = $request->u_name;
    // $userInsert->save(); // DB에 반영
    // return var_dump($userInsert);
    
    // //--update
    // $userUpdate = User::find(4);
    // $userUpdate->u_name = $request->u_name;
    // $userUpdate->save();

    // //--delete
    // $userDelete = User::destroy(4); // 소프트 삭제

    // 삭제된 데이터 포함 검색
    $result = User::withTrashed()->find(4);

    // 삭제 데이터만 검색
    // $result = User::onlyTrashed()->find(4);

    // 삭제된걸 되살림
    // $result = User::where('u_id', 4)->restore();
    
    return var_dump($result);
  }
}
