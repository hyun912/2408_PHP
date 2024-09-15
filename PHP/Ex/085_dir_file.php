<?php

/* #폴더 생성 */
   $mkdir_result = mkdir("./my_dir");

   if($mkdir_result) {
        // 정상 처리
   }else {
        // 비정상
   }

   //-------------//
/* #(폴더) 존재 유무 체크 */
   $chk_result = is_dir("./my_dir");

   echo $chk_result ? "있음" : "없음";

   echo "\n\n";

   //-------------//
/* #(폴더) 열기, 읽기 */
   $open_result = opendir("./my_dir");

   while($file = readdir($open_result)) { // readdir은 한번에 하나만 읽어오므로 끝파일까지 읽기위해 반복돌려야됨
        echo $file."\n";
   }

   echo "\n";

   //-------------//
/* #(폴더) 닫기 */

   closedir($open_result);

   //-------------//
/* #(폴더) 삭제 */

   rmdir("./my_dir");


   //-------------//
/* #(파일) 열기 */
   $file = fopen("./my_dir/test.txt", "a"); // 쓰기 전용, 기존 내용 보존, 해당 파일이 없을경우 자동 생성

   if($file) {
        // 성공 처리
        fwrite($file, "떡볶이"); // 파일 쓰기
   }else {
        // 실패 처리
        echo "파일 열기 실패";
   }

   //-------------//
/* #(파일) 닫기 */

   fclose($file);

   //-------------//
/* #(파일) 삭제 */

   unlink("./my_dir/test.txt");

