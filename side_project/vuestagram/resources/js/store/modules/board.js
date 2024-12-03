import axios from "../../axios";
import router from "../../router";

export default {
  namespaced: true,
  state: () => ({
    boardList: [],
    page: 0,
    boardDetail: null,
    controllFlg: true,
    lastPageFlg: false,
  }),
  mutations: {
    setBoardList(state, boardList) {
      state.boardList = state.boardList.concat(boardList);
    },
    setPage(state, page) {
      state.page = page;
    },
    setBoardDetail(state, board) {
      state.boardDetail = board;
    },
    setBoardListUnShift(state, board) {
      state.boardList.unshift(board);
    },
    setControllFlg(state, flg) {
      state.controllFlg = flg;
    },
    setLastPageFlg(state, flg) {
      state.lastPageFlg = flg;
    },
  },
  actions: {
    /**
     * 게시글 획득
     * 
     * @param {*} context
    */
    boardList(context) {
      context.dispatch('user/chkTokenAndContinueProcess', () => {
        if(context.state.controllFlg && !context.state.lastPageFlg) { 
          context.commit('setControllFlg', false);

          const url = `/api/boards?page=${context.getters.getNextPage}`;
          const config = {
            headers: {
              'Authorization': `Bearer ${localStorage.getItem('accessToken')}`,
            }
          };

          axios.get(url, config)
          .then(res => {
            context.commit('board/setBoardList', res.data.boardList.data, {root: true});
            context.commit('board/setPage', res.data.boardList.current_page, {root: true});
            
            // 마지막 페이지 일 경우 더이상 요청을 보내지 않도록 플래그 처리
            if(res.data.boardList.current_page >= res.data.boardList.last_page) {
              context.commit('board/setLastPageFlg', true, {root: true});
            }
          })
          .catch(err => {
            console.error(err);
          })
          .finally(() => {
            context.commit('board/setControllFlg', true, {root: true});
          });
        }
      }, {root: true});
    },

    /**
     * 게시글 상세 정보 획득
     * 
     * @param {*} context
     * @param {int} id
    */
    showBoard(context, id) {
      // 토큰 만료시 재발급 체크 후 후속 처리 진행
      context.dispatch('user/chkTokenAndContinueProcess', () => {
        const url = `/api/boards/${id}`;
        const config = {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('accessToken')}`,
          }
        };
  
        axios.get(url, config)
        .then(res => {
          context.commit('board/setBoardDetail', res.data.board, {root: true});
        })
        .catch(err => {
          console.error(err);
        });
      }, {root: true});

    },
    /**
     * 게시글 작성
     * 
     * @param {*} context
     * @param {object} data
    */
    storeBoard(context, data) {
      context.dispatch('user/chkTokenAndContinueProcess', () => {
        if(context.state.controllFlg) {
          context.commit('setControllFlg', false);
          const url = '/api/boards';
          const config = {
            headers: {
              'Content-Type': 'multipart/form-data',
              'Authorization': `Bearer ${localStorage.getItem('accessToken')}`,
            }
          };
          const formData = new FormData();
          formData.append('content', data.content);
          formData.append('file', data.file);
          
          axios.post(url, formData, config)
          .then(res => {
            context.commit('board/setBoardListUnShift', res.data.board, {root: true});
            
            // 3번째 파라미터를 true로 주면 스토어로 가면서 다른 모듈에 접근 가능
            context.commit('user/setUserInfoBoardsCount', null, { root: true }); 
            
            router.replace('/boards');
          })
          .catch(err => {
            console.error(err);
          })
          .finally(() => {
            context.commit('board/setControllFlg', true, {root: true});
          });
        }
      }, {root: true});
    }
  },
  getters: {
    getNextPage(state) {
      return state.page + 1;
    }
  },
}