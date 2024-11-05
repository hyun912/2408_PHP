<?php

// 세션 시작 : 세션 시작 전에 출력처리가 있으면 안됨
session_start();
$_SESSION['test_session'] = '세션1';

// 세션 출력
echo $_SESSION['test_session'];

// 세션 삭제
session_destroy();