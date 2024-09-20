<?php
    
    require_once("../Ex/my_db.php");

    // 3명 신규 사원 한번에 추가
    // 하나가 실패할시 전부 롤백인지 아님 패스할건지는 따로 저장할곳이 있는지 상황에따라 다름

    $data = [
        ["name" => "둘리", "birth" => "1983-04-22", "gender" => "M" ]
        ,["name" => "희동이", "birth" => "1985-01-01", "gender" => "M" ]
        ,["name" => "고길동", "birth" => "1940-01-01", "gender" => "M" ]
    ];

    $conn = null;

    // 하나 실패시 전부 롤백하는 경우, 보통 이걸씀

    try {
        
        $conn = my_db_conn();

        $conn->beginTransaction();

        foreach($data as $item) {
            $sql = 
                " INSERT INTO employees( "
                ."       name "
                ."       ,birth "
                ."       ,gender "
                ."       ,hire_at "
                ." ) "
                ." VALUES( "
                ."       :name "
                ."       ,:birth "
                ."       ,:gender "
                ."       ,DATE(NOW()) "
                ." ) "
            ;

            $arr_prepare = [
                "name" => $item["name"]
                ,"birth" => $item["birth"]
                ,"gender" => $item["gender"]
            ];

            $stmt = $conn->prepare($sql);
    
            if(!$stmt->execute($arr_prepare)) {
                throw new Exception("Insert Query Error : employees");
            }
    
            if($stmt->rowCount() !== 1) {
                throw new Exception("Insert Count Error : employees");
            }
        }
    
        $conn->commit();

    }catch(Throwable $th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }

        echo $th->getMessage();
    }