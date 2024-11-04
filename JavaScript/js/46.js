// sleepy("A", 3000)
//   .then(() => sleepy("B", 2000))
//   .then(() => sleepy("C", 1000))
//   .catch(() => console.log("error"))
//   .finally(() => console.log("finally"));

test(); // 똑같지만 문법 차이

async function test() {
  try {
    await sleepy("A", 3000);
    await sleepy("B", 2000);
    await sleepy("C", 1000);
  } catch (err) {
    console.log("error");
  } finally {
    console.log("finally");
  }
}

function sleepy(str, ms) {
  return new Promise(resolve => {
    setTimeout(() => {
      console.log(str);
      resolve();
    }, ms);
  });
}
