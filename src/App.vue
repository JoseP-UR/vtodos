<template>
  <div id="app">

    <router-view/>
  </div>
</template>
<script>
export default {
  name: 'app',

  mounted() {
    console.log(this);
    this.$store.commit('list/SET_CONSOLE', 'test')
  }
}
</script>
<style lang="sass">
#app 
  display: block
  font-family: 'Avenir', Helvetica, Arial, sans-serif
  -webkit-font-smoothing: antialiased
  -moz-osx-font-smoothing: grayscale
  text-align: center
  color: #2c3e50
  background: #e85757
  min-height: 100vh

</style>
