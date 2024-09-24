<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);

    $conn = null;

    try {
        
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // 값은 무조건 string로 옴, 형변환 헤줘야함
    
        $offset = ($page - 1) * MY_LIST_COUNT;

        $conn = my_db_conn();

        $arr_prepare = [
            "list_cnt" => MY_LIST_COUNT
            ,"offset" => $offset
        ];

        $result = my_board_select_pagination($conn, $arr_prepare);

    } catch(Throwable $th) {
        echo $th->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/index.css">

    <title>리스트 페이지</title>
</head>
<body>
    
    <header>
        <h1>Mini Board</h1>
    </header>

    <main>
        <div class="main-top">
            <a href="./insert.html">
                <button class="btn-rigth">글 작성</button>
            </a>
        </div>

        <div class="main-middle">
            <div class="item list-head">
                <div>게시글 번호</div>
                <div>게시글 제목</div>
                <div>작성일자</div>
            </div>

            <?php foreach($result as $item) { ?>
                <div class="item list-content">
                    <div><?php echo $item["id"] ?></div>
                    <div><a href="./detail.html"><?php echo $item["title"] ?></a></div>
                    <div><?php echo $item["created_at"] ?></div>
                </div>
            <?php } ?>
        </div>

        <div class="main-bottom">
            <a href="/index.php?page=1"><button class="btn-small">이전</button></a>
            <a href="/index.php?page=1"><button class="btn-small">1</button></a>
            <a href="/index.php?page=2"><button class="btn-small">2</button></a>
            <a href="/index.php?page=3"><button class="btn-small">3</button></a>
            <a href="/index.php?page=4"><button class="btn-small">4</button></a>
            <a href="/index.php?page=5"><button class="btn-small">5</button></a>
            <a href="/index.php?page=6"><button class="btn-small">다음</button></a>
        </div>
    </main>

</body>
</html>