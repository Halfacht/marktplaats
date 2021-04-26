require("./bootstrap");
require("./functions.js");

import { createApp } from "vue";
import VueCookies from 'vue3-cookies';
import store from './store';
import router from "./routes.js";
import App from './App.vue';


const app = createApp(App);

app.config.devtools = true

app.use(router);
app.use(store);
app.use(VueCookies)

app.mount("#app");
