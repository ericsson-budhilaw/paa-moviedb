//require('./bootstrap');

import Vue from 'vue';
import router from './routes';

// Main
import App from './views/app';

new Vue({
    el: '#app',
    router,
    components: { App }
});

// Vue.use(Router);
// export default new Router({
//     routes: [
//         {
//             path: '/',
//             name: 'Movies',
//             components: Movies
//         }
//     ]
// });

// const app = new Vue({
//     el: '#app',
//     components: { App, Router }
// });
