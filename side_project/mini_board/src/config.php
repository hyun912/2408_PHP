<?php

/* Maria DB 설정 */
define("MY_MARIADB_HOST", "localhost");
define("MY_MARIADB_PORT", "3306");
define("MY_MARIADB_USER", "root");
define("MY_MARIADB_PASSWORD", "123123");
define("MY_MARIADB_NAME", "mini_board");
define("MY_MARIADB_CHARSET", "utf8mb4");
define("MY_MARIADB_DSN", "mysql:host=".MY_MARIADB_HOST.";port=".MY_MARIADB_PORT.";dbname=".MY_MARIADB_NAME.";charset=".MY_MARIADB_CHARSET);

/* PHP Path 설정 */
define("MY_PATH_ROOT", $_SERVER["DOCUMENT_ROOT"]."/"); // web server document root
define("MY_PATH_DB_LIB", MY_PATH_ROOT."lib/db_lib.php"); // DB 라이브러리


/* 로직 설정 */
define("MY_LIST_COUNT", 5);