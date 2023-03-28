import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from "vue/dist/vue.esm-bundler.js";

// COMPONENTS
import CreatePostComponent from "./components/forms/CreatePostComponent.vue";
import PostimagesComponent from "./components/forms/parts/PostimagesComponent.vue";

window.Alpine = Alpine;

Alpine.start();

createApp({
    components: {
        CreatePostComponent,
        PostimagesComponent,
    }
}).mount('#app');
