<template>
  <div class="contract">
    <h1>[squared labs] Scientific Illustration Client Agreement</h1>
    <h2>Request #{{request.id}}</h2>
    <div class="form">
      <div>
        <h4>KFS:</h4>
        <p><strong>{{request.kfs}}</strong></p>
      </div>
      <div>
        <h4>Scope:</h4>
        <p>
          Based on discussions with 
          <strong>{{request.requestee.name}}</strong>, 
          <strong>{{me.name}}</strong> expects the project to take X hours +- X2.
        </p>
        <p>Agreed upon deadline for 1st draft:</p>
        <p>Agreed upon deadline for 2nd draft:</p>
        <p>Agreed upon deadline for final illustration:</p>
      </div>
      <div>
        <h4>Notes:</h4>
        <p>
          It is the responsibility of the client to respond to 
          drafts within 2 business days. 3 rounds of edits will be the 
          maximum unless there are changes due to an illustrator mistake. 
          Larger changes that modify scope, such as changing the whole layout, 
          changing a majority of the imagery, etc. may either be denied or 
          may necessitate the establishment of a new project. Squared Labs, 
          as well as the illustrator who created the piece, 
          retain the right to use the piece for either advertising or 
          as part of a personal portfolio. Illustrations are created 
          individually for labs. Squared Labs will never give your 
          illustration to another lab or journal to use without prior 
          permission. Upon completion of the illustration, you will receive 
          a JPG, PDF, and (if there is one) an Adobe AI file of the completed 
          work. Originals (in a non-digital medium) will be retained by the 
          illustrator. Clients will be required to provide email confirmation 
          that the work was received. Clients agree to notify Squared Labs upon 
          final public display of the illustration (journal article, website, 
          poster, etc.) and allow Squared Labs to use this information for 
          further promotion of the service (if you take a picture of the 
          illustration in final print that’s even better!) 
        </p>
      </div>
      <div class="button">
        <button v-if="request.status==0"><a :href="`/draft/?${request.id}`">Draft Contract</a></button>
        <button v-if="request.status==1"><a :href="`/sign/?${request.id}`">Sign Contract</a></button>
        <button v-if="request.status==2"><a :href="`/complete/?${request.id}`">Complete Contract</a></button>
        <button v-if="request.status==3"><a href="/admin/requests">Back</a></button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  async created(){
    const reqID = window.location.search.substr(1)
    let res = await fetch(`/api/contract/${reqID}`)
    if(res.status!=200){
      console.error(await res.text())
      return alert('Oops, something went wrong.')
    }
    this.request = await res.json()
    res = await fetch(`/api/me`)
    if(res.status!=200){
      console.error(await res.text())
      return alert('Oops, something went wrong.')
    }
    this.me = await res.json()
  },
  data:()=>({
    request: null,
    me: null
  })
}
</script>
<style scoped>
h1, h2{
  text-align: center;
  margin: 1em 0.5em;
}
.form {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.form > *{
  background-color: rgb(245, 245, 245);
  margin: 0.5em;
  flex: 1 1 40%;
}
h4 {
  font-size: 1.2em;
  background-color: #dd3e3f;
  color: white;
  margin: 0;
  padding: 1em; 
}
p{
  padding: 1em;
  margin:  5px;
}
.button {
  flex-basis: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1em;
  background-color: white;
}
button {
  outline: none;
  border: none;
  padding: 0.5em 1em;
  background-color: #dd3e3f;
  color: white;
  border: solid white 2px;
  font-size: 1.3em;
  font-weight: bold;
}
button:hover{
  cursor: pointer;
  background-color: white;
  color: #dd3e3f;
  border-color: #dd3e3f;
}
a {
  color: inherit;
}
</style>
