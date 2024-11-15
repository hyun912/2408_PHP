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
          
          const modalDeleteParent = document.querySelector('#modalDeleteParent');
          modalDeleteParent.textContent = '';

          if(res.data.delete_flg) {
            const newBtn = document.createElement('button');
            newBtn.setAttribute('type', 'button');
            newBtn.setAttribute('class', 'btn btn-danger');
            newBtn.setAttribute('onclick', `boardDestroy(${e.target.value})`);
            newBtn.setAttribute('data-bs-dismiss', 'modal'); // 모달창 닫음
            newBtn.textContent = '삭제';
            modalDeleteParent.appendChild(newBtn);
          }
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

function boardDestroy($id) {
  
  // const url = route('board.destroy', { id:$id });
  const url = '/boards/' + $id;
  
  console.log(url);
  
  axios
    .delete(url)
    .then(res => {
      if(res.data.success) {
        const deleteNode = document.querySelector('#card' + $id);
        deleteNode.remove();
      }else {
        alert('failed delete');
      }
    })
    .catch(err => {
      console.log(err);
      alert('axios error');
    });
}