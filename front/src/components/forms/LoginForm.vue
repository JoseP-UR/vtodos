<template>
    <h2>Login</h2>
    <form @submit="submitLogin">
        <Input type="email" name="email" label="Email" />
        <Input type="password" name="password" label="Password" />
        <Button>Login</Button>
    </form>
</template>

<script setup lang="ts">
    import Input from '../inputs/Input.vue'
    import Button from '../inputs/Button.vue'
    import { ref } from 'vue'
    
    function submitLogin(e: any) {
        console.log(e)
        e.preventDefault()
        const formData = new FormData(e.target)
        console.log(formData)

        console.log(formData.forEach((value: any, key: any) => {
            
        }))
    }
</script>

<style lang="sass" scoped>
    form
        display: flex
        flex-direction: column
        align-items: center
        width: 100%
</style>