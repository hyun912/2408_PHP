//////////////////
// 프로미스 객체 //
//////////////////
//

// setTimeout(() => {
//   console.log("A");
//   setTimeout(() => {
//     console.log("B");
//     setTimeout(() => {
//       console.log("C");
//     }, 1000);
//   }, 2000);
// }, 3000);

sleepy("A", 3000)
  .then(() => sleepy("B", 2000))
  .then(() => sleepy("C", 1000));

sleeping(true)
  .then(data => console.log(data))
  .catch(err => console.log(err))
  .finally(console.log("파이널리"));

function sleepy(str, ms) {
  return new Promise(resolve => {
    setTimeout(() => {
      console.log(str);
      resolve();
    }, ms);
  });
}

function sleeping(flg) {
  return new Promise((resolve, reject) => {
    flg ? resolve("성공") : reject("실패");
  });
}
