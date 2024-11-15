@extends('layout.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/myCommon.css') }}">
@endsection

@section('script')
  <script src="{{ asset('js/board.js') }}" defer></script>
@endsection

@section('title', '게시판')

@section('bodyClassVh', 'vh-100')

@section('main')

  <div class="text-center mt-5 mb-5">
    <h1>{{ $boardInfo->bc_name }}</h1>
    <a href="{{ route('boards.create', ['bc_type' => $boardInfo->bc_type]) }}" class="link-dark">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        {{-- x-link="{{ route('boards.create') }}" --}}
        width="40"
        height="40"
        fill="currentColor"
        class="bi bi-plus-circle-fill"
        viewBox="0 0 16 16">
        <path
          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
      </svg>
    </a>
  </div>

  <main>
    @foreach ($data as $item)
      <div id="card{{ $item->b_id }}" class="card" >
        <img src="{{ asset($item->b_img) }}" class="card-img-top object-fit-cover" alt="..." />
        <div class="card-body">
          <h5 class="card-title">
            {{ $item->b_title }}
          </h5>
          <p class="card-text">
            {{ $item->b_content }}
          </p>
          <button type="button" class="btn btn-primary my-btn-detail" value="{{ $item->b_id }}" data-bs-toggle="modal" data-bs-target="#detailModal">
            상세
          </button>
        </div>
      </div>
    @endforeach
  </main>
  
  <div class="d-flex justify-content-center custom-pagination">
    {{ $data->links('pagination::bootstrap-5') }}
  </div>

  <!-- Modal -->
  <div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalTitle">모달 입네다.</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="fs-6" id="modalDate">2024-01-01 00:00:00</p>
          <p id="modalContent">살려주셈요</p>
          <br />
          <img src="" id="modalImg" class="object-fit-cover" alt="..." />
        </div>
        <div class="modal-footer justify-content-between">
          <div id ="modalDeleteParent">
            {{-- <button id="modalDelete" type="button" class="btn btn-danger">삭제</button> --}}
          </div>
          <div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection