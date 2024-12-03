import { createRouter, createWebHistory } from "vue-router";
import BoardListComponent from "../views/components/board/BoardListComponent.vue";

const routes = [
  {
    // 메인 리스트
    path: '/',
    redirect: '/boards',
  },
  {
    path: '/boards',
    component: BoardListComponent,
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;