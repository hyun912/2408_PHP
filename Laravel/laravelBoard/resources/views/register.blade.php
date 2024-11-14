@extends('layout.layout')

@section('title', '회원가입')

@section('bodyClassVh', 'vh-100')

@section('main')
  <main class="d-flex justify-content-center align-items-center h-75">
    <form  action="{{ route('register') }}" method="post" style="width: 300px"> @csrf
      
      @include('layout.error')

      <div class="mb-3">
        <label for="u_email" class="form-label">이메일</label>
        <input type="email" id="u_email" name="u_email" class="form-control" value="{{ old('u_email') }}" required>
      </div>
      <div class="mb-3">
        <label for="u_password" class="form-label">비밀번호</label>
        <input type="password" id="u_password" name="u_password" class="form-control" placeholder="6 ~ 20자 대문자, 특수기호 포함" required>
      </div>
      <div class="mb-3">
        <label for="u_password_chk" class="form-label">비밀번호 확인</label>
        <input type="password" id="u_password_chk" name="u_password_chk" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="u_name" class="form-label">이름</label>
        <input type="text" id="u_name" name="u_name" class="form-control" value="{{ old('u_name') }}" placeholder="한글만 입력(1 ~ 10자)" required>
      </div>
      <button type="submit" class="btn btn-dark w-100 mb-3">가입</button>
      <a href="{{ route('goLogin') }}" class="btn btn-secondary w-100">취소</a>
    </form>
  </main>
@endsection