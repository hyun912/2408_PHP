<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

  @include('layout.header')
  
  <main>
    <p>MAIN</p>
  </main>
  
  @include('layout.footer', ['key' => 'value'])

</body>
</html>