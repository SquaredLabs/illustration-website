<template>
  <div class="form">
    <div class="input">
      <label for="cover">Is this a journal cover illustration request? *</label>
      <input type="radio" name="cover" :value="0" v-model="form.cover" checked> Yes [Free Service]<br>
      <input type="radio" name="cover" :value="1" v-model="form.cover">No [Paid Service]<br>
    </div>
    <div class="input">
      <label for="desc">Provide a brief description of what you would like illustrated:*</label>
      <textarea type="textarea" name="desc" v-model="form.description"/>
    </div>
    <div class="input">
      <label for="desc">Deadline (Optional)</label>
      <v-date-picker @selected="dateParse"/>
    </div>
    <div class="input">
      <label for="journal">If relevant, please provide the name of the journal where the work will be submitted (for the illustrators to work within journal standards).</label>
      <input type="text" v-model="form.kfs"/>
    </div>
    <div class="input">
      <label for="kfs">KFS*</label>
      <input type="text" v-model="form.kfs"/>
    </div>
    <div class="submit">
      <button :disabled="this.error" @click="submit">{{this.error || 'Submit'}}</button>
    </div>
  </div>
</template>
<script>
import VDatePicker from 'vuejs-datepicker'; 
export default {
  components: {
    VDatePicker
  },
  data: ()=>({
    form: {
      cover: 0,
      description: null,
      deadline: null,
      journal: null,
      kfs: null
    },
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute('content')
  }),
  computed:{
    error(){
      if(!this.form.description) return 'Description required'
      if(!this.form.kfs || this.form.kfs.length!=7) return 'Valid KFS required'
      return false
    }
  },
  methods: {
    dateParse(date){
      this.form.deadline = date.toISOString().slice(0, 19).replace('T', ' ');
    },
    async submit(){
      if(this.error) return
      let formData = new FormData()
      for(const key of Object.keys(this.form)){
        formData.append(key, this.form[key])
      }
      console.log(formData)
      const raw = await fetch("/api/request", {
        method: "post",
        headers: {
          Accept: "application/json",
          "X-CSRF-TOKEN": this.csrf
        },
        body: formData
      })
      if (raw.status != 200) {
        const json = await raw.json()
        const text = JSON.stringify(json)
        console.error(text)
        alert(
          "Something went wrong. Please contact SquaredLabs (squaredlabs@uconn.edu)"
        )
      }
      else{
        alert('Successfully Submitted')
        window.location.href="/"
      }
    }
  }
}
</script>
<style scoped>
.form {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.input {
  flex: 1 1 600px;
  max-width: 1000px;
  margin: 1em;
  padding: 0.5em;
  background-color: rgb(236, 236, 236);
}
.input > *{
  margin: 5px
}
.input > label {
  display: block;
  font-size: 1.2em;
}
textarea {
  width: 90%;
  height: 5em;
  border: none;
  background-color: rgb(204, 204, 204);
  padding: 0.5em;
}
.submit {
  flex-basis: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1em;
}
button {
  outline: none;
  border: none;
  padding: 0.5em 1em;
  background-color: #dd3e3f;
  font-size: 1.3em;
  font-weight: bold;
  color: white;
}
button:hover{
  cursor: pointer;
  background-color: #b83d3d;
}
button:disabled{
  cursor: default;
  background-color: grey;
}
</style>
