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

        return new PDO(MY_MARIADB_DNS, MY_MARIADB_USER, MY_MARIADB_PASSWORD, $option);
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
        $result = $stmt->fetch(); // 결과 맨위 하나만, 또하면 그 다음거 하나, 
                                  // 하나만 가져오는걸 알수있을때 리소스 절약용으로 사용됨

        return $result["cnt"];
    }

    /**
     * borders Insert 처리
     */
    function my_board_insert(PDO $conn, array $arr_param) {
        $sql = 
            " INSERT INTO boards ( "
            ."          title "
            ."          ,content "
            ." ) "
            ." VALUES ( "
            ."          :title "
            ."          ,:content "
            ." ) "
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
     * boards Update 처리
     */
    function my_board_update(PDO $conn, array $arr_param) {
        $sql =
            " UPDATE boards "
            ." SET "
            ."     title = :title "
            ."     ,content = :content "
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
     * borders Delete 처리
     */
    function my_board_delete(PDO $conn, array $arr_param) {
        $sql = 
            " UPDATE boards "
            ." SET "
            ."     updated_at = NOW() "
            ."     ,deleted_at = NOW() "
            ." WHERE "
            ."       id = :id "
        ; // 소프트 딜리트

        $stmt = $conn->prepare($sql);
        
        if(!$stmt->execute($arr_param)) {
            throw new Exception("Delete Query Error : boards");
        }

        if($stmt->rowCount() !== 1) {
            throw new Exception("Delete Query Error : boards");
        }

        return true;
    }