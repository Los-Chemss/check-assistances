/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../css/vue_modal.css');

window.Vue = require('vue').default;


Vue.component('change_themme', require('./components/ChangeThemmeComponent.vue').default);
Vue.component('content-component', require('./components/Content.vue').default);
Vue.component('profile-component', require('./components/ProfileComponent.vue').default);

Vue.component('customers-component', require('./components/CustomerComponent.vue').default);
Vue.component('asistance-component', require('./components/AssistanceComponent.vue').default);
Vue.component('membership-component', require('./components/MembershipComponent.vue').default);
Vue.component('payment-component', require('./components/PaymentComponent.vue').default);
Vue.component('users-component', require('./components/UsersComponent.vue').default);

Vue.component('products-component', require('./components/ProductComponent.vue').default);
Vue.component('sales-component', require('./components/SaleComponent.vue').default);
Vue.component('purchases-component', require('./components/PurchaseComponent.vue').default);
Vue.component('branches-component', require('./components/BranchComponent.vue').default);



const app = new Vue({
    //el: '#app',
    el: '#main-wrapper',
    data: {
        menu: 0 // default 0

    },
});