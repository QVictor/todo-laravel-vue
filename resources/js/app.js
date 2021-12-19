require('./bootstrap');

import Vue from 'vue'
import App from './vue/task/app.vue'
import VueRouter from "vue-router";
import Home from './vue/Home.vue';
import Desk from './vue/desk/desk';

Vue.use(VueRouter);

import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faPlusSquare, faTrash)
Vue.component('font-awesome-icon', FontAwesomeIcon)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/App',
            name: 'app',
            component: App
        },
        {
            path: '/Desk',
            name: 'desk',
            component: Desk
        }
    ]
});

const app = new Vue({
    router,
    el: '#app',
    components: {
        Home, Desk
    }
})
