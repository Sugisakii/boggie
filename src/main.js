import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import VueCarousel from 'vue-carousel';
import axios from 'axios';

Vue.config.productionTip = false

import VueWait from 'vue-wait'
import Notify from 'vue2-notify'
import VueCookies from 'vue-cookies'

Vue.use(VueCookies)
Vue.use(VueCarousel);
Vue.use(VueWait)
Vue.use(Notify, {
	position: "bottom-right",
	visibility: 5000,
	closeButtonClass: "close"
})
Vue.prototype.API = "https://api.sugiweb.ga"

axios.interceptors.response.use(function (response) {
	// Any status code that lie within the range of 2xx cause this function to trigger
	// Do something with response data
	console.log(response.data)
	if (typeof response.data.error == "boolean") {
		if (response.data.error) {
			Vue.$notify(response.data.message, "error");
		}
	}
});

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