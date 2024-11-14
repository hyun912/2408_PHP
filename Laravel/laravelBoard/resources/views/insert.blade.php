@extends('layout.layout')

@section('title', '게시글 작성')

@section('bodyClassVh', 'vh-100')

@section('main')
  <main class="d-flex justify-content-center align-items-center h-75">
    <form action="{{ route('boards.store') }}" method="post" style="width: 300px" enctype="multipart/form-data"> @csrf
      
      {{-- <input type="hidden" name="bc_type" value=""> --}}
      
      @include('layout.error')
      
      <div class="mb-3">
        <label for="b_title" class="form-label">제목</label>
        <input type="text" id="b_title" name="b_title" class="form-control" value="{{ old('b_title') }}" required />
      </div>
      <div class="mb-3">
        <label for="b_content" class="form-label">내용</label>
        <input type="text" id="b_content" name="b_content" class="form-control" value="{{ old('b_content') }}" required />
      </div>
      <div class="mb-3">
        <label for="b_img" class="form-label">이미지</label>
        <input type="file" id="b_img" name="file" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-dark w-100 mb-3">작성</button>
      <a href="{{ route('boards.index') }}" class="btn btn-secondary w-100">취소</a>
    </form>
  </main>
@endsection
