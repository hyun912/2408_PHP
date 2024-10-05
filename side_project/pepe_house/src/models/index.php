<?php

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
        require_once(MY_PATH_ERROR);
        exit; // 이 이후의 처리를 안함
    }