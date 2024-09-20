<?php
    // $stdin = fopen('php://stdin', 'r');
    // $fileContents = fread($stdin, 1024);
    // fclose($stdin);

    // echo $fileContents;

    // 가위바위보
    // 실행시 가위 바위 보 선택
    // 컴은 랜덤 하나선택
    
    // 출력
    // 유저 : 가위
    // 컴   : 바위
    //    win or lose or draw


    fscanf(STDIN, "%s\n", $input);

    $text = ["scissors", "rock", "paper"];
    $user_num = array_search($input, $text);
    $bot_num = random_int(0, 2);

    if($user_num === false){
        $result = "엉뚱한걸 입력하셨네요.";
    } else {
        $ba_num = $user_num - $bot_num;

        if($user_num === $bot_num) {  
            $result = "비겼습니다.";
        } elseif($ba_num === 1 || $ba_num === -2) { 
            $result = "이겼습니다.";
        } elseif($ba_num === -1 || $ba_num === 2) { 
            $result = "졌습니다.";
        }
    }

    echo "유저 : ".$input."\n"
         ."상대 : ".$text[$bot_num]."\n"
         .$result."\n"
    ;
