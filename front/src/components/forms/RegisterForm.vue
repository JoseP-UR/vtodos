<template>
    <h2>Registration</h2>
    <form @submit="submitRegistration">
        <Input type="text" name="name" label="Name" />
        <Input type="email" name="email" label="Email" />
        <Input type="password" name="pass" label="Password" />
        <Button>Register</Button>
    </form>
</template>

<script setup lang="ts">
    import Input from '../inputs/Input.vue'
    import Button from '../inputs/Button.vue'
    import { ref } from 'vue'
    
    function submitRegistration(e: any) {
        console.log(e)
        e.preventDefault()
        const formData = new FormData(e.target)
        console.log(formData)

        console.log(formData.forEach((value: any, key: any) => {
            console.log(value, key)
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