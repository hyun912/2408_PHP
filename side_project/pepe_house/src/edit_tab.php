<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");
  require_once(MY_PATH_DB_LIB);

  require_once(MY_PATH_MODEL_EDIT_TAB);
?>

<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/common.css" />
    <link rel="stylesheet" href="./css/edit_tab.css" />
    <title>Document</title>
  </head>
  <body>

      <?php require_once(MY_PATH_HEADER) ?>

      <!-- 중앙 컨테이너 DIV -->
      <div class="container">
        <div class="mainWrapper">
          <?php foreach($result_tab as $item) { ?>
            <div class="element">
              <div class="leftSide">
                <div class="title">
                  <span class="tab-icon"></span>
                </div>
                <div class="description">
                  <input type="hidden" id="id" value="<?php echo $item['id'] ?>" />
                  <input type="text" id="name" value="<?php echo $item['name'] ?>" required />
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
        <div class="main-bottom">
          <form action="/edit_tab.php" method="POST" onsubmit="return chkFormSubmit(event)">
            <input type="hidden" name="save_tab" id="save_tab" value="" />
            <button type="submit" class="btn btn-sm">저장</button>
          </form>
        </div>
      </div>

      <?php require_once(MY_PATH_FOOTER) ?>
  </body>
</html>

<script src="./js/edit_tab.js"></script>
