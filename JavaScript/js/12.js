////////////////
// 함수 선언식 //
////////////////
// 호이스팅 영향 O
// 재할당 O, 함수명 중복 주의
// console.log(mySum(4, 5));

function mySum(a, b) {
	return a + b;
}

////////////////
// 함수 표현식 //
////////////////
// 호이스팅 영향 X
// 재할당 X
// 이 방식을 선호하진 않음
// 일반 상수랑 구분이 힘들어 모듈화하기가 어려움
const myPlus = function (a, b) {
	return a + b;
};

////////////////
// 화살표 함수 //
////////////////
// 은근 많이씀

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
