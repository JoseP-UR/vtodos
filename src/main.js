import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import components from './components/globals'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  components,
  render: h => h(App)
}).$mount('#app')
