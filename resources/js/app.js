import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// 追加。vueとTestComponentを用意
import { createApp } from 'vue';
import TestComponent from './components/TestComponent.vue';

//createApp()でvue.jsの中身を作り、mount()でid=appの中でマウントすることで、bladeテンプレートの中でvue.jsコンポーネント呼び出せる
const app = createApp({});
app.component('test-component', TestComponent);
app.mount('#app');