import Vue from 'vue'
import axios from "axios";
import './css/cloak.css';
import moment from "moment";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);
Vue.mixin({
    mounted: function () {
        let event = new Event('mounted', {
            bubbles: true
        });
        let elem = this.$el;
        elem.dispatchEvent(event);
    }
});
window.axios = axios;
window.moment = moment;
window.Vue = Vue;
