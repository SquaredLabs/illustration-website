<template>
  <div class="requests">
    <div class="item header">
      <span class="id">ID</span>
      <span class="netid">netID</span>
      <span class="status">Status</span>
      <span class="time">Last Updated</span>
    </div>
    <div class="item request" 
    v-for="request in requests" 
    :key="request.id" @mouseenter="select(request.id)" @mouseleave="unselect">
      <span class="id">{{request.id}}</span>
      <span class="id">{{request.requestee.netid}}</span>
      <span class="status">{{status[request.status]}}</span>
      <span class="time">{{request.updated_at}}</span>
      <transition name="fade">
      <div class="extras" v-show="selected==request.id">
        <div><p>Description</p><span class="desc">{{request.description}}</span></div>
        <div><p>Deadline</p><span class="deadline">{{request.deadline || 'None'}}</span></div>
        <div><p>KFS</p><span class="kfs">{{request.kfs}}</span></div>
        <div><p>Name</p><span class="kfs">{{request.requestee.name}}</span></div>
        <div><p>Email</p><span class="contact">{{request.requestee.email}}</span></div>
        <div class="button"><button><a :href="`/admin/contract?${request.id}`">Draft Contract</a></button></div>
      </div>
      </transition>
    </div>
  </div>
</template>
<script>
export default {
  data: ()=>({
    requests:[], 
    status: ['New', 'Pending signature', 'Signed off', 'Completed'],
    selected: -1,
    timer: null
  }),
  async created(){
    const response = await fetch('/api/requests')
    if(response.status != 200) {
      console.error(await response.text())
      return alert('Something went wrong')
    }
    this.requests = await response.json()
  },
  methods: {
    select(id){
      this.timer=setTimeout(()=>this.selected=id,200)
    },
    unselect(){
      clearTimeout(this.timer); 
      this.selected= -1
    }
  }
  
}
</script>
<style scoped>
.requests {
  padding: 1em;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.item{
  display: flex;
  justify-content: space-evenly;
  background-color: rgb(240, 240, 240);
  margin: 0.3em 0.5em;
  font-size: 1.1em;
  padding: 1em 0.5em;
  flex-wrap: wrap;
  min-height: 1.5em;
  max-width: 1000px;
  width: 100%;
}
.item:hover{
  min-height: 15em;
  background-color: #dd3e3f;
  color: white;
}
.header:hover{
  min-height: 1.5em;
}
.item > *{
  flex-basis: 20%;
  padding: 0 1em;
}
.header {
  font-weight: bold;
  margin-bottom: 1em;
}
.extras {
  flex-basis: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 1em;
  margin-top: 0;
}
.extras > *{
  flex-basis: 20%;
  padding: 0 1em;
  margin: 0.5em;
}
.extras p {
  font-weight: bold;
  margin: 0;
  margin-bottom: 5px;
}
.button {
  flex-basis: 100%;
  display: flex;
  justify-content: center;
}
button {
  outline: none;
  border: none;
  padding: 0.5em 1em;
  background-color: #ffffff;
  color: #dd3e3f;
  font-size: 1.3em;
  font-weight: bold;
}
button:hover{
  cursor: pointer;
  background-color: hsl(0, 0%, 95%);
}
.fade-enter-active {
  transition: opacity .2s;
}
.fade-leave-active {
  transition: opacity 0s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
