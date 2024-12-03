<template>
  <!-- 리스트 -->
  <div class="board-list-box">
    <div v-for="item in boardList" :key="item" @click="openModal(item.board_id)" class="item">
      <img :src="item.img">
    </div>
  </div>

  <!-- 모달창 -->
  <div class="board-detail-box" v-show="modalFlg">
    <div v-if="boardDetail" class="item">
      <img :src="boardDetail.img">

      <hr>

      <p>{{ boardDetail.content }}</p>

      <hr>

      <div class="etc-box">
        <span>작성자 : {{ boardDetail.user.name }}</span>
        <button @click="closeModal" class="btn btn-submit">닫기</button>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { computed, onBeforeMount, ref } from 'vue';
  import { useStore } from 'vuex';


  const store = useStore();

  // 게시글 리스트 ------------------------------------------------------------
  const boardList = computed(() => store.state.board.boardList);

  // 게시글 상세 ------------------------------------------------------------
  const boardDetail = computed(() => store.state.board.boardDetail);

  // 비포 마운트 처리 ------------------------------------------------------------
  // 컴포넌트가 마운트되기 직전에 호출
  onBeforeMount(() => {
    if(store.state.board.boardList.length < 1) {
      store.dispatch('board/boardList');
    }
  });

  // 스크롤 ------------------------------------------------------------
  const boardScrollEvent = () => {
    if(store.state.board.controllFlg) {
      const docHeight = document.documentElement.scrollHeight; // 문서 기준 Y축 길이
      const winHeight = window.innerHeight; // 윈도우 기준 Y축 길이
      const nowHeight = window.scrollY; // 현재 Y축 위치
      const viewHeight = docHeight - winHeight; // Y축 최대 길이
      
      // console.log(`문서 Y축: ${docHeight}, 윈도우 Y축: ${winHeight}, 현재 Y축: ${nowHeight}, 최대 Y축: ${viewHeight}`);
      if(viewHeight <= nowHeight) {
        store.dispatch('board/boardList');
      }
    }
  }

  window.addEventListener('scroll', boardScrollEvent);

  // 모달 ------------------------------------------------------------
  const modalFlg = ref(false);
  const openModal = (id) => {
    store.dispatch('board/showBoard', id);
    modalFlg.value = true;
  }
  const closeModal = () => {
    modalFlg.value = false;
  }
</script>

<style>
  @import url('../../../css/boardList.css');
</style>