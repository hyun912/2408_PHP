<?php 
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">

    <title>에러 페이지</title>
</head>
<body>

    <?php require_once(MY_PATH_ROOT."header.php") ?>

    <main>
        <p>에러! 에러!</p>
        <p>메인으로 돌아가서 다시해럇!</p>
        <p><?php echo $th->getMessage() ?></p>
        <a href="/"><button type="button" class="btn-rigth">메인 페이지</button></a>
    </main>
    
</body>
</html>