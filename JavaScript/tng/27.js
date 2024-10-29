// 원본 유지 오름차순 정렬, 중복값 제거
const ARR1 = [6, 3, 5, 8, 92, 3, 7, 5, 100, 80, 40];
console.log(ARR1);

let resultArr1 = [...ARR1].sort((a, b) => a - b);

// filter, indexOf 이용
console.log(resultArr1.filter((a, b) => resultArr1.indexOf(a) === b));

// Set 이용
// console.log(Array.from(new Set(resultArr1)));

// forEach, includes 이용
// let duplicationArr = [];
// resultArr1.forEach(val => {
//   if (!duplicationArr.includes(val)) {
//     duplicationArr.push(val);
//   }
// });
// console.log(duplicationArr);

// 홀짝 분리 각각 새 배열로 만들기
const ARR2 = [5, 7, 3, 4, 5, 1, 2];
console.log(ARR2.filter(num => num % 2 === 1));
console.log(ARR2.filter(num => num % 2 === 0));
