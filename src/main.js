import { createApp } from 'vue'
import App from './App.vue'
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faCartPlus } from '@fortawesome/free-solid-svg-icons';


import './assets/css/app.css'

import router from './router'

library.add(faCartPlus);

const app = createApp(App)
    app.use(router)
    app.component('font-awesome-icon', FontAwesomeIcon);
    app.mount('#app');