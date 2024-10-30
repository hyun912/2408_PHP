// 1.`버튼` 클릭시 아래 문구 알러트로 출력
// 	안녕하세요.
// 	숨어있는 div를 찾아주세요.
// 2. 숨어있는 div에 마우스가 진입하면 아래 문구 알러트 출력
// 	- 두근두근
// 3. 숨어있는 div를 마우스로 클릭하면 아래 문구 알러트 출력 및 나타나기
// 	- 들켰다
// 4. 들킨 div에는 마우스가 진입해도 두근두근이 뜨지 않는다
// 5. 나타난 div를 다시 클릭하면 아래 문구 알러트 출력 및 사라지기
// 	- 숨는다
// 6. 다시 숨은 div에 마우스가 진입하면 아래 문구 알러트 출력
//  - 두근두근
// -- 보너스 문제 --
// 다시 숨을 때 랜덤 한 위치로 이동

const BTN = document.querySelector("#btn");
const MODEL = document.querySelector(".modal-container");
const ITEM = document.querySelector(".modal-item");

onload = randomHide;

function randomHide() {
  let x = Math.floor(Math.random() * 85) + 1;
  let y = Math.floor(Math.random() * 85) + 1;
  MODEL.style.left = x + "%";
  MODEL.style.top = y + "%";
  // console.log(x + ", " + y);
}

BTN.addEventListener("click", () => {
  alert("안녕하세요.\n숨어있는 div를 찾아주세요.");
});

MODEL.addEventListener("mouseenter", alertDoki);

function alertDoki() {
  alert("두근두근");
}

ITEM.addEventListener("click", () => {
  let dis = ITEM.classList.contains("display-none");

  if (dis === true) {
    alert("들켰다");
    MODEL.removeEventListener("mouseenter", alertDoki);
    ITEM.classList.remove("display-none");
    MODEL.classList.remove("display-none");
  } else {
    alert("숨는다");
    MODEL.addEventListener("mouseenter", alertDoki);
    ITEM.classList.add("display-none");
    MODEL.classList.add("display-none");
    randomHide();
  }
});
