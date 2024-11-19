import { createStore } from "vuex";
import board from './modules/board.js';

// export default = return 
export default createStore({
  modules: {
    board,
  }
});