<template>
    <div class="form-container">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'form-container',

    
}
</script>

<style lang="sass" scoped>
    .form-container
        border: 1px solid #ddd
        border-radius: $borderRadius
        width: 80%
        margin: 10px auto
        padding: 20px
        background: #fff

        

    
    @media(min-width: 768px)
        .form-container
            width: 40%
</style>