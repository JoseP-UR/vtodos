import { RouteRecordRaw } from "vue-router"
import Home from '../components/Home.vue'
import Main from '../components/Main.vue'


const routes: RouteRecordRaw[] = [
    {
        path: '/',
        component: Home,
    },
    {
        path: '/main',
        component: Main,
    }
]

export default routes