<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");
  require_once(MY_PATH_DB_LIB);

  require_once(MY_PATH_MODEL_DELETE);
?>


<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/common.css" />
    <link rel="stylesheet" href="/css/delete.css" />

    <title>페페를 내쫒고 굴을 철거시킵니다</title>
  </head>
  <body>

      <?php require_once(MY_PATH_HEADER) ?>

      <!-- 중앙 컨테이너 DIV -->
      <div class="container">
        <form
          action="/delete.php"
          method="post"
          onsubmit="return chkDelayModal(event)"
        >
          <input type="hidden" name="id" value="<?php echo $result['id'] ?>">

          <div class="main-middle">
            <h2>페페굴 철거</h2>
            <p><?php echo $result["title"] ?></p>
            <p>
              철거시킨 굴은 다시 되돌릴수 없습니다. 정말로 철거시키겠습니까?
            </p>
            <div class="btn-bottom">
              <button type="submit" class="btn btm-sm">철거</button>
            </div>
          </div>
        </form>

        <!-- 딜레이용 모달 -->
        <div id="my-modal" class="modal">
          <div class="modal-content">
            <div class="modal-body">
              <div class="modal-section">
                <div class="modal-img"></div>
                <p>당신의 결정에 실망한 페페가 떠나갑니다</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php require_once(MY_PATH_FOOTER) ?>
  </body>
</html>

<script src="/js/delete.js"></script>
