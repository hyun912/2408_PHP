////////////
// 조건문 //
////////////
let num = 1;

if (num === 1) {
	console.log('1st');
} else if (num === 2) {
	console.log('2st');
} else if (num === 3) {
	console.log('3st');
} else {
	console.log('등수외');
}

switch (num) {
	case 1:
		console.log('1st');
		break;
	case 2:
		console.log('2st');
		break;
	case 3:
		console.log('3st');
		break;
	default:
		console.log('순위외');
		break;
}

////////////
// 반복문 //
////////////
for (let i = 2; i <= 9; i++) {
	console.log('** ' + i + '단 **');
	for (let j = 1; j <= 9; j++) {
		console.log(i + ' X ' + j + ' = ' + i * j);
	}
}

// for...in : 모든 객체를 반복, 이런게 있다~
const OBJ2 = {
	key1: 'val1',
	key2: 'val2'
};

for (let key in OBJ2) {
	console.log(OBJ2[key]); // value 가져오기
}

// for...of : 이터러블(key없는 val값만 있는 배열 또는 단일 객체)만 반복
const STR1 = 'Hello';

for (let val of STR1) {
	console.log(val);
}
