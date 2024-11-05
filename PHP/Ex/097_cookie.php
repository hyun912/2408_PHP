<?php

// 쿠키 추가
setcookie('test_cookie', '마싯쪙', (time() + 3600));

// 쿠키 출력
echo $_COOKIE['test_cookie'];

// 쿠키 삭제
setcookie('test_cookie', '', 0);