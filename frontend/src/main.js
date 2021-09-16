import { createApp } from 'vue';
import App from './App.vue';
import Route from './router';

import axios from 'axios';
import VueAxios from 'vue-axios';

import 'bootstrap/dist/js/bootstrap.bundle.min';
import 'startbootstrap-sb-admin-2/css/sb-admin-2.min.css';
import '@fortawesome/fontawesome-free/css/fontawesome.min.css';
import '@fortawesome/fontawesome-free/css/solid.min.css';

const app = createApp(App);
      app.use(Route);
      app.use(VueAxios, axios);
      app.mount('#wrapper');
