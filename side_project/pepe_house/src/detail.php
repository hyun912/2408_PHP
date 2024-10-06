<?php 
  require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");
  require_once(MY_PATH_DB_LIB);

  require_once(MY_PATH_MODEL_DETAIL);
?>

<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/common.css" />
    <link rel="stylesheet" href="/css/detail.css" />

    <title>제목</title>
  </head>
  <body>

      <?php require_once(MY_PATH_HEADER) ?>

      <!-- 중앙 컨테이너 DIV -->
      <div class="container">
        <div class="head">
          <!-- 탑 버튼 영역 DIV -->
          <div class="head-top">
            <!-- 좌측 버튼 영역 DIV -->
            <div class="head-top-left">
              <!-- 전체글 버튼 DIV -->
              <form action="/detail.php" method="POST">
                <input type="hidden" name="id" value="<?php echo (int)$result["id"] ?>">

                <select name="work" class="btn-sm" required>
                  <option value="" selected>작업</option>
                  <?php if($result["bookmark"] !== '0' || $result["notice"] !== '0') { ?>
                    <option value="normal">일반</option>
                  <?php } 
                  if($result["bookmark"] !== '1') { ?>
                    <option value="bookmark">즐겨찾기</option>
                  <?php } 
                  if($result["notice"] !== '1' && (int)my_board_notice_total_count($conn) < 4) { ?>
                    <option value="notice">공지사항</option>
                  <?php } ?>
                </select>

                <button type="submit" class="btn btn-sm">전환</button>
              </form>
            </div>

            <!-- 우측 버튼 영역 DIV -->
            <div class="head-top-right">
              <!-- 수정 버튼 DIV-->
              <a href="/update.php?no=<?php echo (int)$result["id"] ?>" class="btn btn-sm btn-mr">
                <span class="btn-icons btn-icon-update"></span>
                수정
              </a>

              <!-- 삭제 버튼 DIV-->
              <a href="/delete.php?no=<?php echo (int)$result["id"] ?>" class="btn btn-sm">
                <span class="btn-icons btn-icon-delete"></span>
                철거
              </a>
            </div>
          </div>

          <!-- 타이틀 영역 -->
          <div class="title">
            <!-- 상단 제목 영역 DIV -->
            <div class="title-top">
              <?php if($result["tab_id"] !== 0) { ?>
                <span class="list-tab btn-mr">
                  <?php echo my_tab_get_name_by_id($conn, (int)$result["tab_id"])["name"] ?>
                </span>
              <?php } ?>
              <?php if($result["bookmark"] === '1') { ?>
                <span class="btn-icons btn-icon-bookmark btn-mr"></span>
              <?php } ?>
              <?php echo $result["title"] ?>
            </div>
            <!-- 하단 상세 영역 DIV -->
            <div class="title-bottom">
              <!-- 좌측 닉네임 영역 DIV -->
              <div class="title-bottom-left">
                <span class="btn-icons list-icon-title-stamp"></span>
                익명의 페페
              </div>

              <!-- 우측 나머지 상세 영역 DIV -->
              <div class="title-bottom-right">
                조회수 <?php echo $result["view"] ?> | 작성일 <?php echo date('Y-m-d', strtotime($result["created_at"])) ?> | 수정일 <?php echo date('Y-m-d', strtotime($result["updated_at"])) ?>
              </div>
            </div>
          </div>

          <div class="content">
            <?php echo $result["content"] ?>
          </div>
        </div>
      </div>

      <?php require_once(MY_PATH_FOOTER) ?>
</body>
</html>
