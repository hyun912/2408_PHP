<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

/**
 * DB Connection
 */
function my_db_conn() {
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
function my_board_total_count(PDO $conn, array $arr_param) {
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
        throw new Exception("Count Query Error : boards");
    }

    $result = $stmt->fetch();

    return $result["cnt"];
}

/**
 *  borders Select Pagination 처리 
 */
function my_board_select_pagination(PDO $conn, array $arr_param) {

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
        throw new Exception("Select Query Error : boards");
    }

    return $stmt->fetchAll();
}

/**
 * 공지사항수 체크용
 */
function my_board_notice_total_count(PDO $conn) {
    $sql =
        " SELECT "
        . "       COUNT(*) AS cnt "
        . " FROM "
        . "      boards "
        . " WHERE "
        . "       deleted_at IS NULL "
        . "   AND notice = '1' ";

    $stmt = $conn->query($sql);
    $result = $stmt->fetch();

    return $result["cnt"];
}

/**
 * 공지사항 출력용
 */
function my_board_select_notice(PDO $conn) {
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
function my_tab_select_name(PDO $conn) {
    $sql =
        " SELECT "
        . "      id "
        . "      ,name "
        . " FROM "
        . "       board_tabs "
        . " WHERE "
        . "       deleted_at IS NULL "
        . " ORDER BY "
        . "          number ASC ";

    $stmt = $conn->query($sql);
    return $stmt->fetchAll();
}

/**
 * Edit Tab Update 처리
 */
function my_tab_update(PDO $conn, array $arr_param) {
    $sql =
        " UPDATE board_tabs "
        ." SET "
        ."      number = :number"
        ."     ,name = :name"
        ."     ,updated_at = NOW() "
        ." WHERE "
        ."          id = :id "
    ;

    $stmt = $conn->prepare($sql);
    
    if(!$stmt->execute($arr_param)) {
        throw new Exception("Update Query Error : board_tabs");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Update Count Error : board_tabs");
    }

    return true;

}

/**
 * Pcons select Name 처리
 */
function my_pcon_select_name(PDO $conn) {
    $sql =
        " SELECT "
        . "      name "
        . " FROM "
        . "      pcons "
        . " WHERE "
        . "       deleted_at IS NULL "
        . " ORDER BY "
        . "          id ASC ";

    $stmt = $conn->query($sql);
    return $stmt->fetchAll();
}

/**
 * borders Insert 처리
 */
function my_board_insert(PDO $conn, array $arr_param) {

    $sql = 'SET foreign_key_checks = 0'; // 냠냠
    $conn->query($sql);

    $sql = 
        " INSERT INTO boards ( "
        ."          title "
        ."          ,content ";
    
    if(isset($arr_param["tab_id"])) {
        $sql .= "   ,tab_id   ";
    }

    if(isset($arr_param["pcon_id"])) {
        $sql .= "   ,pcon_id   ";
    }

    $sql .= " ) "
        ." VALUES ( "
        ."          :title "
        ."          ,:content ";

    if(isset($arr_param["tab_id"])) {
        $sql .= "   ,:tab_id   ";
    }

    if(isset($arr_param["pcon_id"])) {
        $sql .= "   ,:pcon_id   ";
    }

    $sql .= " ) ";
    ;

    $stmt = $conn->prepare($sql);
    
    if(!$stmt->execute($arr_param)) {
        throw new Exception("Insert Query Error : boards");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Insert Count Error : boards");
    }

    return true;
}

/**
 * boards update 처리
 */
function my_board_update(PDO $conn, array $arr_param) {
    $sql =
        " UPDATE boards "
        ." SET "
        ."      title = :title"
        ."     ,content = :content"
        ."     ,updated_at = NOW() ";
        
    if(isset($arr_param["tab_id"])) {
        $sql .= "   ,tab_id = :tab_id   ";
    }

    if(isset($arr_param["pcon_id"])) {
        $sql .= "   ,pcon_id = :pcon_id ";
    }

        $sql .=  " WHERE "
                ."       id = :id ";

    $stmt = $conn->prepare($sql);
    
    if(!$stmt->execute($arr_param)) {
        throw new Exception("Update Query Error : boards");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Update Count Error : boards");
    }

    return true;
}

/**
 * boards delete update 처리
 */
function my_board_delete(PDO $conn, array $arr_param) {
    $sql =
        " UPDATE boards "
        ." SET "
        ."     updated_at = NOW() "
        ."     ,deleted_at = NOW() "
        ." WHERE "
        ."       id = :id "
    ;

    $stmt = $conn->prepare($sql);
    
    if(!$stmt->execute($arr_param)) {
        throw new Exception("Delete Query Error : boards");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Delete Count Error : boards");
    }

    return true;
}

/**
 * borders Detail Select 처리
 */
function my_board_select_id(PDO $conn, array $arr_param) {
    $sql =
        " SELECT "
        ."       * "
        ." FROM "
        ."      boards "
        ." WHERE "
        ."      id = :id "
        ."  AND deleted_at IS NULL "
    ;

    $stmt = $conn->prepare($sql);
    
    if(!$stmt->execute($arr_param)) {
        throw new Exception("ID Selete Query Error : boards");
    }

    return $stmt->fetch();
}


/**
 * 디테일 전환 작업 업데이트
 */
function my_board_work_update(PDO $conn, array $arr_param) {
    $sql =
        " UPDATE boards "
        ." SET "
        ."     bookmark = :bookmark "
        ."     ,notice = :notice "
        ."     ,updated_at = NOW() "
        ." WHERE "
        ."       id = :id "
    ;

    $stmt = $conn->prepare($sql);

    if(!$stmt->execute($arr_param)) {
        throw new Exception("Update Query Error : boards");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Update Count Error : boards");
    }

    return true;
}

/**
 * 조회수 올림 처리
 */
function my_board_view_update(PDO $conn, array $arr_param) {
    $sql =
        " UPDATE boards "
        ." SET "
        ."     view = view + 1 "
        // ."     ,updated_at = NOW() "
        ." WHERE "
        ."       id = :id ";

    $stmt = $conn->prepare($sql);

    if(!$stmt->execute($arr_param)) {
        throw new Exception("View Update Query Error : boards");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("View Update Count Error : boards");
    }

    return true;
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

// pcon_id를 써서 pcon name을 가져옴
function my_pcon_get_id_by_name(PDO $conn, string $name)
{
    $sql =
        " SELECT "
        . "      id "
        . " FROM "
        . "      pcons "
        . " WHERE "
        . "          name= " . "'".$name."' "
        . "      AND deleted_at IS NULL ";

    $stmt = $conn->query($sql);
    return $stmt->fetch();
}
