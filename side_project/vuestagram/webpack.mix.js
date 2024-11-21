const mix = require('laravel-mix');

/*
  라라벨과 뷰를 연결
*/

mix.js('resources/js/app.js', 'public/js')
  .vue({
    version: 3, // 버전 명시
  })
  .postCss('resources/css/app.css', 'public/css', [
      //
  ]);
