<template>
  <!-- 중앙 컨테이너 DIV -->
  <div class="container">
    <!-- 배너 이미지 DIV-->
    <div class="pepe-banner"></div>
    <!-- 본문 영역 DIV-->
    <div class="content">
      <!-- 탑 버튼 영역 DIV -->
      <div class="content-top">
        <!-- 좌측 버튼 영역 DIV -->
        <div class="content-top-left">

          <!-- 전체굴 버튼 DIV -->
          <a href="/" class="btn btn-sm btn-mr">
            <span class="btn-icons btn-icon-all-pages"></span>
            전체굴
          </a>

          <!-- ★즐겨찾기 버튼 DIV -->
          <!-- <button type="button" class="btn btn-sm btn-mr">
            <span class="btn-icons btn-icon-bookmark"></span>
            즐겨찾기
          </button> -->
          
          <!-- 정렬 선택바 DIV -->
          <!-- <select @change="sortBoard" name="sort" class="btn-sm">
              <option value="latest">최신순</option>
              <option value="old">오래된순</option>
              <option value="view">조회순</option>
          </select> -->
        </div>

        <!-- 우측 버튼 영역 DIV -->
        <div class="content-top-right">
          <!-- 탭 편집 버튼 DIV-->
          <!-- <button type="button" class="btn btn-sm btn-mr">
            <span class="btn-icons btn-icon-edit-tab"></span>
            탭편집
          </button> -->

          <!-- 굴파기 버튼 DIV-->
          <!-- <button type="button" class="btn btn-sm">
            <span class="btn-icons btn-icon-dig"></span>
            굴파기
          </button> -->
        </div>
      </div>
      
      <!-- 탭 버튼 영역 DIV -->
      <div class="content-tab hide-scrollbar">
        <div class="btn-sm tab-enable">
          <a href="/">전체</a>
        </div>

        <!-- <div class="btn-sm tab-disable">
          <a href="#">테스트</a>
        </div>

        <div class="btn-sm tab-disable">
          <a href="#">· · ·</a>
        </div> -->
      </div>

      <!-- 메인 리스트 영역 DIV -->
      <div class="content-list">
        <!-- 리스트 헤드 영역 DIV -->
        <div class="item list-head">
          <div>번호</div>
          <div>제목</div>
          <div>작성자</div>
          <div>작성일</div>
          <div>조회수</div>
        </div>
        
        <!-- 리스트 공지 영역 DIV -->
        <!-- <div class="item list-board list-notice">
          <div>공지</div>
          <div>제목</div>
          <div>
              <span class="btn-icons list-icon-title-stamp"></span>
              익명의 페페
          </div>
          <div>2024-12-01</div>
          <div>0</div>
        </div> -->

        <!-- 리스트 일반 영역 DIV-->
        <div v-if="boards.length === 0">
          <div class="list-non list-board">
            <div>굴이 존재하지 않습니다</div>
          </div>
        </div>
        <div v-else>
          <div v-for="item in boards" :key="item">
            <div class="item list-board">
              <div>{{ item.id }}</div>
              <div>{{ item.title }}</div>
              <div>
                  <span class="btn-icons list-icon-title-stamp"></span>
                  익명의 페페
              </div>
              <div>{{ item.created_at }}</div>
              <div>{{ item.view }}</div>
            </div>
          </div>
        </div>
      </div>

      
      <!-- 하단 영역 DIV -->
      <!-- <div class="footer"> -->
        <!-- 검색바 영역 DIV -->
        <!-- <div class="search-bar"> -->
          <!-- 검색 선택바 셀렉트 DIV -->
          <!-- <select name="target" class="btn-sm">
            <option value="all">전체</option>
            <option value="title">제목</option>
            <option value="content">내용</option>
          </select> -->

          <!-- 검색 입력바 영역 INPUT -->
          <!-- <input type="text" name="keyword" class="btn-sm" /> -->

          <!-- 돋보기 아이콘 버튼 -->
          <!-- <button type="button" class="btn-icons btn-sm"></button>
        </div>
      </div> -->

      <!-- 페이지네이션 영역 -->
      <div class="pagination-bar">

        <!-- 10개 미만일시 -->
        <button v-if="pages.length === 1" type="button" class="btn btn-sm btn-page-bar page-enable">1</button>

        <div v-else class="pagination-bar">
          <button v-if="currentPage !== 1" @click="movePage(currentPage - 1)" type="button" class="btn btn-sm btn-page-bar">&lt;</button>
          
          <div v-for="item in pages" :key="item">
              <button @click="movePage(item.label)" type="button" class="btn btn-sm btn-page-bar"
                :class="{'page-enable' : item.label === String($store.state.board.currentPage)}"
              >
                {{ item.label }}
              </button>
          </div>
    
          <button v-if="currentPage !== lastPage" @click="movePage(currentPage + 1)" type="button" class="btn btn-sm btn-page-bar">&gt;</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { computed, onBeforeMount } from 'vue';
  import { useStore } from 'vuex';

  const store = useStore();
  const boards = computed(() => store.state.board.boardList);
  const pages = computed(() => store.state.board.links);
  const currentPage = computed(() => Number(store.state.board.currentPage));
  const lastPage = computed(() =>  Number(store.state.board.lastPage));

  // 마운트 전에 로드
  onBeforeMount(() => {
    if(store.state.board.boardList.length < 1) {
      store.dispatch('board/boardList');
    }
  });

  // 페이지 이동 처리
  const movePage = (page) => {
    if(page !== '...' && page !== store.state.board.currentPage) {
      store.dispatch('board/boardList', page);
    }
  }

  // 리스트 정렬
  // const sortBoard = (e) => {
  //   console.log(e.target.value);
  // };

</script>

<style>
  @import url('../../../css/index.css');
</style>