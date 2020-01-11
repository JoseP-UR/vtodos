<template>
    <div class="Main">
        <create-form v-if="createMode"
        @close="update()"
        ></create-form>
        <h1 class="-title _reduced">Welcome to your main page, {{user.name}}.</h1>
        
        <div class="main-section">
            <div class="controls">
                <a class="-button" @click="createMode = true">New Task</a>
                <a class="-button" @click="logout()">Logout</a>
            </div>

            <task-list @update="update()"></task-list>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
import createForm from '../components/main/create-form'
import taskList from '../components/main/task-list'

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
                    return false;
                }
                this.$store.commit('user/SET_USER_DATA', res.data);
                this.update();
                return true;
            })
        }
        
        },
        logout() {
            this.$session.clear();
            this.$session.destroy();
            this.$session.start();
            this.$router.push('/');

        },
        update() {
            this.$store.dispatch('list/fetch', this.$store.state.user.data.uid).then(res => {
                this.$store.commit('list/UPDATE_LIST', res.data);
            });
            this.createMode= false
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
        createForm,
        taskList
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
    

</style>