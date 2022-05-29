<template>
  <div id="app">
    <UploadCSV @result="formatedNames"/>
    <ShowNames v-if="load" :clients="names" />
  </div>
</template>

<script>
import UploadCSV from './components/UploadCSV.vue';
import ShowNames from './components/ShowNames.vue';

export default {
  name: 'App',
  components: {
    UploadCSV,
    ShowNames
  },
  data() {
    return {
      names : [],
      load: false
    }
  },
  methods: {
    formatedNames(value){
      this.names = value;
      this.load = true;
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
