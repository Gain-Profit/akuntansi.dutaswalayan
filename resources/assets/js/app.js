
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('kiraan', require('./components/Kiraan.vue'));

Vue.component('balance', require('./components/Balance.vue'));

Vue.component('neraca', require('./components/Neraca.vue'));

Vue.component('laba', require ('./components/Laba.vue'));

Vue.component('jurnal', require ('./components/Jurnal.vue'));

Vue.component('bukubesar', require ('./components/BukuBesar.vue'));

Vue.component('asset', require ('./components/Asset.vue'));

const app = new Vue({
    el: '#app'
});