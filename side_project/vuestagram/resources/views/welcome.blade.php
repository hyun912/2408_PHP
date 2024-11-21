<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <title>Vuestagram</title>
</head>
<body>
  {{-- 뷰 프로젝트를 여기에다 마운트 할거다 --}}
  <div id="app">
      <App-Component></App-Component>
  </div>
</body>
</html>