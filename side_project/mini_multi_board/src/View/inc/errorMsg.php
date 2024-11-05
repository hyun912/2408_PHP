
<div id="errMsg" class="form-text text-danger">
  <?php
    echo implode('<br>', $this->arrErrorMsg); // 처리가 아직 컨트롤러 안에서 이루어지고 있기에 this 가능
  ?>
</div>