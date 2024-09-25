<?php 
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);

    $conn = null;

    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
        try {

            $conn = my_db_conn();

            $arr_preare = [
                "title" => $_POST["title"]
                , "content" => $_POST["content"]
            ];

            $conn->beginTransaction();

            my_board_insert($conn, $arr_preare);

            $conn->commit();

            header("Location: /"); // index로 이동
            exit;
            
        } catch(Throwable $th) {
            if(!is_null($conn)) {
                $conn->rollBack();
            }

            require_once(MY_PATH_ERROR);
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/insert.css">

    <title>작성 페이지</title>
</head>
<body>

    <?php require_once(MY_PATH_ROOT."header.php") ?>
    
    <main>
        <form action="/insert.php" method="post">
            <div class="main-middle">
                <div class="box box-title">
                    <label>제목</label>
                    <input type="text" name="title" id="title" require>
                </div>

                <div class="box box-content">
                    <label>내용</label>
                    <textarea name="content" id="content" require></textarea>
                </div>
            </div>

            <div class="main-bottom">
                <button type="submit" class="btn-small">작성</button>
                <a href="/"><button type="button" class="btn-small">취소</button></a>
            </div>
        </form>
    </main>
    
</body>
</html>