require('./bootstrap');

import Vue from 'vue';
import router from './router'
import store from './store'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'   

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import animateCss from 'animate.css';
Vue.use(animateCss);

import VueGoodTablePlugin from 'vue-good-table';

// import the styles
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(VueGoodTablePlugin);

import VueTelInput from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css'

Vue.use(VueTelInput)

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'green',
  failedColor: 'red',
  height: '4px'
}) 
import common from './common'
Vue.mixin(common);

Vue.component('mainapp', require('./components/mainapp.vue').default); 
Vue.component('candidates', require('./components/core-members/candidates.vue').default); 
Vue.component('candidate-results', require('./components/results/candidate-results.vue').default); 
Vue.component('vote-results', require('./components/admin-winners/vote-results.vue').default); 
Vue.component('verify', require('./components/register/verify.vue').default); 

const app = new Vue({
    el: '#app',
    router,
    store
})