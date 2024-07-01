<template>
    <div class="uploadMedia">
      <input type="file" @change="onFileChange">
      <video ref="video" style="display: none;"></video>
      <canvas ref="canvas" style="display: none;"></canvas>
      <img :src="thumbnail" alt="Thumbnail" v-if="thumbnail">
    </div>
</template>
  
<script>
//export default構文によって、コンポネントを様々な場所で使いまわせるようになるらしい
  export default {
    data() {
      return {
        thumbnail: null,
      };
    },
    methods: {
        //file形式のinputの中身が変わったら実行
      onFileChange(event) {
        //以下は引数で渡ってきたいeventのtarget(<input>)のファイル群をfileに代入している
        //かつ、アップロードしたファイルは単一であることが前提
        const file = event.target.files[0];
        //ファイルが存在してそれがvideo(video/mp4,video/oggなど)なら
        if (file && file.type.startsWith('video/')) {
        //渡されたfile オブジェクトから一時的なURL（オブジェクトURL）を生成するためのメソッド
        //URLオブジェクト＝ブラウザのネイティブAPI、createObjectURL(file)はそこから提供されるメソッドで、
        //アップロードされたデータの一時的なURLを作成するらしい
          const url = URL.createObjectURL(file);
        //this.$refs.video は Vue.jsのrefディレクティブを使用してコンポーネントの要素にアクセスする方法
        //これにより、<video>タグのプロパティやメソッドを操作できるらしい
          const video = this.$refs.video;
          //<video>タグのsrc属性に、一時的なビデオファイルの名前をあてはめる
          video.src = url;
          //「ビデオのメタデータ（ビデオの幅、高さ、再生時間など）が読み込まれ、最初のフレームが読み込まれたとき」
          //に、後述のサムネイル生成のメソッドを実行せよ
          //ここで言うthisとは、このvue.jsコンポーネントの事でつまりexport defaultを指している
          video.addEventListener('loadeddata', () => {
            this.generateThumbnail();
          });
        }
      },
      //前述のonFileChangeの最後にて実行
      generateThumbnail() {
        //ビデオとキャンバスDOMを取得
        const video = this.$refs.video;
        const canvas = this.$refs.canvas;
        //getContextメソッドは、キャンバスの描画コンテキストを取得するメソッドで、引数には通常2dかwebglがあてられるらしい
        const context = canvas.getContext('2d');
        //ビデオの再生位置を10秒に設定する。ちなみに以下はvue.jsの機能ではなく、Javascriptの標準的な機能である
        video.currentTime = 2; // 10秒のところをサムネイルにする場合
        //ビデオがシークされた際にイベントを追加
        video.addEventListener('seeked', () => {
        //キャンバスの縦横をビデオサイズに合わせて、
          canvas.width = video.videoWidth;
          canvas.height = video.videoHeight;
          //Canvas APIを使用して、HTML5ビデオ要素の現在のフレームをキャンバス上に描画するためのメソッド
          context.drawImage(video, 0, 0, canvas.width, canvas.height);
          //以下で言うthisは、videoタグの事を指しているのではなく、
          //imgタグで設定したthumbnail要素に、
          this.thumbnail = canvas.toDataURL('image/jpeg');
        });
      }
    }
  };
  </script>

<style scoped>
.uploadMedia {
    padding: 20px;
    border: 1px solid #333;
    border-radius: 5px;
}
</style>