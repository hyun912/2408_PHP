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
  // const BTN_STOP = document.querySelector("#btn_stop");
  // const BTN_RESTART = document.querySelector("#btn_restart");
  // const BTN_RECODE = document.querySelector("#btn_recode");
  // const BTN_RESET = document.querySelector("#btn_reset");
  // const SPAN = document.querySelector("#time");

  let timeText = () => (document.querySelector("#time").textContent = getDate());
  let intervalId = null;

  timeText(); // 바로 뜨게
  intervalId = setInterval(timeText, 500);

  document.querySelector("#btn_stop").addEventListener("click", () => {
    clearInterval(intervalId);
    intervalId = null;
  });
  document.querySelector("#btn_restart").addEventListener("click", () => {
    if (intervalId === null) {
      timeText(); // 바로 갱신되게
      intervalId = setInterval(timeText, 500);
    }
  });
  document.querySelector("#btn_recode").addEventListener("click", () => getTimeRecode(getDate()));
  document.querySelector("#btn_reset").addEventListener("click", () => resetRecode());
})();

function leftPadZero(num, len) {
  return String(num).padStart(len, "0");
}

// 시간 텍스트 함수
function getDate() {
  const NOW = new Date(); // 데이터 객체 인스턴스
  const HOUR = NOW.getHours();
  const MINUTES = NOW.getMinutes();
  const SECOND = NOW.getSeconds();

  let ampm = HOUR >= 12 ? "오후" : "오전";
  let hour = HOUR !== 0 ? HOUR : 12;

  if (HOUR > 12) {
    // 오후 01시 ~ 11시
    hour = HOUR - 12;
  }

  return `${ampm} ${leftPadZero(hour, 2)}:${leftPadZero(MINUTES, 2)}:${leftPadZero(SECOND, 2)}`;
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
