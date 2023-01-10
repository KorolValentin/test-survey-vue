import * as vueRouter from 'vue-router';
import routes from './routes_links';
import axios from 'axios';

const router = vueRouter.createRouter({
    history: vueRouter.createWebHistory(),
    routes: routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');

    if(!token) {
        if( to.name === 'login' || to.name === 'registration') {
            return next();
        } else {
            return next({
                name: 'login'
            })
        }
    }

    if((to.name === 'login' || to.name === 'registration') && token) {
        return next({
            name: 'survey'
        })
    }

    return next();
})


export default router;
