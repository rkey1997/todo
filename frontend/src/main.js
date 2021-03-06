import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify';
import axios from '@/plugins/axios'
import router from "../src/router";

Vue.config.productionTip = false

new Vue({
    vuetify,
    axios,
    router,
    render: h => h(App)
}).$mount('#app')