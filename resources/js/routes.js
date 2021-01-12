import Vue from 'vue';
import router from 'vue-router';

import Movies from './views/Movie';
import Login from "./views/Login";
import Home from "./views/Home";
import NotFound from "./views/NotFound";

Vue.use(router);

export default new router({
    mode: 'history',
    routes: [
        {
            path: "*",
            component: NotFound,
        },
        {
            path: "/",
            component: Movies,
            name: "Movies"
        },
        {
            path: "/home",
            component: Home,
            name: "Home"
        },
        {
            path: "/login",
            component: Login,
            name: "Login"
        }
    ]
});
