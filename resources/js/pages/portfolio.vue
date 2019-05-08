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
  .portfolio {

  }
  h1 {
    margin: 1em;
    font-size: 2.5em;
  }
  .items{
    display: flex;
    flex-wrap: wrap;
    overflow: auto;
  }
</style>
