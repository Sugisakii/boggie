import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    session: null
  },
  mutations: {
    SetSession(state, val) {
      state.session = val
    }
  },
  actions: {
  },
  modules: {
  }
})
