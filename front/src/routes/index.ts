import { RouteRecordRaw } from "vue-router"
import Home from '../components/Home.vue'


const routes: RouteRecordRaw[] = [
    {
        path: '/',
        component: Home,
        props: {
            msg: 'oi'
        }
    }
]

export default routes