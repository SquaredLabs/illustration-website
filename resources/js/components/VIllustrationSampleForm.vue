<template>
  <div class="illustration">
    <h1>Upload New Illustration</h1>
    <form>
      <v-picture-input 
        ref="pictureInput"
        width="400" 
        height="400" 
        margin="16" 
        accept="image/jpeg,image/png" 
        size="10" 
        button-class="btn"
        :custom-strings="{
          upload: '<h1>Bummer!</h1>',
          drag: 'Drag or upload an image.'
        }"
        @change="onChange"
        ></v-picture-input>
        <label for="title">Title</label>
        <input v-model="title" type="text" name="title" placeholder="Title"/>
        <label for="description">Description</label>
        <input v-model="description" type="text" name="description" placeholder="Description"/>
        <button @click="submit" type="button">Submit</button>
    </form>
  </div>
</template>
<script>
import VPictureInput from 'vue-picture-input'
export default {
  data: ()=>({
    image: null, 
    title: null, 
    description: null, 
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute('content')
  }),
  components: {
    VPictureInput
  },
  methods: {
    onChange(image){
      if (image) {
        this.image = this.$refs.pictureInput.file
      } else {
        console.log('FileReader API not supported: use the <form>!')
      }
    },
    async submit(){
      console.log('submit')
      let formdata = new FormData()
      formdata.append('image', this.image)
      formdata.append('title', this.title)
      formdata.append('description', this.description)
      const raw = await fetch("/api/illustration", {
        method: "post",
        headers: {
          Accept: "application/json",
          "X-CSRF-TOKEN": this.csrf
        },
        body: formdata
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
        window.location.href = '/admin/home';
      }
    }
  }
}
</script>
