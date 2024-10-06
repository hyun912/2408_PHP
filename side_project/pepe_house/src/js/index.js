// 게시글 썸네일 불러오기용 함수
function loadThumb(id, name) {
  // board_id, pcon_name
  // 해당 번호의 css 배경을 이름에 맞게 경로에 맞춰서 넣음
  $('#thumb-' + id).css('background-image', "url('./img/pcons/" + name + "')");
}
