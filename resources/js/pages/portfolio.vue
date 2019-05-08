<template>
<div class="portfolio">
  <v-portfolio-item 
    v-for="illustration in illustrations"
    :key="illustration.id"
    :img="illustration.thumbnail_url" 
    :desc="illustration.description" 
    :title="illustration.title"/>
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
