<template>
<div class="portfolio-preview">
  <h1>
    Portfolio Items
  </h1>
  <p class="subheader">Newest > Oldest</p>
  <div class="items">
    <div v-for="illustration in illustrations.reverse()"
    :key="'illustration-'+illustration.id" class="item">
      <img :src="illustration.thumbnail_url"/>
      <p><strong>{{illustration.title}}</strong></p>
      <p>{{illustration.description}}</p>
      <button @click="remove(illustration)">Delete</button>
    </div>
  </div>
</div>
</template>
<script>

export default {
  data:()=>({illustrations: []}),
  async created(){
    const raw = await fetch('/api/illustrations')
    this.illustrations = await raw.json()
  },
  methods: {
    async remove(illustration){
      if(!confirm(`Are you sure you want to delete ${illustration.title}?`)) return
      let raw = await fetch(`/api/illustration/delete/${illustration.id}`)
      alert(await raw.text())
      raw = await fetch('/api/illustrations')
      this.illustrations = await raw.json()
    }
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
    flex-direction: column;
    overflow: auto;
  }
  .item {
    background-color: rgb(247, 247, 247);
    margin: 1em;
    padding: 0.5em;
  }
  img {
    max-width: 300px;
  }
  .subheader {
    color: rgb(49, 49, 49);
    margin-left: 2.5em;
    margin-top: -1em;
  }
</style>
