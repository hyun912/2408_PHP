// 딜레이 모달용 변수
const modal = document.querySelector("#my-modal");
const modalImg = document.querySelector(".modal-img");

// form submit시 동작 함수
function chkDelayModal(event) {
  event.preventDefault(); // 일단 폼전송 멈춤

  // 이미지 생성
  const img = new Image();
  img.src = "./img/pcons/disappear_pepe.gif";

  // 모달 보여줌
  modal.style.display = "block";
  modalImg.appendChild(img); // 이미지 삽입

  // 딜레이 후 폼제출
  setTimeout(() => {
    event.target.submit();
  }, 3300);
}
