<template>
    <div class="Main">
        <create-form v-if="createMode"
        @close="createMode= false"
        ></create-form>
        <h1 class="-title _reduced">Welcome to your main page, {{user.name}}.</h1>
        
        <div class="main-section">
            <div class="controls">
                <a class="-button" @click="createMode = true">New Task</a>
                <a class="-button" @click="logout()">Logout</a>
            </div>

            <div class="task-list">
                <div class="task" v-for="task in tasks" :key="task.id">
                    <div class="header">
                        <span class="date"><b>Created: </b>{{task.dateCreated}}</span>
                        <span class="date"><b>Due: </b>{{task.dueDate}}</span>
                        <a class="-button">Edit</a>
                        <a class="-button">Delete</a>
                    </div>
                    <div class="body" v-html="task.description"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
import createForm from '../components/main/create-form'

export default {
    name: 'Main',
    data() {
        return {
            createMode: false,
        }
    },
    computed: {
        ...mapState({
            tasks: state => state.list.tasks,
            user: state => state.user.data,
        })
    },
    methods: {
        login() {
            if (this.$session.has('name') && this.$session.has('pass')) {
            this.$store.dispatch('user/login', { name: this.$session.get('name'), pass: this.$session.get('pass'), session: true }).then(res => {
                if (res.data.error) {
                    console.error('corrupt session');
                    this.$router.push('/');
                    return;
                }
                this.$store.commit('user/SET_USER_DATA', res.data);
            })
        }
        
        },
        logout() {
            this.$session.clear();
            this.$session.destroy();
            this.$session.start();
            this.$router.push('/');

        }
    },
    mounted() {
        if (!this.$session.has('name') || !this.$session.has('pass')) {
                console.error('please login');
                this.$router.push('/');
        }
        this.login();
    },
    components: {
        createForm
    }

}
</script>

<style lang="sass" scoped>
    .Main
        padding: 20px

        >.-title
            margin: 0 auto 10px auto

        .main-section
            background: white
            padding: 20px
            width: 80%
            margin: auto
            border-radius: 5px

            >.controls
                border: 1px solid black
                display: flex
                border-radius: 5px

                >.-button
                    width: 30%
                    margin: 0
            
            >.task-list
                margin-top: 20px
                border: 1px solid black
                border-radius: 5px
                padding: 10px


                >.task
                    border: 1px solid black
                    margin-top: 15px

                    >.header
                        border-bottom: 1px solid black
                        text-align: left
                        padding: 10px 0
                        background-color: #e8e8e8
                        >.-button
                            height: auto
                            display: inline-block
                            width: 50px
                            margin-left: 15px
                        
                        >.date
                            margin-left: 15px
                            >b
                                font-weight: bold
                    
                    >.body
                        min-height: 40px
                        text-align: left
                        padding: 10px
    

</style>