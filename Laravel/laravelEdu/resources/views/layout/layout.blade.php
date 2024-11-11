<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'Layout') {{-- @yield(표시할 변수, ←없을시 디폴트 이름) --}}</title>
</head>
<body>

  @include('layout.header')

  @yield('main')

  {{-- 자식 탬플릿에 해당하는 섹션이 없으면 부모코드 실행 --}}
  @section('show')
  <h2>부모 Show</h2>
  <h3>많은 처리</h3>
  @show
  
  @include('layout.footer')
  
</body>
</html>