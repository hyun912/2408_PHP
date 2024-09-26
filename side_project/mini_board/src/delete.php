<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);

    $conn = null;

    try {

        if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
            $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 0;

            if($id < 1) {
                throw new Exception("ID Parameter Error");
            }

            $conn = my_db_conn();

            $arr_prepare = [
                "id" => $id
            ];

            $result = my_board_select_id($conn, $arr_prepare);
        } else {
            $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

            if($id < 1) {
                throw new Exception("ID Parameter Error");
            }

            $conn = my_db_conn();

            $conn->beginTransaction();

            $arr_prepare = [
                "id" => $id
            ];

            my_board_delete($conn, $arr_prepare);

            $conn->commit();

            header("Location: /");
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
    <link rel="stylesheet" href="/css/delete.css">

    <title>삭제 페이지</title>
</head>
<body>

    <?php require_once(MY_PATH_ROOT."header.php") ?>

    <main>
        <div class="main-header">
            <p>삭제하면 영구적으로 복구할 수 없습니다.</p>
            <p>정말로 삭제 하시겠습니까?</p>
        </div>

        <div class="main-middle">
            <div class="box">
                <label>게시글 번호</label>
                <div class="box-content"><?php echo $result["id"] ?></div>
            </div>
            <div class="box">
                <label>제목</label>
                <div class="box-content"><?php echo $result["title"] ?></div>
            </div>
            <div class="box">
                <label>내용</label>
                <div class="box-content"><?php echo $result["content"] ?></div>
            </div>
            <div class="box">
                <label>작성일자</label>
                <div class="box-content"><?php echo $result["created_at"] ?></div>
            </div>
        </div>

        <div class="main-bottom">
            <form action="/delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $result["id"] ?>">

                <button type="submit" class="btn-small">삭제</button>

                <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>">
                    <button type="button" class="btn-small">취소</button>
                </a>
            </form>
        </div>
    </main>
    
</body>
</html>