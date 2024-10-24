console.log('외부');

//////////////
// 변수 선언 //
//////////////
// var : 중복선언 O, 재할당 O, 함수레벨 스코프
// 가능하면 절대 쓰지 말아야함
var num1 = 1; // 최초 선언
var num1 = 2; // 중복 선언
num1 = 3; // 재할당

// let : 중복선언 X, 재할당 O, 블록레벨
let num2 = 2; // 최초 선언
// let num2 = 3; // 중복 선언 불가
num2 = 4; // 재할당

// const : 중복선언 X, 재할당 X, 블록레벨, 상수
const NUM3 = 3;
// NUM3 = 4; // 재할당 불가

////////////
// 스코프 //
////////////
// 변수나 함수가 유효한 범위
// 전역, 지역, 블록 3가지

// 전역 레벨 : 아무곳에서나 접근 가능
let globalScope = '전역 스코프';

function myPrint() {
	// 이곳 함수안이 함수레벨
	console.log(globalScope);
}

// 지역 레벨 : 함수 안에 선언되있는 변수는 함수 내에서만 쓸수있음
function myLocalPrint() {
	let localScope = '지역';
	console.log(localScope);
}

// 블록 레벨 : if나 for같은 중괄호 {} 내에 선언한것은 var말고는 그안에서밖에 쓸수없음
// 보통은 전역 혹은 지역으로만 선언해두고 블록은 안씀, 주의바람
function myBlock() {
	if (true) {
		var test1 = 'var';
		let test2 = 'let'; // if 안에서만 쓸수있음
		const TEST3 = 'const'; // 마찬가지
	}

	console.log(test1);
	console.log(test2); // 안찍힘
	console.log(TEST3); // 안찍힘
}

/////////////
// 호이스팅 //
/////////////
// 인터프리터가 변수와 함수의 메모리 공간을 선언 전에 미리 할당
console.log(test);
test = 'aaa';
console.log(test);
var test; // var만 뒤에 선언하면 방을 미리 잡아둬서 에러없이 출력됨, let와 const는 에러뜸

////////////////
// 데이터 타입 //
////////////////
// number : 숫자
let num = 1;

// string : 문자열
let str = 'test';

// boolean = 논리
let bool = true;

// NULL : 없숴
let non = null;

// undefined : 값이 할당 되지 않은 상태
let letUndefined;

// symbol : 고유하고 변경이 불가능한 값, 쓸일이 거의 없음
let symbol1 = Symbol('aaa'); // === false
let symbol2 = Symbol('aaa'); // 1과 2의 값은 같지만 주소값은 서로 다름

// object : 객체, 키-값 쌍으로 이루어진 복합 데이터 타입
let obj = {
	key1: 'val1',
	key2: 'val2'
};
