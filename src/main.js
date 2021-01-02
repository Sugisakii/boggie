import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import VueCarousel from 'vue-carousel';
import axios from 'axios';

import { BootstrapVue } from 'bootstrap-vue'

Vue.config.productionTip = false

import VueWait from 'vue-wait'
import Notify from 'vue2-notify'
import VueCookies from 'vue-cookies'

//import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.use(BootstrapVue)
Vue.use(VueCookies)
Vue.use(VueCarousel);
Vue.use(VueWait)
Vue.use(Notify, {
	position: "bottom-right",
	visibility: 5000,
	closeButtonClass: "close"
})
Vue.prototype.API = "https://api.sugiweb.ga"
Vue.prototype.MenuItems = [
	{
		to: "/home",
		name: "Inicio",
		logged: false,
	},
	{
		to: "/servidores",
		name: "Servidores",
		logged: false,
	},
	{
		to: "/noticias",
		name: "Noticias",
		logged: false,
	},
	{
		to: "/top",
		name: "Top Global",
		logged: false,
	},

	{
		to: "/chat",
		name: "Chat Global",
		logged: true,
	},
	{
		to: "/tienda",
		name: "tienda",
		logged: true,
	},
];

axios.interceptors.response.use(function (response) {
	// Any status code that lie within the range of 2xx cause this function to trigger
	// Do something with response data
	console.log(response.data)
	if (typeof response.data.error == "boolean") {
		if (response.data.error) {
			Vue.$notify(response.data.message, "error");
		}
	}
	return response
});
axios.interceptors.request.use(config => {
	config.withCredentials = true
	return config
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