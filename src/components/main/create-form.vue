<template>
    <div class="create-form">
        <form-container>
            <p class="message" v-if="message.body" :class="'-'+message.type">{{message.body}}</p>
            <a class="close" @click="close()">X</a>
        <h1 class="-title _reduced">Create a new task</h1>
            <input-field label="Due date">
                <input type="date" name="dueDate" id="dueDate" placeholder="Due date" v-model="dueDate">
            </input-field>
            <input-field label="Description">
                <input type="text" name="description" id="description" v-model="description">
            </input-field>
            <a class="-button" @click="create()">{{(isLoading) ? 'Saving...' : 'Create'}}</a>
        </form-container>
    </div>
</template>

<script>
export default {
    name: 'create-form',
    data() {
        return {
            dueDate: '',
            description: '',
            message: {
                type: '',
                body: '',
            },
            isLoading: false
        }
    },
    methods: {
        create() {
            if (!this.dueDate || !this.description) {
                this.message.type = 'error';
                this.message.body = 'Please fill in all the fields';
                return;
            }
            this.message.type = '';
            this.message.body = '';
            let userData = this.$store.state.user.data;
            let payload = { dueDate: this.dueDate, description: this.description, user: { uid: userData.uid, name: userData.name, pass: userData.pass }};

            this.$store.dispatch('list/create', payload).then(res => {
                if(res.data.success) {
                    this.$emit('close');
                }
            });
        },
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