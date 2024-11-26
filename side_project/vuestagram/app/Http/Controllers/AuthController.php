<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use MyToken;

class AuthController extends Controller {
  public function login(UserRequest $request) {
    /**
     * TODO : 좀더 최적화시키고 리팩토링시킬 수 있을만한 구석이 있을때. 미래에 뭔가 의미있는 작업을 더 해야 할 필요성을 느낄때.
     * FIXME : 문제가 있는것이 확실하지만, 그걸 지금 당장 그것을 수정할 필요는 없을 때.
     * XXX : 해당 부분에 대해서는 더 생각해볼 필요성이 있을 때. 또는 해당 부분에 질문이 생길 때. 
     *       또는 코드에서 문제가 일어날만한 부분을 강조 표기할때. 완벽하게 정확히 구현되지 않은 부분이 있을 때. 
     *       나중에 고쳐야만하는 부분일 때. 주로 팀보단 자신을 위한 용도로 사용.
    */ 
    
    // 유저 정보 획득
    $userInfo = User::where('account', $request->account)
                  ->withCount('boards')
                  ->first();
    
    // 비밀번호 체크
    if(!(Hash::check($request->password, $userInfo->password))) {
      throw new AuthenticationException('비밀번호 체크 오류'); // 익셉션 던지기 메소드
    }
    
    // 토큰 발행
    list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);

    // 리프레시 토큰 저장
    MyToken::updateRefreshToken($userInfo, $refreshToken);

    $responseData = [
      'success' => true
      ,'msg' => '로그인 성공'
      ,'accessToken' => $accessToken
      ,'refreshToken' => $refreshToken
      ,'data' => $userInfo->toArray()
    ];

    return response()->json($responseData, 200);
  }
}
