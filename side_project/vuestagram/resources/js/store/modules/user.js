import axios from "axios";
import router from "../../router";

export default {
  namespaced: true,
  state: () => ({
    // accessToken: localStorage.getItem('accessToken') ? localStorage.getItem('accessToken') : '',
    authFlg: localStorage.getItem('accessToken') ? true : false,
    userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {} ,
  }),
  mutations: {
    // setAccessToken(state, accessToken) {
    //   state.accessToken = accessToken;
    //   localStorage.setItem('accessToken', accessToken);
    // },
    setAuthFlg(state, flg) {
      state.authFlg = flg;
    },
    setUserInfo(state, userInfo) {
      state.userInfo = userInfo;
    },
  },
  actions: {
    /**
     * 인증관련
     * 로그인 처리
     * 
     * @param {*} context // 스토어 전체
     * @param {*} userInfo // 보내줄 값
    */
    login(context, userInfo) {
      const url = '/api/login';
      const data = JSON.stringify(userInfo);
      const config = {
        headers: {
          'content-type' : 'application/json'
        }
      }

      axios.post(url, data, config)
        .then(res => {
          // 토큰 저장
          // context.commit('setAccessToken', res.data.accessToken);
          localStorage.setItem('accessToken', res.data.accessToken);
          localStorage.setItem('refreshToken', res.data.refreshToken);
          localStorage.setItem('userInfo', JSON.stringify(res.data.data));
          context.commit('setAuthFlg', true);
          context.commit('setUserInfo', res.data.data);

          // 메인 페이지로 이동
          router.replace('/board');
        })
        .catch(err => {
          let errorMsgList = [];
          const errorData = err.response.data;
          
          if(err.response.status === 422) {
            // 유효성 검사 에러
            if(errorData.data.account) {
              errorMsgList.push(errorData.data.account[0]);
            }

            if(errorData.data.password) {
              errorMsgList.push(errorData.data.password[0]);
            }
          }else if(err.response.status === 401) {
            // 비밀번호 에러
            errorMsgList.push(errorData.msg);
          }else {
            errorMsgList.push('예기치 못한 오류 발생');
          }

          alert(errorMsgList.join('\n'));
        });
    },

    /**
     * 로그아웃 처리
     * 
     * @param {*} context
    */
    logout(context) {
      // TODO : 백엔드 처리 추가

      localStorage.clear(); // 로컬 스토리지 비우기

      // state 초기화
      context.commit('setAuthFlg', false);
      context.commit('setUserInfo', {});

      router.replace('/login');
    },
  },
  getters: {

  },
}