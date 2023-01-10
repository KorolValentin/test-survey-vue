const routes = [
    {
        name: 'users',
        title: 'Users',
        path: '/users',
        component: () => import('./pages/Users.vue'),
        admin: true,
    },
    {
        name: 'survey',
        title: 'Survey',
        path: '/survey',
        component: () => import('./pages/Survey.vue'),
        admin: false,
    },
    {
        name: 'statistic',
        title: 'Statistic',
        path: '/statistic',
        component: () => import('./pages/Statistic.vue'),
        admin: true,
    },
    {
        name: 'login',
        title: 'Login',
        path: '/login',
        component: () => import('./pages/Login.vue'),
        admin: true,
    },
    {
        name: 'logout',
        title: 'Logout',
        path: '/logout',
        component: () => import('./pages/Logout.vue'),
        admin: true,
    },
    {
        name: 'registration',
        title: 'Registration',
        path: '/registration',
        component: () => import('./pages/Registration.vue'),
        admin: true,
    },
    {
        name: '404',
        title: '404',
        path: '/:pathMatch(.*)*',
        component: () => import('./pages/404.vue'),
        admin: true,
    },
];

export default routes;
