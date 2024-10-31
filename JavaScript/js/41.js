////////////////
// 타이머 함수 //
////////////////
//

////////////////////////////
// setTimeout(콜백, ms초) //
///////////////////////////
// 일정 시간이 흐른 후 콜백 실행
// 주의점. 순차가 아니라 일괄실행(비동기 처리)
// setTimeout(() => {
//   console.log("5초 경과");
// }, 5000);

// C > B > A
// setTimeout(() => console.log("A"), 3000);
// setTimeout(() => console.log("B"), 2000);
// setTimeout(() => console.log("C"), 1000);

// A > B > C 동기처럼 처리
// setTimeout(() => {
//   console.log("A");
//   setTimeout(() => {
//     console.log("B");
//     setTimeout(() => {
//       console.log("C");
//     }, 1000);
//   }, 2000);
// }, 3000);

//
/////////////////////////////
// clearTimeout(타이머 ID) //
////////////////////////////
// 해당 타이머ID 제거
const TIMER_ID = setTimeout(() => console.log("timer"), 10000);
clearTimeout(TIMER_ID);

//
/////////////////////////////
// clearTimeout(타이머 ID) //
////////////////////////////
// 일정 시간마다 반복 실행
const INTERVAL_ID = setInterval(() => {
  console.log("interval");
}, 1000);

//
/////////////////////////////
// clearTimeout(타이머 ID) //
////////////////////////////
// 해당 ID 인터벌 제거
clearInterval(INTERVAL_ID);

// HTML 없이 두둥등장 띄워 빨 파
(() => {
  const H1 = document.createElement("h1");
  H1.textContent = "두둥등장";
  H1.classList.add("blue");
  H1.style.fontSize = "4rem";
  document.body.appendChild(H1);
})();

setInterval(() => {
  const H1 = document.querySelector("h1");
  // H1.classList.toggle("blue");
  H1.classList.toggle("red");
}, 200);
