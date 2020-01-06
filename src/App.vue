<template>
  <div id="app">

    <router-view/>
  </div>
</template>
<script>
export default {
  name: 'app',

  mounted() {
    if (!this.$session.exists()) {
      this.$session.start();
    }
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
