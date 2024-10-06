<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");
require_once(MY_PATH_DB_LIB);

require_once(MY_PATH_MODEL_UPDATE);
?>


<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/common.css" />
    <link rel="stylesheet" href="/css/create.css" />

    <title>입주한 페페의 내용을 바꿉니다</title>
  </head>
  <body>
    <div class="out-side"></div>

    <?php require_once(MY_PATH_HEADER) ?>

    <!-- 중앙 컨테이너 DIV -->
    <div class="container">
        <form
          action="/update.php"
          method="post"
          onsubmit="return chkDelayModal(event)"
        >
          <input type="hidden" name="id" value="<?php echo $result["id"] ?>" />
          <input type="hidden" name="content" id="hiddenContent" value="" />

          <!-- 탭 선택 영역 DIV -->
          <div class="main-middle">
            <div class="box box-select">
              <select name="tab_id">
                <option value="0">일반</option>
                <?php foreach ($result_tab as $item) { ?>
                  <option value="<?php echo $item['id'] ?>"<?php 
                    if($result["tab_id"] === $item['id']) { 
                      ?> selected    
                    <?php } ?>>
                    <?php echo $item["name"] ?>
                  </option>
                <?php } ?>
              </select>
            </div>

            <!-- 제목 영역 DIV -->
            <div class="box box-title">
              <input type="text" name="title" placeholder="제목" value="<?php echo $result["title"] ?>" required />
            </div>

            <!-- 내용 영역 DIV -->
            <div class="box box-content">
              <!-- 내용 위쪽 아이콘 영역 DIV -->
              <div class="text-icons">
                <span class="btn-icons btn-icon-pepecon"></span>
                <!-- 페페콘 팝업창 영역 DIV -->
                <div class="pcon-body">
                  <div class="pcon-select-window">
                    <?php foreach ($result_pcon as $item) { ?>
                      <img src="/img/pcons/<?php echo $item["name"] ?>" class="pcon-image" />
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- 내용글 영역 DIV -->
              <div class="content-area">
                <div class="text-content" contenteditable="true"><?php echo $result["content"] ?></div>
                <div class="placeholder">♚♚페페 하우스♚♚가입시$$전원 페페콘 증정☜☜페페의 친구들 무료 증정￥<br>특정조건 §§페페의 세계§§★힐링의 여정★페페 초상화획득 기회@@@<br>즉시이동 http://localhost<br><br>★페★페★의★세★상★ 20렙까지 무료$$$안전 운영☜☜10년 연속 인기 캐릭터<br>☏☎☏☎단골달성시♥페♥페♥의♥아이콘♥증정♬모험가/탐험가♬ ♂길드 시스템♂<br>지금 접속하기☞☞ http://localhost</div>
              </div>
            </div>
          </div>

          <!-- 하단 작성 버튼 DIV -->
          <div class="main-bottom">
            <button type="submit" class="btn btn-sm">수정</button>
          </div>
        </form>

    </div>


    <?php require_once(MY_PATH_FOOTER) ?>

  </body>
</html>

<script src="/js/update.js"></script>
