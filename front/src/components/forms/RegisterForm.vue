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
    import { parseForm } from '../composables/parseForm'
    
    function submitRegistration(e: Event) {
        e.preventDefault();
        const formData = parseForm(e.target as HTMLFormElement);

        console.log(formData);
        fetch('/api/user/register', {
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