import axios from "axios";
// import router from "../../router"

export default {
  namespaced: true,
  state: () => ({
    boardList: [],
    currentPage: localStorage.getItem('currentPage') ? localStorage.getItem('currentPage') : 1,
    lastPage: localStorage.getItem('lastPage') ? localStorage.getItem('lastPage') : 1,
    links: [],
  }),
  mutations: {
    setBoardList(state, boardList) {
      state.boardList = boardList;
    },
    setCurrentPage(state, currentPage) {
      state.currentPage = currentPage;
    },
    setLinks(state, links) {
      state.links = links;
    },
    setLastPage(state, lastPage) {
      state.lastPage = lastPage;
    },
  },
  actions: {
    /**
     * 게시판 목록
     * 
     * @param {*} context
    */
    boardList(context, page = context.state.currentPage) {
      const url = `/api/boards?page=${page}`;
      const config = {
        headers: {
          'Content-type': 'application/json',
        }
      };

      axios.get(url, config)
      .then(res => {
        // 리스트, 페이지네이션
        context.commit('setBoardList', res.data.boards.data);
        context.commit('setLinks', (res.data.boards.links).slice(1, res.data.boards.links.length -1));

        // 현제 페이지, 마지막 페이지
        localStorage.setItem('currentPage', page);
        localStorage.setItem('lastPage', res.data.boards.last_page);
        context.commit('setCurrentPage', page);
        context.commit('setLastPage', res.data.boards.last_page);

        // console.log(accessPage+ ', '+res.data.boards.last_page);
        // console.log(res.data.boards.links);
      })
      .catch(err => {
        console.error(err);
      });
    },

  },
  getters: {
  }
}