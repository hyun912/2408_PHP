(() => {
  document.querySelectorAll(".my-btn-detail").forEach(node => {
    node.addEventListener("click", e => {
      const URL = "/boards/detail?b_id=" + e.target.value;

      axios
        .get(URL)
        .then(res => {
          const TITLE = document.querySelector("#modalTitle");
          const CONTENT = document.querySelector("#modalContent");
          const IMG = document.querySelector("#modalImg");
          const NAME = document.querySelector("#modalName");

          TITLE.textContent = res.data.b_title;
          CONTENT.textContent = res.data.b_content;
          IMG.setAttribute("src", res.data.b_img);
          NAME.textContent = res.data.u_name;
          NAME.style.fontSize = "0.8rem";
        })
        .catch(err => {
          console.log(err);
        });
    });
  });

  document.querySelector("#btnInsert").addEventListener("click", e => {
    location = "/boards/insert?bc_type=" + e.target.dataset.value;
  });
})();
