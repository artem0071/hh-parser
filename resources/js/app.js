require('./bootstrap');

window.Vue = require('vue');

Vue.component('searchable-component', require('./components/SearchableComponent.vue'));

const app = new Vue({
    el: '#app'
});
