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

// 즉시실행함수 IIFE : 로드되자마자 딱 한번 실행, 리소스 관리면에서 유용
(() => {
  const BTN_INFO = document.querySelector("#btn");
  const CONTAINER = document.querySelector(".container");
  const BOX = document.querySelector(".box");

  // 1.`버튼` 클릭시 아래 문구 알러트로 출력
  BTN_INFO.addEventListener("click", () => {
    alert("안녕하세요.\n숨어있는 div를 찾아주세요.");
  });

  // 2. 숨어있는 div에 마우스가 진입하면 아래 문구 알러트 출력
  CONTAINER.addEventListener("mouseenter", alertDoki);

  // 3. 숨어있는 div를 마우스로 클릭하면 아래 문구 알러트 출력 및 나타나기
  BOX.addEventListener("click", busted);

  // 초기 위치 랜덤 설정
  randomMove();
})();

function alertDoki() {
  alert("두근두근");
}

function busted() {
  alert("들켰다");
  const CONTAINER = document.querySelector(".container");
  const BOX = document.querySelector(".box");

  BOX.removeEventListener("click", busted); // 들켰다 삭제
  // 5. 나타난 div를 다시 클릭하면 아래 문구 알러트 출력 및 사라지기
  BOX.addEventListener("click", hide); // 숨는다 부여
  BOX.classList.remove("bcolor-trans"); // 안쪽 투명 제거

  // 4. 들킨 div에는 마우스가 진입해도 두근두근이 뜨지 않는다
  CONTAINER.removeEventListener("mouseenter", alertDoki); // 두근두근 제거
  CONTAINER.classList.remove("bcolor-trans"); // 바깥쪽 투명 제거
}

function hide() {
  alert("숨는다");
  const CONTAINER = document.querySelector(".container");
  const BOX = document.querySelector(".box");

  BOX.removeEventListener("click", hide); // 숨는다 제거
  BOX.addEventListener("click", busted); // 들켰다 부여
  BOX.classList.add("bcolor-trans"); // 안쪽 투명 부여

  // 6. 다시 숨은 div에 마우스가 진입하면 아래 문구 알러트 출력
  CONTAINER.addEventListener("mouseenter", alertDoki); // 두근두근 부여
  CONTAINER.classList.add("bcolor-trans"); // 바깥쪽 투명 부여

  // 7. 다시 숨을 때 랜덤 한 위치로 이동
  randomMove();
}

function randomMove() {
  const CONTAINER = document.querySelector(".container");
  const RANDOM_X = Math.round(Math.random() * (innerWidth - CONTAINER.offsetWidth)); // 웹뷰포트 넓이 - 바깥쪽 넓이
  const RANDOM_Y = Math.round(Math.random() * (innerHeight - CONTAINER.offsetHeight)); // 웹뷰포트 높이 - 바깥쪽 높이

  CONTAINER.style.left = RANDOM_X + "px";
  CONTAINER.style.top = RANDOM_Y + "px";
}

// const BTN = document.querySelector("#btn");
// const CONTAINER = document.querySelector(".container");
// const BOX = document.querySelector(".box");

// onload = randomHide;

// function randomHide() {
//   const CONTAINER = document.querySelector(".container");

//   let x = Math.floor(Math.random() * 85) + 1;
//   let y = Math.floor(Math.random() * 85) + 1;
//   CONTAINER.style.left = x + "%";
//   CONTAINER.style.top = y + "%";
// }

// BTN.addEventListener("click", () => {
//   alert("안녕하세요.\n숨어있는 div를 찾아주세요.");
// });

// CONTAINER.addEventListener("mouseenter", alertDoki);

// BOX.addEventListener("click", () => {
//   let dis = BOX.classList.contains("bcolor-trans");

//   if (dis === true) {
//     alert("들켰다");
//     CONTAINER.removeEventListener("mouseenter", alertDoki);
//     BOX.classList.remove("bcolor-trans");
//     CONTAINER.classList.remove("bcolor-trans");
//   } else {
//     alert("숨는다");
//     CONTAINER.addEventListener("mouseenter", alertDoki);
//     BOX.classList.add("bcolor-trans");
//     CONTAINER.classList.add("bcolor-trans");
//     randomHide();
//   }
// });
