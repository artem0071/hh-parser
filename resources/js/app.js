require('./bootstrap');

window.Vue = require('vue');

import TextHighlight from 'vue-text-highlight';
Vue.component('text-highlight', TextHighlight);

Vue.component('searchable-component', require('./components/SearchableComponent.vue'));
Vue.component('item-component', require('./components/ItemComponent.vue'));

const app = new Vue({
    el: '#app'
});
