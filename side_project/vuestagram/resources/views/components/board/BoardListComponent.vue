<template>
  <!-- 리스트 -->
  <div class="board-list-box">
    <div @click="openModal" class="item">
      <img src="/img/001.png">
    </div>
    <div @click="openModal" class="item">
      <img src="/img/002.png">
    </div>
    <div @click="openModal" class="item">
      <img src="/img/003.png">
    </div>
    <div @click="openModal" class="item">
      <img src="/img/004.png">
    </div>
    <div @click="openModal" class="item">
      <img src="/img/005.png">
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
import { ref } from 'vue';

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