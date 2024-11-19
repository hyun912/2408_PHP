<template>
  <img alt="Vue logo" src="./assets/logo.png">
  <!-- <h1>{{ count }}</h1>
  <button @click="store.commit('board/addCount')">증가</button> -->

  <BoardListComponents />
</template>

<script setup>
  import BoardListComponents from './components/BoardListComponents.vue';

  // 반응형 데이터로 다루기 위해 computed 사용
  // const count = computed(() => store.state.board.count);

</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
