require("./bootstrap");
require("./functions.js");

import { createApp } from "vue";
import store from './store';
import router from "./routes.js";
import App from './App.vue';


const app = createApp(App);

app.config.devtools = true

app.use(router);
app.use(store);

app.mount("#app");
