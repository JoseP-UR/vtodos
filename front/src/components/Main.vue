<template>
    <h1>welcome {{ user.name }}</h1>
</template>

<script setup lang="ts">
import { useUserState } from '../store/user';
import { useRouter } from 'vue-router';
import { onMounted } from 'vue';

const router = useRouter();
const user = useUserState();

onMounted(() => {
    if (!user.uid) {
        router.push('/');
    }

});
</script>