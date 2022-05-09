<template>
    <h2>Login</h2>
    <form @submit="submitLogin">
        <Input type="text" name="name" label="Username" />
        <Input type="password" name="pass" label="Password" />
        <Button>Login</Button>
    </form>
</template>

<script setup lang="ts">
    import Input from '../inputs/Input.vue'
    import Button from '../inputs/Button.vue'
    import { ref } from 'vue'
    import { parseForm } from '../composables/parseForm'
    
    function submitLogin(e: Event) {
        e.preventDefault();
        const formData = parseForm(e.target as HTMLFormElement);

        console.log(formData);
        fetch('/api/user/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
        })
    }
</script>

<style lang="sass" scoped>
    form
        display: flex
        flex-direction: column
        align-items: center
        width: 100%
</style>