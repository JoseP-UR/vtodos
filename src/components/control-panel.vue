<template>
    <div class="control-panel">
        <control-item :icon="['fas', 'plus']"  iconColor="#339900">
            New
        </control-item>
    </div>
</template>


<script>
import controlItem from './control-item'

export default {
    name: 'control-panel',
    data() {
        return {
        }
    },
    components: {
        controlItem
    }
}
</script>

<style lang="sass" scoped>

    .control-panel
        border: 1px solid black
        border-radius: $borderRadius
        background: #fff
        box-shadow: inset 0px 0px 12px -3px black
        height: 70px
        margin: auto
        padding: 15px
        text-align: left
        display: flex
        flex-direction: row
        

</style>