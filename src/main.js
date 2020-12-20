import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

Vue.config.productionTip = false

import VueWait from 'vue-wait'
import Notify from 'vue2-notify'

import "@/assets/bootstrap/css/bootstrap.min.css"
import "@/assets/css/bootstrap-slider.min.css"
import "@/assets/css/custom.css"
import "@/assets/css/default-skin.css"
import "@/assets/css/flickity.min.css"
import "@/assets/css/goodgames.css"
import "@/assets/css/ionicons.min.css"
import "@/assets/css/photoswipe.css"
import "@/assets/css/styles.css"
import "@/assets/css/summernote-bs4.css"
import "@/assets/css/all.css"

Vue.use(VueWait)
Vue.use(Notify, {
  position: "bottom-right",
  visibility: 5000,
  closeButtonClass: "close"
})

new Vue({
  router,
  store,
  wait: new VueWait({
    useVuex: false,
    vuexModuleName: 'wait',
    registerComponent: true,
    componentName: "v-wait",
    registerDirective: true,
    directiveName: "v-wait",
  }),
  render: h => h(App)
}).$mount('#app')