const BTN_CALL = document.querySelector("#btn_call");
BTN_CALL.addEventListener("click", getList);

function getList() {
  const URL = document.querySelector("#url").value;
  console.log(URL);
}
