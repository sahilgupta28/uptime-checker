import Vue from 'vue';
import router from './router';
import WebsietList from './components/WebsiteList'

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        WebsietList
    },
    router
});
