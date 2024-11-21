---------- 구성 ----------

1. laravel 프로젝트 생성
    composer create-project laravel/laravel="9" ztest

2. npm 설치
    ** 주의 : 프로젝트 디렉토리에 설치할 것 **
        npm install

    ** 아래 명령어로 컴파일이 잘되는지 시도 **
        npm run dev
    
3. vue.js 설치
    ** 주의 : 프로젝트 디렉토리에 설치할 것 **
        npm install --save-dev vue
        npm install --save-dev vue-loader
        npm install vue-router@4
        npm install vuex@next
    ** package.json 파일의 "devDependencies"에 "vue"가 추가 되었는지 확인할 것 **

    ** 아래 명령어로 컴파일이 잘되는지 시도 **
        npm run dev

4. resources/components에 Component 생성
    ** 주의 : 되도록이면 2단어 이상의 조합으로 작성할 것, 예기치 못한 에러가 발생할 수 있음 **
        예) AppComponent, BoardComponent 등등
    ** 편의에 따라 resources/ 직하라면 어디든 생성가능하나, 이후 단계의 경로는 맞추어 줄것 **

5. resources/js/app.js 수정
    ** 아래 소스코드 추가 **
        import { createApp } from 'vue';
        import AppComponent from '../components/AppComponent.vue';

        createApp({
            components: {
                AppComponent,
            }
        }).mount('#app');

6. webpack.mix.js 수정
    ** mix에 아래 추가 **
        .vue({
            version: 3,
        })

7. vue 컴파일 확인
    npm run dev

    ** Error: Cannot find module 'webpack/lib/rules/DescriptionDataMatcherRulePlugin' 에러 발생시, 아래 코드를 실행하고 다시 컴파일 ** 
        npm install --``save-dev vue-loader

8. resources/views/welcome.blade.php 수정
    ** 주의 : 아래의 js파일을 호출하고 있을 것 **
        <script src="{{ asset('js/app.js')}}" defer></script> 

    ** 주의 : 바디에는 아래 소스코드만 있을 것 **
    ** 주의 : Blade Template에서는 단어 사이에 '-'를 꼭 넣을 것(Vue Component에서는 '-'없이 작성할 것) **
        예) Vue Component명이 AppComponent일 경우, Blade Template에서는 App-Component 로 작성할 것
        <div id="app">
            <App-Component></App-Component>
        </div>