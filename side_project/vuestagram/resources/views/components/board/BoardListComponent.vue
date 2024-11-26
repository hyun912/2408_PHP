<template>
  <!-- TODO: 스크롤 넘기는 처리 -->

  <!-- 리스트 -->
  <div class="board-list-box">
    <div v-for="item in boardList" :key="item" @click="openModal" class="item">
      <img :src="item.img">
    </div>
  </div>

  <!-- 모달창 -->
  <div class="board-detail-box" v-show="modalFlg">
    <div class="item">
      <img src="/img/001.png">

      <hr>

      <p>내용</p>

      <hr>

      <div class="etc-box">
        <span>작성자 : 몰?루</span>
        <button @click="closeModal">닫기</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, onBeforeMount, ref } from 'vue';
import { useStore } from 'vuex';


const store = useStore();

const boardList = computed(() => store.state.board.boardList);

// 비포 마운트 처리
onBeforeMount(() => {
  if(store.state.board.boardList.length < 1) {
    store.dispatch('board/getBoardList');
  }
});

// 모달
const modalFlg = ref(false);
const openModal = () => {
  modalFlg.value = true;
}
const closeModal = () => {
  modalFlg.value = false;
}
</script>

<style>
  @import url('../../../css/boardList.css');
</style>