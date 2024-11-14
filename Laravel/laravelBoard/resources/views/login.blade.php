@extends('layout.layout')

@section('title', '로그인')

@section('bodyClassVh', 'vh-100')

@section('main')
  <main class="d-flex justify-content-center align-items-center h-75">
    <form action="{{ route('login') }}" method="post" style="width: 300px"> @csrf
      {{-- 에러메세지가 있는가 --}}
      @if($errors->any()) 
        <div id="errMsg" class="form-text text-danger">
          @foreach ($errors->all() as $msg)
            <span>{{ $msg }}</span> <br>
          @endforeach
        </div>
      @endif
      <div class="mb-3">
        <label for="u_email" class="form-label">이메일</label>
        <input type="email" name="u_email" id="u_email" class="form-control" >
      </div>
      <div class="mb-3">
        <label for="u_password" class="form-label">비밀번호</label>
        <input type="password" name="u_password" id="u_password" class="form-control" >
      </div>
      <button type="submit" class="btn btn-dark w-100 mb-3">로그인</button>
      <a href="./regist.html" class="btn btn-secondary w-100">회원가입</a>
    </form>
  </main>
@endsection