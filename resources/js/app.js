require('./bootstrap');

require('alpinejs');

window.Vue = require('vue');

Vue.component('character-count', require('./components/CharacterCount.vue').default);
Vue.component('post-likes', require('./components/PostLikes.vue').default);

const app = new Vue({
    el: "#root"
});
