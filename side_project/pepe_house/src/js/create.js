// 딜레이 모달용 변수
const modal = document.querySelector("#my-modal");
const modalImg = document.querySelector(".modal-img");

// 페페콘 변수
const pepeBody = document.querySelector(".pcon-body");
const pepeBtn = document.querySelector(".btn-icon-pepecon");
const pepeWindow = document.querySelector(".pcon-select-window");
const outSide = document.querySelector(".out-side");

// 내용 변수
const contentDiv = document.querySelector(".text-content");
const hideInput = document.querySelector("#hiddenContent");
const placeholder = document.querySelector(".placeholder");

// 이미지 처리 변수
const imagePcons = document.querySelectorAll(".pcon-image");

// 처음 로드 시 placeholder 상태 설정
chkPlaceholder();

// 모든 문단개행 처리를 div에서 p로 바꿈
document.execCommand("defaultParagraphSeparator", false, "p");

// 입력 영역이 비어 있으면 placeholder 표시
function chkPlaceholder() {
  if (contentDiv.innerHTML === "") {
    placeholder.style.display = "inline-block";
  } else {
    placeholder.style.display = "none";
  }
}

// 포커싱 될경우 플레이스홀더 숨김
function hidePlaceholder() {
  placeholder.style.display = "none";
}

// 페페콘 선택창 열기
function openWindow() {
  pepeBody.style.display = "flex";
  outSide.style.display = "flex";
}

// 외부 클릭시 닫을 함수
function outsideClick(event) {
  // if (event.target != pepeBtn || event.target != pepeWindow) {
  pepeBody.style.display = "none";
  outSide.style.display = "none";
  // }
}

// form submit시 동작 함수
function chkDelayModal(event) {
  event.preventDefault(); // 일단 폼전송 멈춤

  // hideInput.value = contentDiv.innerHTML;
  // console.log(hideInput.value);
  // event.target.submit();

  if (contentDiv.innerHTML === "") {
    // 내용이 비었으면
    alert("내용을 입력헤주세요."); // 경고문 출력
  } else {
    // 적은 내용을 숨겨진 input에 담음
    hideInput.value = contentDiv.innerHTML;

    // 이미지 생성
    const img = new Image();
    img.src = "/img/pcons/coming_pepe.gif";

    // 모달 보여줌
    modal.style.display = "block";
    modalImg.appendChild(img); // 이미지 삽입

    // 3초(3000ms) 딜레이 후 폼제출
    setTimeout(() => {
      event.target.submit();
    }, 3000);
  }
}

// 포커스 위치에 이미지를 삽입하는 함수
function insertAtCaret(el, img) {
  el.focus();
  const span = document.createElement("span"); // span 생성
  const selection = window.getSelection();
  const range = selection.getRangeAt(0);

  span.appendChild(img); // span 내부에 이미지 삽입
  range.insertNode(span); // 다 넣은걸 투입
  range.insertNode(document.createTextNode(" ")); // 이미지 옆에 공백을 추가해 문자 입력 가능하게
  range.collapse(false); // 커서를 이미지 뒤로 이동
  selection.removeAllRanges(); // 드래그 상태 해제
  selection.addRange(range); // 새로운 범위 설정
}

imagePcons.forEach((pcon) => {
  pcon.addEventListener("click", () => {
    const img = document.createElement("img");
    img.src = pcon.src; // 경로 삽입
    img.style.width = "100px"; // 이미지 크기 고정
    img.style.height = "100px";
    img.style.display = "inline-block"; // 이미지를 인라인 블록으로 설정

    // 포커스된 위치에 이미지 삽입
    insertAtCaret(contentDiv, img);
  });
});

contentDiv.addEventListener("focus", hidePlaceholder); // 포커싱하면 홀더 사라짐
contentDiv.addEventListener("blur", chkPlaceholder); // 포커스 때면 내용 비었는지 검사

pepeBtn.addEventListener("click", openWindow); // 아이콘 클릭 이벤트
// window.addEventListener("click", outsideClick); // 외부 클릭 이벤트
outSide.addEventListener("click", outsideClick); // 외부 클릭 이벤트
