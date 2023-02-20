import './bootstrap';
import { createApp } from 'vue';

import store from './store'
import router from './router'

const app = createApp({
    el: '#app',
    store:store
});
app.use(router);
app.mount('#app');
