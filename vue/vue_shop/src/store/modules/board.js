export default {
  namespaced: true, // 모듈화 된 스토어의 네임스페이스 활성화, 무조건 true로 해야 함
  state: () => ({ // 데이터가 저장되는 영역
    count: 0,
    products: [
      { productName: '바지', productPrice: 38000, productContent: '매우 아름다운 바지' } , 
      { productName: '셔츠', productPrice: 38000, productContent: '매우 알록달록 셔츠' } , 
      { productName: '양말', productPrice: 39900, productContent: '매우 비싼 양말' } , 
    ],
    detailProduct: { productName: '', productPrice: 0, productContent: '' },
  }),
  mutations: { // state의 데이터를 수정할 수 있는 함수들을 정의
    addCount(state) {
      state.count++;
    },
    setDetailProduct(state, item) {
      state.detailProduct = item;
    }
  },
  actions: { // 비동기성 비즈니스 로직 함수 정의

  },
  getters: { // 추가처리하여 state의 데이터를 획득하기위한 함수들을 정의
    
  },
};