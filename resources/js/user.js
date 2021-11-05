require('./bootstrap');

window.Vue = require('vue');

Vue.component('user-master', require('./components/user/UserMaster.vue').default);

import router from './user/router'

import {store} from './common/store/store'

import library from './common/library'

const user = new Vue({
    el: '#user',
    router,
    store,
    data:{
        test: "test for user interface"
    }
});
