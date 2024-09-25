<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);

    $conn = null;
    $max_board_cnt = 0;
    $max_page = 0;

    try {

        $conn = my_db_conn();

        // 총 게시글 수
        $max_board_cnt = my_board_total_count($conn);
        $max_page = (int)ceil($max_board_cnt / MY_LIST_COUNT);
        

        // 페이지네이션
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // 값은 무조건 string로 옴, 형변환 헤줘야함
        $offset = ($page - 1) * MY_LIST_COUNT;
        
        // 게시글 시작과 끝값
        // ((ceil(현재 페이지 번호 / 한 화면에 보여질 페이지 개수) - 1) * 한 화면에 보여질 페이지 개수) + 1
        $start_page_btn_num = (int)((ceil($page / MY_PAGE_BUTTON_COUNT) -1) * MY_PAGE_BUTTON_COUNT) +1;
                          //  (floor(($page -1) / MY_PAGE_BUTTON_COUNT) * MY_PAGE_BUTTON_COUNT) +1;
        $end_page_btn_num = $start_page_btn_num + MY_PAGE_BUTTON_COUNT;
        $end_page_btn_num = $end_page_btn_num > $max_page ? $max_page : $end_page_btn_num;

        $prev_page_btn_num = $page - 1 < 1 ? 1 : $page -1;
        $next_page_btn_num = $page + 1 > $max_page ? $max_page : $page +1;

        $arr_prepare = [
            "list_cnt" => MY_LIST_COUNT
            ,"offset" => $offset
        ];

        $result = my_board_select_pagination($conn, $arr_prepare);

    } catch(Throwable $th) {
        // echo $th->getMessage();
        require_once(MY_PATH_ERROR);
        exit; // 이 이후의 처리를 안함
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/index.css">

    <title>리스트 페이지</title>
</head>
<body>

    <?php require_once(MY_PATH_ROOT."header.php") ?>

    <main>
        <div class="main-top">
            <a href="/insert.php">
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
                    <div><a href="/detail.php?page=<?php echo $page ?>&id=<?php echo $item["id"] ?>"><?php echo $item["title"] ?></a></div>
                    <div><?php echo $item["created_at"] ?></div>
                </div>
            <?php } ?>
        </div>

        <div class="main-bottom">
            <?php if($page !== 1) { ?>
                <a href="/index.php?page=<?php echo $prev_page_btn_num?>">
                    <button class="btn-small">이전</button>
                </a>
            <?php } ?>

            <?php for($i = $start_page_btn_num; $i <= $end_page_btn_num; $i++) { ?>
                <a href="/index.php?page=<?php echo $i ?>">
                    <button class="btn-small<?php echo $page === $i ? " btn-selectd" : "" ?>">
                        <?php echo $i ?>
                    </button>
                </a>
            <?php } ?>
            
            <?php if($page !== $max_page) { ?>
                <a href="/index.php?page=<?php echo $next_page_btn_num ?>">
                    <button class="btn-small">다음</button>
                </a>
            <?php } ?>
        </div>
    </main>

</body>
</html>