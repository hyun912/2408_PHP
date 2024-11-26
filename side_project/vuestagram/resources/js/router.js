import { createWebHistory, createRouter } from "vue-router";
import LoginComponent from "../views/components/auth/LoginComponent.vue";
import BoardListComponent from "../views/components/board/BoardListComponent.vue";
import BoardCreateComponent from "../views/components/board/BoardCreateComponent.vue";
import UserRegistrationComponent from "../views/components/user/UserRegistrationComponent.vue";
import NotFoundComponent from "../views/components/NotFoundComponent.vue";
import { useStore } from "vuex";

const chkAuth = (to, from, next) => { // 이동할 경로, 라우터 오기전의 경로, 후속 처리 경로
  const store = useStore();
  const authFlg = store.state.user.authFlg;
  const noAuthPassFlg = (to.path === '/' || to.path === '/login' || to.path === '/registration'); // 비 로그인시 접근 가능한 플래그

  if(authFlg && noAuthPassFlg) {
    // 인증 된 유저가 비인증으로 이동할 수 있는 페이지에 접근할 경우 이동
    next('/boards'); 
  }else if(!authFlg && !noAuthPassFlg) {
    // 비인증 유저가 인증으로 이동할 수 없는 페이지에 접근할 경우 이동
    next('/login');
  }else {
    // 그 이외는 정상 접근
    next();
  }
};

const routes = [
  {
    path: '/',
    redirect: '/login',
    beforeEnter: chkAuth,
  },
  {
    path: '/login',
    component: LoginComponent,
    beforeEnter: chkAuth,
  },
  {
    path: '/boards',
    component: BoardListComponent,
    beforeEnter: chkAuth,
  },
  {
    path: '/boards/create',
    component: BoardCreateComponent,
    beforeEnter: chkAuth,
  },
  {
    path: '/registration',
    component: UserRegistrationComponent,
    beforeEnter: chkAuth,
  },
  {
    path: '/:catchAll(.*)',
    component: NotFoundComponent,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;