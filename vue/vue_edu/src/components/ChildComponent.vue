<template>
  <slot></slot>
  <h1>자식 컴포넌트</h1>
  <div v-for="item in props.data" :key="item">
    <span>{{ item.name }}</span>
  </div>
  <p>{{ props.count }}</p>
  
  <!-- slot 부모쪽에서 호출할때 쓴 태그들을 표시 -->
  <slot></slot>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  'data': Array
  ,'count': Number
});
</script>

<style>
</style>