import Vue from 'vue'
import Vuex from 'vuex'
import user from './user'
import list from './list'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    ...user,
    ...list
  }
})
