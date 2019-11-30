<template>
    <div class="input-field">
        <label class="label" v-if="label">{{label}}</label>
        <slot></slot>

    </div>
</template>

<script>
export default {
    name: "input-field",
    data() {
        return {
            text: ''
        }
    },
    props: {
        label: {
            type: String
        }
    }
}
</script>

<style lang="sass" scoped>

    $childWidth: 90%

    .input-field
        margin: 10px auto
        height: auto

        >.label
            display: block
            margin: auto
            text-align: left
            width: $childWidth
            margin-bottom: 5px

        >input[type="text"],input[type="password"],input[type="email"],textarea
            border: 1px solid #DDD
            box-shadow: 0px 0px 4px -2px #000
            border-radius: $borderRadius
            width: $childWidth
            height: 25px
        

</style>