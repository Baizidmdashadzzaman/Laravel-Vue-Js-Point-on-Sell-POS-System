/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import router from './router'
import store from './store'

import swal from 'sweetalert2';
window.Swal = swal;

import Print from 'vue-print-nb'
Vue.use(Print);

const app = new Vue({
    el: '#app',
    router:router,
    store:store
});