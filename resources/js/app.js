require('./bootstrap');

require('alpinejs');

window.Vue = require('vue');

Vue.component('character-count', require('./components/CharacterCount.vue').default);
Vue.component('like', )

const app = new Vue({
    el: "#root"
});
