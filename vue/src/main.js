import Vue from 'vue'
import axios from "axios";
import axiosHelpers from './helpers/axios.helpers';
import './css/cloak.css';
import './RWD-Table-Patterns/dist/css/rwd-table.min.css';
import './RWD-Table-Patterns/dist/js/rwd-table.min';

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
