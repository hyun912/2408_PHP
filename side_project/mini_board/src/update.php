<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);

    $conn = null;

    try {

        // $conn = my_db_conn();

        if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") { // detail -> update
            $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

            if($id < 1) {
                throw new Exception("ID Parameter Error");
            }

            $arr_prepare = [
                "id" => $id
            ];

            $conn = my_db_conn();

            $result = my_board_select_id($conn, $arr_prepare);

        } else { // post, update -> detail
            $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
            $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
            $title = isset($_POST["title"]) ? (int)$_POST["title"] : "";
            $content = isset($_POST["content"]) ? (int)$_POST["content"] : "";

            if($id < 1 || $title === "" || $content === "") {
                throw new Exception("Parameter Error");
            }

            $conn = my_db_conn();

            $conn->beginTransaction();
            
            $arr_prepare = [
                "id" => $id
                ,"title" => $title 
                ,"content" => $content
            ];

            my_board_update($conn, $arr_prepare);
            
            $conn->commit();
            
            header("Location: /detail.php?id=".$id."&page=".$page);
            exit;
        }

    } catch(Throwable $th) {
        if(!is_null($conn) && $conn->inTransaction()) {
            $conn->rollBack();
        }

        require_once(MY_PATH_ERROR);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/update.css">

    <title>수정 페이지</title>
</head>
<body>

    <?php require_once(MY_PATH_ROOT."header.php") ?>
    
    <main>
        <form action="/update.php" method="post">

            <input type="hidden" name="page" value="<?php echo $page ?>">
            <input type="hidden" name="id" value="<?php echo $result["id"] ?>">

            <div class="main-middle">
                <div class="box box-number">
                    <label>글번호</label>
                    <div class="box-num"><?php echo $result["id"] ?></div>
                </div>

                <div class="box box-title">
                    <label>제목</label>
                    <input type="text" name="title" id="title" value="<?php echo $result["title"] ?>" require>
                </div>

                <div class="box box-content">
                    <label>내용</label>
                    <textarea name="content" id="content" require><?php echo $result["content"] ?></textarea>
                </div>
            </div>
            
            <div class="main-bottom">
                <button type="submit" class="btn-small">수정</button>
                <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>">
                    <button type="button" class="btn-small">취소</button>
                </a>
            </div>
        </form>
    </main>
    
</body>
</html>