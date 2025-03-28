// import axios from "axios";
import axios from "../../axios";
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
    setUserInfoBoardsCount(state) {
      state.userInfo.boards_count++;
      localStorage.setItem('userInfo', JSON.stringify(state.userInfo));
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
      // const config = {
      //   headers: {
      //     'content-type' : 'application/json'
      //   }
      // }

      // axios.post(url, data, config)
      axios.post(url, data)
      .then(res => {
        // 토큰 저장
        // context.commit('setAccessToken', res.data.accessToken);
        localStorage.setItem('accessToken', res.data.accessToken);
        localStorage.setItem('refreshToken', res.data.refreshToken);
        localStorage.setItem('userInfo', JSON.stringify(res.data.data));
        context.commit('setAuthFlg', true);
        context.commit('setUserInfo', res.data.data);

        // 메인 페이지로 이동
        router.replace('/boards');
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
      context.dispatch('chkTokenAndContinueProcess', () => {
        const url = '/api/logout';
        const config = {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('accessToken')}`,
          }
        };

        axios.post(url, null, config)
        .then(res => {
          alert('로그아웃 완료');
        })
        .catch(err => {
          alert('문제 발생하여 로그아웃 처리');
        })
        .finally(() => {
          // 로컬 스토리지 초기화
          localStorage.clear();
    
          // state 초기화
          context.commit('setAuthFlg', false);
          context.commit('setUserInfo', {});

          router.replace('/login');
        });
      });
      // axios에서 finally 하고나선 이후처리 안먹힘. 비동기라서
    },
    /**
     * 회원가입 처리
     * 
     * @param {*} context
     * @param {*} userInfo
    */
    registration(context, userInfo) {
      const url = '/api/registration';
      const config = {
        headers: {
          'Content-Type': 'multipart/form-data',
        }
      };

      // form data 세팅
      const formData = new FormData();
      formData.append('account', userInfo.account);
      formData.append('password', userInfo.password);
      formData.append('password_chk', userInfo.password_chk);
      formData.append('name', userInfo.name);
      formData.append('gender', userInfo.gender);
      formData.append('profile', userInfo.profile);

      axios.post(url, formData, config)
      .then(res => {
        alert('회원가입 성공\n가입하신 계정으로 로그인 해주세요.');

        router.replace('/login');
      })
      .catch(err => {
        // console.log(err.response.data);
        alert('회원가입 실패');
      });
    },
    /**
     * 토큰 만료 체크후 재발급
     * 
     * @param {*} context
     * @param {function} callbackProcess
    */
    chkTokenAndContinueProcess(context, callbackProcess) {
      // 페이로드 획득
      const payload = localStorage.getItem('accessToken').split('.')[1];
      const base64 = payload.replace(/-/g, '+').replace('_', '/');
      const objPayload = JSON.parse(atob(base64));
      const now = new Date().getTime();

      if((objPayload.exp * 1000) > now) {
        // 유효한 토큰
        callbackProcess();
      }else {
        // 만료된 토큰
        context.dispatch('reissueAccessToken', callbackProcess);
      }
    },
    /**
     * 토큰 재발급 처리
     * 
     * @param {*} context
     * @param {callback} callbackProcess
    */
    reissueAccessToken(context, callbackProcess) {
      const url = '/api/reissue';
      const config = {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('refreshToken')}`,
        }
      };

      axios.post(url, null, config)
      .then(res => {
        // 토큰 세팅
        localStorage.setItem('accessToken', res.data.accessToken);
        localStorage.setItem('refreshToken', res.data.refreshToken);

        // 후속 처리 진행
        callbackProcess();
      })
      .catch(err => {
        console.error(err);
      });
    },
  },
  getters: {
  },
}