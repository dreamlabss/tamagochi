import Vue from 'vue'

import VueCookies from 'vue-cookies'
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App';

Vue.use(VueAxios, axios);
Vue.use(VueCookies);

import store from './store';

new Vue({
    render: (h) => h(App),
    store
}).$mount('#app')
  