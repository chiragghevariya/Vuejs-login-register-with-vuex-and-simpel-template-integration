/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

import axios from 'axios';
import VueAxios from 'vue-axios';
  
import VueAuth from '@websanova/vue-auth'; 
import AuthBearer from '@websanova/vue-auth';

import { store } from './store/store.js';
import Notifications from 'vue-notification';
import VueMeta from 'vue-meta';
  
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Notifications);
Vue.use(VueMeta);


Vue.config.productionTip = false
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('common-header', require('./components/CommonHeader.vue').default);
Vue.component('common-footer', require('./components/CommonFooter.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const ifNotAuthenticated = (to, from, next) => {
  if (!store.state.isLoggedIn) {
    next()
    return
  }
  next('/')
}

const ifAuthenticated = (to, from, next) => {
  console.log('check ayth',store.state.isLoggedIn);
  if (store.state.isLoggedIn) {
    next()
    return
  }
  next('/login')
}

const routes = [
  { 
  	name:"Home",
  	path: '/', 
  	component: require('./view/Home.vue').default,
    meta: {
        auth: false
    } 
  },
  { 
  	name:"ContactUs",
  	path: '/contact-us', 
  	component: require('./view/ContactUs.vue').default,
  },
  { 
  	name:"BlogListing",
  	path: '/blog', 
  	component: require('./view/Blog/BlogListing.vue').default,
  },
  { 
  	name:"BlogDetail",
  	path: '/blog/:slug', 
  	component: require('./view/Blog/BlogDetail.vue').default,
  },
  { 
    name:"Login",
    path: '/login', 
    component: require('./view/Login.vue').default,
    beforeEnter: ifNotAuthenticated, 
  },
  { 
    name:"Register",
    path: '/register', 
    component: require('./view/Register.vue').default,
  },
  { 
    name:"Dashboard",
    path: '/dashboard', 
    component: require('./view/Dashboard.vue').default ,
    beforeEnter: ifAuthenticated,
  }
]
 
axios.defaults.baseURL = 'http://localhost/vue-laravel/api';

const router = new VueRouter({
  mode: "history",
  base: 'vue-laravel',
  routes:routes 
})

const app = new Vue({
    el: '#app',
    store,
    router,
    created () {
      
      const userInfo = localStorage.getItem('token');

      if (userInfo) {
        
        axios.defaults.headers.common['Authorization'] = 'Bearer '+userInfo;
         
        const token = userInfo;
        store.dispatch('setUserData',token);
        
      }else{

        delete axios.defaults.headers.common["Authorization"];
      }

      // axios.interceptors.response.use(
      //   response => response,
      //   error => {
      //     console.log(error);
      //     if (error.response.status === 401) {
      //       store.dispatch('logout')
      //     }
      //     return Promise.reject(error)
      //   }
      // )
    }
});

