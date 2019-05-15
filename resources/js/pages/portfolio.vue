<template>
<div class="portfolio">
  <h1>
    Our Work
  </h1>
  <div class="items">
    <v-portfolio-item 
      v-for="illustration in illustrations"
      :key="illustration.id"
      :img="illustration.thumbnail_url" 
      :desc="illustration.description" 
      :title="illustration.title"/>
  </div>
  <div class="request">
    <a href="/request">Request an Illustration</a>
  </div>
</div>
</template>
<script>
export default {
  data:()=>({illustrations: []}),
  async created(){
    const raw = await fetch('/api/illustrations')
    this.illustrations = await raw.json()
  }
}
</script>
<style scoped>
  h1 {
    margin: 1em;
    font-size: 2.5em;
  }
  .items{
    display: flex;
    flex-wrap: wrap;
    overflow: auto;
  }
  a {
    color: white;
  }
  .request {
    position: fixed;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #dd3e3f;
    padding: 0.5em;
    font-size: 1.3em;
    font-weight: bold;
  }
  .request:hover{
    cursor: pointer;
    background-color: #b83d3d;
  }
</style>
