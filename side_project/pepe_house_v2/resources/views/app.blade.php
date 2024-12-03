<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>우물 속의 페페🐸하우스</title>
  </head>
  <body>
    <div id="app">
      <App-Component></App-Component>
    </div>
  </body>
</html>