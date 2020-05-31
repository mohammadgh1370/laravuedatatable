// require('./bootstrap');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Vue = require('vue');
window.eventBus = new Vue({});

Vue.component('data-table', () => import('./components/datatable/src/components/DataTable'/* webpackChunkName: "js/components/datatable/src/components/DataTable" */));
Vue.component('flash', () => import('./components/FlashMessage'/* webpackChunkName: "js/components/utils/FlashMessage" */));
Vue.component('image-table-tool-tip', () => import('./components/ImageTableToolTip'/* webpackChunkName: "js/components/utils/ImageTableToolTip" */));
Vue.component('select-search', () => import('./components/SelectSearch'/* webpackChunkName: "js/components/utils/SelectSearch" */));

Vue.component('edit-permission', () => import('./components/admin/EditPermission'/* webpackChunkName: "js/components/admin/EditPermission" */));
Vue.component('edit-role', () => import('./components/admin/EditRole'/* webpackChunkName: "js/components/admin/EditRole" */));
Vue.component('edit-admin', () => import('./components/admin/EditAdmin'/* webpackChunkName: "js/components/admin/EditAdmin" */));
Vue.component('edit-user', () => import('./components/admin/EditUser'/* webpackChunkName: "js/components/admin/EditUser" */));

const app = new Vue({
    el: '#admin',
});
