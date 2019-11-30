<template>
    <div class="control-item">
        <font-awesome-icon class="icon" :icon="icon" :color="iconColor" />
        <div class="description">
            <slot></slot>
        </div>
    </div>
</template>


<script>
export default {
    name: 'control-item',
    data() {
        return {
        }
    },
    props: {
        icon: {
            type: Array,
            required: true
        },
        iconColor: {
            type: String,
            default: '#000'
        }
    }
}
</script>

<style lang="sass" scoped>

    .control-item
        border: 1px solid black
        flex-basis: 20%
        text-align: center
        padding: 10px
        background: #fff
        cursor: pointer
        font-size: 20px

        &:hover
            box-shadow: inset 0px 0px 10px -5px #000

        >.icon
            font-size: inherit
        
        >.description
            font-size: inherit
            font-weight: bold
            color: inherit
</style>