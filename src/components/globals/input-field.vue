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

    .input-field
        margin: 10px auto
        height: auto

        >*
            width: 90%
            margin: auto

        >.label
            display: block
            text-align: left
            margin-bottom: 5px

        >input[type="text"],input[type="password"],input[type="email"],input[type="date"],textarea
            border: 1px solid #DDD
            box-shadow: 0px 0px 4px -2px #000
            border-radius: $borderRadius
            height: 25px

        >.hint
            text-align: left
            font-size: 10px
            display: block
            margin-top: 5px
            padding-left: 5px
        

</style>