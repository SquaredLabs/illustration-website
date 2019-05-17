<template>
  <div class="usermanage">
    <div class="search">
      <input type="text" v-model="search" placeholder="Search users"/>
    </div>
    <div class="users">
      <div class="user header">
        <p>ID</p>
        <p>netID</p>
        <p>Name</p>
        <p>Email</p>
      </div>
      <div class="user item" 
      v-for="user in usersFiltered" 
      :key="'user'+user.id" 
      :class="{admin: user.admin}"
      @click="click(user)">
        <p>{{user.id}}</p>
        <p>{{user.netid}}</p>
        <p>{{user.name}}</p>
        <p>{{user.email}}</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({users: [], search: null}),
  async created(){
    const raw = await fetch('/api/users')
    this.users =  await raw.json()
  },
  computed:{
    usersFiltered(){
      let filtered = this.users
      if(this.search==null) filtered = this.users
      else filtered = filtered.filter(item=>item.name.includes(this.search))
      filtered =  filtered.sort((a, b)=> a.id - b.id)
      filtered =  filtered.sort((a, b)=> a.admin ? -1 : 1)
      return filtered
    }
  },
  methods: {
    async click(user){
      if(user.admin){
        if(!confirm(`Are you sure you wish to remove administrator from ${user.name}?`)) return
        let res = await fetch(`/api/admin/remove/${user.id}`)
        alert(await res.text())
      }
      else {
        if(!confirm(`Are you sure you wish to add administrator to ${user.name}?`)) return
        let res = await fetch(`/api/admin/new/${user.id}`)
        alert(await res.text())
      }
      const raw = await fetch('/api/users')
      this.users =  await raw.json()
    }
  }
  
}
</script>
<style scoped>
.search {
  padding: 1em;
  text-align: center;
}
input {
  font-size: 1.6em;
  width: 100%;
  max-width: 1010px;
  padding: 10px;
  outline: none;
  border: none;
  background-color: rgb(240, 240, 240);
  border-bottom: solid black 2px;
}
.users {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 0 2em;
}
.user {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  max-width: 1000px;
  width: 100%;
  margin: 0.3em  0;
  padding: 0 1em;
}
.user.header {
  font-weight: bold;
}

.user.item:hover, .user.admin {
  cursor: pointer;
  background-color: #dd3e3f;
  color: white;
}
.user, .user.admin:hover {
  background-color: rgb(243, 243, 243);
  color: black;
}
.user > * {
  flex-basis: 25%;
  flex-shrink: 2;
}
.user > *:first-child{
  flex-basis: 1em;
  flex-grow: 2;
}
</style>
