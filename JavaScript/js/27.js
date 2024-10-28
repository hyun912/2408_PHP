//////////
// 배열 //
//////////
//

const ARR1 = [1, 2, 3, 4, 5];

// push(삽입값) : 뒤에 새로 추가, 리턴하면 추가후의 길이를 반환시킴
ARR1.push(10);

// .length : 길이 획득
console.log(ARR1.length);

// Array.isArray(체크값) : 배열인지 아닌지 확인
console.log(Array.isArray(ARR1));