require('./bootstrap');
window.Vue = require('vue');

Vue.component('flash', () => import('./components/Flash'));

const app = new Vue({
    el: '#user',
});
