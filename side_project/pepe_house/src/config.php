<?php

/* Maria DB 설정 */
define("MY_MARIADB_HOST", "localhost");
define("MY_MARIADB_PORT", "3306");
define("MY_MARIADB_USER", "root");
define("MY_MARIADB_PASSWORD", "123123");
define("MY_MARIADB_NAME", "pepe_house");
define("MY_MARIADB_CHARSET", "utf8mb4");
define("MY_MARIADB_DSN", "mysql:host=" . MY_MARIADB_HOST . ";port=" . MY_MARIADB_PORT . ";dbname=" . MY_MARIADB_NAME . ";charset=" . MY_MARIADB_CHARSET);

/* PHP Path 설정 */
define("MY_PATH_ROOT", $_SERVER["DOCUMENT_ROOT"] . "/"); // web server document root
define("MY_PATH_DB_LIB", MY_PATH_ROOT . "lib/db_lib.php"); // DB 라이브러리
define("MY_PATH_ERROR", MY_PATH_ROOT . "error.php"); // Error page
define("MY_PATH_HEADER", MY_PATH_ROOT . "header.php"); // Header page
define("MY_PATH_FOOTER", MY_PATH_ROOT . "footer.php"); // Footer page
define("MY_PATH_MODEL_INDEX", MY_PATH_ROOT . "models/index.php"); // Model Index
define("MY_PATH_MODEL_CREATE", MY_PATH_ROOT . "models/create.php"); // Model Create
define("MY_PATH_MODEL_DETAIL", MY_PATH_ROOT . "models/detail.php"); // Model Detail
define("MY_PATH_MODEL_UPDATE", MY_PATH_ROOT . "models/update.php"); // Model Update
define("MY_PATH_MODEL_DELETE", MY_PATH_ROOT . "models/delete.php"); // Model Delete
define("MY_PATH_MODEL_EDIT_TAB", MY_PATH_ROOT . "models/edit_tab.php"); // Model Edit Tab


/* 로직 설정 */
define("MY_LIST_COUNT", 10); // 표시할 게시글 수
define("MY_PAGE_BUTTON_COUNT", 10); // 밑에 페이지 버튼수