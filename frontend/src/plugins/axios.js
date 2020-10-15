import Vue from 'vue'
import axios from 'axios'
// import router from '@/router'
// import store from '@/store/'

const config = {
    baseURL: '/api',
    // timeout: 60 * 1000, // Timeout
    withCredentials: true,
}

export const _axios = axios.create(config)



Plugin.install = function(Vue) {
    Vue.axios = _axios
    window.axios = _axios
    Object.defineProperties(Vue.prototype, {
        axios: {
            get() {
                return _axios
            }
        },
        $axios: {
            get() {
                return _axios
            }
        },
    })
}

Vue.use(Plugin)

export default Plugin