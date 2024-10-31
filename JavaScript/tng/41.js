// 현재시간을 12시간 기준으로 표시
// 멈추는 버튼과 재시작 버튼
// 멈추는 버튼을 누르면 시간이 멈춤
// 재시작을 누르면 현재 시간을 기준으로 다시 시작함
// -- 보너스 --
// 기록과 리셋 버튼을 만듬
// 기록 버튼을 누르면 그 누른 시간을 아래에 출력함
// - n번째 : 시간
// 리셋 버튼을 누르면 기록 텍스트들 모두 지워짐

(() => {
  const BTN_STOP = document.querySelector("#btn_stop");
  const BTN_RESTART = document.querySelector("#btn_restart");
  const BTN_RECODE = document.querySelector("#btn_recode");
  const BTN_RESET = document.querySelector("#btn_reset");
  const SPAN = document.querySelector("#time");
  let TEXT = () => (SPAN.textContent = setTimeVal());
  let TIMER = setInterval(TEXT, 100);

  TEXT();

  BTN_STOP.addEventListener("click", () => clearInterval(TIMER));
  BTN_RESTART.addEventListener("click", () => (TIMER = setInterval(TEXT, 100)));
  BTN_RECODE.addEventListener("click", () => getTimeRecode(setTimeVal()));
  BTN_RESET.addEventListener("click", () => resetRecode());
})();

function toNumbers(num, len) {
  return String(num).padStart(len, "0");
}

// 시간 텍스트 함수
function setTimeVal() {
  const NOW = new Date();
  const HOUR = toNumbers(NOW.getHours(), 2);
  const MINUTES = toNumbers(NOW.getMinutes(), 2);
  const SECOND = toNumbers(NOW.getSeconds(), 2);

  let am_pm = "오전";
  let hour = HOUR;

  if (HOUR >= 12) {
    am_pm = "오후";

    if (HOUR > 12) {
      hour = toNumbers(HOUR - 12, 2);
    }
  }

  return `${am_pm} ${hour}:${MINUTES}:${SECOND}`;
}

// 기록 함수
function getTimeRecode(time) {
  const UL = document.querySelector("ul");
  const LI = document.createElement("li");
  const NUM = UL.childElementCount + 1;

  LI.textContent = `${NUM}번째 : ${time}`;
  UL.appendChild(LI);
}

// 리셋 함수
function resetRecode() {
  const UL = document.querySelector("ul");
  UL.textContent = "";
}
