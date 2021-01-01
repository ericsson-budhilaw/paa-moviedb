import Vue from 'vue';
import router from 'vue-router';

import Movies from './views/Movie';
import Login from "./views/Login";

Vue.use(router);

export default new router({
    routes: [
        {
            path: "/",
            component: Movies,
            name: "Movies"
        },
        {
            path: "/login",
            component: Login,
            name: "Login"
        }
    ]
});
