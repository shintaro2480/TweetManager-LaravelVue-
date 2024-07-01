<template>
    <div id="app">
        <!-- @+preventで、デフォルトの挙動を抑える -->
      <div 
        class="drop-area"
        @dragover.prevent
        @drop.prevent="handleDrop"
      >
        ドラッグ＆ドロップでファイルをアップロードしてください
      </div>
      <div v-if="file">
        <component :is="componentType" :file="file"></component>
      </div>
    </div>
  </template>
  
  <script>
  import VideoComponent from './components/VideoComponent.vue';
  import ImageComponent from './components/ImageComponent.vue';
  
  export default {
    data() {
      return {
        file: null,
        componentType: null
      };
    },
    methods: {
      handleDrop(event) {
        const file = event.dataTransfer.files[0];
        this.file = file;
  
        if (file.type.startsWith('video/')) {
          this.componentType = 'VideoComponent';
        } else if (file.type.startsWith('image/')) {
          this.componentType = 'ImageComponent';
        } else {
          this.file = null;
          alert('サポートされていないファイルタイプです');
        }
      }
    },
    components: {
      VideoComponent,
      ImageComponent
    }
  };
  </script>
  
  <style>
  .drop-area {
    width: 300px;
    height: 200px;
    border: 2px dashed #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 20px auto;
  }
  </style>
  