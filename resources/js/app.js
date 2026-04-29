import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';
import SearchProduk from './components/SearchProduk.vue';

const app = createApp({});
app.component('search-produk', SearchProduk);
app.mount('#app');