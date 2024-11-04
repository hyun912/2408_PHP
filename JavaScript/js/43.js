const BTN_CALL = document.querySelector("#btn_call");
BTN_CALL.addEventListener("click", getList);

function getList() {
  const URL = document.querySelector("#url").value;

  // GET
  // 체이닝 메소드 : 뒤에 둘둘이 .으로 연결
  // .then() .catch() : try catch
  axios
    .get(URL)
    .then(response => {
      response.data.forEach(item => {
        // console.log(item.download_url);
        const NEW = document.createElement("img");
        NEW.setAttribute("src", item.download_url);
        NEW.style.width = "200px";
        NEW.style.height = "200px";

        document.querySelector(".container").appendChild(NEW);
      });
    })
    .catch(error => {
      console.log(error);
    });
}
