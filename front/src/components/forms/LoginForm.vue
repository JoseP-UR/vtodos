<template>
    <h2>Login</h2>
    <form @submit="submitLogin">
        <Input type="text" name="name" label="Username" />
        <Input type="password" name="pass" label="Password" />
        <Button>{{loading ? 'Logging in...' : 'Login'}}</Button>
    </form>
</template>

<script setup lang="ts">
import Input from '../inputs/Input.vue'
import Button from '../inputs/Button.vue'
import { ref } from 'vue'
import { parseForm } from '../composables/parseForm'
import { useUserState } from '../../store/user'
import { useRouter } from 'vue-router'
const userStore = useUserState();
const router = useRouter();
const loading = ref(false);

async function submitLogin(e: Event) {
    e.preventDefault();
    const formData = parseForm(e.target as HTMLFormElement);
    if (loading.value) {
        return;
    }
    loading.value = true;

    const response = await fetch('/api/user/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    });
    const data = await response.json()

    loading.value = false;

    if (!data.error) {
        userStore.name = data.name;
        userStore.uid = data.uid;
        userStore.pass = data.pass;
        router.push('/main');
        return;
    }

    alert(data.error, 'error');
}
</script>

<style lang="sass" scoped>
    form
        display: flex
        flex-direction: column
        align-items: center
        width: 100%
</style>