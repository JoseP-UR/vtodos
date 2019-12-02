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


        >.message
            width: 45%
            height: 30px
            line-height: 30px
            border-radius: $borderRadius
            background: $primary
            color: #FFFFFF
            font-weight: 500
            font-size: 18px
            text-shadow: 0px 0px 10px 10px black
            margin: auto
            box-shadow: inset 0px 0px 10px -5px black

            &.-error
                background: $danger

            &.-success
                background: $success                
        

    
    @media(min-width: 768px)
        .form-container
            width: 40%
</style>