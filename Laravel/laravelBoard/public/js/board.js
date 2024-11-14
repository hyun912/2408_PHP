(() => {

  document.querySelectorAll('.my-btn-detail').forEach(node => {
    node.addEventListener('click', e => {
      const URL = '/boards/' + e.target.value;

      axios
        .get(URL)
        .then(res => {
          document.querySelector('#modalTitle').textContent = res.data.b_title;
          document.querySelector('#modalDate').textContent = res.data.created_at;
          document.querySelector('#modalContent').textContent = res.data.b_content;
          document.querySelector('#modalImg').setAttribute('src', res.data.b_img);
        })
        .catch(err => {
          console.log(err);
        });
    });
  });

  // document.querySelector("#btnInsert").addEventListener("click", e => {
  //   location = "/boards/insert?bc_type=" + e.target.dataset.value;
  // });
  
})();
