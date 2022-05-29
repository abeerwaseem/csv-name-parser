<template>
  <div class="hello">
    <h3>Clients</h3>
    <ul class="parent-list" v-for="(client, key) in clients" :key="key">
      <ul class="child-list" v-for="(person, index) in client" :key="index">
        <li >
          Title : {{person.title}}
        </li>
        <li >
          First Name : {{person.first_name}}
        </li>
        <li >
          Initial : {{person.initial}}
        </li>
        <li >
          Last Name : {{person.last_name}}
        </li>
      </ul>
    </ul>
  </div>
</template>

<script>
export default {
  props: ['clients'],
  name: 'ShowNames',
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  width: 600px;
  margin: 0 auto;
  list-style-type: none;
  padding: 0;

}
ul.parent-list{
  border-bottom:  1px solid;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
