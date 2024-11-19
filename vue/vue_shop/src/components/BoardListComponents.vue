<template>
  <div v-for="item in products" :key="item">
    <h2 @click="openDetailModal(item)">{{ item.productName }}</h2>
    <p>{{ item.productContent }}</p>
    <span>{{ `${item.productPrice}원` }}</span>  
  </div>

  <!-- detail modal -->
  <Transition name="detailModalAnimation">
    <div class="bg-modal-black" v-show="flgDetail">
      <div class="bg-modal-white">
        <h2>{{ detailProduct.productName }}</h2>
        <p>{{ detailProduct.productContent }}</p>
        <p>{{ `${detailProduct.productPrice}원` }}</p>
        <button @click="closeDetailModal">닫기</button>
      </div>
    </div>
  </Transition>
</template>

<script setup>
  import { computed, ref } from 'vue';
  import { useStore } from 'vuex';

  const store = useStore();
  const products = computed(() => store.state.board.products);

  // 상세 모달 제어
  const flgDetail = ref(false);
  // const toggleDetailModal = () => {
  //   flgDetail.value = !flgDetail.value;
  // }
  const detailProduct = computed(() => store.state.board.detailProduct);

  const openDetailModal = (item) => {
    store.commit('board/setDetailProduct', item);
    flgDetail.value = true;
  }
  const closeDetailModal = () => {
    flgDetail.value = false;
  }
</script>

<style scoped>
  .bg-modal-black {
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.7);
    position: fixed;
    top: 0;
    left: 0;
  }
  .bg-modal-white {
    background-color: #fff;
    width: 80%;
    max-width: 500px;
    padding: 20px;
    margin: 20px auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  /* 시작 초기값 */
  .detailModalAnimation-enter-from {
    opacity: 0;
  }
  /* 어떤식으로 시작할지 */
  .detailModalAnimation-enter-active {
    transition: 0.3s ease;
  }
  /* 시작 끝날때 */
  .detailModalAnimation-enter-to {
    opacity: 1;
  }

  /* 끝 초기값 */
  .detailModalAnimation-leave-from {
    transform: translateY(0px);
  }
  /* 어떤식으로 끝날지 */
  .detailModalAnimation-leave-active {
    transition: all 4s;
  }
  /* 끝 종료시 */
  .detailModalAnimation-leave-to {
    transform: translateX(4000px);
  }

</style>
