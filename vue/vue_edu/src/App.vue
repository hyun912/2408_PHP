<template>
  <!-- HTML -->

  <!-- v-if -->
  <h1 v-if="cnt >= 5">5보다 큼</h1>
  <h1 v-else-if="cnt < 0">음수</h1>
  <h1 v-else>나머지</h1>
  
  <h1>{{ cnt }}</h1>
  <button @click="addCnt">증가</button> &nbsp;
  <button @click="disCnt">감소</button>
  
  <hr>
  
  <!-- class 바인딩 -->
  <h2>이름: {{ userInfo.name }}</h2>
  <h2 :class="ageBlue">나이: {{ userInfo.age }}</h2>
  <h2>성별: {{ userInfo.gender }}</h2>
  <button @click="changeName">변경</button> &nbsp;
  <button @click="changeAgeBlue">나이 파랑</button> 
  
  <hr>
  <!-- v-model 양방향 데이터 바인딩, 회원가입의 실시간 체크때 쓰임 -->
  <input type="text" v-model="transGender"> &nbsp;
  <button @click="userInfo.gender = transGender">성별 변경</button>
  <p>{{ transGender }}</p>

  <hr>

  <!-- v-show, 주로 토글용 모달에 씀 -->
  <h1 v-show="flgShow">출력</h1>
  <button @click="flgShow = !flgShow">쇼 토글</button> &nbsp;

  <hr>

  <!-- v-for -->
  <!-- <div v-for="i in 8" :key="i++">
    {{ `** ${i} 단 **` }} 
    <div v-for="j in 9" :key="j">
      {{ `${i} * ${j} = ${i * j}` }}
    </div>
  </div> -->

  <div v-for="(item, key) in data" :key="item">
    <p>{{`${key} : ${item.name} - ${item.age} - ${item.gender}`}}</p>
  </div>

  <hr>

  <!-- 자식 컴포넌트 호출, 이름을 두단어 이상 조합 필수  -->
  <BoardComponent />

  <hr>

  <!-- props : 데이터를 자식에게 전달, 잘안씀 -->
  <ChildComponent 
    :data = "data"
    :count = "cnt"
  >
    <h3>부모쪽에서 작성</h3>
    <p>와! 샌즈!</p>
  </ChildComponent>

  <hr>

  <!-- component event -->
   <p>부모 cnt : {{ cnt }}</p>
   <!-- <button @click="addCnt">부모버튼</button> -->

   <EventComponent 
    :cnt = "cnt"
    @eventAddCnt = "addCnt"
    @eventAddCntParam = "addCntParam"
    @eventResetCnt = "resetCnt"
   />
</template>

<script setup>
import BoardComponent from './components/BoardComponent.vue';
import ChildComponent from './components/ChildComponent.vue';
import EventComponent from './components/EventComponent.vue';
import { reactive, ref } from 'vue';

  // JS
  const cnt = ref(0);
  const userInfo = reactive({ // 배열과 같음
    name: '홍'
    ,age: 20
    ,gender: 'undefined'
  });
  const ageBlue = ref('');
  const transGender = ref('');
  const flgShow = ref('');
  const data = reactive(
    [
      {name: '홍' ,age: 20 ,gender: '남'},
      {name: '김' ,age: 12 ,gender: '여'},
      {name: '둘' ,age: 41 ,gender: '수'},
    ]
  );

  function addCnt() {
    cnt.value++;
  }

  function disCnt() {
    cnt.value--;
  }

  function addCntParam(num) {
    cnt.value += num;
  }

  function changeName() {
    userInfo.name = '갑';
  }

  function resetCnt() {
    cnt.value = 0;
  }

  function changeAgeBlue() {
    ageBlue.value = 'blue';
  }
  
</script>

<!-- scoped를 붙이면 여기에만 적용 -->
<style> 
  /* CSS */
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.blue {
  color: #0000ff;
}
</style>
