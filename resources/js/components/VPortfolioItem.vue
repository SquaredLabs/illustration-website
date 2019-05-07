<template>
  <div class="item">
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
