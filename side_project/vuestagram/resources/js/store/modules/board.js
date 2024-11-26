import axios from "../../axios";
// import router from "../../router";

export default {
  namespaced: true,
  state: () => ({
    boardList: [],
    page: 0,
  }),
  mutations: {
    setBoardList(state, boardList) {
      state.boardList = boardList;
    },
    setPage(state, page) {
      state.page = page;
    },
  },
  actions: {
    /**
     * 게시글 획득
     * 
     * @param {*} context
    */
    getBoardList(context) {
      const url = `/api/boards?page=${context.getters.getNextPage}`;
      const config = {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('accessToken')}`
        }
      };

      axios.get(url, config)
      .then(res => {
        // console.log(res);
        context.commit('setBoardList', res.data.boardList.data);
        context.commit('setPage', res.data.boardList.current_page);
      })
      .catch(err => {
        console.error(err);
      });

    },
  },
  getters: {
    getNextPage(state) {
      return state.page + 1;
    }
  },
}