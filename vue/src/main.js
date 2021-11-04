import Vue from 'vue'
import axios from "axios";
import axiosHelpers from './helpers/axios.helpers';

window.Vue = Vue;
axios.helpers = axiosHelpers;
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
