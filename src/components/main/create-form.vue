<template>
    <div class="create-form">
        <form-container>
            <a class="close" @click="close()">X</a>
        <h1 class="-title _reduced">Create a new task</h1>
            <input-field label="Due date">
                <input type="date" name="dueDate" id="dueDate" placeholder="Due date" v-model="dueDate">
            </input-field>
            <input-field label="Description">
                <input type="text" name="description" id="description" v-model="description">
            </input-field>
            <a class="-button">Create</a>
        </form-container>
    </div>
</template>

<script>
export default {
    name: 'create-form',
    data() {
        return {
            dueDate: '',
            description: ''
        }
    },
    methods: {
        close() {

            this.$emit('close')
        }
    }

}
</script>


<style lang="sass" scoped>
    .create-form
        background-color: transparentize(#000000, 0.7)
        position: absolute
        width: 100vw
        height: 100vh
        top: 0
        left: 0

        >.form-container
            >.close
                display: block
                float: right
                text-align: right
                cursor: pointer
                
</style>