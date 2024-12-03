import axios from "axios";
// import router from "../../router"

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
     * 게시판 목록
     * 
     * @param {*} context
    */
    boardList(context) {
      const url = `/api/boards?page=${context.getters.getNextPage}`;
      const config = {
        headers: {
          'Content-type': 'application/json',
        }
      };

      axios.get(url, config)
      .then(res => {
        context.commit('setBoardList', res.data.boards.data);
        context.commit('setPage', res.data.boards.current_page);
        // console.log(res);
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
  }
}