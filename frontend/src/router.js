import Vue from 'vue'
import VueRouter from 'vue-router'

import Index from '@/views/Index';
import View from '@/views/View';



Vue.use(VueRouter);

let router = new VueRouter({

    routes: [{
            path: '/',
            name: 'index',
            component: Index,
            props: true,
        },
        {
            path: "/view",
            name: 'view',
            component: View,
            props: true,
        },
    ]

});
export default router;