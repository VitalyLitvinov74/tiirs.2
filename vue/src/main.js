import Vue from 'vue'
import axios from "axios";
import './css/cloak.css';

window.Vue = Vue;
window.axios = axios;
window.Vue.mixin({
    updated: function () {
        let event = new Event('updated', {
            bubbles: true
        });
        let elem = this.$el;
        elem.dispatchEvent(event);
    }
});
