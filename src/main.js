import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import components from './components/globals'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import _ from 'lodash'
import vueSession from 'vue-session'


Vue.use(vueSession, { persist: true })
library.add(fas)

Vue.prototype.$_ = _

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false

new Vue({
  router,
  store,
  components,
  render: h => h(App)
}).$mount('#app')
