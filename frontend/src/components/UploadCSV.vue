<template>
  <div class="hello">
    <!--UPLOAD-->
      <label>File
        <input type="file" @change="handleFileUpload( $event )"/>
      </label>
      <br>
      <button v-on:click="submitFile()">Submit</button>
  </div>
</template>

<script>
import { upload } from '../file-upload.service';

export default {
  name: 'UploadCSV',
  data() {
    return {
      file: ''
    }
  },
  methods: {
    handleFileUpload(event){
      this.file = event.target.files[0];
    },
    submitFile(){
      let formData = new FormData();
      formData.append('file', this.file);
      upload(formData)
      .then(response => {
        this.$emit('result', response.data)
      });
    }
  },
}
</script>
