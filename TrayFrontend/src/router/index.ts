import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '@/views/HomeView.vue'
import NotFound from '@/views/NotFound.vue'
import users from '@/views/UserList.vue'
import profile from '@/views/CompleteProfile.vue'

const routes = [
  { path: '/', name: 'home', component: HomeView },
  { path: '/:pathMatch(.*)*', name: 'not-found', component: NotFound },
  { path: '/complete-profile', name: 'profile', component: profile },
  { path: '/users', name: 'users', component: users },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
