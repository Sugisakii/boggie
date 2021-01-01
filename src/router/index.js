import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Tienda from '../views/Tienda.vue'
import Noticias from '../views/Noticias.vue'
import Top from '../views/Top.vue'
import Servidores from '../views/Servidores.vue'
import Chat from '../views/Chat.vue'
import Recover from '../views/Recover.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    redirect: '/home',
  },
  {
    path: '/home',
    name: 'Home',
    component: Home
  },
  {
    path: '/servidores',
    name: 'Servidores',
    component: Servidores
  }, {
    path: '/noticias',
    name: 'Noticias',
    component: Noticias
  }, {
    path: '/top',
    name: 'Top',
    component: Top
  }, {
    path: '/tienda',
    name: 'Tienda',
    component: Tienda
  }, {
    path: '/chat',
    name: 'Chat',
    component: Chat
  }, {
    path: '/recover',
    name: 'Recover',
    component: Recover
  }
]

const router = new VueRouter({
  routes
})
export default router
