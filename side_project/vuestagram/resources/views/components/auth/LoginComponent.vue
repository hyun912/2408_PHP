<template>
  <div class="form-box">
    <p class="form-title">로그인</p>

    <input v-model="userInfo.account" type="text" name="account" placeholder="아이디" required>
    <input v-model="userInfo.password" type="password" name="password" placeholder="비밀번호" required>
    
    <button @click="$store.dispatch('user/login', userInfo)" class="btn btn-submit btn-bg-black">
      로그인
    </button>
  </div>
</template>

<script setup>
  import { reactive } from 'vue';

  const userInfo = reactive({
    account: '',
    password: '',
  });
</script>

<style>
  
</style>