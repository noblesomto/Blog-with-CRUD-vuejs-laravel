import './bootstrap';
import { createApp } from "vue";
import App from "./App.vue";
import { useStorage } from "@vueuse/core";
import router from "./router/index";
import VueSnip from 'vue-snip';

createApp(App)
    .use(router)
    .use(useStorage)
    .use(VueSnip)
    .mount("#app");