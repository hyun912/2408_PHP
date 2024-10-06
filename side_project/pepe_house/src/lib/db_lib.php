<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

/**
 * DB Connection
 */
function my_db_conn()
{
    $option = [
        PDO::ATTR_EMULATE_PREPARES      => false,
        PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
    ];

    return new PDO(MY_MARIADB_DSN, MY_MARIADB_USER, MY_MARIADB_PASSWORD, $option);
}

/**
 * borders Max Count 처리
 */
function my_board_total_count(PDO $conn, array $arr_param)
{
    $sql =
        " SELECT "
        . "       COUNT(*) AS cnt "
        . " FROM "
        . "       boards";

    // 탭
    if (isset($arr_param["tab"])) {
        $sql .= " JOIN board_tabs "
            . " ON boards.tab_id = board_tabs.id "
            . "        AND board_tabs.name = :tab ";
    }

    $sql .=
        " WHERE "
        . "       boards.deleted_at IS NULL "
        . "   AND boards.notice = :notice ";

    // 즐겨찾기
    if (isset($arr_param["mode"])) {
        $sql .= " AND boards.bookmark = :mode ";
    }

    // 검색
    if (isset($arr_param["keyword"])) {
        if (isset($arr_param["target"])) {
            $sql .= " AND :target LIKE '%' || :keyword || '%' ";
        } else {
            $arr_param["keyword2"] = $arr_param["keyword"];
            $sql .= " AND (title LIKE '%' || :keyword || '%' "
                .   "  OR content LIKE '%' || :keyword2 || '%') ";
        }
    } elseif (isset($arr_param["target"])) {
        unset($arr_param["target"]);
    }

    $stmt = $conn->prepare($sql);

    if (!$stmt->execute($arr_param)) {
        throw new Exception("Selete Query Error : boards");
    }

    $result = $stmt->fetch();

    return $result["cnt"];
}

/**
 *  borders Select Pagination 처리 
 */
function my_board_select_pagination(PDO $conn, array $arr_param)
{

    $sql =
        " SELECT "
        . "       * "
        . " FROM "
        . "      boards ";

    // 탭
    if (isset($arr_param["tab"])) {
        $sql .= " JOIN board_tabs "
            . "     ON boards.tab_id = board_tabs.id "
            . "        AND board_tabs.name = :tab ";
    }

    $sql .=
        " WHERE "
        . "       boards.deleted_at IS NULL "
        . "   AND boards.notice = :notice ";

    // 즐겨찾기
    if (isset($arr_param["mode"])) {
        $sql .= " AND boards.bookmark = :mode ";
    }

    // 검색
    if (isset($arr_param["keyword"])) {
        if (isset($arr_param["target"])) {
            $sql .= " AND :target LIKE '%' || :keyword || '%' ";
        } else {
            $arr_param["keyword2"] = $arr_param["keyword"];
            $sql .= " AND (title LIKE '%' || :keyword || '%' "
                .   "  OR content LIKE '%' || :keyword2 || '%') ";
        }
    } elseif (isset($arr_param["target"])) {
        unset($arr_param["target"]);
    }

    $sql .= " ORDER BY ";

    $sql .= isset($arr_param["sort"]) ? " :sort" : " boards.created_at DESC, boards.id DESC";

    $sql .= " LIMIT :list_cnt OFFSET :offset ";

    $stmt = $conn->prepare($sql);

    if (!$stmt->execute($arr_param)) {
        throw new Exception("Selete Query Error : boards");
    }

    return $stmt->fetchAll();
}


/**
 * 공지사항 출력용
 */
function my_board_select_notice(PDO $conn)
{
    $sql =
        " SELECT "
        . "       * "
        . " FROM "
        . "      boards "
        . " WHERE "
        . "       deleted_at IS NULL "
        . "   AND notice = '1' ";

    $stmt = $conn->query($sql);
    return $stmt->fetchAll();
}

/**
 * Tabs select Number 처리
 */
function my_tab_select_name(PDO $conn)
{
    $sql =
        " SELECT "
        . "      name "
        . " FROM "
        . "      board_tabs "
        . " ORDER BY "
        . "          number ASC ";

    $stmt = $conn->query($sql);
    return $stmt->fetchAll();
}

// tab_id를 써서 tab name을 가져옴
function my_tab_get_name_by_id(PDO $conn, int $id)
{
    $sql =
        " SELECT "
        . "      name "
        . " FROM "
        . "      board_tabs "
        . " WHERE "
        . "          id= " . $id;
    $stmt = $conn->query($sql);
    return $stmt->fetch();
}


// pcon_id를 써서 pcon name을 가져옴
function my_pcon_get_name_by_id(PDO $conn, int $id)
{
    $sql =
        " SELECT "
        . "      name "
        . " FROM "
        . "      pcons "
        . " WHERE "
        . "          id= " . $id;
    $stmt = $conn->query($sql);
    return $stmt->fetch();
}
