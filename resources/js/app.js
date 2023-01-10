import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler.js';
import App from "./App.vue";

const appVue = createApp({});
import router from './routes.js';
appVue.use(router);
appVue.component('app', App);
appVue.mount('#app')
