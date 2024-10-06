<?php

$conn = null;
$max_board_cnt = 0;
$max_page = 0;
$arr_prepare = [];

try {

    $conn = my_db_conn();

    // 즐겨찾기
    if (isset($_GET["mode"]) && $_GET["mode"] === "best") {
        $mode_best = $_GET["mode"];
        $arr_prepare["mode"] = '1';
    }

    // 탭
    if (isset($_GET["category"])) {
        $enb_tab = $_GET["category"];
        $arr_prepare["tab"] = $_GET["category"];
    }

    // 검색 대상
    if (isset($_GET["target"])) {
        if ($_GET["target"] === "title" || $_GET["target"] === "content") {
            $search_target = $_GET["target"];
            $arr_prepare["target"] = $_GET["target"];
        }
    }
    // 검색 키워드
    if (isset($_GET["keyword"]) && $_GET["keyword"] !== "") {
        $search_keyword = $_GET["keyword"];
        $arr_prepare["keyword"] = $_GET["keyword"];
    }

    // print_r($arr_prepare);

    // 총 게시글 수
    $arr_prepare["notice"] = '0'; // 공지는 따로 출력할거임
    $max_board_cnt = my_board_total_count($conn, $arr_prepare);
    $max_page = (int)ceil($max_board_cnt / MY_LIST_COUNT);

    // 페이지네이션
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // 값은 무조건 string로 옴, 형변환 헤줘야함
    $offset = ($page - 1) * MY_LIST_COUNT;

    // 게시글 시작과 끝값
    // ((ceil(현재 페이지 번호 / 한 화면에 보여질 페이지 개수) - 1) * 한 화면에 보여질 페이지 개수) + 1
    $start_page_btn_num = ((ceil($page / MY_PAGE_BUTTON_COUNT) - 1) * MY_PAGE_BUTTON_COUNT) + 1;
    $end_page_btn_num = $start_page_btn_num + MY_PAGE_BUTTON_COUNT;
    $end_page_btn_num = $end_page_btn_num > $max_page ? $max_page : $end_page_btn_num;

    $prev_page_btn_num = $page - 1 < 1 ? 1 : $page - 1;
    $next_page_btn_num = $page + 1 > $max_page ? $max_page : $page + 1;

    $arr_prepare["list_cnt"] = MY_LIST_COUNT;
    $arr_prepare["offset"] = $offset;

    // 순서 정렬 셀렉트
    if (isset($_GET["sort"])) {
        $enb_sort = $_GET["sort"];

        if ($enb_sort === "old") {
            $arr_prepare["sort"] = " boards.created_at ASC ";
        } elseif ($enb_sort === "view") {
            $arr_prepare["sort"] = " boards.view DESC ";
        }
    }

    // print_r($arr_prepare);

    $result = my_board_select_pagination($conn, $arr_prepare);
    $result_notice = my_board_select_notice($conn); // 공지 출력용
    $result_tab = my_tab_select_name($conn); // 탭 출력용
} catch (Throwable $th) {
    // echo $th->getMessage();
    require_once(MY_PATH_ERROR);
    exit; // 이 이후의 처리를 안함
}
