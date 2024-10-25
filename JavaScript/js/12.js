////////////////
// 함수 선언식 //
////////////////
//
// 호이스팅 영향 O
// 재할당 O, 함수명 중복 주의

// console.log(mySum(4, 5));
function mySum(a, b) {
	return a + b;
}

//
////////////////
// 함수 표현식 //
////////////////
//
// 호이스팅 영향 X
// 재할당 X
// 이 방식을 선호하진 않음
// 일반 상수랑 구분이 힘들어 모듈화하기가 어려움

const myPlus = function (a, b) {
	return a + b;
};

//
////////////////
// 화살표 함수 //
////////////////
//
// **은근 많이씀

// 파라미터 2개
const arrowFnc = (a, b) => a + b;

// 파라미터 1개, 괄호 생략 가능
const arrowFnc2 = a => a;

// 파라미터 X
const arrowFnc3 = () => 'test';

// 처리가 여러줄
const arrowFnc4 = (a, b) => {
	if (a < b) {
		return 'a가 큼';
	} else {
		return 'b가 큼';
	}
};

//
///////////////////
// 즉시 실행 함수 //
///////////////////
//
// 함수의 정의와 동시에 실행
// 있다는것만 알자

const execFnc = (function (a, b) {
	return a + b;
})(5, 6); // 뒤에 아규먼트를 바로 집어넣음

//
///////////////
// 콜백 함수 //
///////////////
//
// 다른 함수의 파라미터로 전달되어 특정 조건에 따라 호출되는 함수
// **조옹나 많이씀

function myCallBack() {
	console.log('myCallBack');
}

function myChkPrint(callback, flg) {
	if (flg) {
		callback(); // 파라미터가 함수면 뒤에 () 붙여야함, 만약 아규먼트가 있다면 위에 추가로 파라미터를 넣어야함
	}
}
// myChkPrint(myCallBack, true)
