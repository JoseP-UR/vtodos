import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHashHistory } from 'vue-router'
import { createPinia } from 'pinia'
import routes from './routes'
import CustomAlert from './components/CustomAlert.vue'

const app = createApp(App)

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

app.use(createPinia())
app.use(router);
app.mount('#app')