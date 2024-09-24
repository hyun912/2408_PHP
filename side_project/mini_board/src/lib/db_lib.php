<?php

    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");

    function my_db_conn() {
        $option = [
            PDO::ATTR_EMULATE_PREPARES      => false
            ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
            ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
        ];

        return new PDO(MY_MARIADB_DSN, MY_MARIADB_USER, MY_MARIADB_PASSWORD, $option);
    }

    function my_board_select_pagination($conn, array $arr_param) {
        $sql = 
            " SELECT "
            ."       * "
            ." FROM "
            ."      boards"
            ." ORDER BY "
            ."          created_at DESC "
            ."          , id DESC"
            ." LIMIT :list_cnt OFFSET :offset "
        ;

        $stmt = $conn->prepare($sql);
        
        if(!$stmt->execute($arr_param)) {
            throw new Exception("Query Failed Error : Boards");
        }

        return $stmt->fetchAll();
    }