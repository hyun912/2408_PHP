<template>
  <div>
    <!-- 인라인 핸들러 안씀 -->
    <!-- <h1 @click="plusCnt">{{ cnt }}</h1> -->
    <h1 @mouseenter="plusCnt">{{ cnt }}</h1>
    
    <hr>
    
    <input type="text" v-model="tel"> &nbsp;
    <span :style="color">{{ msg }}</span>
  </div>
</template>
<script setup>
import { ref, watch } from 'vue';

  const cnt = ref(0);

  // 대부분 메소드 핸들러로 씀
  const plusCnt = () => {
    cnt.value++;
  }

  // 와처즈 : 값이 변경되면 즉시실행
  const tel = ref('');
  const msg = ref('X');
  const color = ref('color:red');

  watch(tel, (val) => {
    const regex = /^[0-9]{10,11}$/;
    if(!regex.test(val)) {
      msg.value = 'X';
      color.value = 'color:red;';
    } else {
      msg.value = 'O';
      color.value = 'color:green;';
    }
  });

</script>

<style>
</style>