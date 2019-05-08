<template>
  <div class="item" :style="{flexBasis: `${15+Math.random()*30}%`}">
    <img :src="img"/>
    <h2>{{title}}</h2>
    <p>{{desc}}</p>
  </div>
</template>
<script>
export default {
  props: {
    img: {type: String, required: true},
    title: {type: String, required: true},
    desc: {type: String, required: true},
  }
}
</script>
<style scoped>
  .item {
    background-color: rgb(240,240,240);
    flex: 1 1 26%;
    width: 30vw;
    margin: 0.5em;
    padding: 0.5em;
    box-sizing: border-box;
    box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.2);
  }
  h2 {
    margin: 0;
  }
  p {
    margin: 0;
  }
  img {
    width: 100%;
  }
</style>
