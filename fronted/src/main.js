import { createApp } from 'vue'

import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'

import VueSweetalert2 from 'vue-sweetalert2';
import '@sweetalert2/theme-dark/dark.css';

const app = createApp(App);

// vue create proto-vue-cli2
// https://router.vuejs.org/installation.html#direct-download-cdn
// https://www.npmjs.com/package/vue-axios
// https://www.npmjs.com/package/vue-sweetalert2
// https://github.com/sweetalert2/sweetalert2-themes/tree/master/dark
// https://www.npmjs.com/package/bcryptjs
// https://www.npmjs.com/package/vue-cookies

// npm install --save axios vue-axios
// npm install -S vue-sweetalert2 @sweetalert2/theme-dark
// npm install bcryptjs
// npm install vue-cookies --save

app.use(router);
app.use(VueAxios, axios);
app.use(VueSweetalert2);

app.mount('#app');

