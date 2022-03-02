import Vue from 'vue';
import Search from './components/Search'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 require('./bootstrap');
 
Vue.component('Search' , Search);

const app = new Vue({
    el: '#app',
});
