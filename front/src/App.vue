<template>
  <router-view></router-view>
  <AlertBox v-if="alert.show"></AlertBox>
</template>

<script setup lang="ts">
 import { useAlertState } from './store/alert';
 import AlertBox from './components/AlertBox.vue';

 const alert = useAlertState();

 window.alert = (message: string, type: string = 'info') => {
   alert.show = true;
   alert.message = message;
   alert.type = type;
 };
</script>

<style>
* {
  margin: 0;
  padding: 0;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  height: 100vh;
  width: 100vw;
  margin: 0;
  padding: 0;
}
</style>
