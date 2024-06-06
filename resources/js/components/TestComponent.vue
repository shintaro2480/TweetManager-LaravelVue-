<template>
  <button v-on:click="counter" class="btn">数字：{{count}}</button>
</template>
 
 
<script>
//export default構文によって、コンポネントを様々な場所で使いまわせるようになるらしい
export default {
  //スコープの中で、dataとmethodを定義する
  data() {
    return {
      count: 1
    }
  },
  methods: {
    counter() {
      this.count++;
    }
  }
}

</script>

//以下はスタイル。scopeは他のコンポネントやグローバルには影響を与えないでね、という意味らしい
<style scoped>
.btn {
    background-color: blue;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
}
</style>