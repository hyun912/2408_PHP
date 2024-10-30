////////////
// 이벤트 //
///////////
//

function inlineEventBtn() {
  alert("띠용");
}

function changeTitle() {
  const TITLE = document.querySelector("h1");
  TITLE.classList.add("title-click");
}

//
//////////////////////////////////////
// .addEventListener("이벤트", 콜백) //
//////////////////////////////////////
// 이벤트 설정
const BTN_LISTENER = document.querySelector("#btn1");
BTN_LISTENER.addEventListener("click", callAlert);

function callAlert() {
  alert("running to event listener");
}

const BTN_TOGGLE = document.querySelector("#btn_toggle");
BTN_TOGGLE.addEventListener("click", () => {
  const TITLE = document.querySelector("h1");
  TITLE.classList.toggle("title-click");
});

//
/////////////////////////////////////////
// .removeEventListener("이벤트", 콜백) //
/////////////////////////////////////////
// 이벤트 삭제
BTN_LISTENER.removeEventListener("click", callAlert);

const H2 = document.querySelector("h2");
H2.addEventListener(
  "click",
  testyong
  // ,{ once: true } // 옵션, 한번만 실행
);

function testyong() {
  alert("test only");
}

const TITLE = document.querySelector("h1");
TITLE.addEventListener("mouseenter", () => {
  H2.removeEventListener("click", testyong);
});

//
/////////////////
// 이벤트 객체 //
////////////////
//
const H3 = document.querySelector("h3");
H3.addEventListener("mouseup", e => {
  // console.log(e);
  e.target.style.color = "red";
});
H3.addEventListener("mousedown", e => {
  e.target.style.color = "green";
});

//
/////////////////////////////////////////
// 모달 //
/////////////////////////////////////////
//
const BTN_MODAL = document.querySelector("#btn_modal");
BTN_MODAL.addEventListener("click", () => {
  const MODAL = document.querySelector(".modal-container");
  MODAL.classList.remove("display-none");
});

const MODAL = document.querySelector(".modal-container");
MODAL.addEventListener("click", e => {
  e.target.classList.add("display-none");
});

const MODAL_CLOSE = document.querySelector("#modal_close");
MODAL_CLOSE.addEventListener("click", () => {
  const MODAL = document.querySelector(".modal-container");
  MODAL.classList.add("display-none");
});

//
//////////
// 팝업 //
//////////
//
const NAVER = document.querySelector("#naver");
NAVER.addEventListener("click", () => {
  open("https://www.naver.com", "", "width=500 height=500");
});
