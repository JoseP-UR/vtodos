<template>
  <div class="home-view">
    <h1>Welcome to your todo list!</h1>
    <div class="form" >    
        <LoginForm v-if="activeForm == 'Login'" />
        <RegisterForm v-if="activeForm != 'Login'" />
        <Button @click="toggleForm">{{activeForm == 'Login' ? 'Register' : 'Login'}}</Button>
    </div>
  </div>
</template>

<script setup lang="ts">
import LoginForm from "./forms/LoginForm.vue";
import Button from './inputs/Button.vue';
import RegisterForm from "./forms/RegisterForm.vue";

import { ref } from "vue";

const activeForm = ref("Login");

function toggleForm() {
    activeForm.value = activeForm.value === "Login" ? "Register" : "Login";
}
</script>

<style lang="sass" scoped>
    .home-view
        background-color: #c2dcf5
        height: 100vh
        display: flex
        flex-direction: column
        align-items: center
        justify-content: center

        *
            flex-basis: auto

        h1
            font-size: 2rem
            margin: 1rem 0
        
        .form
            width: 100%
            max-width: 500px
            margin: 0 auto
            display: flex
            flex-direction: column
            align-items: center
            justify-content: center
            padding: 1rem
            border: 1px solid #2c3e50
            border-radius: 5px
            background-color: #fff
            box-shadow: 0 0 5px #2c3e50
            text-align: center
</style>