///////////////
// Date 객체 //
///////////////
// 현재 날짜 획득
const NOW = new Date();

// 앞에 0 붙이기
const addLpadZero = (num, length) => {
  return String(num).padStart(length, "0");
};

//
///////////////////
// getFullYear() //
///////////////////
// 연도만 가져옴 (Y, yyyy)
const YEAR = NOW.getFullYear();

//
////////////////
// getMonth() //
////////////////
// 해당월 가져옴
// 근데 0 ~ 11 이라 +1 해줘야함
const MONTH = addLpadZero(NOW.getMonth() + 1, 2);

//
///////////////
// getDate() //
///////////////
// 해당일 가져옴
const DAY = addLpadZero(NOW.getDate(), 2);

//
////////////////
// getHours() //
////////////////
// 시를 가져옴 (24시간)
const HOUR = addLpadZero(NOW.getHours(), 2);

//
//////////////////
// getMinutes() //
//////////////////
// 분을 가져옴
const MINUTES = addLpadZero(NOW.getMinutes(), 2);

//
//////////////////
// getSeconds() //
//////////////////
// 초를 가져옴
const SECOND = addLpadZero(NOW.getSeconds(), 2);

//
///////////////////////
// getMilliseconds() //
///////////////////////
// ms초를 가져옴
const MILLISECONDS = addLpadZero(NOW.getMilliseconds(), 3);

//
//////////////
// getDay() //
//////////////
// 요일을 숫자로 가져옴
// 0(일) ~ 6(토)
const YOIL = NOW.getDay();

// 요일 한글 변환
const dayToKr = day => {
  const ARR_DAY = ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"];
  return ARR_DAY[day];
};

const FORMAT_DATE = `${YEAR}-${MONTH}-${DAY} ${HOUR}:${MINUTES}:${SECOND}.${MILLISECONDS} ${dayToKr(YOIL)}`;
console.log(FORMAT_DATE);

//
///////////////
// getTime() //
///////////////
// UNIX Timestamp 반환, ms초 단위
console.log(NOW.getTime());

// 두 날짜 차 구하기
// **많이 사용됨
// 1000 * 60 * 60 * 24 (일 단위, 올리면 오늘포함, 버리면 오늘 미포함) * 30 (월 단위)
const TARGET_DATE = new Date("2025-03-13 18:10:00");
const DIFF_DATE = Math.floor(Math.abs(NOW - TARGET_DATE) / 86400000);

//
// 2024-01-01 13:00:00 | 2025-05-30 00:00:00 몃개월 후?
const BEFORE = new Date("2024-01-01 13:00:00");
const AFTER = new Date("2025-05-30 00:00:00");
console.log(Math.floor(Math.abs(BEFORE - AFTER) / (1000 * 60 * 60 * 24 * 30)));
