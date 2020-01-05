<template>
    <div class="Main">
        <h1 class="-title _reduced">Welcome to your main page, {{user.name}}.</h1>
        
        <div class="main-section">
            <div class="controls">
                <a class="-button" @click="logout()">Logout</a>
            </div>

            <div class="task-list">
                <div class="task" v-for="task in tasks" :key="task.id">
                    <div class="header">
                        <span class="date"><b>Created: </b>{{task.dateCreated}}</span>
                        <span class="date"><b>Due: </b>{{task.dueDate}}</span>
                    </div>
                    <div class="body" v-html="task.description"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    name: 'Main',
    data() {
        return {

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
        this.login();
    },
    components: {
    }

}
</script>

<style lang="sass" scoped>
    .Main
        padding: 20px

        >.-title
            margin: 0 auto 10px auto
    

</style>