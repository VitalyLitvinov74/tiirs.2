import Vue from 'vue'
import axios from "axios";
import './css/cloak.css';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


Vue.mixin({
    mounted: function () {
        console.log('hello');
        let event = new Event('mounted', {
            bubbles: true
        });
        let elem = this.$el;
        elem.dispatchEvent(event);
    }
});
window.axios = axios;
window.Vue = Vue;
