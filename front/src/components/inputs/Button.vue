<template>
    <button @click="onClick" class="button">
        <slot></slot>
    </button>
</template>

<script setup lang="ts">
    const emits = defineEmits(['click'])
    function onClick(e: any) {
        emits('click', e)
    }
</script>


<style lang="sass" scoped>
    .button
        display: flex
        flex-direction: column
        align-items: center
        justify-content: center
        margin: 0.5rem 0
        padding: 0.5rem
        border: 1px solid #2c3e50
        border-radius: 5px
        background-color: #fff
        box-shadow: 0 0 5px #2c3e50
</style>