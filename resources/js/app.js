import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// 追加。vueとTestComponentを用意
import { createApp } from 'vue';
import TestComponent from './components/TestComponent.vue';
import UploadMedia from './components/UploadMedia.vue';

//createApp()でvue.jsの中身を作り、mount()でid=appの中でマウントすることで、bladeテンプレートの中でvue.jsコンポーネント呼び出せる
const app = createApp({});
app.component('test-component', TestComponent);
app.component('upload-media', UploadMedia);
app.mount('#app');