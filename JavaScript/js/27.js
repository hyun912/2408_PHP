//////////
// 배열 //
//////////
//

const ARR1 = [1, 2, 3, 4, 5];
// console.log(ARR1);

//
/////////////////
// push(삽입값) //
/////////////////
// 뒤에 새로운값 추가
// 리턴하면 추가후의 길이를 반환시킴
// 원본에서 변경됨, 한번에 여러개도 가능
ARR1.push(10);
// 성능이슈 발생시 길이를 이용해 직접 요소 추가
ARR1[ARR1.length] = 100;

//
/////////////
// .length //
/////////////
// 해당 배열의 길이 획득
console.log(ARR1.length);

//
///////////////////////////
// Array.isArray(체크값) //
//////////////////////////
// 배열인지 아닌지 확인
console.log(Array.isArray(ARR1)); // true
console.log(Array.isArray(1)); // false

//
////////////////////
// indexOf(찾을값) //
////////////////////
// 배열 요소 검색, key값 반환, 해당값이 없으면 -1
let i = ARR1.indexOf(4);
console.log(i);

//
/////////////////////
// includes(찾을값) //
/////////////////////
// 배열 요소 존재여부 체크, true or false 반환
let arr1 = ["홍길동", "갑돌이", "갑순이"];
let boo = arr1.includes("갑순이");
console.log(boo);

//
//////////////
// 배열 복사 //
//////////////
// 이퀄로 가져오는건 값을 가져오는게 아니라 주소값을 가져와 참조하는 식
// 그래서 겉으론 복사지만 값을 새로 넣으면 원본값도 같이 바뀌어버림
// ↗이걸 얕은 복사(shalow copy)라고 함
const COPY_ARR1 = ARR1;
COPY_ARR1[COPY_ARR1.length] = 9999;

// **원본 자체를 복사하고 싶으면 깊은 복사(deep copy)를 해야함
// 그러기 위해서는 스프레드 오퍼레이터(spread operator)를 이용함
const COPY_ARR2 = [...ARR1];
COPY_ARR2[COPY_ARR2.length] = 8888;

//
///////////
// pop() //
///////////
// 원본의 마지막 요소 제거, 제거된 요소 반환, 원본변경
// 제거 요소가 없으면 undefined 반환
const ARR_POP = [1, 2, 3, 4, 5];
let resutPop = ARR_POP.pop();
// ARR_POP.length -= 1;
console.log(resutPop);

//
//////////////////////
// unshift(추가할값) //
//////////////////////
// 원본 배열 첫번째 요소 추가, 변경된 길이 반환, 원본변경
const ARR_UNSHIFT = [1, 2, 3];
let resultUnshift = ARR_UNSHIFT.unshift(100);
console.log(resultUnshift);
ARR_UNSHIFT.unshift(200, 333, 444); // 여러개도 가능

//
/////////////
// shift() //
/////////////
// 원본 배열 첫번째 요소 제거, 제거 요소 반환, 원본변경
// 제거 요소 없을시 undefined 반환
const ARR_SHIFT = [1, 2, 3, 4];
let resultShift = ARR_SHIFT.shift();
console.log(resultShift);

//
////////////////////////////////
// splice(시작번호, 자를 갯수) //
///////////////////////////////
// 요소를 잘라 반환, 원본변경
let arrSplice = [1, 2, 3, 4, 5];
let resultSplice = arrSplice.splice(2);
console.log(arrSplice); // [1, 2]

// 시작을 음수로 할 경우
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(-2);
console.log(arrSplice); // [1, 2, 3]

// 시작과 갯수를 모두 지정 할 경우
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(1, 2);
console.log(arrSplice); // [1, 4, 5]
console.log(resultSplice); // [2, 3]

// 배열 특정 위치에 새 요소 추가
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(2, 0, 999); // 3번째부턴 추가할거 계속 적을수 있음
console.log(arrSplice); // [1, 2, 999, 3, 4, 5]
console.log(resultSplice); // []

// 배열 특정 요소를 새 요소로 변경
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(2, 1, 999);
console.log(arrSplice); // [1, 2, 999, 4, 5]
console.log(resultSplice); // [3]

//
//////////////////
// join(구분자) //
/////////////////
// 배열 특정 구분자로 연결한 문자열 반환
let arrJoin = [1, 2, 3, 4];
let resultJoin = arrJoin.join(", ");
console.log(arrJoin); // [1, 2, 3, 4]
console.log(resultJoin); // 1, 2, 3, 4

//
////////////
// sort() //
////////////
// 배열 요소 오름차순 정렬
// 파라미터 없을경우, 문자열로 변환 후 정렬
let arrSort = [5, 6, 7, 3, 2, 20];
// let resultSort = arrSort.sort();
// console.log(arrSort); // 원본도 바뀌기 때문에 주의
// console.log(resultSort); // [2, 20, 3, 5, 6, 7]

// 문자열이 아닌 숫자로 정렬하고 싶을 경우, 순수 숫자 배열은 보기힘듬
let resultSort = arrSort.sort((a, b) => a - b); // 오름차순, 음수면 안바꾸고 양수면 순서 바꾸게
// let resultSort = arrSort.sort((a, b) => b - a); // 내림차순
console.log(arrSort); // [2, 3, 5, 6, 7, 20]
console.log(resultSort);

//
///////////
// map() //
///////////
// 배열 모든 요소에 대해 콜백 함수 반복 실행후, 결과를 새 배열로 반환
// foreach와 방식이 비슷함
let arrMap = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let resultMap = arrMap.map(num => {
  if (num % 3 === 0) {
    return "짝";
  } else {
    return num;
  }
});
console.log(arrMap); // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
console.log(resultMap); // [1, 2, '짝', 4, 5, '짝', 7, 8, '짝', 10]

// map의 기본 구조
const TEST = {
  entity: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
  length: 10,
  map: function (callback) {
    let resultArr = [];

    for (let i = 0; i < this.entity.length; i++) {
      resultArr[resultArr.length] = callback(this.entity[i]);
    }
    return resultArr;
  }
};

let resultTest = TEST.map(num => {
  if (num % 3 === 0) {
    return "짝";
  } else {
    return num;
  }
});
console.log(resultTest);

// **자주 쓰이는 아래 4가지↓

//
////////////////////
// filter(조건식) //
///////////////////
// 배열의 모든 요소에 콜백 함수를 반복 실행, 만족한 요소만 배열 반환
let arrFilter = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let resultFilter = arrFilter.filter(num => num % 3 === 0); // if처리할경우 리턴을 true or false로
console.log(resultFilter); // [3, 6, 9]

//
//////////////////
// some(조건식) //
/////////////////
// 배열의 모든 요소에 콜백 함수를 반복 실행
// 조건에 만족하면 true, 하나도 없으면 false
let arrSome = [1, 2, 3, 4, 5];
let resultSome = arrSome.some(num => num === 5); // 5가 있느냐
console.log(resultSome); // true

//
///////////////////
// every(조건식) //
//////////////////
// 배열의 모든 요소에 콜백 함수를 반복 실행
// 조건을 배열 전부 만족하면 true, 하나라도 틀리면 false
let arrEvery = [1, 2, 3, 4, 5];
let resultEvery = arrEvery.every(num => num === 5); // 전부다 5냐
console.log(resultEvery); // false

//
/////////////////////
// foreach(조건식) //
////////////////////
// 배열의 모든 요소에 콜백 함수를 반복 실행
let arrForeach = [1, 2, 3, 4, 5];
arrForeach.forEach((val, key) => {
  // console.log(key + ' : ' + val);
  console.log(`${key} : ${val}`);
});
