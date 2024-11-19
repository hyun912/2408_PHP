<template>
  <p>자식쪽 cnt : {{ props.cnt }}</p>
  <button @click="$emit('eventAddCnt')">자식증가</button> &nbsp;
  <button @click="$emit('eventAddCntParam', 2)">자식증가+2</button> &nbsp;
  <button @click="$emit('eventResetCnt')">자식 초기화</button>
</template>

<script setup>
  import { defineProps } from 'vue';

  const props = defineProps({
    'cnt': Number
  });
</script>

<style >
  
</style>