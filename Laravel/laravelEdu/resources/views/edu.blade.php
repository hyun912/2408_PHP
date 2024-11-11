<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>코레와 미에루</h1>
  {{-- <h1>코레와 미에나이요</h1> --}}
  <p>{{ $data['name'] }}</p>
  <p><?php echo htmlspecialchars('<scirpt>'.$data['name'].'</script>') ?></p>

</body>
</html>