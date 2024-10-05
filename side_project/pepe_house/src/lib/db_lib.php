<?php

    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php"); // c://xampp/htdocs/config.php

    /**
     * DB Connection
     */
    function my_db_conn() {
        $option = [
            PDO::ATTR_EMULATE_PREPARES      => false
            ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
            ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
        ];

        return new PDO(MY_MARIADB_DSN, MY_MARIADB_USER, MY_MARIADB_PASSWORD, $option);
    }

    /**
     *  borders Select Pagination 처리 
     */
    function my_board_select_pagination(PDO $conn, array $arr_param) {
        $sql = 
            " SELECT "
            ."       * "
            ." FROM "
            ."      boards"
            ." WHERE "
            ."       deleted_at IS NULL "
            ." ORDER BY "
            ."          created_at DESC "
            ."          , id DESC"
            ." LIMIT :list_cnt OFFSET :offset "
        ;

        $stmt = $conn->prepare($sql);
        
        if(!$stmt->execute($arr_param)) {
            throw new Exception("Selete Query Error : boards");
        }

        return $stmt->fetchAll();
    }

    /**
     * borders Max Count 처리
     */
    function my_board_total_count(PDO $conn) {
        $sql = 
            " SELECT "
            ."       COUNT(*) AS cnt "
            ." FROM "
            ."       boards"
            ." WHERE "
            ."       deleted_at IS NULL "
        ;

        $stmt = $conn->query($sql);
        $result = $stmt->fetch();

        return $result["cnt"];
    }